window.fbAsyncInit = function() {
  console.log('Facebook Loaded - IDSocial');
  FB.init({
    appId      : idsocial_fb_app_id,
    xfbml      : true,
    version    : 'v2.0'
  });
  if (idsocial_logged_in !== '1') {
    idsocial_fblogin_check();
  }
};
function fb_login() {
    FB.login( function(response) {idsocial_fblogin_callback(response)}, { scope: 'email, user_friends, public_profile' } );
}
(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));