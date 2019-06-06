<?php
if ( file_exists( dirname( __FILE__ ) . '/../../template/inc/adress.txt' ) ) {
	Redux_Functions::initWpFilesystem();
	global $wp_filesystem;
	$addresslist = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/../../template/inc/adress.txt' );
}
$this->sections[] = array(
		'title'  => __( 'Subscribe Settings', 'nature' ),
		'desc'   => __( 'Settings for the Subscribe Form. It can be displayed by using the <strong>[nature-subscribe-form]</strong> shortcode.', 'nature' ),
		'icon'   => 'el-icon-address-book',
		  'fields' => array(
			array(
				'id'	   =>'subscribe_icon',
				'type' 	   => 'select',
				'title'    => __('Icon', 'nature'),
				'subtitle' => __('choose your subscribe icon for this section <strong>[nature-subscribe-icon]</strong>.', 'nature'),
				'options'  => font_awesome_icons(),
				'class'    => 'font-awesome-icons',
				'default'  => 'fa-send'
			),
			array(
				'id'       => 'subscribe_email_field_label',
				'type'     => 'text',
				'title'    => __( 'Email Field Label', 'nature' ),
				'default'  => 'Enter your e-mail address...',
			),
			 array(
				'id'       => 'subscribe_button_label',
				'type'     => 'text',
				'title'    => __( 'Button Label', 'nature' ),
				'default'  => 'Notify Me',
			),
			array(
				'id'       => 'subscribe_success_msg',
				'type'     => 'text',
				'title'    => __( 'Success Message', 'nature' ),
				'validate' => 'html',
				'default'  => '<h1>Success!</h1><p>Thank you for subscribing to our newsletter!</p>',
			),
			array(
                'id'         => 'subscribe_addresses',
                'type'       => 'raw',
                'full_width' => false,
                'title'    => __('Subscribers List', 'nature'),
                'content'    => "<textarea readonly style='float: left; width: 25em;'>".$addresslist."</textarea>",
            ),
				array(
				'id'       => 'subscribe_use_mailchimp',
				'type'     => 'switch',
				'title'    => __( 'Use MailChimp?', 'nature' ),
				'subtitle' => __( 'Set to Yes if you want to use MailChimp to manage subscribers. If set to No the email addresses will be added to a simple text string.', 'nature' ),

			),
			
			 array(
				'id'       => 'mailchimp_section',
				'type'     => 'section',
				'title'    => __( 'mailchimp details', 'nature' ),
				'subtitle' => __( '
					Follow the steps below to get the form data.<br>
					1.Navigate to the Lists page.<br>
					2.Click the drop-down menu to the right of the Stats button for the list you want to work with, then select Signup forms.<br>
					3.Click Embedded forms. <br>
					Data Values example = us0-123456789-00000000<br>
					<strong>123456789</strong> = is MailChimp User ID<br>
					<strong>00000000</strong> = is Mailchimp List ID<br>
					<strong>us0</strong> = is your Mailchimp server<br>
				
				', 'nature' ),
				'indent'   => true, // Indent all options below until the next 'section' option is set.
				'required' => array( 'subscribe_use_mailchimp', "=", 1 ),
			),
			 
			array(
				'id'       => 'mailchimp_your_name',
				'type'     => 'text',
				'title'    => __( 'Mailchimp User Name', 'nature' ),
				'default'  => '',
			),
			 
			array(
				'id'       => 'mailchimp_your_id',
				'type'     => 'text',
				'title'    => __( 'MailChimp User ID', 'nature' ),
				'default'  => '',
			),
			
			array(
				'id'       => 'mailchimp_form_id',
				'type'     => 'text',
				'title'    => __( 'Mailchimp List ID', 'nature' ),
				'default'  => '',
			),

			 array(
				'id'       => 'mailchimp_server',
				'type'     => 'select',
				'title'    => __( 'Mailchimp server', 'nature' ),
				'subtitle' => __( 'Choose your server', 'nature' ),
				'options'  => array(
					'1' => 'us1',
					'2' => 'us2',
					'3' => 'us3',
					'4' => 'us4',
					'5' => 'us5',
					'6' => 'us6',
					'7' => 'us7',
					'8' => 'us8',
					'9' => 'us9',
					'10' => 'us10',
					'11' => 'us11',
					'12' => 'us12',
					'13' => 'us13',
					'14' => 'us14',
					'15' => 'us15',
					'16' => 'us16',
					'17' => 'us17',
					'18' => 'us18',
					'19' => 'us19',
					'20' => 'us20'
					
				),
			),
			
			 array(
				'id'       => 'mailchimp_section_end',
				'type'     => 'section',
			),
			
			//================================================Social
			array(
				'id'          => 'social_section',
				'type'        => 'section',
				'title'       => __('Social Settings'),
				'subtitle'    => __('Here you can edit and sort the links displayed in the subscribe.', 'nature'),
				'indent'      => true,
			),
			array(
			'id'=>'social_link',
			'type' => 'social',
			'title' => __('Links', 'nature'),
			'subtitle' => __('choose your subscribe  social icons for this section <strong>[nature-social]</strong>', 'nature'),
			'options' => font_awesome_icons(),
			'default_show' => false,
			'default' => array(
					0 => array(
						'title' => 'Follow us on Twitter',
						'select' => 'fa-twitter',
						'url' => '#Twitter',
						'sort' => 0
						),
					1 => array(
						'title' => 'Like us on Facebook',
						'url' => '#Facebook',
						'select' => 'fa-facebook',
						'sort' => 1
						),
					2 => array(
						'title' => 'Join us on Youtube',
						'url' => '#Youtube',
						'select' => 'fa-youtube',
						'sort' => 2
						),
					3 => array(
						'title' => 'Pinterest Pinboard',
						'url' => '#Pinboard',
						'select' => 'fa-pinterest',
						'sort' => 3
						),
					4 => array(
						'title' => 'Find me on LinkedIn',
						'url' => '#LinkedIn',
						'select' => 'fa-linkedin',
						'sort' => 4
						),
				)
			),
			array(
				'id'     => 'social_section_end',
				'type'   => 'section',
				'indent' => false,
			),
			
		),
	);
?>