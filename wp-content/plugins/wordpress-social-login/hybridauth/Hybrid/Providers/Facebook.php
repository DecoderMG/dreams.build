<?php
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html 
*/

/**
 * Hybrid_Providers_Facebook provider adapter based on OAuth2 protocol
 * 
 * Hybrid_Providers_Facebook use the Facebook PHP SDK created by Facebook
 * 
 * http://hybridauth.sourceforge.net/userguide/IDProvider_info_Facebook.html
 */
class Hybrid_Providers_Facebook extends Hybrid_Provider_Model
{
	// default permissions, and a lot of them. You can change them from the configuration by setting the scope to what you want/need
	public $scope = "email, public_profile, user_about_me, user_birthday, user_hometown, user_website";

	/**
	* IDp wrappers initializer 
	*/
	function initialize() 
	{
		if ( ! $this->config["keys"]["id"] || ! $this->config["keys"]["secret"] ){
			throw new Exception( "Your application id and secret are required in order to connect to {$this->providerId}.", 4 );
		}

		// Need to override package version
		if( class_exists('BaseFacebook', false ) && ! defined( 'GRAPH_API_VERSION' ) ){
			throw new Exception( "Confilict detected. Facebook SDK is already loaded by another package. Initialization failed, exit." );
		}

		require_once realpath( dirname( __FILE__ ) )  . "/../thirdparty/Facebook/base_facebook.php";
		require_once realpath( dirname( __FILE__ ) )  . "/../thirdparty/Facebook/facebook.php";

		if ( isset ( Hybrid_Auth::$config["proxy"] ) ) {
			BaseFacebook::$CURL_OPTS[CURLOPT_PROXY] = Hybrid_Auth::$config["proxy"];
		}

		$trustForwarded = isset( $this->config['trustForwarded'] ) ? (bool) $this->config['trustForwarded'] : false;

		$this->api = new Facebook( ARRAY( 'appId' => $this->config["keys"]["id"], 'secret' => $this->config["keys"]["secret"], 'trustForwarded' => $trustForwarded ) );
	}

	/**
	* begin login step
	* 
	* simply call Facebook::require_login(). 
	*/
	function loginBegin()
	{
		$parameters = array("scope" => $this->scope, "redirect_uri" => $this->endpoint, "display" => "page");
		$optionals  = array("scope", "redirect_uri", "display", "auth_type");

		foreach ($optionals as $parameter){
			if( isset( $this->config[$parameter] ) && ! empty( $this->config[$parameter] ) ){
				$parameters[$parameter] = $this->config[$parameter];
				
				//If the auth_type parameter is used, we need to generate a nonce and include it as a parameter
				if($parameter == "auth_type"){
					$nonce = md5(uniqid(mt_rand(), true));
					$parameters['auth_nonce'] = $nonce;
					
					Hybrid_Auth::storage()->set('fb_auth_nonce', $nonce);
				}
			}
		}

		if( isset( $this->config[ 'force' ] ) && $this->config[ 'force' ] === true ){
			$parameters[ 'auth_type' ]  = 'reauthenticate';
			$parameters[ 'auth_nonce' ] = md5( uniqid( mt_rand(), true ) );

			Hybrid_Auth::storage()->set( 'fb_auth_nonce', $parameters[ 'auth_nonce' ] );
		}

		// get the login url 
		$url = $this->api->getLoginUrl( $parameters );

		// redirect to facebook
		Hybrid_Auth::redirect( $url );
	}

	/**
	* finish login step 
	*/
	function loginFinish()
	{ 
		// in case we get error_reason=user_denied&error=access_denied
		if ( isset( $_REQUEST['error'] ) && $_REQUEST['error'] == "access_denied" ){ 
			throw new Exception( "Authentication failed! The user denied your request.", 5 );
		}

		// in case we are using iOS/Facebook reverse authentication
		if(isset($_REQUEST['access_token'])){
			$this->token("access_token",  $_REQUEST['access_token'] );
			$this->api->setAccessToken( $this->token("access_token") );
			$this->api->setExtendedAccessToken();
			$access_token = $this->api->getAccessToken();

			if( $access_token ){
				$this->token("access_token", $access_token );
				$this->api->setAccessToken( $access_token );
			}

			$this->api->setAccessToken( $this->token("access_token") );
		}

		// if auth_type is used, then an auth_nonce is passed back, and we need to check it.
		if(isset($_REQUEST['auth_nonce'])){
			
			$nonce = Hybrid_Auth::storage()->get('fb_auth_nonce');
			
			//Delete the nonce
			Hybrid_Auth::storage()->delete('fb_auth_nonce');
			
			if($_REQUEST['auth_nonce'] != $nonce){
				throw new Exception( "Authentication failed! Invalid nonce used for reauthentication.", 5 );
			}
		}

		// try to get the UID of the connected user from fb, should be > 0 
		if ( ! $this->api->getUser() ){
			throw new Exception( "Authentication failed! {$this->providerId} returned an invalid user id.", 5 );
		}

		// set user as logged in
		$this->setUserConnected();

		// store facebook access token 
		$this->token( "access_token", $this->api->getAccessToken() );
	}

	/**
	* logout
	*/
	function logout()
	{ 
		$this->api->destroySession();

		parent::logout();
	}

	/**
	* setAccessToken
	*/
	function setAccessToken()
	{ 

		if ( $this->token("access_token") ) {
			$this->api->setAccessToken( $this->token("access_token") );
			$this->api->setExtendedAccessToken();
			$access_token = $this->api->getAccessToken();

			if( $access_token ){
				$this->token("access_token", $access_token );
				$this->api->setAccessToken( $access_token );
			}

			$this->api->setAccessToken( $this->token("access_token") ); 
		}
	}

	/**
	* load the user profile from the IDp api client
	*/
	function getUserProfile()
	{
		// request user profile from fb api
		try{ 
			$this->setAccessToken();

			$fields = array(
				'id', 'name', 'first_name', 'last_name', 'link', 'website', 
				'gender', 'locale', 'about', 'email', 'hometown', 'location',
				'verified'
			);

			$data = $this->api->api('/me?fields=' . implode(',', $fields));
		}
		catch( FacebookApiException $e ){
			throw new Exception( "User profile request failed! {$this->providerId} returned an error", 6 );
		} 

		// if the provider identifier is not received, we assume the auth has failed
		if ( ! isset( $data["id"] ) ){ 
			throw new Exception( "User profile request failed! {$this->providerId} api returned an invalid response.", 6 );
		}

		# store the user profile.
		$this->user->profile->identifier    = (array_key_exists('id',$data))?$data['id']:"";
		$this->user->profile->username      = (array_key_exists('username',$data))?$data['username']:"";
		$this->user->profile->displayName   = (array_key_exists('name',$data))?$data['name']:"";
		$this->user->profile->firstName     = (array_key_exists('first_name',$data))?$data['first_name']:"";
		$this->user->profile->lastName      = (array_key_exists('last_name',$data))?$data['last_name']:"";
		$this->user->profile->photoURL      = "https://graph.facebook.com/" . $this->user->profile->identifier . "/picture?width=150&height=150";
		$this->user->profile->profileURL    = (array_key_exists('link',$data))?$data['link']:""; 
		$this->user->profile->webSiteURL    = (array_key_exists('website',$data))?$data['website']:""; 
		$this->user->profile->gender        = (array_key_exists('gender',$data))?$data['gender']:"";
        $this->user->profile->language      = (array_key_exists('locale',$data))?$data['locale']:"";
		$this->user->profile->description   = (array_key_exists('about',$data))?$data['about']:"";
		$this->user->profile->email         = (array_key_exists('email',$data))?$data['email']:"";
		$this->user->profile->region        = (array_key_exists("hometown",$data)&&array_key_exists("name",$data['hometown']))?$data['hometown']["name"]:"";

		if( array_key_exists('verified',$data ) && $data['verified'] == 1 ){
			$this->user->profile->emailVerified = $this->user->profile->email;
		}

		if(!empty($this->user->profile->region )){
			$regionArr = explode(',',$this->user->profile->region );
			if(count($regionArr) > 1){
				$this->user->profile->city = trim($regionArr[0]);
				$this->user->profile->country = trim($regionArr[1]);
			}
		}

		if( array_key_exists('birthday',$data) ) {
			list($birthday_month, $birthday_day, $birthday_year) = explode( "/", $data['birthday'] );

			$this->user->profile->birthDay   = (int) $birthday_day;
			$this->user->profile->birthMonth = (int) $birthday_month;
			$this->user->profile->birthYear  = (int) $birthday_year;
		}

		return $this->user->profile;
 	}

	/**
	* load the user contacts
	*/
	function getUserContacts()
	{
		$apiCall = '?fields=link,name,email';
		$returnedContacts = array();
		$pagedList = false;

		do {
			try{ 
				$this->setAccessToken();

				$response = $this->api->api('/me/friends' . $apiCall); 
			}
			catch( FacebookApiException $e ){
				throw new Exception( 'User contacts request failed! {$this->providerId} returned an error' );
			} 

			// Prepare the next call if paging links have been returned
			if (array_key_exists('paging', $response) && array_key_exists('next', $response['paging'])) {
				$pagedList = true;
			        $next_page = explode('friends', $response['paging']['next']);
			        $apiCall = $next_page[1];
			}
			else{
				$pagedList = false;
			}

			// Add the new page contacts
			$returnedContacts = array_merge($returnedContacts, $response['data']);
		}
		while ($pagedList == true);

		$contacts = ARRAY();
 
		foreach( $returnedContacts as $item ){
			$uc = new Hybrid_User_Contact();

			$uc->email  = (array_key_exists("email",$item))?$item["email"]:"";
			$uc->identifier  = (array_key_exists("id",$item))?$item["id"]:"";
			$uc->displayName = (array_key_exists("name",$item))?$item["name"]:"";
			$uc->profileURL  = (array_key_exists("link",$item))?$item["link"]:"https://www.facebook.com/profile.php?id=" . $uc->identifier;
			$uc->photoURL    = "https://graph.facebook.com/" . $uc->identifier . "/picture?width=150&height=150";

			$contacts[] = $uc;
		}

		return $contacts;
 	}

    /**
    * update user status
	*
	* @param  string $pageid   (optional) User page id
    */
    function setUserStatus( $status, $pageid = null )
    {
        if( !is_array( $status ) ){
            $status = array( 'message' => $status );
        }

        if( is_null( $pageid ) ){
            $pageid = 'me';

        // if post on page, get access_token page
        }else{
            $access_token = null;
            foreach( $this->getUserPages( true ) as $p ){
                if( isset( $p[ 'id' ] ) && intval( $p['id'] ) == intval( $pageid ) ){
                    $access_token = $p[ 'access_token' ];
                    break;
                }
            }

            if( is_null( $access_token ) ){
                throw new Exception( "Update user page failed, page not found or not writeable!" );
            }

            $status[ 'access_token' ] = $access_token;
        }

        try{ 
            $this->setAccessToken();

            $response = $this->api->api( '/' . $pageid . '/feed', 'post', $status );
        }
        catch( FacebookApiException $e ){
            throw new Exception( "Update user status failed! {$this->providerId} returned an error: $e" );
        }

        return $response;
    }

	/**
	* load the user latest activity  
	*    - timeline : all the stream
	*    - me       : the user activity only  
	*/
	function getUserActivity( $stream )
	{
		try{
			$this->setAccessToken();

			if( $stream == "me" ){
				$response = $this->api->api( '/me/feed' ); 
			}
			else{
				$response = $this->api->api('/me/home'); 
			}
		}
		catch( FacebookApiException $e ){
			throw new Exception( "User activity stream request failed! {$this->providerId} returned an error: $e" );
		} 

		if( ! $response || ! count(  $response['data'] ) ){
			return ARRAY();
		}

		$activities = ARRAY();

		foreach( $response['data'] as $item ){
			if( $stream == "me" && $item["from"]["id"] != $this->api->getUser() ){
				continue;
			}

			$ua = new Hybrid_User_Activity();

			$ua->id                 = (array_key_exists("id",$item))?$item["id"]:"";
			$ua->date               = (array_key_exists("created_time",$item))?strtotime($item["created_time"]):"";

			if( $item["type"] == "video" ){
				$ua->text           = (array_key_exists("link",$item))?$item["link"]:"";
			}

			if( $item["type"] == "link" ){
				$ua->text           = (array_key_exists("link",$item))?$item["link"]:"";
			}

			if( empty( $ua->text ) && isset( $item["story"] ) ){
				$ua->text           = (array_key_exists("link",$item))?$item["link"]:"";
			}

			if( empty( $ua->text ) && isset( $item["message"] ) ){
				$ua->text           = (array_key_exists("message",$item))?$item["message"]:"";
			}

			if( ! empty( $ua->text ) ){
				$ua->user->identifier   = (array_key_exists("id",$item["from"]))?$item["from"]["id"]:"";
				$ua->user->displayName  = (array_key_exists("name",$item["from"]))?$item["from"]["name"]:"";
				$ua->user->profileURL   = "https://www.facebook.com/profile.php?id=" . $ua->user->identifier;
				$ua->user->photoURL     = "https://graph.facebook.com/" . $ua->user->identifier . "/picture?type=square";

				$activities[] = $ua;
			}
		}

		return $activities;
 	}
}
