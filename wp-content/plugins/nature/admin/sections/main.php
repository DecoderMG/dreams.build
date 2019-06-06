<?php

$this->sections[] = array(
	'title'  => __( 'Main Settings', 'nature' ),
	'icon'   => 'el el-home',
	  'fields' => array(

	   //================================================plugin_mode
		array(
			'id'       => 'plugin_mode',
			'type'     => 'select',
			'title'    => __( 'plugin mode', 'nature' ),
			'subtitle' => __( 'Choose the mode in which you want the plugin to operate in.', 'nature' ),
			'desc'     => __( '<ul><li><strong>Off</strong> - nature will be switch off.</li><li><strong>Coming Soon Mode</strong> - <strong>JUST</strong> Visitors will see nature while you work on your theme (Administrator can not see).</li> ', 'nature' ),
			'options'  => array(
				'1' => 'Off',
				'2' => 'Coming Soon Mode',
				//'3' => 'maintenance mode',
			),
			'default'  => '1'
		),
		//================================================Skin
		 array(
			'id'       => 'can_edit_theme',
			'type'     => 'select',
			'title'    => __( 'Role', 'nature' ),
			'subtitle' => __( 'Choose <strong>role</strong> of your website can edit posts or pages(Preview the plugin will be disabled for this role )', 'nature' ),
			'description' => __( 'Above role, can not see the preview the plugin , Above role can to edit pages and posts', 'nature' ),
			'options'  => array(
				'administrator' => 'Administrator',
				'editor' => 'Editor',
				'author' => 'Author',
				'contributor' => 'Contributor',
				'subscriber' => 'Subscriber'
			),
			'default'  => 'administrator'

		),
		
		//================================================Skin
		 array(
			'id'       => 'skin',
			'type'     => 'select',
			'title'    => __( 'Style Type', 'nature' ),
			'subtitle' => __( 'Choose your style / light or dark', 'nature' ),
			'options'  => array(
				'light' => 'light',
				'dark' => 'dark'
			),
			'default'  => 'dark'

		),
		
		//================================================Skin Color
		array(
			'id'       => 'skin_color',
			'type'     => 'select',
			'title'    => __( 'Skin Color', 'nature' ),
			'subtitle' => __( 'Choose your skin Color', 'nature' ),
			'options'  => array(
				'red' => 'red',
				'teal' => 'teal',
				'blue' => 'blue',
				'brown' => 'brown',
				'orange' => 'orange',
				'green' => 'green',
				'torquoise' => 'torquoise',
				'vine' => 'vine',
				'violet' => 'violet',
				'yellow' => 'yellow'
			),
			'default'  => 'red'

		),
	  
	   //================================================logo_type
		array(
			'id'       => 'logo_type',
			'type'     => 'radio',
			'title'    => __( 'Logo Type', 'nature' ),
			'subtitle' => __( 'This can be accessed by using the <strong>[nature-logo]</strong> shortcode in your pages.', 'nature' ),
			'options'  => array(
				'image' => 'image',
				'title' => 'title',
			),
			'default'   => 'title',
		),
	   
	   //================================================logo_image
		array(
			'id'       => 'logo_image',
			'type'     => 'media',
			'title'    => __( 'Logo Image', 'nature' ),
			'required' => array( 'logo_type', "=", 'image' ),
		),
		
		//================================================logo_title
		 array(
			'id'       => 'logo_title',
			'type'     => 'text',
			'title'    => __( 'Logo Title', 'nature' ),
			'required' => array( 'logo_type', "=", 'title' ),
			'validate' => 'html',
			'default'  => "NEW<span>ONE</span>",
		),
		
		//================================================logo_desc
		 array(
			'id'       => 'logo_desc',
			'type'     => 'text',
			'title'    => __( 'Logo Subtitle', 'nature' ),
			'validate' => 'html',
			'default'  => "CREATE AWESOME STUFF",
		),
		
		//================================================text_slider
		array(
			'id'=>'text_slider',
			'type' => 'multi_text',
			'title' => __('Text Slider', 'nature'),
			'subtitle' => __('This can be accessed by using the <strong>[nature-text-slider]</strong> shortcode in your pages.', 'nature'),
			'validate' => 'html',
			'default' => array(
				'Show <span>The</span> World',
				'You Are Amazing',
				'In Every <b>Single</b> Way',
			),
		),
		
		//================================================coming_soon_html
		array(
			'id'=>'coming_soon_html',
			'type' => 'textarea',
			'title' => __('Coming Soon', 'nature'),
			'subtitle' => __('This can be accessed by using the <strong>[nature-description]</strong> shortcode in your pages.', 'nature'),
			'validate' => 'html',
			'default' => '<div class="description">'."\n\t".'<p class="uptodown">we are coming soon</p>'."\n\t".'<p class="jump"><span></span><i class="fa fa-heart breath direction" data-direction="up"></i><span></span></p>'."\n\t".'<p class="downtoup"> We come on time</p>'."\n".'</div>',
		),
	),
);
$this->sections[] = array(
	'title'  => __( 'Styling Options', 'nature' ),
	'icon'   => 'el el-website',
	'subsection' => true,
	'fields' => array(
		//================================================favicon
		array(
			'id'       => 'favicon',
			'type'     => 'media',
			'title'    => __( 'Favicon', 'nature' ),
			'desc'     => __( 'Use a 16x16 .ico or .png file.', 'nature' ),
			'subtitle' => __( 'This is the icon displayed in the browser title bar.', 'nature' ),
		),
		///////////////////////////////////////////////////////////////////////////////ios_icon
		array(
			'id'       => 'ios_icon',
			'type'     => 'switch',
			'title'    => __( 'IOS icon', 'nature' ),
			'subtitle' => __( 'Make sure that your website is prepared for mobile browsing.', 'nature' ),
		),
		 array(
			'id'       => 'ios_icon_section',
			'type'     => 'section',
			'indent'   => true, 
		),
		//================================================iphone_icon
		array(
			'id'       => 'iphone_icon',
			'type'     => 'media',
			'title'    => __( 'classic iPhone / iPod icon', 'nature' ),
			'desc'     => __( 'Use a .png file.', 'nature' ),
			'subtitle' => __( 'This is the icon to save your webpage to the home screen.', 'nature' ),
			'required' => array( 'ios_icon', "=", 1 ),
		),
		//================================================ipad_icon
		array(
			'id'       => 'ipad_icon',
			'type'     => 'media',
			'title'    => __( 'iPad icon', 'nature' ),
			'desc'     => __( 'Use a 76x76 .png file.', 'nature' ),
			'subtitle' => __( 'This is the icon to save your webpage to the home screen.', 'nature' ),
			'required' => array( 'ios_icon', "=", 1 ),
		),
		//================================================iphone_icon_retina
		array(
			'id'       => 'iphone_icon_retina',
			'type'     => 'media',
			'title'    => __( 'iPhone / iPod Retina icon', 'nature' ),
			'desc'     => __( 'Use a 120x120 .png file.', 'nature' ),
			'subtitle' => __( 'This is the icon to save your webpage to the home screen.', 'nature' ),
			'required' => array( 'ios_icon', "=", 1 ),
		),
		//================================================ipad_icon_retina
		array(
			'id'       => 'ipad_icon_retina',
			'type'     => 'media',
			'title'    => __( 'iPad Retina icon', 'nature' ),
			'desc'     => __( 'Use a 152×152 .png file.', 'nature' ),
			'subtitle' => __( 'This is the icon to save your webpage to the home screen.', 'nature' ),
			'required' => array( 'ios_icon', "=", 1 ),
		),
		
		array(
			'id'       => 'iphone6_icon',
			'type'     => 'media',
			'title'    => __( 'iPhone 6 Plus icon', 'nature' ),
			'desc'     => __( 'Use a 180×180 .png file.', 'nature' ),
			'subtitle' => __( 'This is the icon to save your webpage to the home screen.', 'nature' ),
			'required' => array( 'ios_icon', "=", 1 ),
		),
		array(
			'id'       => 'ios_icon_section_end',
			'type'     => 'section',
			'indent'   => false,
		),
		
		//================================================mouse_scroll_effect
		array(
		'id'=>'mouse_scroll_effect',
		'type' => 'switch',
		'title' => __('Mouse Scroll Effect', 'nature'),
		'subtitle'=> __('This fun effect is great if you happen to have a lot users who utilize a mousewheel.', 'nature'),
		'default'       => 1,
		),
		//================================================load-other-assets
		array(
		'id'=>'load-other-assets',
		'type' => 'switch',
		'title' => __('Load Styles and Scripts from other Plugins', 'nature'),
		'subtitle'=> __('<p>Choose whether or not to load CSS and Javascript files enqueued by the active theme and other active plugins.</p><p>This will allow you to use any shortcodes that other plugins provide but <strong>may break nature.</strong></p>', 'nature'),
		'default'      => 0,
		),
		//================================================custom_css
		array(
			'id'       => 'custom_css',
			'type'     => 'ace_editor',
			'title'    => __( 'custom css', 'nature' ),
			'subtitle' => __( 'Paste your CSS code here.', 'nature' ),
			'mode'     => 'css',
			'desc'     => 'Use this field to customize the layout or style of your nature install.',
			'default'  => ''
		),
		
		//================================================custom_html
		array(
			'id'       => 'custom_html',
			'type'     => 'ace_editor',
			'title'    => __( 'Custom HTML', 'nature' ),
			'subtitle' => __( 'Paste your HTML code here.', 'nature' ),
			'desc'     => __( 'Inserts HTML before the closing </body> tag. For example, it can be used to add your Google Analytics code.', 'nature' ),
			'mode' => 'html',
			'default'  => ''
		),
	),
);

$this->sections[] = array(
	'title'  => __( 'Typography', 'nature' ),
	'icon'   => 'el el-fontsize',
	'desc'   => __( 'Manage fonts and typography settings.', 'nature' ),
	'subsection' => true,
	'fields' => array(
		array(
			'id'   => 'typography-info-field',
			'type' => 'info',
			'style' => 'critical',
			'desc'   => __( 'If you do not want to change the default font style, please skip this section without change', 'nature' ),
		),
	
	//================================================body-typography
		array(
			'id'       => 'change-fonts',
			'type'     => 'switch',
			'title'    => __('Custom Fonts', 'nature'), 
			'subtitle' => __('If you do not want to change the default fonts style, please skip this section without change', 'nature'),
			'desc'     => __('Click on the above options to be enabled options.', 'nature'),
			'off'    => __('Default font', 'nature'), 
			'on'    => __('Custom font', 'nature'), 
			'indent'  => true,
		),
		array(
			'id'          => 'body-typography',
			'type'        => 'typography', 
			'title'       => __('Main text font', 'nature'),
			'subtitle'    => __('This is your main font, used for standard text', 'nature'),
			'required' => array( 'change-fonts', "=", 1 ),
			'google'      => true,
			'subsets'     => false,
			'line-height' => false,
			'color'       => false,
			'font-style'  => false,
			'text-align'  => false,
			'font-weight' => true,
			'units'       =>'px',
			'preview'     => array(
				'text'        		=>'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',
				'always_display'    =>true,
			),			
			'default'     => array(
				'font-size'  		=> '16', 
				'font-weight'  		=> '400', 
				'font-family'		=> 'Raleway', 
				'google'      		=> true,
			),
		),
		//================================================slider-typography
		array(
			'id'          => 'slider-typography',
			'type'        => 'typography', 
			'title'       => __('Slider text font', 'nature'),
			'subtitle'    => __('This is your main font, used for Slider text', 'nature'),
			'required' => array( 'change-fonts', "=", 1 ),
			'google'      => true,
			'subsets'     => false,
			'line-height' => false,
			'color'       => false,
			'font-style'  => false,
			'font-size'   => false,
			'text-align'  => false,
			'font-weight' => true,
			'units'       =>'rem',
			'preview'     => array(
				'text'       		 =>'<span style="font-size:60px">SHOW THE WORLD</span>',
				'always_display'     =>true,
			),

			'default'     => array(
				'font-weight'  		 => '700', 
				'font-family'		 => 'Raleway', 
				'google'   			 => true,
			),
		),
		//================================================timer-typography
		array(
			'id'          => 'timer-typography',
			'type'        => 'typography', 
			'title'       => __('Countdown timer text font', 'nature'),
			'subtitle'    => __('This is a font used for main website Countdown timer', 'nature'),
			'required' => array( 'change-fonts', "=", 1 ),
			'google'      => true,
			'subsets'     => false,
			'line-height' => false,
			'color'       => false,
			'text-align'  => false,
			'font-style'  => false,
			'font-size'   => false,
			'font-weight' => true,
			'units'       => 'rem',
			'preview'     => array(
				'text'       		 =>'<span style="font-size:40px">98 76 54</span>',
				'always_display'     =>true,
			),
			'default'     => array(
				'font-family' 		 => 'Open Sans', 
				'font-weight' 		 => '700', 
				'google'     		 => true,
			),
		),
	),
);

?>