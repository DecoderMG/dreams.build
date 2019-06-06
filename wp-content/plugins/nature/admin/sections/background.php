<?php

$this->sections[] = array(
	'title'  => __( 'Background Settings', 'nature' ),
	'desc'   => __( '<strong>Note</strong>: When you choose a background type. Please disable others backgrounds.', 'nature' ),
	'icon'   => 'el-icon-picture',
		'fields' => array(
			
			//----------------------------------------------------animation 1
			array(
				'id'       => 'background_animation_1',
				'type'     => 'switch',
				'title'    => __( 'Red Origami Background', 'nature' ),
				'default'       => 1,
			),
			array(
				'id'       => 'background_animation_1_section',
				'type'     => 'section',
				'indent'   => true,
				'required' => array( 'background_animation_1', "=", 1 ),
			),
			/*
			array(
				'id'       => 'background_animation_1_color',
				'type'     => 'color',
				'title'    => __('Color', 'nature'),
				'default'  => '#FFFFFF',
				'validate' => 'color',
			),
			*/
			array(
				'id'       => 'background_animation_1_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			//----------------------------------------------------animation 2
			array(
				'id'       => 'background_animation_2',
				'type'     => 'switch',
				'title'    => __( 'Green Origami Background', 'nature' ),
			),
			array(
				'id'       => 'background_animation_2_section',
				'type'     => 'section',
				'indent'   => true,
				'required' => array( 'background_animation_2', "=", 1 ),
			),
			/*
			array(
				'id'       => 'background_animation_2_color',
				'type'     => 'color',
				'title'    => __('Color', 'nature'),
				'default'  => '#FFFFFF',
				'validate' => 'color',
			),
			*/
			array(
				'id'       => 'background_animation_2_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			
			//----------------------------------------------------animation 3
			array(
				'id'       => 'background_animation_3',
				'type'     => 'switch',
				'title'    => __( 'Fantasy Background', 'nature' ),
			),
			array(
				'id'       => 'background_animation_3_section',
				'type'     => 'section',
				'indent'   => true, // Indent all options below until the next 'section' option is set.
				'required' => array( 'background_animation_3', "=", 1 ),
			),
			array(
				'id'       => 'background_animation_3_image',
				'type'     => 'media',
				'title'    => __( 'Background Image', 'nature' ),
				'mode'     => false,
				'subtitle' => __( 'Select the images you want in the background', 'nature' ),
				
			),
			array(
				'id'       => 'background_animation_3_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
		
			//----------------------------------------------------animation 4
			array(
				'id'       => 'background_animation_4',
				'type'     => 'switch',
				'title'    => __( 'Bubble Background', 'nature' ),
			),
			array(
				'id'       => 'background_animation_4_section',
				'type'     => 'section',
				'indent'   => true,
				'required' => array( 'background_animation_4', "=", 1 ),
			),
			array(
				'id'       => 'background_animation_4_image',
				'type'     => 'media',
				'title'    => __( 'Background Image', 'nature' ),
				'mode'     => false,
				'subtitle' => __( 'Select the images you want in the background', 'nature' ),
			),
			array(
				'id'       => 'background_animation_4_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			
			//----------------------------------------------------Gradiant
			array(
				'id'       => 'background_gradiant',
				'type'     => 'switch',
				'title'    => __( 'Gradiant Background', 'nature' ),
			),
			array(
				'id'       => 'background_gradiant_section',
				'type'     => 'section',
				'indent'   => true,
				'required' => array( 'background_gradiant', "=", 1 ),
			),
			array(
				'id'       => 'background_gradiant_1_1',
				'type'     => 'color',
				'title'    => __('create gradient 1 from', 'nature'),
				'default'  => '#FFFFFF',
				'validate' => 'color',
			),
			array(
				'id'       => 'background_gradiant_1_2',
				'type'     => 'color',
				'title'    => __('to', 'nature'),
				'default'  => '#FFFFFF',
				'validate' => 'color',
			),
			array(
				'id'       => 'background_gradiant_2_1',
				'type'     => 'color',
				'title'    => __('create gradient 2 from', 'nature'),
				'default'  => '#FFFFFF',
				'validate' => 'color',
			),
			array(
				'id'       => 'background_gradiant_2_2',
				'type'     => 'color',
				'title'    => __('to', 'nature'),
				'default'  => '#FFFFFF',
				'validate' => 'color',
			),
			array(
				'id'       => 'background_gradient_image',
				'type'     => 'media',
				'title'    => __('Background Image', 'nature'),
				'subtitle' => __('Select the images you want in the background', 'nature'),
			),
			array(
				'id'       => 'background_gradiant_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			//----------------------------------------------------Image
			array(
				'id'       => 'background_image',
				'type'     => 'switch',
				'title'    => __( 'Static Image Background', 'nature' ),
			),
			array(
				'id'       => 'background_image_section',
				'type'     => 'section',
				'indent'   => true, // Indent all options below until the next 'section' option is set.
				'required' => array( 'background_image', "=", 1 ),
			),
			array(
				'id'       => 'background_image_upload',
				'type'     => 'media',
				'title'    => __( 'Background Image', 'nature' ),
				'mode'     => false,
				'subtitle' => __( 'Select the images you want in the background', 'nature' ),
			),
			array(
				'id'       => 'background_image_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			//----------------------------------------------------map
			array(
				'id'       => 'background_map',
				'type'     => 'switch',
				'title'    => __( 'Google Map Background', 'nature' ),
			),
			array(
				'id'       => 'background_map_section',
				'type'     => 'section',
				'indent'   => true, // Indent all options below until the next 'section' option is set.
				'required' => array( 'background_map', "=", 1 ),
			),
			array(
				'id'       => 'background_map_lat',
				'type'     => 'text',
				'title'    => __('Latitude', 'nature'),
				'desc' => __('You can find your custom map address from this site : http://ctrlq.org/maps/address/', 'nature', 'nature'),
				'default'  => '60.500525',
			),
			array(
				'id'       => 'background_map_lang',
				'type'     => 'text',
				'title'    => __('Longitude', 'nature'),
				'desc' => __('You can find your custom map address from this site : http://ctrlq.org/maps/address/', 'nature', 'nature'),
				'default'  => '-164.318849',
			),
			array(
				'id'       => 'background_map_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			
			//----------------------------------------------------Parallax
			array(
				'id'       => 'background_parallax',
				'type'     => 'switch',
				'title'    => __( 'Parallax Background', 'nature' ),
			),
			array(
				'id'       => 'background_parallax_section',
				'type'     => 'section',
				'indent'   => true, // Indent all options below until the next 'section' option is set.
				'required' => array( 'background_parallax', "=", 1 ),
			),
			array(
				'id'       => 'background_parallax_image_1',
				'type'     => 'media',
				'title'    => __( 'Image 1', 'nature' ),
				'mode'     => false,
				'default'  => array(
					'id'   		=> 'nature_parallax_3',
					'url'	    => plugins_url()."/nature/template/media/parallax/3.png",
					'width'	 	=> 1013,
					'height' 	=> 300,
					'thumbnail'	=> plugins_url()."/nature/template/media/parallax/3-150x150.png",
				),
			),
			array(
				'id'       => 'background_parallax_speed_1',
				'type'     => 'text',
				'title'    => __('Speed 1', 'nature'),
				'default'  => '0.30',
			),
			array(
				'id'       => 'background_parallax_image_2',
				'type'     => 'media',
				'title'    => __( 'Image 2', 'nature' ),
				'mode'     => false,
				'default'  => array(
					'id'  		 => 'nature_parallax_5',
					'url' 		 => plugins_url()."/nature/template/media/parallax/5.png",
					'width'		 => 96,
					'height' 	 => 61,
					'thumbnail'	 => plugins_url()."/nature/template/media/parallax/5.png",
				),
			),
			array(
				'id'       => 'background_parallax_speed_2',
				'type'     => 'text',
				'title'    => __('Speed 2', 'nature'),
				'default'  => '0.60',
			),
			array(
				'id'       => 'background_parallax_image_3',
				'type'     => 'media',
				'title'    => __( 'Image 3', 'nature' ),
				'mode'     => false,
				'default'  => array(
					'id'  	 => 'nature_parallax_1',
					'url' 		=> plugins_url()."/nature/template/media/parallax/1.png",
					'width'		=> 325,
					'height' 	=> 700,
					'thumbnail'	=> plugins_url()."/nature/template/media/parallax/1-150x150.png",
				),
			),
			array(
				'id'       => 'background_parallax_speed_3',
				'type'     => 'text',
				'title'    => __('Speed 3', 'nature'),
				'default'  => '0.20',
			),
			array(
				'id'       => 'background_parallax_image_4',
				'type'     => 'media',
				'title'    => __( 'Image 4', 'nature' ),
				'mode'     => false,
				'default'  => array(
					'id' 		 => 'nature_parallax_2',
					'url'		 => plugins_url()."/nature/template/media/parallax/2.png",
					'width'		 => 396,
					'height'	 => 550,
					'thumbnail'	 => plugins_url()."/nature/template/media/parallax/2-150x150.png",
				),
			),
			array(
				'id'       => 'background_parallax_speed_4',
				'type'     => 'text',
				'title'    => __('Speed 4', 'nature'),
				'default'  => '0.70',
			),
			array(
				'id'       => 'background_parallax_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			
			//----------------------------------------------------Pattern
			array(
				'id'       => 'background_pattern',
				'type'     => 'switch',
				'title'    => __( 'Pattern Background', 'nature' ),
			),
			array(
				'id'       => 'background_pattern_section',
				'type'     => 'section',
				'indent'   => true, // Indent all options below until the next 'section' option is set.
				'required' => array( 'background_pattern', "=", 1 ),
			),
			array(
				'id'       => 'background_pattern_select',
				'type'     => 'image_select',
				'title'    => __('Pattern Preset', 'nature'), 
				'subtitle' => __('Select a background pattern.', 'nature'),
				'options'  => array(
					'1'      => array(
						'alt'   => '1', 
						'img'   => plugins_url()."/nature/template/media/pattern/1.png",
					),
					'2'      => array(
						'alt'   => '2', 
						'img'   => plugins_url()."/nature/template/media/pattern/2.png",
					),
					'3'      => array(
						'alt'   => '3', 
						'img'  => plugins_url()."/nature/template/media/pattern/3.png",
					),
					'4'      => array(
						'alt'   => '4', 
						'img'   => plugins_url()."/nature/template/media/pattern/4.png",
					),
					'5'      => array(
						'alt'   => '5', 
						'img'   => plugins_url()."/nature/template/media/pattern/5.png",
					),
					'6'      => array(
						'alt'  => '6', 
						'img'  => plugins_url()."/nature/template/media/pattern/6.png",
					),
					'7'      => array(
						'alt'  => '7', 
						'img'  => plugins_url()."/nature/template/media/pattern/7.png",
					),
					'8'      => array(
						'alt'  => '8', 
						'img'  => plugins_url()."/nature/template/media/pattern/8.png",
					)
				),
				'default' => '1',
				'width' => 100,
				'height' => 100,
			),
			array(
				'id'       => 'background_pattern_upload',
				'type'     => 'media',
				'title'    => __( 'Custom Pattern', 'nature' ),
				'mode'     => false,
				'subtitle' => __( 'Select the images you want in the pattern', 'nature' ),
			),
			array(
				'id'       => 'background_pattern_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			//----------------------------------------------------Rain
			array(
				'id'       => 'background_rain',
				'type'     => 'switch',
				'title'    => __( 'Rain Background', 'nature' ),
			),
			array(
				'id'       => 'background_rain_section',
				'type'     => 'section',
				'indent'   => true, // Indent all options below until the next 'section' option is set.
				'required' => array( 'background_rain', "=", 1 ),
			),
			array(
				'id'       => 'background_rain_image',
				'type'     => 'media',
				'title'    => __( 'Background Image', 'nature' ),
				'mode'     => false,
				'subtitle' => __( 'Select the images you want in the background', 'nature' ),
			),
			array(
				'id'       => 'background_rain_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			
			//----------------------------------------------------Snow
			array(
				'id'       => 'background_snow',
				'type'     => 'switch',
				'title'    => __( 'Snow Background', 'nature' ),
			),
			array(
				'id'       => 'background_snow_section',
				'type'     => 'section',
				'indent'   => true, // Indent all options below until the next 'section' option is set.
				'required' => array( 'background_snow', "=", 1 ),
			),
			array(
				'id'       => 'background_snow_image',
				'type'     => 'media',
				'title'    => __( 'Background Image', 'nature' ),
				'mode'     => false,
				'subtitle' => __( 'Select the images you want in the background', 'nature' ),
			),
			array(
				'id'       => 'background_snow_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			
			//----------------------------------------------------Slider
			array(
				'id'       => 'background_slider',
				'type'     => 'switch',
				'title'    => __( 'Slider Background', 'nature' ),
			),
			array(
				'id'       => 'background_slider_section',
				'type'     => 'section',
				'indent'   => true, // Indent all options below until the next 'section' option is set.
				'required' => array( 'background_slider', "=", 1 ),
			),
			array(
				'id'       => 'background_slider_images',
				'type'     => 'gallery',
				'title'    => __('Slideshow Images', 'nature'),
				'subtitle' => __('Select the images you want in the slideshow', 'nature'),
			),
			array(
				'id'       => 'background_slider_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			
			//----------------------------------------------------Solid
			array(
				'id'       => 'background_solid',
				'type'     => 'switch',
				'title'    => __( 'Solid Background', 'nature' ),
			),
			array(
				'id'       => 'background_solid_section',
				'type'     => 'section',
				'indent'   => true,
				'required' => array( 'background_solid', "=", 1 ),
			),
			array(
				'id'       => 'background_solid_color',
				'type'     => 'color',
				'title'    => __('Color', 'nature'),
				'subtitle' => __('Select the color you want in the background', 'nature'),
				'default'  => '#FFFFFF',
				'validate' => 'color',
			),
			array(
				'id'       => 'background_solid_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			
			//----------------------------------------------------Video
			array(
				'id'       => 'background_video',
				'type'     => 'switch',
				'title'    => __( 'Video Background', 'nature' ),
			),
			array(
				'id'       => 'background_video_section',
				'type'     => 'section',
				'indent'   => true, // Indent all options below until the next 'section' option is set.
				'required' => array( 'background_video', "=", 1 ),
			),
			array(
				'id'       => 'background_video_mp4',
				'type'     => 'media',
				'title'    => __( 'Video File - MP4', 'nature' ),
				'mode'     => false,
				'subtitle' => __( 'H.264 (mp4) video format file. This one is required because we use it to fall back to Flash playback when HTML5 video support is missing. For example, Firefox only supports this format natively on Windows so on other systems it will fallback to Flash playback which is a bit slower.', 'nature' ),
			),
			array(
				'id'       => 'background_video_webm',
				'type'     => 'media',
				'title'    => __( 'Video File - WebM', 'nature' ),
				'mode'     => false,
				'subtitle' => __( 'Optional WebM format. WebM files are generally smaller and faster than H.264 and are played by Chrome, Firefox, Opera and Android browsers (which also support H.264).', 'nature' ),
			),
			array(
				'id'       => 'background_video_ogg',
				'type'     => 'media',
				'title'    => __( 'Video File - OGG', 'nature' ),
				'mode'     => false,
				'subtitle' => __( 'Optional OGG format. OGG Video is optional but useful because it’s played natively by Firefox on OSX and Linux.', 'nature' ),
			),
			array(
				'id'       => 'background_video_cover',
				'type'     => 'media',
				'title'    => __( 'Video Fallback Image', 'nature' ),
				'mode'     => false,
				'subtitle' => __( 'Fallback image for browsers that can not play video (such as mobile devices).', 'nature' ),
			),
			array(
				'id'       => 'background_video_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			
			//----------------------------------------------------Youtube
			array(
				'id'       => 'background_youtube',
				'type'     => 'switch',
				'title'    => __( 'Youtube Background', 'nature' ),
			),
			array(
				'id'       => 'background_youtube_section',
				'type'     => 'section',
				'indent'   => true,
				'required' => array( 'background_youtube', "=", 1 ),
			),
			array(
				'id'       => 'background_youtube_link',
				'type'     => 'text',
				'title'    => __( 'YouTube URL', 'nature' ),
				'subtitle' => __( 'The URL of the Youtube Video.', 'nature' ),
			),
			array(
				'id'       => 'background_youtube_quality',
				'type'     => 'select',
				'title'    => __('Youtube Quality', 'nature'), 
				'subtitle' => __('you can choose your quality video youtube', 'nature'),
				'options'  => array(
					'small' => 'small',
					'medium' => 'medium',
					'large' => 'large',
					'hd720' => 'hd720',
					'hd1080' => 'hd1080',
					'highres' => 'highres'
				),
				'default'  => 'small',
			),
			array(
				'id'       => 'background_youtube_startat',
				'type'     => 'text',
				'title'    => __( 'YouTube Video - Start at', 'nature' ),
				'subtitle' => __( 'If you dont’t want the video to start from the very beginning, enter the time offset in seconds.', 'nature' ),
				'default'  => '0',
			),
			array(
				'id'       => 'background_youtube_cover',
				'type'     => 'media',
				'title'    => __( 'Video Fallback Image', 'nature' ),
				'mode'     => false,
				'subtitle' => __( 'Fallback image for browsers that can not play video (such as mobile devices).', 'nature' ),
			),
			array(
				'id'       => 'background_youtube_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			
			//----------------------------------------------------Star
			array(
				'id'       => 'background_star',
				'type'     => 'switch',
				'title'    => __( 'Star Background', 'nature' ),
			),
			array(
				'id'       => 'background_star_section',
				'type'     => 'section',
				'indent'   => true,
				'required' => array( 'background_star', "=", 1 ),
			),
			array(
				'id'       => 'background_star_image',
				'type'     => 'media',
				'title'    => __( 'Background Image', 'nature' ),
				'mode'     => false,
				'subtitle' => __( 'Select the images you want in the background', 'nature' ),
			),
			array(
				'id'       => 'background_star_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
			//----------------------------------------------------Cloud
			array(
				'id'       => 'background_cloud',
				'type'     => 'switch',
				'title'    => __( 'Cloud Background', 'nature' ),
			),
			array(
				'id'       => 'background_cloud_section',
				'type'     => 'section',
				'indent'   => true,
				'required' => array( 'background_cloud', "=", 1 ),
			),
			array(
				'id'       => 'background_cloud_image',
				'type'     => 'media',
				'title'    => __( 'Background Image', 'nature' ),
				'mode'     => false,
				'subtitle' => __( 'Select the images you want in the background', 'nature' ),
			),
			array(
				'id'       => 'background_cloud_section_end',
				'type'     => 'section',
				'indent'   => false,
			),
		),
	);
?>