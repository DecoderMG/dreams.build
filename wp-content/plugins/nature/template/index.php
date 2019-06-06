<?php 
global $artabaz_nature;
global $nature_template_url;
$nature_template_url = plugins_url()."/nature/template"; 
include("background_select.php");

$countdown_top= ' <!-- nav top --><div class="nav top"><div class="arrow"><a href="#" class="direction" data-direction="up"><i class="fa '.$artabaz_nature['countdown_page_icon_top'].'"></i><span>'.$artabaz_nature['countdown_page_arrow_top'].'</span></a></div></div><!-- end nav top --> ';
$countdown_bottom= ' <!-- nav bottom --><div class="nav bottom"><div class="arrow"><a href="#" class="direction" data-direction="down"><i class="fa '.$artabaz_nature['countdown_page_icon_bottom'].'"></i><span>'.$artabaz_nature['countdown_page_arrow_bottom'].'</span></a></div></div><!-- end nav bottom --> ';
$countdown_left= ' <!-- nav left --><div class="nav left"><div class="arrow"><a href="#" class="direction" data-direction="left"><i class="fa '.$artabaz_nature['countdown_page_icon_left'].'"></i><span>'.$artabaz_nature['countdown_page_arrow_left'].'</span></a></div></div><!-- end nav left --> ';
$countdown_right= ' <!-- nav right --><div class="nav right"><div class="arrow"><a href="#" class="direction" data-direction="right"><i class="fa '.$artabaz_nature['countdown_page_icon_right'].'"></i><span>'.$artabaz_nature['countdown_page_arrow_right'].'</span></a></div></div><!-- end nav right --> ';
$service_top= ' <!-- nav top --><div class="nav top"><div class="arrow"><a href="#" class="direction" data-direction="up"><i class="fa '.$artabaz_nature['service_page_icon_top'].'"></i><span>'.$artabaz_nature['service_page_arrow_top'].'</span></a></div></div><!-- end nav top --> ';
$service_bottom= ' <!-- nav bottom --><div class="nav bottom"><div class="arrow"><a href="#" class="direction" data-direction="down"><i class="fa '.$artabaz_nature['service_page_icon_bottom'].'"></i><span>'.$artabaz_nature['service_page_arrow_bottom'].'</span></a></div></div><!-- end nav bottom --> ';
$service_left= ' <!-- nav left --><div class="nav left"><div class="arrow"><a href="#" class="direction" data-direction="left"><i class="fa '.$artabaz_nature['service_page_icon_left'].'"></i><span>'.$artabaz_nature['service_page_arrow_left'].'</span></a></div></div><!-- end nav left --> ';
$service_right= ' <!-- nav right --><div class="nav right"><div class="arrow"><a href="#" class="direction" data-direction="right"><i class="fa '.$artabaz_nature['service_page_icon_right'].'"></i><span>'.$artabaz_nature['service_page_arrow_right'].'</span></a></div></div><!-- end nav right --> ';
$home_top= ' <!-- nav top --><div class="nav top"><div class="arrow"><a href="#" class="direction" data-direction="up"><i class="fa '.$artabaz_nature['home_page_icon_top'].'"></i><span>'.$artabaz_nature['home_page_arrow_top'].'</span></a></div></div><!-- end nav top --> ';
$home_bottom= ' <!-- nav bottom --><div class="nav bottom"><div class="arrow"><a href="#" class="direction" data-direction="down"><i class="fa '.$artabaz_nature['home_page_icon_bottom'].'"></i><span>'.$artabaz_nature['home_page_arrow_bottom'].'</span></a></div></div><!-- end nav bottom --> ';
$home_left= ' <!-- nav left --><div class="nav left"><div class="arrow"><a href="#" class="direction" data-direction="left"><i class="fa '.$artabaz_nature['home_page_icon_left'].'"></i><span>'.$artabaz_nature['home_page_arrow_left'].'</span></a></div></div><!-- end nav left --> ';
$home_right= ' <!-- nav right --><div class="nav right"><div class="arrow"><a href="#" class="direction" data-direction="right"><i class="fa '.$artabaz_nature['home_page_icon_right'].'"></i><span>'.$artabaz_nature['home_page_arrow_right'].'</span></a></div></div><!-- end nav right --> ';
$contact_top= ' <!-- nav top --><div class="nav top"><div class="arrow"><a href="#" class="direction" data-direction="up"><i class="fa '.$artabaz_nature['contact_page_icon_top'].'"></i><span>'.$artabaz_nature['contact_page_arrow_top'].'</span></a></div></div><!-- end nav top --> ';
$contact_bottom= ' <!-- nav bottom --><div class="nav bottom"><div class="arrow"><a href="#" class="direction" data-direction="down"><i class="fa '.$artabaz_nature['contact_page_icon_bottom'].'"></i><span>'.$artabaz_nature['contact_page_arrow_bottom'].'</span></a></div></div><!-- end nav bottom --> ';
$contact_left= ' <!-- nav left --><div class="nav left"><div class="arrow"><a href="#" class="direction" data-direction="left"><i class="fa '.$artabaz_nature['contact_page_icon_left'].'"></i><span>'.$artabaz_nature['contact_page_arrow_left'].'</span></a></div></div><!-- end nav left --> ';
$contact_right= ' <!-- nav right --><div class="nav right"><div class="arrow"><a href="#" class="direction" data-direction="right"><i class="fa '.$artabaz_nature['contact_page_icon_right'].'"></i><span>'.$artabaz_nature['contact_page_arrow_right'].'</span></a></div></div><!-- end nav right --> ';
$subscribe_top= ' <!-- nav top --><div class="nav top"><div class="arrow"><a href="#" class="direction" data-direction="up"><i class="fa '.$artabaz_nature['subscribe_page_icon_top'].'"></i><span>'.$artabaz_nature['subscribe_page_arrow_top'].'</span></a></div></div><!-- end nav top --> ';
$subscribe_bottom= ' <!-- nav bottom --><div class="nav bottom"><div class="arrow"><a href="#" class="direction" data-direction="down"><i class="fa '.$artabaz_nature['subscribe_page_icon_bottom'].'"></i><span>'.$artabaz_nature['subscribe_page_arrow_bottom'].'</span></a></div></div><!-- end nav bottom --> ';
$subscribe_left= ' <!-- nav left --><div class="nav left"><div class="arrow"><a href="#" class="direction" data-direction="left"><i class="fa '.$artabaz_nature['subscribe_page_icon_left'].'"></i><span>'.$artabaz_nature['subscribe_page_arrow_left'].'</span></a></div></div><!-- end nav left --> ';
$subscribe_right= ' <!-- nav right --><div class="nav right"><div class="arrow"><a href="#" class="direction" data-direction="right"><i class="fa '.$artabaz_nature['subscribe_page_icon_right'].'"></i><span>'.$artabaz_nature['subscribe_page_arrow_right'].'</span></a></div></div><!-- end nav right --> ';
$about_top= ' <!-- nav top --><div class="nav top"><div class="arrow"><a href="#" class="direction" data-direction="up"><i class="fa '.$artabaz_nature['about_page_icon_top'].'"></i><span>'.$artabaz_nature['about_page_arrow_top'].'</span></a></div></div><!-- end nav top --> ';
$about_bottom= ' <!-- nav bottom --><div class="nav bottom"><div class="arrow"><a href="#" class="direction" data-direction="down"><i class="fa '.$artabaz_nature['about_page_icon_bottom'].'"></i><span>'.$artabaz_nature['about_page_arrow_bottom'].'</span></a></div></div><!-- end nav bottom --> ';
$about_left= ' <!-- nav left --><div class="nav left"><div class="arrow"><a href="#" class="direction" data-direction="left"><i class="fa '.$artabaz_nature['about_page_icon_left'].'"></i><span>'.$artabaz_nature['about_page_arrow_left'].'</span></a></div></div><!-- end nav left --> ';
$about_right= ' <!-- nav right --><div class="nav right"><div class="arrow"><a href="#" class="direction" data-direction="right"><i class="fa '.$artabaz_nature['about_page_icon_right'].'"></i><span>'.$artabaz_nature['about_page_arrow_right'].'</span></a></div></div><!-- end nav right --> ';
$blog_top= ' <!-- nav top --><div class="nav top"><div class="arrow"><a href="#" class="direction" data-direction="up"><i class="fa '.$artabaz_nature['blog_page_icon_top'].'"></i><span>'.$artabaz_nature['blog_page_arrow_top'].'</span></a></div></div><!-- end nav top --> ';
$blog_bottom= ' <!-- nav bottom --><div class="nav bottom"><div class="arrow"><a href="#" class="direction" data-direction="down"><i class="fa '.$artabaz_nature['blog_page_icon_bottom'].'"></i><span>'.$artabaz_nature['blog_page_arrow_bottom'].'</span></a></div></div><!-- end nav bottom --> ';
$blog_left= ' <!-- nav left --><div class="nav left"><div class="arrow"><a href="#" class="direction" data-direction="left"><i class="fa '.$artabaz_nature['blog_page_icon_left'].'"></i><span>'.$artabaz_nature['blog_page_arrow_left'].'</span></a></div></div><!-- end nav left --> ';
$blog_right= ' <!-- nav right --><div class="nav right"><div class="arrow"><a href="#" class="direction" data-direction="right"><i class="fa '.$artabaz_nature['blog_page_icon_right'].'"></i><span>'.$artabaz_nature['blog_page_arrow_right'].'</span></a></div></div><!-- end nav right --> ';

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>  
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<!-- START SEO -->
		<title><?php echo $artabaz_nature['site_title']; ?></title>
		<?php if(!empty($artabaz_nature['site_description'])){?><meta name="description" content="<?php echo $artabaz_nature['site_description']; ?>"><?php } ?>
		<?php if(!empty($artabaz_nature['site_keywords'])){?><meta name="keywords" content="<?php echo $artabaz_nature['site_keywords']; ?>"><?php } ?>
		<?php if($artabaz_nature['webmaster_tools']){ ?>
			<?php if(!empty($artabaz_nature['google_verify'])){?><meta name="google-site-verification" content="<?php echo $artabaz_nature['google_verify']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['ms_verify'])){?><meta name="msvalidate.01" content="<?php echo $artabaz_nature['ms_verify']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['alexa_verify'])){?><meta name="alexaVerifyID" content="<?php echo $artabaz_nature['alexa_verify']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['pin_verify'])){?><meta name="p:domain_verify" content="<?php echo $artabaz_nature['pin_verify']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['yandex_verify'])){?><meta name="yandex-verification" content="<?php echo $artabaz_nature['yandex_verify']; ?>"><?php } ?>
		<?php } ?>
		<?php if($artabaz_nature['social_tools']){ ?>
			<?php if(!empty($artabaz_nature['site_publisher'])){?><link rel="publisher" href="<?php echo $artabaz_nature['site_publisher']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['site_author'])){?><link rel="author" href="<?php echo $artabaz_nature['site_author']; ?>"><?php } ?>
			<meta property="og:type" content="website">
			<meta property="og:url" content="<?php echo bloginfo('url');?>">
			<meta property="og:locale" content="<?php echo bloginfo('language');?>">
			<?php if(!empty($artabaz_nature['fb_url'])){?><meta property="article:publisher" content="<?php echo $artabaz_nature['fb_url']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['fb_title'])){?><meta property="og:title" content="<?php echo $artabaz_nature['fb_title']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['fb_description'])){?><meta property="og:description" content="<?php echo $artabaz_nature['fb_description']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['fb_image']['url'])){?><meta property="og:image" content="<?php echo $artabaz_nature['fb_image']['url']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['site_title'])){?><meta property="og:site_name" content="<?php echo $artabaz_nature['site_title']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['fb_url'])){?><meta property="fb:admins" content="<?php echo $artabaz_nature['fb_url']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['fb_app'])){?><meta property="fb:app_id" content="<?php echo $artabaz_nature['fb_app']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['fb_page'])){?><meta property="fb:page_id" content="<?php echo $artabaz_nature['fb_page']; ?>"><?php } ?>
			<meta name="twitter:card" content="summary">
			<meta name="twitter:url" content="<?php echo bloginfo('url');?>">
			<?php if(!empty($artabaz_nature['tw_title'])){?><meta name="twitter:title" content="<?php echo $artabaz_nature['tw_title']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['tw_description'])){?><meta name="twitter:description" content="<?php echo $artabaz_nature['tw_description']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['tw_name'])){?><meta name="twitter:site" content="@<?php echo $artabaz_nature['tw_name']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['site_title'])){?><meta name="twitter:domain" content="<?php echo $artabaz_nature['site_title']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['tw_name'])){?><meta name="twitter:creator" content="@<?php echo $artabaz_nature['tw_name']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['tw_image']['url'])){?><meta name="twitter:image:src" content="<?php echo $artabaz_nature['tw_image']['url']; ?>"><?php } ?>
		<?php } ?>
		<?php if(!empty($artabaz_nature['favicon']['url'])){?><link rel="shortcut icon" type="image/x-icon" href="<?php echo $artabaz_nature['favicon']['url']; ?>"><?php } ?>
		<?php if($artabaz_nature['ios_icon']){ ?>
			<?php if(!empty($artabaz_nature['iphone_icon']['url'])){?><link rel="apple-touch-icon" href="<?php echo $artabaz_nature['iphone_icon']['url']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['ipad_icon']['url'])){?><link rel="apple-touch-icon" sizes="76x76" href="<?php echo $artabaz_nature['ipad_icon']['url']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['iphone_icon_retina']['url'])){?><link rel="apple-touch-icon" sizes="120x120" href="<?php echo $artabaz_nature['iphone_icon_retina']['url']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['iphone_icon_retina']['url'])){?><link rel="apple-touch-icon" sizes="152x152" href="<?php echo $artabaz_nature['iphone_icon_retina']['url']; ?>"><?php } ?>
			<?php if(!empty($artabaz_nature['iphone6_icon']['url'])){?><link rel="apple-touch-icon" sizes="180x180" href="<?php echo $artabaz_nature['iphone6_icon']['url']; ?>"><?php } ?>
		<?php } ?>
		<link rel="canonical" href="<?php echo bloginfo('url');?>">
		
		<!-- END SEO -->
		
		<!-- style -->
		<link rel="stylesheet" href="<?php echo $nature_template_url; ?>/css/style.css" media="screen">
		<link rel="stylesheet" href="<?php echo $nature_template_url; ?>/css/normalize.css" media="screen">
		<link rel="stylesheet" href="<?php echo $nature_template_url; ?>/css/font-awesome.min.css" media="screen">
		<link rel="stylesheet" href="<?php echo $nature_template_url; ?>/css/popup.css" media="screen">
		<link rel="stylesheet" href="<?php echo $nature_template_url; ?>/css/media.css" media="screen">
		<!-- color style -->
		<?php if($artabaz_nature['skin']!='dark'){ ?><link rel="stylesheet" href="<?php echo $nature_template_url; ?>/css/<?php echo $artabaz_nature['skin']; ?>.css" media="screen"><?php } ?>
		<link rel="stylesheet" href="<?php echo $nature_template_url; ?>/css/colors/<?php echo $artabaz_nature['skin_color']; ?>.css" media="screen">
				
		
		<!--[if IE]>
			<style>section{overflow:hidden !important;}</style>
			<script src='http://html5shim.googlecode.com/svn/trunk/html5.js'></script>
		<![endif]-->
		<?php if($artabaz_nature['load-other-assets']){?><?php wp_head(); ?><?php } ?>
		<?php if($artabaz_nature['blog_page']):?><style>.blog-post {max-width:800px;margin: 20px auto;background: #FFF;padding: 0;line-height: 0;position: relative;color: black;}.blog-post .fullwidth .col{width: 100%;}.blog-post .col {width: 50%; float:left;}.blog-post .col img,.blog-post .col video,.blog-post .col audio {width: 100%; height: auto;}audio {float:left;}.col h1{color:#000000;}.col h2{color:#000000;}.col h3{color:#000000;}.col h4{color:#000000;}.blog-post .content{padding:1rem;line-height:1rem;}.clearfix {clear: both;float: none;}@media all and (max-width:30em) {.col { width: 100%;float:none;}}.blog-post .mfp-close{color:#000000;font-size: 17px;}</style><?php endif; ?>
		<?php if(!empty($artabaz_nature['custom_css'])){?><style><?php echo $artabaz_nature['custom_css']; ?></style><?php } ?>
		<!-- font -->
		<?php if($artabaz_nature['change-fonts']){ ?>
			<link href="http://fonts.googleapis.com/css?family=<?php echo $artabaz_nature['body-typography']['font-family']; ?>:<?php echo $artabaz_nature['body-typography']['font-weight']; ?>|<?php echo $artabaz_nature['slider-typography']['font-family']; ?>:<?php echo $artabaz_nature['slider-typography']['font-weight']; ?>|<?php echo $artabaz_nature['timer-typography']['font-family']; ?>:<?php echo $artabaz_nature['timer-typography']['font-weight']; ?>" rel="stylesheet" type="text/css">
			<style>body,h1,h2,h3,h4,h5,h6,p,li,ul{<?php echo 'font-family:' .$artabaz_nature['body-typography']['font-family'] .'!important;'; ?><?php echo 'font-weight:' .$artabaz_nature['body-typography']['font-weight'] .'!important;'; ?>}.ce-days, .ce-hours, .ce-minutes, .ce-seconds, .ce-dseconds, .ce-mseconds {<?php echo 'font-family:' .$artabaz_nature['timer-typography']['font-family'] .'!important;'; ?><?php echo 'font-weight:' .$artabaz_nature['timer-typography']['font-weight'] .'!important;';?>}#textslider h1{<?php echo 'font-family:' .$artabaz_nature['slider-typography']['font-family'] .'!important;'; ?><?php echo 'font-weight:' .$artabaz_nature['slider-typography']['font-weight'] .'!important;'; ?>}</style>
		<?php }else{ ?>
		<link href="http://fonts.googleapis.com/css?family=Raleway:700,400,500" rel="stylesheet" type="text/css">
		<?php } ?>
	</head>
<body <?php if($background_id=="rain"){echo "class='rain'";} ?>>
<!--PRELOADER ##########################-->
    <div id="preloader">
        <div class="loading">
			<div class="loader"></div>
		</div>
    </div>
<!--CUSTOM BACKGROUND ##########################-->
	<div <?php echo $container_style; ?> id="<?php echo $background_id; ?>">
		<?php echo $cover_container; ?>
	</div>
	<div id="sections">
		<?php if($artabaz_nature['home_page']): ?>
		<!--HOME ##########################-->
		<section id="home">
			<!-- container -->
			<div class="container clearfix">
					<div class="">
						<?php echo do_shortcode($artabaz_nature['home_page_content']); ?>
					</div>
			</div>
			<!-- end container -->
			
			
			<?php if($artabaz_nature['home_page']): ?>
				<?php	if($artabaz_nature['home_page_arrow'][0]=="top"){ echo $home_top;  } else 
					if($artabaz_nature['home_page_arrow'][1]=="top"){  echo $home_top;  } else
					if($artabaz_nature['home_page_arrow'][2]=="top"){  echo $home_top;  } else 
					if($artabaz_nature['home_page_arrow'][3]=="top"){  echo $home_top;  };
					if($artabaz_nature['home_page_arrow'][0]=="bottom"){ echo $home_bottom;  } else 
					if($artabaz_nature['home_page_arrow'][1]=="bottom"){  echo $home_bottom;  } else
					if($artabaz_nature['home_page_arrow'][2]=="bottom"){  echo $home_bottom;  } else 
					if($artabaz_nature['home_page_arrow'][3]=="bottom"){  echo $home_bottom;  };
					if($artabaz_nature['home_page_arrow'][0]=="left"){ echo $home_left;  } else 
					if($artabaz_nature['home_page_arrow'][1]=="left"){  echo $home_left;  } else
					if($artabaz_nature['home_page_arrow'][2]=="left"){  echo $home_left;  } else 
					if($artabaz_nature['home_page_arrow'][3]=="left"){  echo $home_left;  };
					if($artabaz_nature['home_page_arrow'][0]=="right"){ echo $home_right;  } else 
					if($artabaz_nature['home_page_arrow'][1]=="right"){  echo $home_right;  } else
					if($artabaz_nature['home_page_arrow'][2]=="right"){  echo $home_right;  } else 
					if($artabaz_nature['home_page_arrow'][3]=="right"){  echo $home_right;  }; 		?>
			<?php endif; ?>
			
		</section>
		<?php endif; ?>
		<?php if($artabaz_nature['service_page']): ?>
		<!--SERVICES ##########################-->		
		<section id="service">
			<!-- container -->
			<div class="container clearfix">
				<!-- center -->
				<div class="intro">
					<div class="center">
						<?php echo do_shortcode($artabaz_nature['service_page_content']); ?>
					</div>
				</div>
				<!-- end container -->
			</div>
			<!-- end intro middle -->
			<?php if($artabaz_nature['service_page']): ?>
				<?php	if($artabaz_nature['service_page_arrow'][0]=="top"){ echo $service_top;  } else 
					if($artabaz_nature['service_page_arrow'][1]=="top"){  echo $service_top;  } else
					if($artabaz_nature['service_page_arrow'][2]=="top"){  echo $service_top;  } else 
					if($artabaz_nature['service_page_arrow'][3]=="top"){  echo $service_top;  };
					if($artabaz_nature['service_page_arrow'][0]=="bottom"){ echo $service_bottom;  } else 
					if($artabaz_nature['service_page_arrow'][1]=="bottom"){  echo $service_bottom;  } else
					if($artabaz_nature['service_page_arrow'][2]=="bottom"){  echo $service_bottom;  } else 
					if($artabaz_nature['service_page_arrow'][3]=="bottom"){  echo $service_bottom;  };
					if($artabaz_nature['service_page_arrow'][0]=="left"){ echo $service_left;  } else 
					if($artabaz_nature['service_page_arrow'][1]=="left"){  echo $service_left;  } else
					if($artabaz_nature['service_page_arrow'][2]=="left"){  echo $service_left;  } else 
					if($artabaz_nature['service_page_arrow'][3]=="left"){  echo $service_left;  };
					if($artabaz_nature['service_page_arrow'][0]=="right"){ echo $service_right;  } else 
					if($artabaz_nature['service_page_arrow'][1]=="right"){  echo $service_right;  } else
					if($artabaz_nature['service_page_arrow'][2]=="right"){  echo $service_right;  } else 
					if($artabaz_nature['service_page_arrow'][3]=="right"){  echo $service_right;  }; 		?>
			<?php endif; ?>
		</section>
		<?php endif; ?>
		<?php if($artabaz_nature['contact_page']):?>
		<!--CONTACT ##########################-->			
		<section id="contact">
			<!-- container -->
			<div class="container clearfix">
				<!-- center -->
				<div class="intro">
					<div class="center">
						<input type="hidden" id="template_path_contact" value="<?php echo $nature_template_url; ?>" />
						<?php echo do_shortcode($artabaz_nature['contact_page_content']); ?>
					</div>
				</div>
				<!-- end container -->
			</div>
			<!-- end intro middle -->
			
			<?php if($artabaz_nature['contact_page']): ?>
				<?php	if($artabaz_nature['contact_page_arrow'][0]=="top"){ echo $contact_top;  } else 
					if($artabaz_nature['contact_page_arrow'][1]=="top"){  echo $contact_top;  } else
					if($artabaz_nature['contact_page_arrow'][2]=="top"){  echo $contact_top;  } else 
					if($artabaz_nature['contact_page_arrow'][3]=="top"){  echo $contact_top;  };
					if($artabaz_nature['contact_page_arrow'][0]=="bottom"){ echo $contact_bottom;  } else 
					if($artabaz_nature['contact_page_arrow'][1]=="bottom"){  echo $contact_bottom;  } else
					if($artabaz_nature['contact_page_arrow'][2]=="bottom"){  echo $contact_bottom;  } else 
					if($artabaz_nature['contact_page_arrow'][3]=="bottom"){  echo $contact_bottom;  };
					if($artabaz_nature['contact_page_arrow'][0]=="left"){ echo $contact_left;  } else 
					if($artabaz_nature['contact_page_arrow'][1]=="left"){  echo $contact_left;  } else
					if($artabaz_nature['contact_page_arrow'][2]=="left"){  echo $contact_left;  } else 
					if($artabaz_nature['contact_page_arrow'][3]=="left"){  echo $contact_left;  };
					if($artabaz_nature['contact_page_arrow'][0]=="right"){ echo $contact_right;  } else 
					if($artabaz_nature['contact_page_arrow'][1]=="right"){  echo $contact_right;  } else
					if($artabaz_nature['contact_page_arrow'][2]=="right"){  echo $contact_right;  } else 
					if($artabaz_nature['contact_page_arrow'][3]=="right"){  echo $contact_right;  }; 		?>
			<?php endif; ?>
		</section>
		<?php endif; ?>
		<?php if($artabaz_nature['countdown_page']):?>
		<!--COUNTDOWN ##########################-->			
		<section id="countdown">
			<!-- container -->
			<div class="container clearfix">
				<!-- center -->
				<div class="intro">
					<div class="center">
						<?php echo do_shortcode($artabaz_nature['countdown_page_content']); ?>
					</div>
				</div>
				<!-- end container -->
			</div>
			<!-- end intro middle -->
			
			<?php if($artabaz_nature['countdown_page']): ?>
				<?php	if($artabaz_nature['countdown_page_arrow'][0]=="top"){ echo $countdown_top;  } else 
					if($artabaz_nature['countdown_page_arrow'][1]=="top"){  echo $countdown_top;  } else
					if($artabaz_nature['countdown_page_arrow'][2]=="top"){  echo $countdown_top;  } else 
					if($artabaz_nature['countdown_page_arrow'][3]=="top"){  echo $countdown_top;  };
					if($artabaz_nature['countdown_page_arrow'][0]=="bottom"){ echo $countdown_bottom;  } else 
					if($artabaz_nature['countdown_page_arrow'][1]=="bottom"){  echo $countdown_bottom;  } else
					if($artabaz_nature['countdown_page_arrow'][2]=="bottom"){  echo $countdown_bottom;  } else 
					if($artabaz_nature['countdown_page_arrow'][3]=="bottom"){  echo $countdown_bottom;  };
					if($artabaz_nature['countdown_page_arrow'][0]=="left"){ echo $countdown_left;  } else 
					if($artabaz_nature['countdown_page_arrow'][1]=="left"){  echo $countdown_left;  } else
					if($artabaz_nature['countdown_page_arrow'][2]=="left"){  echo $countdown_left;  } else 
					if($artabaz_nature['countdown_page_arrow'][3]=="left"){  echo $countdown_left;  };
					if($artabaz_nature['countdown_page_arrow'][0]=="right"){ echo $countdown_right;  } else 
					if($artabaz_nature['countdown_page_arrow'][1]=="right"){  echo $countdown_right;  } else
					if($artabaz_nature['countdown_page_arrow'][2]=="right"){  echo $countdown_right;  } else 
					if($artabaz_nature['countdown_page_arrow'][3]=="right"){  echo $countdown_right;  }; 		?>
			<?php endif; ?>
		</section>
		<?php endif; ?>
		<?php if($artabaz_nature['subscribe_page']):?>
		<!--SUBSCRIBE ##########################-->			
		<section id="subscribe">
			<!-- container -->
			<div class="container clearfix">
				<!-- center -->
				<div class="intro">
					<div class="center">
						<?php echo do_shortcode($artabaz_nature['subscribe_page_content']); ?>
					</div>
				</div><div class="clearfix"></div>
				<!-- end container -->
			</div>
			<!-- end intro middle -->
			
			<?php if($artabaz_nature['subscribe_page']): ?>
				<?php	if($artabaz_nature['subscribe_page_arrow'][0]=="top"){ echo $subscribe_top;  } else 
					if($artabaz_nature['subscribe_page_arrow'][1]=="top"){  echo $subscribe_top;  } else
					if($artabaz_nature['subscribe_page_arrow'][2]=="top"){  echo $subscribe_top;  } else 
					if($artabaz_nature['subscribe_page_arrow'][3]=="top"){  echo $subscribe_top;  };
					if($artabaz_nature['subscribe_page_arrow'][0]=="bottom"){ echo $subscribe_bottom;  } else 
					if($artabaz_nature['subscribe_page_arrow'][1]=="bottom"){  echo $subscribe_bottom;  } else
					if($artabaz_nature['subscribe_page_arrow'][2]=="bottom"){  echo $subscribe_bottom;  } else 
					if($artabaz_nature['subscribe_page_arrow'][3]=="bottom"){  echo $subscribe_bottom;  };
					if($artabaz_nature['subscribe_page_arrow'][0]=="left"){ echo $subscribe_left;  } else 
					if($artabaz_nature['subscribe_page_arrow'][1]=="left"){  echo $subscribe_left;  } else
					if($artabaz_nature['subscribe_page_arrow'][2]=="left"){  echo $subscribe_left;  } else 
					if($artabaz_nature['subscribe_page_arrow'][3]=="left"){  echo $subscribe_left;  };
					if($artabaz_nature['subscribe_page_arrow'][0]=="right"){ echo $subscribe_right;  } else 
					if($artabaz_nature['subscribe_page_arrow'][1]=="right"){  echo $subscribe_right;  } else
					if($artabaz_nature['subscribe_page_arrow'][2]=="right"){  echo $subscribe_right;  } else 
					if($artabaz_nature['subscribe_page_arrow'][3]=="right"){  echo $subscribe_right;  }; 		?>
			<?php endif; ?>
		</section>
		<?php endif; ?>
		
		<?php if($artabaz_nature['blog_page']):?>
		<!--SUBSCRIBE ##########################-->			
		<section id="blog">
			<!-- container -->
			<div class="container clearfix">
				<!-- center -->
				<div class="intro">
					<div class="center">
						<?php echo do_shortcode($artabaz_nature['blog_page_content']); ?>
					</div>
				</div><div class="clearfix"></div>
				<!-- end container -->
			</div>
			<!-- end intro middle -->
			
			<?php if($artabaz_nature['blog_page']): ?>
				<?php	if($artabaz_nature['blog_page_arrow'][0]=="top"){ echo $blog_top;  } else 
					if($artabaz_nature['blog_page_arrow'][1]=="top"){  echo $blog_top;  } else
					if($artabaz_nature['blog_page_arrow'][2]=="top"){  echo $blog_top;  } else 
					if($artabaz_nature['blog_page_arrow'][3]=="top"){  echo $blog_top;  };
					if($artabaz_nature['blog_page_arrow'][0]=="bottom"){ echo $blog_bottom;  } else 
					if($artabaz_nature['blog_page_arrow'][1]=="bottom"){  echo $blog_bottom;  } else
					if($artabaz_nature['blog_page_arrow'][2]=="bottom"){  echo $blog_bottom;  } else 
					if($artabaz_nature['blog_page_arrow'][3]=="bottom"){  echo $blog_bottom;  };
					if($artabaz_nature['blog_page_arrow'][0]=="left"){ echo $blog_left;  } else 
					if($artabaz_nature['blog_page_arrow'][1]=="left"){  echo $blog_left;  } else
					if($artabaz_nature['blog_page_arrow'][2]=="left"){  echo $blog_left;  } else 
					if($artabaz_nature['blog_page_arrow'][3]=="left"){  echo $blog_left;  };
					if($artabaz_nature['blog_page_arrow'][0]=="right"){ echo $blog_right;  } else 
					if($artabaz_nature['blog_page_arrow'][1]=="right"){  echo $blog_right;  } else
					if($artabaz_nature['blog_page_arrow'][2]=="right"){  echo $blog_right;  } else 
					if($artabaz_nature['blog_page_arrow'][3]=="right"){  echo $blog_right;  }; 		?>
			<?php endif; ?>
		</section>
		<?php endif; ?>
		
		<?php if($artabaz_nature['about_page']):?>
		<!--ABOUT ##########################-->			
		<section id="about">
			<!-- container -->
			<div class="container clearfix">
				<!-- center -->
				<div class="intro">
					<div class="center">
						<?php echo do_shortcode($artabaz_nature['about_page_content']); ?>
					</div>
				</div><div class="clearfix"></div>
				<!-- end container -->
			</div>
			<!-- end intro middle -->
			<?php if($artabaz_nature['about_page']): ?>
				<?php	if($artabaz_nature['about_page_arrow'][0]=="top"){ echo $about_top;  } else 
					if($artabaz_nature['about_page_arrow'][1]=="top"){  echo $about_top;  } else
					if($artabaz_nature['about_page_arrow'][2]=="top"){  echo $about_top;  } else 
					if($artabaz_nature['about_page_arrow'][3]=="top"){  echo $about_top;  };
					if($artabaz_nature['about_page_arrow'][0]=="bottom"){ echo $about_bottom;  } else 
					if($artabaz_nature['about_page_arrow'][1]=="bottom"){  echo $about_bottom;  } else
					if($artabaz_nature['about_page_arrow'][2]=="bottom"){  echo $about_bottom;  } else 
					if($artabaz_nature['about_page_arrow'][3]=="bottom"){  echo $about_bottom;  };
					if($artabaz_nature['about_page_arrow'][0]=="left"){ echo $about_left;  } else 
					if($artabaz_nature['about_page_arrow'][1]=="left"){  echo $about_left;  } else
					if($artabaz_nature['about_page_arrow'][2]=="left"){  echo $about_left;  } else 
					if($artabaz_nature['about_page_arrow'][3]=="left"){  echo $about_left;  };
					if($artabaz_nature['about_page_arrow'][0]=="right"){ echo $about_right;  } else 
					if($artabaz_nature['about_page_arrow'][1]=="right"){  echo $about_right;  } else
					if($artabaz_nature['about_page_arrow'][2]=="right"){  echo $about_right;  } else 
					if($artabaz_nature['about_page_arrow'][3]=="right"){  echo $about_right;  }; 		?>
			<?php endif; ?>
		</section>
		<?php endif; ?>
	</div>
	<!-- end sections -->
	<audio id="beep" preload="auto"><source src="<?php echo $nature_template_url; ?>/media/tone.mp3" /></audio>
	<!-- SHADERS -->
	<script id="vs" type="x-shader/x-vertex">varying vec2 vUv;void main(){vUv=uv;gl_Position=projectionMatrix*modelViewMatrix*vec4(position,1.0);}</script>
	<script id="fs" type="x-shader/x-fragment">uniform sampler2D map;uniform vec3 fogColor;uniform float fogNear;uniform float fogFar;varying vec2 vUv;void main(){float depth=gl_FragCoord.z/gl_FragCoord.w;float fogFactor=smoothstep(fogNear,fogFar,depth);gl_FragColor=texture2D(map,vUv);gl_FragColor.w*=pow(gl_FragCoord.z,20.0);gl_FragColor=mix(gl_FragColor,vec4(fogColor,gl_FragColor.w),fogFactor);}</script>
	<!-- script -->
	<script src="<?php echo $nature_template_url; ?>/js/jquery.js"></script> 
	<script src="<?php echo $nature_template_url; ?>/js/plugin.min.js"></script>
	<script src="<?php echo $nature_template_url; ?>/js/modernizr.custom.js"></script>
	<?php if($js_id=="map"){ ?><script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script><?php } ?>
	<?php if($js_id!==false){ ?><script src="<?php echo $nature_template_url; ?>/js/<?php echo $js_id; ?>.js"></script><?php  } if(!empty($custom_js)){echo $custom_js;} ?>
	<script src="<?php echo $nature_template_url; ?>/js/main.js"></script>
	<?php if($artabaz_nature['subscribe_use_mailchimp']){ ?><script src="<?php echo $nature_template_url; ?>/js/form.js"></script><?php } ?>
	<script type="text/javascript">
	// floor
	<?php 
	$home_page_block = $artabaz_nature['home_page_block'];
	$countdown_page_block = $artabaz_nature['countdown_page_block'];
	$subscribe_page_block = $artabaz_nature['subscribe_page_block'];
	$service_page_block = $artabaz_nature['service_page_block'];
	$contact_page_block = $artabaz_nature['contact_page_block'];
	$blog_page_block = $artabaz_nature['blog_page_block'];
	$about_page_block = $artabaz_nature['about_page_block'];
	
	$home_page_label = $artabaz_nature['home_page_label'];
	$countdown_page_label = $artabaz_nature['countdown_page_label'];
	$subscribe_page_label = $artabaz_nature['subscribe_page_label'];
	$service_page_label = $artabaz_nature['service_page_label'];
	$contact_page_label = $artabaz_nature['contact_page_label'];
	$blog_page_label = $artabaz_nature['blog_page_label'];
	$about_page_label = $artabaz_nature['about_page_label'];
	$js_floor_name = "";
	$js_floor_dir = "";
	if($artabaz_nature['home_page']){ $js_floor_name .= '"'.$home_page_label.'",'; $js_floor_dir.=''.$home_page_block.',';}
	if($artabaz_nature['service_page']){ $js_floor_name .= '"'.$service_page_label.'",'; $js_floor_dir.=''.$service_page_block.',';}
	if($artabaz_nature['contact_page']){ $js_floor_name .= '"'.$contact_page_label.'" ,'; $js_floor_dir.=''.$contact_page_block.',';}
	if($artabaz_nature['countdown_page']){ $js_floor_name .= '"'.$countdown_page_label.'" ,'; $js_floor_dir.=''.$countdown_page_block.',';}
	if($artabaz_nature['subscribe_page']){ $js_floor_name .= '"'.$subscribe_page_label.'" ,'; $js_floor_dir.=''.$subscribe_page_block.',';}
	if($artabaz_nature['blog_page']){ $js_floor_name .= '"'.$blog_page_label.'" ,'; $js_floor_dir.=''.$blog_page_block.',';}
	if($artabaz_nature['about_page']){ $js_floor_name .= '"'.$about_page_label.'" ,'; $js_floor_dir.= ''.$about_page_block.',';}
	$js_floor_name = rtrim($js_floor_name, ",");
	$js_floor_dir = rtrim($js_floor_dir, ",");
	?>
	var pofloor = $("#sections").pofloor({pofloorFloorName:[<?php echo $js_floor_name; ?>], time:1000,childType:"section",easing: "easeInOutExpo" ,<?php if($artabaz_nature['mouse_scroll_effect']){?>wheelNavigation: true,<?php } ?>
	direction: [<?php echo $js_floor_dir; ?>]});
	var pofloorInstance = $("#sections").data("pofloor");
	$(".direction").click(function() {
		pofloorInstance.scrollToDirection($(this).data("direction"));
	});	
	</script>
	<?php 
	$countdown_date = $artabaz_nature['countdown_date'];
	if(!empty($countdown_date)){
		$countdown_date_arr = explode( "/" , $countdown_date );
	}
	$countdown_labels = $artabaz_nature['countdown_labels'];
	if(!empty($countdown_labels)){
		$countdown_labels_arr = explode( "," , $countdown_labels );
	}
	?>
	<script type="text/javascript">
		// countdown
		$(".countdown").countEverest({
			//Set your target date here!
			day: <?php if(!empty($countdown_date)){ echo $countdown_date_arr[1];} ?>,
			month: <?php if(!empty($countdown_date)){ echo $countdown_date_arr[0];} ?>,
			year: <?php if(!empty($countdown_date)){ echo $countdown_date_arr[2];} ?>
			<?php if(!empty($countdown_labels)){ 
			echo ',' ?>
			daysLabel: "<?php if(!empty($countdown_labels)){ echo $countdown_labels_arr[0];} ?>", 
			dayLabel: "<?php if(!empty($countdown_labels)){ echo $countdown_labels_arr[1];} ?>", 
			hoursLabel: "<?php if(!empty($countdown_labels)){ echo $countdown_labels_arr[2];} ?>", 
			hourLabel: "<?php if(!empty($countdown_labels)){ echo $countdown_labels_arr[3];} ?>", 
			minutesLabel: "<?php if(!empty($countdown_labels)){ echo $countdown_labels_arr[4];} ?>", 
			minuteLabel: "<?php if(!empty($countdown_labels)){ echo $countdown_labels_arr[5];} ?>", 
			secondsLabel: "<?php if(!empty($countdown_labels)){ echo $countdown_labels_arr[6];} ?>",  
			secondLabel: "<?php if(!empty($countdown_labels)){ echo $countdown_labels_arr[7];} ?>"
			<?php }?>
		});
	</script>
	<?php if(!empty($artabaz_nature['custom_html'])){?><script type="text/javascript"><?php echo $artabaz_nature['custom_html']; ?></script><?php } ?>
	<?php if($artabaz_nature['load-other-assets']){?><?php wp_footer(); ?><?php } ?>
</body>
</html>