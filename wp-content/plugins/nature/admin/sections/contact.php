<?php
$this->sections[] = array(
		'title'  => __( 'Contact Settings', 'nature' ),
		'desc'   => __( 'Settings for the Contact Form. It can be displayed by using the <strong>[nature-contact-form]</strong> shortcode.', 'nature' ),
		'icon'   => 'el-icon-envelope',
		  'fields' => array(
			array(
				'id'       => 'contact_email',
				'type'     => 'text',
				'title'    => __( 'Target E-mail Address', 'nature' ),
				'subtitle' => __( 'This is the email address where you’ll receive the contact form messages', 'nature' ),
				'desc'    => __( 'NOTE: you must use email service for this filed for example use of gmail,yahoo,hotmail and etc...', 'nature' ),
				'default'  => get_option( 'admin_email' ),
			),
			array(
				'id'       => 'contact_email_name',
				'type'     => 'text',
				'title'    => __( 'TO Name ', 'nature' ),
				'subtitle' => __( 'Enter your name', 'nature' ),
				'default'  => "nature",
			),
			array(
				'id'       => 'contact_subject',
				'type'     => 'text',
				'title'    => __( 'E-mail Subject Prefix', 'nature' ),
				'subtitle' => __( 'Prefix for the email subject. Useful for filtering mail', 'nature' ),
				'default'  => "nature message from - ",
			),
			array(
				'id'       => 'contact_name_field_label',
				'type'     => 'text',
				'title'    => __( 'Name Field Label', 'nature' ),
				'default'  => 'Name',
			),
			array(
				'id'       => 'contact_email_field_label',
				'type'     => 'text',
				'title'    => __( 'Email Field Label', 'nature' ),
				'default'  => 'Email',
			),
			
			array(
				'id'       => 'contact_phone_field_label',
				'type'     => 'text',
				'title'    => __( 'Phone Field Label', 'nature' ),
				'default'  => 'Phone',
			),
			array(
				'id'       => 'contact_message_field_label',
				'type'     => 'text',
				'title'    => __( 'Message Field Label', 'nature' ),
				'default'  => 'Message',
			),
			 array(
				'id'       => 'contact_button_label',
				'type'     => 'text',
				'title'    => __( 'Button Label', 'nature' ),
				'default'  => 'Send message',
			),
			array(
				'id'       => 'contact_success_msg',
				'type'     => 'text',
				'title'    => __( 'Success Message', 'nature' ),
				'validate' => 'html',
				'default'  => '<h1>Thanks!</h1><p>We\'ll be in touch real soon!</p>',
			),
			
			//================================================right_page
			
			array(
				'id'          => 'section_CONTACT_PAGE_Column',
				'type'        => 'section',
				'title'       => __('Contact Info'),
				'subtitle'    => __('These settings affect the contact forms. It can be displayed by using the <strong>[nature-contact-box]</strong> shortcode.', 'nature'),
				'indent'      => true,
			),
			
			//---------------------------------------------------Contact BOX 1
			array(
				'id'          => 'Info_Box_1',
				'type'        => 'section',
				'title'       => __('Contact BOX 1'),
				'indent'      => true,
			),
				array(
					'id'       => 'Info_Box_1_text',
					'type'     => 'text',
					'title'    => __( 'Text', 'nature' ),
					'default'  => "info@company.com",
				),
				array(
					'id'	   =>'Info_Box_1_icon',
					'type' 	   => 'select',
					'title'    => __('Icon', 'nature'),
					'options'  => font_awesome_icons(),
					'class'    => 'font-awesome-icons',
					'default'  => 'fa-mail-forward'
				),
			array(
				'id'     => 'Info_Box_1_end',
				'type'   => 'section',
				'indent' => false,
			),
			
			//---------------------------------------------------Contact BOX 2
			array(
				'id'          => 'Info_Box_2',
				'type'        => 'section',
				'title'       => __('Contact BOX 2'),
				'indent'      => true,
			),
				array(
					'id'       => 'Info_Box_2_text',
					'type'     => 'text',
					'title'    => __( 'Text', 'nature' ),
					'default'  => "0789-012-345",
				),
				array(
					'id'	   =>'Info_Box_2_icon',
					'type' 	   => 'select',
					'title'    => __('Icon', 'nature'),
					'options'  => font_awesome_icons(),
					'class'    => 'font-awesome-icons',
					'default'  => 'fa-phone'
				),
			array(
				'id'     => 'Info_Box_2_end',
				'type'   => 'section',
				'indent' => false,
			),
			//---------------------------------------------------Contact BOX 3
			array(
				'id'          => 'Info_Box_3',
				'type'        => 'section',
				'title'       => __('Contact BOX 3'),
				'indent'      => true,
			),
				array(
					'id'       => 'Info_Box_3_text',
					'type'     => 'text',
					'title'    => __( 'Text', 'nature' ),
					'default'  => "99a First Street, London, United Kingdom",
				),
				array(
					'id'	   =>'Info_Box_3_icon',
					'type' 	   => 'select',
					'title'    => __('Icon', 'nature'),
					'options'  => font_awesome_icons(),
					'class'    => 'font-awesome-icons',
					'default'  => 'fa-map-marker'
				),
			array(
				'id'     => 'Info_Box_3_end',
				'type'   => 'section',
				'indent' => false,
			),
			
			//--------------
			array(
				'id'     => 'section_CONTACT_PAGE_Column_end',
				'type'   => 'section',
				'indent' => false,
			),
			
		),
	);
?>