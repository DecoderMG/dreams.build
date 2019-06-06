<?php
if($artabaz_nature['background_animation_1']){
	$background_id = "animation";
	$js_id = "animation1";
	$container_style = "";
	$cover_background_style="style='background-color:rgba(0,0,0,0.7) !important;'";
	$cover_container = '<div id="cover" '.$cover_background_style.' class="cover"></div>';
}
else if($artabaz_nature['background_animation_2']){
	$background_id = "animation";
	$js_id = "animation2";
	$container_style = "";
	$cover_background_style="style='background-color:rgba(0,0,0,0.7) !important;'";
	$cover_container = '<div id="cover" '.$cover_background_style.' class="cover"></div>';
}
else if($artabaz_nature['background_animation_3']){
	$background_id = "animation";
	$js_id = "animation3";
	$container_style = "style='background:url(".$artabaz_nature['background_animation_3_image']['url'].") !important;'";
	$cover_background_style="style='background-color:rgba(2, 181, 189, 0.4) !important;'";
	$cover_container = '<div class="cover" '.$cover_background_style.'><canvas id="cover"></canvas></div>';
	
}
else if($artabaz_nature['background_animation_4']){
	$background_id = "animation";
	$js_id = "animation4";
	$custom_js = '
	<script type="text/javascript">
		$("#animation").each(function() {
		$(".cover").pobubble({
			color: "#ffffff",
	        ammount: 10,
	        min: .1,
	        max: .4,
	        time: 60,
	        vertical:true,
	        horizontal:true,
	        style: "circle"
		});
	});
	</script>
	<style>.cover{background:none !important}</style>
	';
	$container_style = "style='background:url(".$artabaz_nature['background_animation_4_image']['url'].") !important;'";
	$cover_background_style="style='display:block !important; position: static !important;'";
	$cover_container = '<div '.$cover_background_style.' class="cover"></div>';
}
else if($artabaz_nature['background_image']){
	$background_id = "image";
	$js_id = false;
	$container_style = "style='background:url(".$artabaz_nature['background_image_upload']['url'].") !important;'";
	$cover_background_style="style='background-color:rgba(0,0,0,0.7) !important;'";
	$cover_container = '<div class="cover" '.$cover_background_style.' ></div>';
}
else if($artabaz_nature['background_map']){
	$background_id = "map";
	$js_id = "map";
	$container_style = "";
	$cover_background_style="style='background-color:rgba(0,0,0,0.7) !important;'";
	$cover_container = '<div id="mapcontent" class="map"></div><div '.$cover_background_style.' class="cover"></div><input type="hidden" id="latMap" value="'.$artabaz_nature['background_map_lat'].'" /><input type="hidden" id="langMap" value="'.$artabaz_nature['background_map_lang'].'" />';
}
else if($artabaz_nature['background_parallax']){
	$background_id = "parallax";
	$js_id = "parallax";
	$container_style = "style='background:".$nature_template_url."/media/imgparallax.jpg !important;'";
	$cover_container = '
		<div id="parallax-container">
			<ul class="scene scene-one">
				<li class="layer" data-depth="'.$artabaz_nature['background_parallax_speed_1'].'"><img src="'.$artabaz_nature['background_parallax_image_1']['url'].'"></li>
			</ul>
			<ul class="scene scene-two">
				<li class="layer" data-depth="'.$artabaz_nature['background_parallax_speed_2'].'"><img src="'.$artabaz_nature['background_parallax_image_2']['url'].'"></li>
			</ul>
			<ul class="scene scene-three">
				<li class="layer" data-depth="'.$artabaz_nature['background_parallax_speed_3'].'"><img src="'.$artabaz_nature['background_parallax_image_3']['url'].'"></li>
			</ul>
			<ul class="scene scene-four">
				<li class="layer" data-depth="'.$artabaz_nature['background_parallax_speed_4'].'"><img src="'.$artabaz_nature['background_parallax_image_4']['url'].'"></li>
			</ul>
		</div><!-- end parallax-container -->
	';
	$custom_js = '
		<script type="text/javascript">
		// parallax
		$("#parallax").each(function() {
			
			jQuery(".scene-one").parallax({
				calibrateX: true,
				calibrateY: true,
				invertX: false,
				invertY: true,
				limitX: 3500,
				limitY: 10,
				scalarX: 17,
				scalarY: 5,
				frictionX: 0.2,
				frictionY: 0.8
			});
			jQuery(".scene-two").parallax({
				calibrateX: true,
				calibrateY: true,
				invertX: false,
				invertY: true,
				limitX: 2900,
				limitY: 25,
				scalarX: 30,
				scalarY: 30,
				frictionX: 0.2,
				frictionY: 0.8
			});
			jQuery(".scene-three").parallax({
				calibrateX: true,
				calibrateY: true,
				invertX: false,
				invertY: true,
				limitX: false,
				limitY: false,
				scalarX: 25,
				scalarY: 15,
				frictionX: 0.2,
				frictionY: 0.8
			});
			jQuery(".scene-four").parallax({
				calibrateX: true,
				calibrateY: true,
				invertX: false,
				invertY: true,
				limitX: false,
				limitY: 10,
				scalarX: 10,
				scalarY: 8,
				frictionX: 0.2,
				frictionY: 0.8
			});
		});
		</script>
	';
}
else if($artabaz_nature['background_pattern']){
	$background_id = "pattern";
	$js_id = false;
	if(!empty($artabaz_nature['background_pattern_upload']['url'])){
		$background_pattern_image = $artabaz_nature['background_pattern_upload']['url'];
	}
	else{
		$background_pattern_image = $nature_template_url."/media/pattern/".$artabaz_nature['background_pattern_select'].".png";
	}
	$container_style = "style='background:url(".$background_pattern_image.") 100px 250px !important;'";
	$cover_container = "";
}
else if($artabaz_nature['background_rain']==true){
	$background_id = "rain";
	$js_id = "animation_rain";
	$container_style = "";
	$cover_container = '<img id="background" src="'.$artabaz_nature['background_rain_image']['url'].'" alt=""/>';
	$custom_js = "
	<script type='text/javascript'>
	// rain
	$('.rain').each(function() {
		var image = document.getElementById('background');
		image.crossOrigin = 'anonymous';
		var engine = new RainyDay({
			element: 'background',
			blur: 10,
			opacity: 1,
			fps:30
		});
		engine.trail = engine.TRAIL_SMUDGE;
		engine.gravity = engine.GRAVITY_NON_LINEAR;
		
		engine.rain([ [3, 2, 2] ], 100);
	});
	</script>
	";
}
else if($artabaz_nature['background_snow']==true){
	$background_id = "snow";
	$js_id = "animation_snow";
	$container_style = "style='background-image:url(".$artabaz_nature['background_snow_image']['url'].") !important;'";
	$cover_container = '<div class="snow"></div><input type="hidden" id="imageSnow" value="'.$nature_template_url.'/media/snow.png" />';
	$custom_js = "
	<script type='text/javascript'>
	// rain
	$('.snow').each(function() {
		snowEffectBind();
	});
	</script>
	";
}
else if($artabaz_nature['background_slider']==true){
	$background_id = "slider";
	$js_id = false;
	$container_style = "";
	$background_slider_images = $artabaz_nature['background_slider_images'];
	$background_slider_images_array = explode("," , $background_slider_images);
	$cover_container = '
		<div id="imageslider">
			<div class="slides-container">';
				foreach((array)$background_slider_images_array as $image_id){
					$cover_container .= '<img src="'.wp_get_attachment_url($image_id).'" alt="">';
				}
	$cover_container .='</div>
		</div>
		<div class="cover"></div>
	';
	$custom_js = '
	<script type="text/javascript">
	// slider
	$("#imageslider").superslides({
		play: 10000, // 6 seconds between each slide
		animation: "fade",
		animation_speed: "slow",
		pagination: false,
		usekeyboard: false
	});
	</script>
	';
}
else if($artabaz_nature['background_solid']==true){
	$background_id="solid";
	$js_id = false;
	$container_style = "style='background:".$artabaz_nature['background_solid_color']." !important;'";
	$cover_container = '';
}
else if($artabaz_nature['background_star']==true){
	$background_id="star";
	$js_id = "animation_star";
	$custom_js = '
	<script type="text/javascript">
	// STARS
	$("#star").each(function() {
		postars($(".cover")[0]).init();
	});
	</script>
	';
	$container_style = "style='background-image:url(".$artabaz_nature['background_star_image']['url'].") !important;'";
	$cover_container = '<canvas class="cover"></canvas>';
}
else if($artabaz_nature['background_cloud']==true){
	$background_id="cloud";
	$js_id = "animation_cloud";
	$custom_js = '
	<script type="text/javascript">
	// STARS
	$("#star").each(function() {
		postars($(".cover")[0]).init();
	});
	</script>
	';
	$container_style = "style='background-image:url(".$artabaz_nature['background_cloud_image']['url'].") !important;'";
	$cover_container = '<input type="hidden" id="imageCloud" value="'.$nature_template_url.'/media/cloud.png" />';
}
else if($artabaz_nature['background_video']==true){
	$background_id="video";
	$js_id = false;
	$container_style = "";
	$cover_container = '
		<div class="video-fallback" style="background-image: url('.$artabaz_nature['background_video_cover']['url'].') !important;"></div>
		<video autoplay loop>';
            if(!empty($artabaz_nature['background_video_mp4']['url'])){$cover_container .= '<source src="'.$artabaz_nature['background_video_mp4']['url'].'" type="video/mp4"/>';}
            if(!empty($artabaz_nature['background_video_ogg']['url'])){$cover_container .= '<source src="'.$artabaz_nature['background_video_ogg']['url'].'" type="video/ogg"/>';}
            if(!empty($artabaz_nature['background_video_webm']['url'])){$cover_container .= '<source src="'.$artabaz_nature['background_video_webm']['url'].'" type="video/webm"/>';}
            $cover_container .= 'Your browser does not support the video tag. I suggest you upgrade your browser.';
        $cover_container .= '</video>
		<div class="cover"></div>
	';
}
else if($artabaz_nature['background_youtube']==true){
	$background_id="video";
	$js_id = "youtube";
	$custom_js = '
	<script type="text/javascript">
	// youtube
	$(".player").each(function() {
		$(".player").mb_YTPlayer();
	});
	</script>
	';
	$container_style = "";
	$cover_container = '
		<div class="video-fallback" style="background-image:url('.$artabaz_nature['background_youtube_cover']['url'].') !important;"></div>
		<a class="player" data-property="{videoURL:\''.$artabaz_nature['background_youtube_link'].'\', containment:\'body\', autoPlay:true, mute:true, quality: \''.$artabaz_nature['background_youtube_quality'].'\', startAt:'.$artabaz_nature['background_youtube_startat'].', showControls:false, opacity:1}" data-poster="images/poster.jpg" ></a>
		<div class="cover"></div>
	';
}

else if($artabaz_nature['background_gradiant']==true){
	$background_id="gradient";
	$js_id = false;
	$gradiant_color_1_1_hex = $artabaz_nature['background_gradiant_1_1'];
	list($r, $g, $b) = sscanf($gradiant_color_1_1_hex, "#%02x%02x%02x");
	$gradiant_color_1_1_rgb = $r.",".$g.",".$b;
	
	$gradiant_color_1_2_hex = $artabaz_nature['background_gradiant_1_2'];
	list($r, $g, $b) = sscanf($gradiant_color_1_2_hex, "#%02x%02x%02x");
	$gradiant_color_1_2_rgb = $r.",".$g.",".$b;
	
	$gradiant_color_2_1_hex = $artabaz_nature['background_gradiant_2_1'];
	list($r, $g, $b) = sscanf($gradiant_color_2_1_hex, "#%02x%02x%02x");
	$gradiant_color_2_1_rgb = $r.",".$g.",".$b;
	
	$gradiant_color_2_2_hex = $artabaz_nature['background_gradiant_2_2'];
	list($r, $g, $b) = sscanf($gradiant_color_2_2_hex, "#%02x%02x%02x");
	$gradiant_color_2_2_rgb = $r.",".$g.",".$b;

	$container_style = "style='background-image:url(".$artabaz_nature['background_gradient_image']['url'].") !important;'";
	$cover_style="
		background: -moz-linear-gradient(-45deg, rgba(".$gradiant_color_1_1_rgb.",0.7) 0%, rgba(".$gradiant_color_1_2_rgb.",0.7) 100%) !important;
		background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(".$gradiant_color_1_1_rgb.",0.7)), color-stop(100%,rgba(".$gradiant_color_1_2_rgb.",0.7))) !important;
		background: -webkit-linear-gradient(-45deg, rgba(".$gradiant_color_1_1_rgb.",0.7) 0%,rgba(".$gradiant_color_1_2_rgb.",0.7) 100%) !important;
		background: -o-linear-gradient(-45deg, rgba(".$gradiant_color_1_1_rgb.",0.7) 0%,rgba(".$gradiant_color_1_2_rgb.",0.7) 100%) !important;
		background: -ms-linear-gradient(-45deg, rgba(".$gradiant_color_1_1_rgb.",0.7) 0%,rgba(".$gradiant_color_1_2_rgb.",0.7) 100%) !important;
		background: linear-gradient(135deg, rgba(".$gradiant_color_1_1_rgb.",0.7) 0%,rgba(".$gradiant_color_1_2_rgb.",0.7) 100%) !important;
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='".$gradiant_color_1_1_hex."', endColorstr='".$gradiant_color_1_2_hex."',GradientType=1 ) !important;
	";
	$cover_intro_style="
		background: -moz-linear-gradient(45deg, rgba(".$gradiant_color_2_1_rgb.",0.7) 0%, rgba(".$gradiant_color_2_2_rgb.",0.7) 100%) !important;
		background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,rgba(".$gradiant_color_2_1_rgb.",0.7)), color-stop(100%,rgba(".$gradiant_color_2_2_rgb.",0.7))) !important;
		background: -webkit-linear-gradient(45deg, rgba(".$gradiant_color_2_1_rgb.",0.7) 0%,rgba(".$gradiant_color_2_2_rgb.",0.7) 100%) !important;
		background: -o-linear-gradient(45deg, rgba(".$gradiant_color_2_1_rgb.",0.7) 0%,rgba(".$gradiant_color_2_2_rgb.",0.7) 100%) !important;
		background: -ms-linear-gradient(45deg, rgba(".$gradiant_color_2_1_rgb.",0.7) 0%,rgba(".$gradiant_color_2_2_rgb.",0.7) 100%) !important;
		background: linear-gradient(45deg, rgba(".$gradiant_color_2_1_rgb.",0.7) 0%,rgba(".$gradiant_color_2_2_rgb.",0.7) 100%) !important;
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='".$gradiant_color_2_1_hex."', endColorstr='".$gradiant_color_2_2_hex."',GradientType=1 ) !important;
	";
	$cover_container = '
		<div class="cover" style="'.$cover_style.'">
			<div class="cover-intro" style="'.$cover_intro_style.'"></div>
		</div>
	';
}
else{
	$background_id="animation";
	$js_id = "animation1";
	$container_style = "";
	$cover_background_style="style='background-color:rgba(0,0,0,0.7) !important;'";
	$cover_container = '<div id="cover" '.$cover_background_style.' class="cover"></div>';
}
?>