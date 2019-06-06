<?php

function nature_newsletter_shortcode() {
	global $artabaz_nature;
	$return = '
		<!-- row -->
		<div class="row">';
		if(!$artabaz_nature['subscribe_use_mailchimp']){
		$return .= '<form action="'.plugins_url().'/nature/template/inc/newsletter.php" method="post" class="subscribe-form" id="subscribe-form">
				<input type="email" name="email" class="subscribe-input" placeholder="'.$artabaz_nature['subscribe_email_field_label'].'"  required>
				<button type="submit" class="subscribe-submit submit">'.$artabaz_nature['subscribe_button_label'].'</button>
			</form>';
		}
		else{
			$return .= '
			
			<div class="row" id="mailchimp">
				<form role="form" action="http://'.$artabaz_nature['mailchimp_your_name'].'.us'.$artabaz_nature['mailchimp_server'].'.list-manage.com/subscribe/post-json?u='.$artabaz_nature['mailchimp_your_id'].'&amp;id='.$artabaz_nature['mailchimp_form_id'].'&amp;c=?" method="post" class="mailchimp" autocomplete="off">
					<input type="email" name="EMAIL" class="col-sm-9 col-md-10 col-lg-10" placeholder="'.$artabaz_nature['subscribe_email_field_label'].'"  required>
					<button type="submit" class="col-sm-3 col-md-2 col-lg-2 button-large white-border submit" name="subscribe">'.$artabaz_nature['subscribe_button_label'].'</button>
				</form>
				
				<!-- /END SUBSCRIBE FORM -->
				<div class="message hide"></div>
				<div class="waiting">
					<div class="arrow_sec"></div>
					<div class="arrow_min"></div>
				</div>
			</div>
			';
		}
		$return .= '
		<div class="message hide"></div>
			<div class="waiting">
				<div class="arrow_sec"></div>
				<div class="arrow_min"></div>
			</div>
		</div>
		<!-- end row -->

		
	';
	return $return;
}

function nature_team_shortcode() {
	global $artabaz_nature;
	if(empty($artabaz_nature['team_boxes']) || count($artabaz_nature['team_boxes']) < 1) {
		return;
	}
$team_info = array_values($artabaz_nature['team_boxes']);
for ($i=0, $cnt = count($team_info); $i < $cnt; $i++) {
	$teams = $team_info[$i];
	$return .='
		<!-- Team box -->
		<div class="three-column">
		<div class="team">
			<a class="entry-image"><img alt="team" src="'.$teams['image'].'"></a>
			<div class="entry-team">
				<div class="content-team">
					'.$teams['title'].'
					'.$teams['description'].'
				</div>
			</div>
		</div>
		</div>
		<!-- end Team box -->
	';
	}		
	return '
		<!-- row -->
			<div class="row">
			'.$return.'
			</div>
		<!-- end row -->
	';
}
function nature_social_shortcode() {
	global $artabaz_nature;
		
	if(empty($artabaz_nature['social_link']) || count($artabaz_nature['social_link']) < 1) {
		return;
	}
	$social_info = array_values($artabaz_nature['social_link']);
	if(empty($artabaz_nature['social_link'][0]['title'])) {
		return;
	}
	$html = '<!-- row -->
			<div class="row">
				<!-- social icon -->
				<div class="social">';
	for ($i=0, $cnt = count($social_info); $i < $cnt; $i++) {
		$item = $social_info[$i];
		$html .= '<a href="'.$item['url'].'" class="social-icon" title="'.htmlspecialchars($item['title']).'"><i class="fa '.$item['select'].'"></i></a>'."\n";
	}
	
	return $html.'</div>
				<!-- end social icon -->
			</div>
			<!-- end row -->';
}
function nature_subscribe_form_shortcode() {
	global $artabaz_nature;
	return '
			<div class="row">
				<!-- countdown timer -->
				<div class="countdown">
					<div class="four-column"><span class="ce-days"></span> <span class="ce-days-label"></span></div>
					<div class="four-column"><span class="ce-hours"></span> <span class="ce-hours-label"></span></div>
					<div class="four-column"><span class="ce-minutes"></span> <span class="ce-minutes-label"></span></div>
					<div class="four-column"><span class="ce-seconds"></span> <span class="ce-seconds-label"></span></div>
				</div>
				<!-- end countdown timer -->
			</div>
	';
}
function nature_count_down_counter_shortcode() {
	global $artabaz_nature;
	return '
			<div class="row">
				<!-- countdown timer -->
				<div class="countdown">
					<div class="four-column"><span class="ce-days"></span> <span class="ce-days-label"></span></div>
					<div class="four-column"><span class="ce-hours"></span> <span class="ce-hours-label"></span></div>
					<div class="four-column"><span class="ce-minutes"></span> <span class="ce-minutes-label"></span></div>
					<div class="four-column"><span class="ce-seconds"></span> <span class="ce-seconds-label"></span></div>
				</div>
				<!-- end countdown timer -->
			</div>
	';
}
function nature_count_down_icon_shortcode() {
	global $artabaz_nature;
	return '
			<div class="row">
				<div class="large-icon">
					<i class="fa '.$artabaz_nature['countdown_icon'].'"></i>
				</div>
			</div>
	';
}
function nature_blog_icon_shortcode() {
	global $artabaz_nature;
	return '
			<div class="row">
				<div class="large-icon">
					<i class="fa '.$artabaz_nature['blog_icon'].'"></i>
				</div>
			</div>
	';
}
function nature_subscribe_icon_shortcode() {
	global $artabaz_nature;
	return '
			<div class="row">
				<div class="large-icon">
					<i class="fa '.$artabaz_nature['subscribe_icon'].'"></i>
				</div>
			</div>
	';
}

function nature_service_page_boxes_shortcode() {
	global $artabaz_nature;
	$return = '';
	$return .= '
	<!-- row -->
	<div class="row">
		<!-- left icon box -->
		<div class="two-column">
	';
	for($i=0;$i<5;$i++){
		if(!empty($artabaz_nature['lplc_Box_'.$i.'_title'])){
			$return .= '
				<div class="iconbox rtl">
					<div class="icon">
						<i class="fa '.$artabaz_nature['lplc_Box_'.$i.'_icon'].'"></i>
					</div>
					<div class="content">
						<h3>'.$artabaz_nature['lplc_Box_'.$i.'_title'].'</h3>
						<p>'.$artabaz_nature['lplc_Box_'.$i.'_desc'].'
						</p>
					</div>
				</div>
		';
		}
	}
	$return .= '
		</div>
		<!-- end left icon box -->
		
		<!-- right icon box -->
		<div class="two-column">
	';
	for($i=0;$i<5;$i++){
		if(!empty($artabaz_nature['lprc_Box_'.$i.'_title'])){
			$return .= '
				<div class="iconbox">
					<div class="icon">
						<i class="fa '.$artabaz_nature['lprc_Box_'.$i.'_icon'].'"></i>
					</div>
					<div class="content">
						<h3>'.$artabaz_nature['lprc_Box_'.$i.'_title'].'</h3>
						<p>'.$artabaz_nature['lprc_Box_'.$i.'_desc'].'
						</p>
					</div>
				</div>
		';
		}
	}
	$return .= '
			</div>
			<!-- end right icon box -->
		</div>
		<!-- end row -->
	';
	return $return;
}

function nature_text_slider_shortcode() {
	global $artabaz_nature;
	if(empty($artabaz_nature['text_slider'])){
		return;
	}
	$return = '
			<!-- slider -->
			<div id="textslider">
				<ul class="slides-container">
					';
					foreach($artabaz_nature['text_slider'] as $ts){
					$return .='
						<li>
							<div class="middle"><h1>'.$ts.'</h1></div>
						</li>';
					}
				$return .='
				</ul>
			</div>
			<!-- end slider -->
	';
	return $return;
}
function nature_description_shortcode() {
	global $artabaz_nature;
	if(empty($artabaz_nature['coming_soon_html'])){
		return;
	}
	$itagpos = strpos($artabaz_nature['coming_soon_html'] , "></i>");
	$coming_soon_html = substr_replace($artabaz_nature['coming_soon_html'], 'data-direction="up"' , $itagpos , 0);
	return '
			<!-- description -->
			'.$coming_soon_html.'
			<!-- end description -->
	';
}
function nature_logo_shortcode() {
	global $artabaz_nature;
	if(empty($artabaz_nature['logo_type'])){
		return;
	}
	else if($artabaz_nature['logo_type']=="title"){
		return '
				<!-- logo -->
				<div id="logo">
					<h1>'.$artabaz_nature['logo_title'].'</h1>
					<p>'.$artabaz_nature['logo_desc'].'</p>
				</div>
				<!-- end logo -->
		';
	}
	else if($artabaz_nature['logo_type']=="image"){
		return '
				<!-- logo -->
				<div id="logo">
					<img src="'.$artabaz_nature['logo_image']['url'].'" alt="logo"/>
					<p>'.$artabaz_nature['logo_desc'].'</p>
				</div>
				<!-- end logo -->
		';
	}
	else{
		return;
	}
}
function nature_info_shortcode() {
	global $artabaz_nature;
	return '
			<!-- row -->
			<div class="row">
				<!-- contact details -->
				<div class="contact-detail">
					<div class="three-column">
						<i class="fa '.$artabaz_nature['Info_Box_1_icon'].'"></i>
						<p>'.$artabaz_nature['Info_Box_1_text'].'</p>
					</div>
					<div class="three-column">
						<i class="fa '.$artabaz_nature['Info_Box_2_icon'].'"></i>
						<p>'.$artabaz_nature['Info_Box_2_text'].'</p>
					</div>
					<div class="three-column">
						<i class="fa '.$artabaz_nature['Info_Box_3_icon'].'"></i>
						<p>'.$artabaz_nature['Info_Box_3_text'].'</p>
					</div>
				</div>
				<!-- end contact details -->
			</div>
			<!-- end row -->
	';
}
function nature_contact_form_shortcode() {
	global $artabaz_nature;
	return '
		<!-- row -->
		<div class="row">
			<form class="contact-form" novalidate="" id="contactForm">
				<div class="two-column">
					<input type="text" id="contactName" name="name" placeholder="'.$artabaz_nature['contact_name_field_label'].'" class="text">
					<input type="email" id="contactEmail" name="email" placeholder="'.$artabaz_nature['contact_email_field_label'].'" class="email">
					<input type="text" id="contactPhone" name="phonenumber" placeholder="'.$artabaz_nature['contact_phone_field_label'].'" class="text">
				</div>
				<div class="two-column">
					<textarea id="contactMessage" placeholder="'.$artabaz_nature['contact_message_field_label'].'" name="message" class="textarea"></textarea>
				</div>
				<button class="submit white-border" data-hover="Send message">'.$artabaz_nature['contact_button_label'].'</button>
			</form>
			<!-- contact message -->
			<div class="message hide">
				'.$artabaz_nature['contact_success_msg'].'
			</div>
			<!-- end contact message -->
			<div class="waiting">
				<div class="arrow_sec"></div>
				<div class="arrow_min"></div>
			</div>
		</div>
		<!-- end row -->
	';
}
function nature_blog_shortcode() {
	global $artabaz_nature;
	global $wp_query;
	
	$postid = $wp_query->post->ID;
	
	
	$post_count= $artabaz_nature['post_count'];
	$post_type= $artabaz_nature['post_type'];
	$post_category= $artabaz_nature['post_category'];
	if($artabaz_nature['post_type']=="post"){ 
		$args = array('category' => ''.$post_category.'', 'numberposts' => $post_count,'post_type' => ''.$post_type.'', 'post_status' => 'publish');
	} else {
		$args = array('numberposts' => $post_count,'post_type' => ''.$post_type.'', 'post_status' => 'publish');	
	};
	$recent_posts = wp_get_recent_posts($args);
	foreach( $recent_posts as $recent ){
		$src =   wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ),  '' );
		$content_post .=  '
		<!-- row -->
		<div class="blogpost">
			<h4><a class="popup-modal" href="#modal-' .$recent["ID"] . '">' .$recent["post_title"].'</a></h4> 
			<h6>' .get_the_date('Y/m/d',$recent["ID"]) .'&nbsp;&nbsp;&bull;&nbsp;&nbsp;' .$recent["comment_count"].' Comment</h6>
		</div>
		<div class="mfp-hide blog-post" id="modal-' .$recent["ID"]. '">
			<div class="col">';
			$content_post .= '';
			$content_post .=  '</div>
			<div class="col" style="width: 100%;">
				<div class="content">
					<h1>' .$recent["post_title"].'</h1>
					<p>' .$recent["post_content"].'</p>
				</div>
			</div>
			<div class="clearfix"></div>
			<button title="close" class="mfp-close"><i class="fa fa-times"></i></button>
		</div>
		';
	}
	return '
		<!-- row -->
			<div class="row">
			'.$content_post.'
			</div>
		<!-- end row -->
	';
}

function nature_register_shortcode(){
	add_shortcode( 'nature-subscribe-form', 'nature_newsletter_shortcode' );
	add_shortcode( 'nature-subscribe-icon', 'nature_subscribe_icon_shortcode' );
	add_shortcode( 'nature-social', 'nature_social_shortcode' );
	
	add_shortcode( 'nature-countdown-counter', 'nature_count_down_counter_shortcode' );
	add_shortcode( 'nature-countdown-icon', 'nature_count_down_icon_shortcode' );
	
	add_shortcode( 'nature-service-boxes', 'nature_service_page_boxes_shortcode' );
	
	add_shortcode( 'nature-text-slider', 'nature_text_slider_shortcode' );
	add_shortcode( 'nature-description', 'nature_description_shortcode' );
	add_shortcode( 'nature-logo', 'nature_logo_shortcode' );
	
	add_shortcode( 'nature-contact-box', 'nature_info_shortcode' );
	add_shortcode( 'nature-contact-form', 'nature_contact_form_shortcode' );
	
	add_shortcode( 'nature-blog-icon', 'nature_blog_icon_shortcode' );
	add_shortcode( 'nature-blog-post', 'nature_blog_shortcode' );
	add_shortcode( 'nature-about-team', 'nature_team_shortcode' );
}
add_action( 'init', 'nature_register_shortcode');
?>