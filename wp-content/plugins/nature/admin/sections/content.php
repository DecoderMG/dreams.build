<?php

$this->sections[] = array(
	'title'  => __( 'Page Content', 'nature' ),
	'icon'   => 'el-icon-file-edit',
	'fields' => array(
		array(
			'id'   => 'page-content-info-field',
			'type' => 'info',
			'style' => 'success',
			'desc'   => __( '
				In this section you can edit the content of your pages.
				<p>The following shortcodes are available:</p>
				<ul>
					<li><strong>[nature-logo]</strong> : Displays the logo as configured in the Main Settings section.</li>
					<li><strong>[nature-text-slider]</strong> : Displays the slider as configured in the Main Settings section.</li>
					<li><strong>[nature-description]</strong> : Displays the Live Heart as configured in the Main Settings section.</li>
					<li><strong>[nature-countdown-counter]</strong> : Displays the countdown timer as configured in the Countdown Settings section.</li>
					<li><strong>[nature-subscribe-form]</strong> : Displays the "Get Notified" subscription form as configured in the Subscribe Settings section.</li>
					<li><strong>[nature-social]</strong> : Displays the "Get Notified" subscription form as configured in the Subscribe Settings section.</li>
					<li><strong>[nature-contact-box]</strong> : Displays the contact info (phone, e-mail, etc.) as configured in the Contact Settings section.</li>
					<li><strong>[nature-contact-form]</strong> : Displays the contact form as configured in the Contact Settings section.</li>
					<li><strong>[nature-blog-posts]</strong> : Displays the blog posts as configured in the Blog Settings section.</li>
					<li><strong>[nature-service-boxes]</strong> : Displays the service boxes as configured in the Service Settings section.</li>
					<li><strong>[nature-about-team]</strong> : Displays the teams as configured in the Team Settings section.</li>
					<li><strong>[nature-blog-icon]</strong> : Displays the blog icon as configured in the Blog Settings section.</li>
					<li><strong>[nature-subscribe-icon]</strong> : Displays the subscribe icon as configured in the Subscribe Settings section.</li>
					<li><strong>[nature-countdown-icon]</strong> : Displays the countdown icon as configured in the Countdown Settings section.</li>
				</ul>
			', 'nature' ),
		),
	),
);
$this->sections[] = array(
	'title'  => __( 'Home', 'nature' ),
	'icon'   => 'el el-home',
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'home_page',
			'type'     => 'switch',
			'title'    => __( 'Home Page Content', 'nature' ),
			'subtitle' => __( 'Choose whether or not you want the home page and button to be displayed.', 'nature' ),
			'default'       => 1,
		),
		
		array(
			'id'       => 'home_page_section',
			'type'     => 'section',
			'indent'   => true, 
			'required' => array( 'home_page', "=", 1 ),
		),
		array(
			'id'       => 'home_page_content',
			'type'     => 'editor',
			'default'  => "[nature-logo]\n\n[nature-text-slider]\n\n[nature-description]",
			'args'   => array(
				'teeny'            => false,
				'textarea_rows'    => 15,
			)
		),
		array(
			'id'       => 'home_page_label',
			'type'     => 'text',
			'title'    => __( 'Home Page label', 'nature' ),
			'subtitle' => __( 'your home Page label', 'nature' ),
			'default'  => 'Home',
		),
		//start arrows
		array(
			'id'       => 'home_page_arrow',
			'type'     => 'select',
			'title'    => __('Home page arrows', 'nature'),
			'subtitle' => __('choose your custom arrows', 'nature'),
			'multi'    => true,
			'options' => array(
				'top' =>	 'Top', 
				'bottom' =>  'Bottom', 
				'left' => 	 'Left',
				'right' =>   'Right',
			),
			'default' => array('left','right','bottom')
		),
		array(
			'id'	   =>'home_page_icon_top',
			'type' 	   => 'select',
			'title'    => __('Top arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-up',
			'required' => array( 'home_page_arrow', "=", 'top' ),
		),
		array(
			'id'       => 'home_page_arrow_top',
			'type'     => 'text',
			'title'    => __( 'Top arrow label', 'nature' ),
			'default'  => 'Top',
			'required' => array( 'home_page_arrow', "=", 'top' ),
		),
		array(
			'id'	   =>'home_page_icon_bottom',
			'type' 	   => 'select',
			'title'    => __('Bottom arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-down',
			'required' => array( 'home_page_arrow', "=", 'bottom' ),
		),
		array(
			'id'       => 'home_page_arrow_bottom',
			'type'     => 'text',
			'title'    => __( 'Bottom arrow label', 'nature' ),
			'default'  => 'Bottom',
			'required' => array( 'home_page_arrow', "=", 'bottom' ),
		),
		array(
			'id'	   =>'home_page_icon_left',
			'type' 	   => 'select',
			'title'    => __('Left arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-left',
			'required' => array( 'home_page_arrow', "=", 'left' ),
		),
		array(
			'id'       => 'home_page_arrow_left',
			'type'     => 'text',
			'title'    => __( 'Left arrow label', 'nature' ),
			'default'  => 'Left',
			'required' => array( 'home_page_arrow', "=", 'left' ),
		),
		array(
			'id'	   =>'home_page_icon_right',
			'type' 	   => 'select',
			'title'    => __('Right arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-right',
			'required' => array( 'home_page_arrow', "=", 'right' ),
		),
		array(
			'id'       => 'home_page_arrow_right',
			'type'     => 'text',
			'title'    => __( 'Right arrow label', 'nature' ),
			'default'  => 'Right',
			'required' => array( 'home_page_arrow', "=", 'right' ),
		),
		//end arrows
		array(
			'id'       => 'home_page_block',
			'type'     => 'image_select',
			'title'    => __('Blocks', 'nature'), 
			'subtitle' => __('Select a block.', 'nature'),
			'options'  => array(
				'[0,0]'      => array(
					'alt'   => '1', 
					'img'   => plugins_url()."/nature/template/media/options/0x0.png",
				),
				'[0,1]'      => array(
					'alt'   => '2', 
					'img'   => plugins_url()."/nature/template/media/options/0x1.png",
				),
				'[0,2]'      => array(
					'alt'   => '3', 
					'img'  => plugins_url()."/nature/template/media/options/0x2.png",
				),
				'[0,3]'      => array(
					'alt'   => '4', 
					'img'   => plugins_url()."/nature/template/media/options/0x3.png",
				),
				'[1,0]'      => array(
					'alt'   => '5', 
					'img'   => plugins_url()."/nature/template/media/options/1x0.png",
				),
				'[1,1]'      => array(
					'alt'  => '6', 
					'img'  => plugins_url()."/nature/template/media/options/1x1.png",
				),
				'[1,2]'      => array(
					'alt'  => '7', 
					'img'  => plugins_url()."/nature/template/media/options/1x2.png",
				),
				'[1,3]'      => array(
					'alt'  => '8', 
					'img'  => plugins_url()."/nature/template/media/options/1x3.png",
				),
				'[2,0]'      => array(
					'alt'   => '9', 
					'img'   => plugins_url()."/nature/template/media/options/2x0.png",
				),
				'[2,1]'      => array(
					'alt'   => '10', 
					'img'   => plugins_url()."/nature/template/media/options/2x1.png",
				),
				'[2,2]'      => array(
					'alt'   => '11', 
					'img'  => plugins_url()."/nature/template/media/options/2x2.png",
				),
				'[2,3]'      => array(
					'alt'   => '12', 
					'img'   => plugins_url()."/nature/template/media/options/2x3.png",
				),
				'[3,0]'      => array(
					'alt'   => '13', 
					'img'   => plugins_url()."/nature/template/media/options/3x0.png",
				),
				'[3,1]'      => array(
					'alt'  => '14', 
					'img'  => plugins_url()."/nature/template/media/options/3x1.png",
				),
				'[3,2]'      => array(
					'alt'  => '15', 
					'img'  => plugins_url()."/nature/template/media/options/3x2.png",
				),
				'[3,3]'      => array(
					'alt'  => '16', 
					'img'  => plugins_url()."/nature/template/media/options/3x3.png",
				)
			),
			'default' => '[1,2]',
			'width' => 65,
			'height' => 65,
		),
		array(
			'id'       => 'home_page_section_end',
			'type'     => 'section',
			'indent'   => false,
		),
	),
);
		///////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
$this->sections[] = array(
	'title'  => __( 'Contact', 'nature' ),
	'icon'   => 'el el-envelope',
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'contact_page',
			'type'     => 'switch',
			'title'    => __( 'Contact Page Content', 'nature' ),
			'subtitle' => __( 'Choose whether or not you want the contact page and button to be displayed.', 'nature' ),
		),
		array(
			'id'       => 'contact_page_section',
			'type'     => 'section',
			'indent'   => true,
			'required' => array( 'contact_page', "=", 1 ),
		),
		 array(
			'id'       => 'contact_page_content',
			'type'     => 'editor',
			'default'  => "<div class='row header'><h2>Do you have a <b>question?</b></h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius.</p></div>\n\n[nature-contact-box]\n[nature-contact-form]",
			'args'   => array(
				'teeny'            => false,
				'textarea_rows'    => 15,
			)
		),
		array(
			'id'       => 'contact_page_label',
			'type'     => 'text',
			'title'    => __( 'Contact Page label', 'nature' ),
			'subtitle' => __( 'your Contact Page label', 'nature' ),
			'default'  => 'Contact',
		),
		//start arrows
		array(
			'id'       => 'contact_page_arrow',
			'type'     => 'select',
			'title'    => __('Contact page arrows', 'nature'),
			'subtitle' => __('choose your custom arrows', 'nature'),
			'multi'    => true,
			'options' => array(
				'top' =>	 'Top', 
				'bottom' =>  'Bottom', 
				'left' => 	 'Left',
				'right' =>   'Right',
			),
			'default' => 'left',
		),
		array(
			'id'	   =>'contact_page_icon_top',
			'type' 	   => 'select',
			'title'    => __('Top arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-up',
			'required' => array( 'contact_page_arrow', "=", 'top' ),
		),
		array(
			'id'       => 'contact_page_arrow_top',
			'type'     => 'text',
			'title'    => __( 'Top arrow label', 'nature' ),
			'default'  => 'Top',
			'required' => array( 'contact_page_arrow', "=", 'top' ),
		),
		array(
			'id'	   =>'contact_page_icon_bottom',
			'type' 	   => 'select',
			'title'    => __('Bottom arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-down',
			'required' => array( 'contact_page_arrow', "=", 'bottom' ),
		),
		array(
			'id'       => 'contact_page_arrow_bottom',
			'type'     => 'text',
			'title'    => __( 'Bottom arrow label', 'nature' ),
			'default'  => 'Bottom',
			'required' => array( 'contact_page_arrow', "=", 'bottom' ),
		),
		array(
			'id'	   =>'contact_page_icon_left',
			'type' 	   => 'select',
			'title'    => __('Left arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-left',
			'required' => array( 'contact_page_arrow', "=", 'left' ),
		),
		array(
			'id'       => 'contact_page_arrow_left',
			'type'     => 'text',
			'title'    => __( 'Left arrow label', 'nature' ),
			'default'  => 'Left',
			'required' => array( 'contact_page_arrow', "=", 'left' ),
		),
		array(
			'id'	   =>'contact_page_icon_right',
			'type' 	   => 'select',
			'title'    => __('Right arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-right',
			'required' => array( 'contact_page_arrow', "=", 'right' ),
		),
		array(
			'id'       => 'contact_page_arrow_right',
			'type'     => 'text',
			'title'    => __( 'Right arrow label', 'nature' ),
			'default'  => 'Right',
			'required' => array( 'contact_page_arrow', "=", 'right' ),
		),
		//end arrows
		array(
			'id'       => 'contact_page_block',
			'type'     => 'image_select',
			'title'    => __('Blocks', 'nature'), 
			'subtitle' => __('Select a block.', 'nature'),
			'options'  => array(
				'[0,0]'      => array(
					'alt'   => '1', 
					'img'   => plugins_url()."/nature/template/media/options/0x0.png",
				),
				'[0,1]'      => array(
					'alt'   => '2', 
					'img'   => plugins_url()."/nature/template/media/options/0x1.png",
				),
				'[0,2]'      => array(
					'alt'   => '3', 
					'img'  => plugins_url()."/nature/template/media/options/0x2.png",
				),
				'[0,3]'      => array(
					'alt'   => '4', 
					'img'   => plugins_url()."/nature/template/media/options/0x3.png",
				),
				'[1,0]'      => array(
					'alt'   => '5', 
					'img'   => plugins_url()."/nature/template/media/options/1x0.png",
				),
				'[1,1]'      => array(
					'alt'  => '6', 
					'img'  => plugins_url()."/nature/template/media/options/1x1.png",
				),
				'[1,2]'      => array(
					'alt'  => '7', 
					'img'  => plugins_url()."/nature/template/media/options/1x2.png",
				),
				'[1,3]'      => array(
					'alt'  => '8', 
					'img'  => plugins_url()."/nature/template/media/options/1x3.png",
				),
				'[2,0]'      => array(
					'alt'   => '9', 
					'img'   => plugins_url()."/nature/template/media/options/2x0.png",
				),
				'[2,1]'      => array(
					'alt'   => '10', 
					'img'   => plugins_url()."/nature/template/media/options/2x1.png",
				),
				'[2,2]'      => array(
					'alt'   => '11', 
					'img'  => plugins_url()."/nature/template/media/options/2x2.png",
				),
				'[2,3]'      => array(
					'alt'   => '12', 
					'img'   => plugins_url()."/nature/template/media/options/2x3.png",
				),
				'[3,0]'      => array(
					'alt'   => '13', 
					'img'   => plugins_url()."/nature/template/media/options/3x0.png",
				),
				'[3,1]'      => array(
					'alt'  => '14', 
					'img'  => plugins_url()."/nature/template/media/options/3x1.png",
				),
				'[3,2]'      => array(
					'alt'  => '15', 
					'img'  => plugins_url()."/nature/template/media/options/3x2.png",
				),
				'[3,3]'      => array(
					'alt'  => '16', 
					'img'  => plugins_url()."/nature/template/media/options/3x3.png",
				)
			),
			'default' => '[1,3]',
			'width' => 65,
			'height' => 65,
		),
		array(
			'id'       => 'contact_page_section_end',
			'type'     => 'section',
			'indent'   => false,
		),
	),
);
		///////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
$this->sections[] = array(
	'title'  => __( 'Subscribe', 'nature' ),
	'icon'   => 'el el-address-book',
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'subscribe_page',
			'type'     => 'switch',
			'title'    => __( 'Subscribe Page Content', 'nature' ),
			'subtitle' => __( 'Choose whether or not you want the subscribe page and button to be displayed.', 'nature' ),
		),
		array(
			'id'       => 'subscribe_page_section',
			'type'     => 'section',
			'indent'   => true, 
			'required' => array( 'subscribe_page', "=", 1 ),
		),
		array(
			'id'       => 'subscribe_page_content',
			'type'     => 'editor',
			'default'  => "<div class='row header'><h2>subscribe to our <b> newsletter</b></h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius.</p></div>\n\n[nature-subscribe-icon]\n[nature-subscribe-form]\n[nature-social]",
			'args'   => array(
				'teeny'            => false,
				'textarea_rows'    => 15,
			)
		),
		array(
			'id'       => 'subscribe_page_label',
			'type'     => 'text',
			'title'    => __( 'Subscribe page arrow label', 'nature' ),
			'subtitle' => __( 'your subscribe page arrow label', 'nature' ),
			'default'  => 'Subscribe',
		),
		//start arrows
		array(
			'id'       => 'subscribe_page_arrow',
			'type'     => 'select',
			'title'    => __('subscribe page arrows', 'nature'),
			'subtitle' => __('choose your custom arrows', 'nature'),
			'multi'    => true,
			'options' => array(
				'top' =>	 'Top', 
				'bottom' =>  'Bottom', 
				'left' => 	 'Left',
				'right' =>   'Right',
			),
			'default' => array('top','bottom')
		),
		array(
			'id'	   =>'subscribe_page_icon_top',
			'type' 	   => 'select',
			'title'    => __('Top arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-up',
			'required' => array( 'subscribe_page_arrow', "=", 'top' ),
		),
		array(
			'id'       => 'subscribe_page_arrow_top',
			'type'     => 'text',
			'title'    => __( 'Top arrow label', 'nature' ),
			'default'  => 'Top',
			'required' => array( 'subscribe_page_arrow', "=", 'top' ),
		),
		array(
			'id'	   =>'subscribe_page_icon_bottom',
			'type' 	   => 'select',
			'title'    => __('Bottom arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-down',
			'required' => array( 'subscribe_page_arrow', "=", 'bottom' ),
		),
		array(
			'id'       => 'subscribe_page_arrow_bottom',
			'type'     => 'text',
			'title'    => __( 'Bottom arrow label', 'nature' ),
			'default'  => 'Bottom',
			'required' => array( 'subscribe_page_arrow', "=", 'bottom' ),
		),
		array(
			'id'	   =>'subscribe_page_icon_left',
			'type' 	   => 'select',
			'title'    => __('Left arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-left',
			'required' => array( 'subscribe_page_arrow', "=", 'left' ),
		),
		array(
			'id'       => 'subscribe_page_arrow_left',
			'type'     => 'text',
			'title'    => __( 'Left arrow label', 'nature' ),
			'default'  => 'Left',
			'required' => array( 'subscribe_page_arrow', "=", 'left' ),
		),
		array(
			'id'	   =>'subscribe_page_icon_right',
			'type' 	   => 'select',
			'title'    => __('Right arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-right',
			'required' => array( 'subscribe_page_arrow', "=", 'right' ),
		),
		array(
			'id'       => 'subscribe_page_arrow_right',
			'type'     => 'text',
			'title'    => __( 'Right arrow label', 'nature' ),
			'default'  => 'Right',
			'required' => array( 'subscribe_page_arrow', "=", 'right' ),
		),
		//end arrows
		array(
			'id'       => 'subscribe_page_block',
			'type'     => 'image_select',
			'title'    => __('Blocks', 'nature'), 
			'subtitle' => __('Select a block.', 'nature'),
			'options'  => array(
				'[0,0]'      => array(
					'alt'   => '1', 
					'img'   => plugins_url()."/nature/template/media/options/0x0.png",
				),
				'[0,1]'      => array(
					'alt'   => '2', 
					'img'   => plugins_url()."/nature/template/media/options/0x1.png",
				),
				'[0,2]'      => array(
					'alt'   => '3', 
					'img'  => plugins_url()."/nature/template/media/options/0x2.png",
				),
				'[0,3]'      => array(
					'alt'   => '4', 
					'img'   => plugins_url()."/nature/template/media/options/0x3.png",
				),
				'[1,0]'      => array(
					'alt'   => '5', 
					'img'   => plugins_url()."/nature/template/media/options/1x0.png",
				),
				'[1,1]'      => array(
					'alt'  => '6', 
					'img'  => plugins_url()."/nature/template/media/options/1x1.png",
				),
				'[1,2]'      => array(
					'alt'  => '7', 
					'img'  => plugins_url()."/nature/template/media/options/1x2.png",
				),
				'[1,3]'      => array(
					'alt'  => '8', 
					'img'  => plugins_url()."/nature/template/media/options/1x3.png",
				),
				'[2,0]'      => array(
					'alt'   => '9', 
					'img'   => plugins_url()."/nature/template/media/options/2x0.png",
				),
				'[2,1]'      => array(
					'alt'   => '10', 
					'img'   => plugins_url()."/nature/template/media/options/2x1.png",
				),
				'[2,2]'      => array(
					'alt'   => '11', 
					'img'  => plugins_url()."/nature/template/media/options/2x2.png",
				),
				'[2,3]'      => array(
					'alt'   => '12', 
					'img'   => plugins_url()."/nature/template/media/options/2x3.png",
				),
				'[3,0]'      => array(
					'alt'   => '13', 
					'img'   => plugins_url()."/nature/template/media/options/3x0.png",
				),
				'[3,1]'      => array(
					'alt'  => '14', 
					'img'  => plugins_url()."/nature/template/media/options/3x1.png",
				),
				'[3,2]'      => array(
					'alt'  => '15', 
					'img'  => plugins_url()."/nature/template/media/options/3x2.png",
				),
				'[3,3]'      => array(
					'alt'  => '16', 
					'img'  => plugins_url()."/nature/template/media/options/3x3.png",
				)
			),
			'default' => '[2,2]',
			'width' => 65,
			'height' => 65,
		),
		array(
			'id'       => 'subscribe_page_section_end',
			'type'     => 'section',
			'indent'   => false,
		),
	),
);
		///////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
$this->sections[] = array(
	'title'  => __( 'Service', 'nature' ),
	'icon'   => 'el el-briefcase',
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'service_page',
			'type'     => 'switch',
			'title'    => __( 'Service Page Content', 'nature' ),
			'subtitle' => __( 'Choose whether or not you want the service page and button to be displayed.', 'nature' ),
		),
		array(
			'id'       => 'service_page_section',
			'type'     => 'section',
			'indent'   => true, // Indent all options below until the next 'section' option is set.
			'required' => array( 'service_page', "=", 1 ),
		),
		 array(
			'id'       => 'service_page_content',
			'type'     => 'editor',
			'default'  => "<div class='row header'><h2>our <b>Service</b></h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius.</p></div>\n\n[nature-service-boxes]",
			'args'   => array(
				'teeny'            => false,
				'textarea_rows'    => 15,
			)
		),
		array(
			'id'       => 'service_page_label',
			'type'     => 'text',
			'title'    => __( 'Service page arrow label', 'nature' ),
			'subtitle' => __( 'your service page arrow label', 'nature' ),
			'default'  => 'Service',
		),
		//start arrows
		array(
			'id'       => 'service_page_arrow',
			'type'     => 'select',
			'title'    => __('service page arrows', 'nature'),
			'subtitle' => __('choose your custom arrows', 'nature'),
			'multi'    => true,
			'options' => array(
				'top' =>	 'Top', 
				'bottom' =>  'Bottom', 
				'left' => 	 'Left',
				'right' =>   'Right',
			),
			'default' => array('left','right')
		),
		array(
			'id'	   =>'service_page_icon_top',
			'type' 	   => 'select',
			'title'    => __('Top arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-up',
			'required' => array( 'service_page_arrow', "=", 'top' ),
		),
		array(
			'id'       => 'service_page_arrow_top',
			'type'     => 'text',
			'title'    => __( 'Top arrow label', 'nature' ),
			'default'  => 'Top',
			'required' => array( 'service_page_arrow', "=", 'top' ),
		),
		array(
			'id'	   =>'service_page_icon_bottom',
			'type' 	   => 'select',
			'title'    => __('Bottom arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-down',
			'required' => array( 'service_page_arrow', "=", 'bottom' ),
		),
		array(
			'id'       => 'service_page_arrow_bottom',
			'type'     => 'text',
			'title'    => __( 'Bottom arrow label', 'nature' ),
			'default'  => 'Bottom',
			'required' => array( 'service_page_arrow', "=", 'bottom' ),
		),
		array(
			'id'	   =>'service_page_icon_left',
			'type' 	   => 'select',
			'title'    => __('Left arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-left',
			'required' => array( 'service_page_arrow', "=", 'left' ),
		),
		array(
			'id'       => 'service_page_arrow_left',
			'type'     => 'text',
			'title'    => __( 'Left arrow label', 'nature' ),
			'default'  => 'Left',
			'required' => array( 'service_page_arrow', "=", 'left' ),
		),
		array(
			'id'	   =>'service_page_icon_right',
			'type' 	   => 'select',
			'title'    => __('Right arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-right',
			'required' => array( 'service_page_arrow', "=", 'right' ),
		),
		array(
			'id'       => 'service_page_arrow_right',
			'type'     => 'text',
			'title'    => __( 'Right arrow label', 'nature' ),
			'default'  => 'Right',
			'required' => array( 'service_page_arrow', "=", 'right' ),
		),
		//end arrows
		array(
			'id'       => 'service_page_block',
			'type'     => 'image_select',
			'title'    => __('Blocks', 'nature'), 
			'subtitle' => __('Select a block.', 'nature'),
			'options'  => array(
				'[0,0]'      => array(
					'alt'   => '1', 
					'img'   => plugins_url()."/nature/template/media/options/0x0.png",
				),
				'[0,1]'      => array(
					'alt'   => '2', 
					'img'   => plugins_url()."/nature/template/media/options/0x1.png",
				),
				'[0,2]'      => array(
					'alt'   => '3', 
					'img'  => plugins_url()."/nature/template/media/options/0x2.png",
				),
				'[0,3]'      => array(
					'alt'   => '4', 
					'img'   => plugins_url()."/nature/template/media/options/0x3.png",
				),
				'[1,0]'      => array(
					'alt'   => '5', 
					'img'   => plugins_url()."/nature/template/media/options/1x0.png",
				),
				'[1,1]'      => array(
					'alt'  => '6', 
					'img'  => plugins_url()."/nature/template/media/options/1x1.png",
				),
				'[1,2]'      => array(
					'alt'  => '7', 
					'img'  => plugins_url()."/nature/template/media/options/1x2.png",
				),
				'[1,3]'      => array(
					'alt'  => '8', 
					'img'  => plugins_url()."/nature/template/media/options/1x3.png",
				),
				'[2,0]'      => array(
					'alt'   => '9', 
					'img'   => plugins_url()."/nature/template/media/options/2x0.png",
				),
				'[2,1]'      => array(
					'alt'   => '10', 
					'img'   => plugins_url()."/nature/template/media/options/2x1.png",
				),
				'[2,2]'      => array(
					'alt'   => '11', 
					'img'  => plugins_url()."/nature/template/media/options/2x2.png",
				),
				'[2,3]'      => array(
					'alt'   => '12', 
					'img'   => plugins_url()."/nature/template/media/options/2x3.png",
				),
				'[3,0]'      => array(
					'alt'   => '13', 
					'img'   => plugins_url()."/nature/template/media/options/3x0.png",
				),
				'[3,1]'      => array(
					'alt'  => '14', 
					'img'  => plugins_url()."/nature/template/media/options/3x1.png",
				),
				'[3,2]'      => array(
					'alt'  => '15', 
					'img'  => plugins_url()."/nature/template/media/options/3x2.png",
				),
				'[3,3]'      => array(
					'alt'  => '16', 
					'img'  => plugins_url()."/nature/template/media/options/3x3.png",
				)
			),
			'default' => '[1,1]',
			'width' => 65,
			'height' => 65,
		),
		array(
			'id'       => 'service_page_section_end',
			'type'     => 'section',
			'indent'   => false,
		),
	),
);
		
		///////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
$this->sections[] = array(
	'title'  => __( 'Countdown', 'nature' ),
	'icon'   => 'el el-calendar',
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'countdown_page',
			'type'     => 'switch',
			'title'    => __( 'Countdown Page Content', 'nature' ),
			'subtitle' => __( 'Choose whether or not you want the countdown page and button to be displayed', 'nature' ),
		),
		array(
			'id'       => 'countdown_page_section',
			'type'     => 'section',
			'indent'   => true, // Indent all options below until the next 'section' option is set.
			'required' => array( 'countdown_page', "=", 1 ),
		),
		array(
			'id'       => 'countdown_page_content',
			'type'     => 'editor',
			'default'  => "<div class='row header'><h2>Time left <b>until launching</b></h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius.</p></div>\n\n[nature-countdown-icon]\n[nature-countdown-counter]",
			'args'   => array(
				'teeny'            => false,
				'textarea_rows'    => 15,
			)
		),
		array(
			'id'       => 'countdown_page_label',
			'type'     => 'text',
			'title'    => __( 'Countdown page arrow label', 'nature' ),
			'subtitle' => __( 'your countdown page arrow label', 'nature' ),
			'default'  => 'Countdown',
		),
		//start arrows
		array(
			'id'       => 'countdown_page_arrow',
			'type'     => 'select',
			'title'    => __('countdown page arrows', 'nature'),
			'subtitle' => __('choose your custom arrows', 'nature'),
			'multi'    => true,
			'options' => array(
				'top' =>	 'Top', 
				'bottom' =>  'Bottom', 
				'left' => 	 'Left',
				'right' =>   'Right',
			),
			'default' => 'bottom',
		),
		array(
			'id'	   =>'countdown_page_icon_top',
			'type' 	   => 'select',
			'title'    => __('Top arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-up',
			'required' => array( 'countdown_page_arrow', "=", 'top' ),
		),
		array(
			'id'       => 'countdown_page_arrow_top',
			'type'     => 'text',
			'title'    => __( 'Top arrow label', 'nature' ),
			'default'  => 'Top',
			'required' => array( 'countdown_page_arrow', "=", 'top' ),
		),
		array(
			'id'	   =>'countdown_page_icon_bottom',
			'type' 	   => 'select',
			'title'    => __('Bottom arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-down',
			'required' => array( 'countdown_page_arrow', "=", 'bottom' ),
		),
		array(
			'id'       => 'countdown_page_arrow_bottom',
			'type'     => 'text',
			'title'    => __( 'Bottom arrow label', 'nature' ),
			'default'  => 'Bottom',
			'required' => array( 'countdown_page_arrow', "=", 'bottom' ),
		),
		array(
			'id'	   =>'countdown_page_icon_left',
			'type' 	   => 'select',
			'title'    => __('Left arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-left',
			'required' => array( 'countdown_page_arrow', "=", 'left' ),
		),
		array(
			'id'       => 'countdown_page_arrow_left',
			'type'     => 'text',
			'title'    => __( 'Left arrow label', 'nature' ),
			'default'  => 'Left',
			'required' => array( 'countdown_page_arrow', "=", 'left' ),
		),
		array(
			'id'	   =>'countdown_page_icon_right',
			'type' 	   => 'select',
			'title'    => __('Right arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-right',
			'required' => array( 'countdown_page_arrow', "=", 'right' ),
		),
		array(
			'id'       => 'countdown_page_arrow_right',
			'type'     => 'text',
			'title'    => __( 'Right arrow label', 'nature' ),
			'default'  => 'Right',
			'required' => array( 'countdown_page_arrow', "=", 'right' ),
		),
		//end arrows
		array(
			'id'       => 'countdown_page_block',
			'type'     => 'image_select',
			'title'    => __('Blocks', 'nature'), 
			'subtitle' => __('Select a block.', 'nature'),
			'options'  => array(
				'[0,0]'      => array(
					'alt'   => '1', 
					'img'   => plugins_url()."/nature/template/media/options/0x0.png",
				),
				'[0,1]'      => array(
					'alt'   => '2', 
					'img'   => plugins_url()."/nature/template/media/options/0x1.png",
				),
				'[0,2]'      => array(
					'alt'   => '3', 
					'img'  => plugins_url()."/nature/template/media/options/0x2.png",
				),
				'[0,3]'      => array(
					'alt'   => '4', 
					'img'   => plugins_url()."/nature/template/media/options/0x3.png",
				),
				'[1,0]'      => array(
					'alt'   => '5', 
					'img'   => plugins_url()."/nature/template/media/options/1x0.png",
				),
				'[1,1]'      => array(
					'alt'  => '6', 
					'img'  => plugins_url()."/nature/template/media/options/1x1.png",
				),
				'[1,2]'      => array(
					'alt'  => '7', 
					'img'  => plugins_url()."/nature/template/media/options/1x2.png",
				),
				'[1,3]'      => array(
					'alt'  => '8', 
					'img'  => plugins_url()."/nature/template/media/options/1x3.png",
				),
				'[2,0]'      => array(
					'alt'   => '9', 
					'img'   => plugins_url()."/nature/template/media/options/2x0.png",
				),
				'[2,1]'      => array(
					'alt'   => '10', 
					'img'   => plugins_url()."/nature/template/media/options/2x1.png",
				),
				'[2,2]'      => array(
					'alt'   => '11', 
					'img'  => plugins_url()."/nature/template/media/options/2x2.png",
				),
				'[2,3]'      => array(
					'alt'   => '12', 
					'img'   => plugins_url()."/nature/template/media/options/2x3.png",
				),
				'[3,0]'      => array(
					'alt'   => '13', 
					'img'   => plugins_url()."/nature/template/media/options/3x0.png",
				),
				'[3,1]'      => array(
					'alt'  => '14', 
					'img'  => plugins_url()."/nature/template/media/options/3x1.png",
				),
				'[3,2]'      => array(
					'alt'  => '15', 
					'img'  => plugins_url()."/nature/template/media/options/3x2.png",
				),
				'[3,3]'      => array(
					'alt'  => '16', 
					'img'  => plugins_url()."/nature/template/media/options/3x3.png",
				)
			),
			'default' => '[0,2]',
			'width' => 65,
			'height' => 65,
		),
		array(
			'id'       => 'countdown_page_section_end',
			'type'     => 'section',
			'indent'   => false,
		),
	),
);
		///////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
$this->sections[] = array(
	'title'  => __( 'Blog', 'nature' ),
	'icon'   => 'el el-pencil',
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'blog_page',
			'type'     => 'switch',
			'title'    => __( 'Blog Page Content', 'nature' ),
			'subtitle' => __( 'Choose whether or not you want the blog page and button to be displayed', 'nature' ),
		),
		array(
			'id'       => 'blogs_page_section',
			'type'     => 'section',
			'indent'   => true, 
			'required' => array( 'blog_page', "=", 1 ),
		),
		array(
			'id'       => 'blog_page_content',
			'type'     => 'editor',
			'default'  => "<div class='row header'><h2>LATEST <b>NEWS</b></h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius.</p></div>\n\n[nature-blog-icon]\n[nature-blog-post]",
			'args'   => array(
				'teeny'            => false,
				'textarea_rows'    => 15,
			)
		),
		array(
			'id'       => 'blog_page_label',
			'type'     => 'text',
			'title'    => __( 'Blog page arrow label', 'nature' ),
			'subtitle' => __( 'your blog page arrow label', 'nature' ),
			'default'  => 'Blog',
		),
		//start arrows
		array(
			'id'       => 'blog_page_arrow',
			'type'     => 'select',
			'title'    => __('blog page arrows', 'nature'),
			'subtitle' => __('choose your custom arrows', 'nature'),
			'multi'    => true,
			'options' => array(
				'top' =>	 'Top', 
				'bottom' =>  'Bottom', 
				'left' => 	 'Left',
				'right' =>   'Right',
			),
			'default' => 'top',
		),
		array(
			'id'	   =>'blog_page_icon_top',
			'type' 	   => 'select',
			'title'    => __('Top arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-up',
			'required' => array( 'blog_page_arrow', "=", 'top' ),
		),
		array(
			'id'       => 'blog_page_arrow_top',
			'type'     => 'text',
			'title'    => __( 'Top arrow label', 'nature' ),
			'default'  => 'Top',
			'required' => array( 'blog_page_arrow', "=", 'top' ),
		),
		array(
			'id'	   =>'blog_page_icon_bottom',
			'type' 	   => 'select',
			'title'    => __('Bottom arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-down',
			'required' => array( 'blog_page_arrow', "=", 'bottom' ),
		),
		array(
			'id'       => 'blog_page_arrow_bottom',
			'type'     => 'text',
			'title'    => __( 'Bottom arrow label', 'nature' ),
			'default'  => 'Bottom',
			'required' => array( 'blog_page_arrow', "=", 'bottom' ),
		),
		array(
			'id'	   =>'blog_page_icon_left',
			'type' 	   => 'select',
			'title'    => __('Left arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-left',
			'required' => array( 'blog_page_arrow', "=", 'left' ),
		),
		array(
			'id'       => 'blog_page_arrow_left',
			'type'     => 'text',
			'title'    => __( 'Left arrow label', 'nature' ),
			'default'  => 'Left',
			'required' => array( 'blog_page_arrow', "=", 'left' ),
		),
		array(
			'id'	   =>'blog_page_icon_right',
			'type' 	   => 'select',
			'title'    => __('Right arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-right',
			'required' => array( 'blog_page_arrow', "=", 'right' ),
		),
		array(
			'id'       => 'blog_page_arrow_right',
			'type'     => 'text',
			'title'    => __( 'Right arrow label', 'nature' ),
			'default'  => 'Right',
			'required' => array( 'blog_page_arrow', "=", 'right' ),
		),
		//end arrows
		array(
			'id'       => 'blog_page_block',
			'type'     => 'image_select',
			'title'    => __('Blocks', 'nature'), 
			'subtitle' => __('Select a block.', 'nature'),
			'options'  => array(
				'[0,0]'      => array(
					'alt'   => '1', 
					'img'   => plugins_url()."/nature/template/media/options/0x0.png",
				),
				'[0,1]'      => array(
					'alt'   => '2', 
					'img'   => plugins_url()."/nature/template/media/options/0x1.png",
				),
				'[0,2]'      => array(
					'alt'   => '3', 
					'img'  => plugins_url()."/nature/template/media/options/0x2.png",
				),
				'[0,3]'      => array(
					'alt'   => '4', 
					'img'   => plugins_url()."/nature/template/media/options/0x3.png",
				),
				'[1,0]'      => array(
					'alt'   => '5', 
					'img'   => plugins_url()."/nature/template/media/options/1x0.png",
				),
				'[1,1]'      => array(
					'alt'  => '6', 
					'img'  => plugins_url()."/nature/template/media/options/1x1.png",
				),
				'[1,2]'      => array(
					'alt'  => '7', 
					'img'  => plugins_url()."/nature/template/media/options/1x2.png",
				),
				'[1,3]'      => array(
					'alt'  => '8', 
					'img'  => plugins_url()."/nature/template/media/options/1x3.png",
				),
				'[2,0]'      => array(
					'alt'   => '9', 
					'img'   => plugins_url()."/nature/template/media/options/2x0.png",
				),
				'[2,1]'      => array(
					'alt'   => '10', 
					'img'   => plugins_url()."/nature/template/media/options/2x1.png",
				),
				'[2,2]'      => array(
					'alt'   => '11', 
					'img'  => plugins_url()."/nature/template/media/options/2x2.png",
				),
				'[2,3]'      => array(
					'alt'   => '12', 
					'img'   => plugins_url()."/nature/template/media/options/2x3.png",
				),
				'[3,0]'      => array(
					'alt'   => '13', 
					'img'   => plugins_url()."/nature/template/media/options/3x0.png",
				),
				'[3,1]'      => array(
					'alt'  => '14', 
					'img'  => plugins_url()."/nature/template/media/options/3x1.png",
				),
				'[3,2]'      => array(
					'alt'  => '15', 
					'img'  => plugins_url()."/nature/template/media/options/3x2.png",
				),
				'[3,3]'      => array(
					'alt'  => '16', 
					'img'  => plugins_url()."/nature/template/media/options/3x3.png",
				)
			),
			'default' => '[3,2]',
			'width' => 65,
			'height' => 65,
		),
		array(
			'id'       => 'blog_page_section_end',
			'type'     => 'section',
			'indent'   => false,
		),
	),
);
		///////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////
$this->sections[] = array(
	'title'  => __( 'About', 'nature' ),
	'icon'   => 'el el-group',
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'about_page',
			'type'     => 'switch',
			'title'    => __( 'About Page Content', 'nature' ),
			'subtitle' => __( 'Choose whether or not you want the about page and button to be displayed', 'nature' ),
		),
		array(
			'id'       => 'about_page_section',
			'type'     => 'section',
			'indent'   => true, 
			'required' => array( 'about_page', "=", 1 ),
		),
		array(
			'id'       => 'about_page_content',
			'type'     => 'editor',
			'default'  => "<div class='row header'><h2>about <b>nature</b></h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius.</p></div>\n\n[nature-about-team]",
			'args'   => array(
				'teeny'            => false,
				'textarea_rows'    => 15,
			)
		),
		array(
			'id'       => 'about_page_label',
			'type'     => 'text',
			'title'    => __( 'About page arrow label', 'nature' ),
			'subtitle' => __( 'your about page arrow label', 'nature' ),
			'default'  => 'About',
		),
		//start arrows
		array(
			'id'       => 'about_page_arrow',
			'type'     => 'select',
			'title'    => __('about page arrows', 'nature'),
			'subtitle' => __('choose your custom arrows', 'nature'),
			'multi'    => true,
			'options' => array(
				'top' =>	 'Top', 
				'bottom' =>  'Bottom', 
				'left' => 	 'Left',
				'right' =>   'Right',
			),
			'default' => 'right'
		),
		array(
			'id'	   =>'about_page_icon_top',
			'type' 	   => 'select',
			'title'    => __('Top arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-up',
			'required' => array( 'about_page_arrow', "=", 'top' ),
		),
		array(
			'id'       => 'about_page_arrow_top',
			'type'     => 'text',
			'title'    => __( 'Top arrow label', 'nature' ),
			'default'  => 'Top',
			'required' => array( 'about_page_arrow', "=", 'top' ),
		),
		array(
			'id'	   =>'about_page_icon_bottom',
			'type' 	   => 'select',
			'title'    => __('Bottom arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-down',
			'required' => array( 'about_page_arrow', "=", 'bottom' ),
		),
		array(
			'id'       => 'about_page_arrow_bottom',
			'type'     => 'text',
			'title'    => __( 'Bottom arrow label', 'nature' ),
			'default'  => 'Bottom',
			'required' => array( 'about_page_arrow', "=", 'bottom' ),
		),
		array(
			'id'	   =>'about_page_icon_left',
			'type' 	   => 'select',
			'title'    => __('Left arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-left',
			'required' => array( 'about_page_arrow', "=", 'left' ),
		),
		array(
			'id'       => 'about_page_arrow_left',
			'type'     => 'text',
			'title'    => __( 'Left arrow label', 'nature' ),
			'default'  => 'Left',
			'required' => array( 'about_page_arrow', "=", 'left' ),
		),
		array(
			'id'	   =>'about_page_icon_right',
			'type' 	   => 'select',
			'title'    => __('Right arrow icon', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-angle-right',
			'required' => array( 'about_page_arrow', "=", 'right' ),
		),
		array(
			'id'       => 'about_page_arrow_right',
			'type'     => 'text',
			'title'    => __( 'Right arrow label', 'nature' ),
			'default'  => 'Right',
			'required' => array( 'about_page_arrow', "=", 'right' ),
		),
		//end arrows
		array(
			'id'       => 'about_page_block',
			'type'     => 'image_select',
			'title'    => __('Blocks', 'nature'), 
			'subtitle' => __('Select a block.', 'nature'),
			'options'  => array(
				'[0,0]'      => array(
					'alt'   => '1', 
					'img'   => plugins_url()."/nature/template/media/options/0x0.png",
				),
				'[0,1]'      => array(
					'alt'   => '2', 
					'img'   => plugins_url()."/nature/template/media/options/0x1.png",
				),
				'[0,2]'      => array(
					'alt'   => '3', 
					'img'  => plugins_url()."/nature/template/media/options/0x2.png",
				),
				'[0,3]'      => array(
					'alt'   => '4', 
					'img'   => plugins_url()."/nature/template/media/options/0x3.png",
				),
				'[1,0]'      => array(
					'alt'   => '5', 
					'img'   => plugins_url()."/nature/template/media/options/1x0.png",
				),
				'[1,1]'      => array(
					'alt'  => '6', 
					'img'  => plugins_url()."/nature/template/media/options/1x1.png",
				),
				'[1,2]'      => array(
					'alt'  => '7', 
					'img'  => plugins_url()."/nature/template/media/options/1x2.png",
				),
				'[1,3]'      => array(
					'alt'  => '8', 
					'img'  => plugins_url()."/nature/template/media/options/1x3.png",
				),
				'[2,0]'      => array(
					'alt'   => '9', 
					'img'   => plugins_url()."/nature/template/media/options/2x0.png",
				),
				'[2,1]'      => array(
					'alt'   => '10', 
					'img'   => plugins_url()."/nature/template/media/options/2x1.png",
				),
				'[2,2]'      => array(
					'alt'   => '11', 
					'img'  => plugins_url()."/nature/template/media/options/2x2.png",
				),
				'[2,3]'      => array(
					'alt'   => '12', 
					'img'   => plugins_url()."/nature/template/media/options/2x3.png",
				),
				'[3,0]'      => array(
					'alt'   => '13', 
					'img'   => plugins_url()."/nature/template/media/options/3x0.png",
				),
				'[3,1]'      => array(
					'alt'  => '14', 
					'img'  => plugins_url()."/nature/template/media/options/3x1.png",
				),
				'[3,2]'      => array(
					'alt'  => '15', 
					'img'  => plugins_url()."/nature/template/media/options/3x2.png",
				),
				'[3,3]'      => array(
					'alt'  => '16', 
					'img'  => plugins_url()."/nature/template/media/options/3x3.png",
				)
			),
			'default' => '[1,0]',
			'width' => 65,
			'height' => 65,
		),
		array(
			'id'       => 'about_page_section_end',
			'type'     => 'section',
			'indent'   => false,
		),
	),
);
?>