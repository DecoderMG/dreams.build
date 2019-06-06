<?php
$this->sections[] = array(
	'title'  => __( 'Seo Settings', 'nature' ),
	'icon'   => 'el-icon-link',
	  'fields' => array(
		
		//================================================site_title
		array(
			'id'       => 'site_title',
			'type'     => 'text',
			'title'    => __( 'Site Title', 'nature' ),
			'default'  => get_bloginfo('title'),
		),
		//================================================site_description
		array(
			'id'       => 'site_description',
			'type'     => 'text',
			'title'    => __( 'Site Description', 'nature' ),
			'default'  => get_bloginfo('description'),
		),
		//================================================site_keywords
		array(
			'id'=>'site_keywords',
			'type' => 'textarea',
			'title' => __('Site keywords', 'nature'),
			'validate' => 'no_html',
			'default' => '',
		),
	),
);
$this->sections[] = array(
	'title'  => __( 'Webmaster Tools', 'nature' ),
	'icon'   => 'el el-signal',
	'subsection' => true,
	'fields' => array(
			///////////////////////////////////////////////////////////////////////////////webmaster_tools
			array(
				'id'       => 'webmaster_tools',
				'type'     => 'switch',
				'title'    => __( 'Webmaster Tools', 'nature' ),
				'subtitle' => __( 'You can use the boxes below to verify with the different Webmaster Tools, if your site is already verified, you can just forget about these. Enter the verify meta values for', 'nature' ),
				'indent' => true 
			),
		   //================================================google_verify
			array(
				'id'       => 'google_verify',
				'type'     => 'text',
				'title'    => __( '<a href="https://www.google.com/webmasters/verification/verification?hl=en&siteUrl='.get_bloginfo('url').'">Google Webmaster Tools</a>', 'nature' ),
				'default'  => '',
				'required' => array( 'webmaster_tools', "=", 1 ),
			), 
			//================================================ms_verify
			array(
				'id'       => 'ms_verify',
				'type'     => 'text',
				'title'    => __( '<a href="http://www.bing.com/webmaster/?rfp=1#/Dashboard/?url='.get_bloginfo('url').'">Bing Webmaster Tools</a>', 'nature' ),
				'default'  => '',
				'required' => array( 'webmaster_tools', "=", 1 ),
			),
			//================================================alexa_verify
			array(
				'id'       => 'alexa_verify',
				'type'     => 'text',
				'title'    => __( '<a href="http://www.alexa.com/siteowners/claim">Alexa Verification ID</a>', 'nature' ),
				'default'  => '',
				'required' => array( 'webmaster_tools', "=", 1 ),
			),
			//================================================pin_verify
			array(
				'id'       => 'pin_verify',
				'type'     => 'text',
				'title'    => __( '<a href="https://help.pinterest.com/entries/22488487-Verify-with-HTML-meta-tags">Pinterest</a>', 'nature' ),
				'default'  => '',
				'required' => array( 'webmaster_tools', "=", 1 ),
			),
			//================================================yandex_verify
			array(
				'id'       => 'yandex_verify',
				'type'     => 'text',
				'title'    => __( '<a href="http://help.yandex.com/webmaster/service/rights.xml#how-to">Yandex Webmaster Tools</a>', 'nature' ),
				'default'  => '',
				'required' => array( 'webmaster_tools', "=", 1 ),
			),
			array(
				'id'       => 'webmaster_tools_section_end',
				'type'     => 'section',
				'indent' => false,
			),
			///////////////////////////////////////////////////////////////////////////////social_tools
			array(
				'id'       => 'social_tools',
				'type'     => 'switch',
				'title'    => __( 'Social Tools', 'nature' ),
				'subtitle' => __( 'It is a way for website owners to send structured data to search engine robots. helping them to understand your content and create well-presented search results.', 'nature' ),
			),
			//================================================site_author
			array(
				'id'       => 'site_author',
				'type'     => 'text',
				'title'    => __( 'Google Author profile', 'nature' ),
				'desc'     => __( "If you have a Google+ profile , add that URL here and link it on your Google+ profile's about page.", 'nature' ),
				'default'  => '',
				'validate' => 'url',
				'required' => array( 'social_tools', "=", 1 ),
			),
			//================================================site_publisher
			array(
				'id'       => 'site_publisher',
				'type'     => 'text',
				'title'    => __( 'Google Publisher Page', 'nature' ),
				'desc'     => __( "If you have a Google+ page for your business, add that URL here and link it on your Google+ page's about page.", 'nature' ),
				'default'  => '',
				'validate' => 'url',
				'required' => array( 'social_tools', "=", 1 ),
			),
			//================================================fb_url
			array(
				'id'       => 'fb_url',
				'type'     => 'text',
				'title'    => __( 'Facebook Page URL', 'nature' ),
				'default'  => '',
				'validate' => 'url',
				'required' => array( 'social_tools', "=", 1 ),
			),
			//================================================fb_title
			array(
				'id'       => 'fb_title',
				'type'     => 'text',
				'title'    => __( 'Title', 'nature' ),
				'desc'     => __( 'These is the title used in the Open Graph meta tags on the front page of your site.', 'nature' ),
				'default'  => '',
				'required' => array( 'social_tools', "=", 1 ),
			),
			//================================================fb_description
			array(
				'id'       => 'fb_description',
				'type'     => 'text',
				'title'    => __( 'Description', 'nature' ),
				'desc'     => __( 'These is the  description used in the Open Graph meta tags on the front page of your site.', 'nature' ),
				'default'  => '',
				'required' => array( 'social_tools', "=", 1 ),
			),
			//================================================fb_image
			 array(
				'id'       => 'fb_image',
				'type'     => 'media',
				'title'    => __( 'Image', 'nature' ),
				'desc'     => __( 'These is the image used in the Open Graph meta tags on the front page of your site.', 'nature' ),
				'required' => array( 'social_tools', "=", 1 ),
			),
			
			//================================================fb_page
			array(
				'id'       => 'fb_page',
				'type'     => 'text',
				'title'    => __( 'Facebook page ID', 'nature' ),
				'default'  => '',
				'required' => array( 'social_tools', "=", 1 ),
			),
			//================================================fb_app
			array(
				'id'       => 'fb_app',
				'type'     => 'text',
				'title'    => __( 'Facebook app ID', 'nature' ),
				'default'  => '',
				'required' => array( 'social_tools', "=", 1 ),
			),
			
			//================================================tw_name
			array(
				'id'       => 'tw_name',
				'type'     => 'text',
				'title'    => __( 'Site Twitter Username', 'nature' ),
				'default'  => '',
				'required' => array( 'social_tools', "=", 1 ),
			),
			//================================================tw_title
			array(
				'id'       => 'tw_title',
				'type'     => 'text',
				'title'    => __( 'Title', 'nature' ),
				'desc'     => __( 'Add title to Twitter card meta data.', 'nature' ),
				'default'  => '',
				'required' => array( 'social_tools', "=", 1 ),
			),
			//================================================tw_description
			array(
				'id'       => 'tw_description',
				'type'     => 'text',
				'title'    => __( 'Description', 'nature' ),
				'desc'     => __( 'Add description to Twitter card meta data.', 'nature' ),
				'default'  => '',
				'required' => array( 'social_tools', "=", 1 ),
			),
			//================================================tw_image
			 array(
				'id'       => 'tw_image',
				'type'     => 'media',
				'title'    => __( 'Image', 'nature' ),
				'desc'     => __( 'Add image to Twitter card meta data.', 'nature' ),
				'required' => array( 'social_tools', "=", 1 ),
			),
			array(
				'id'       => 'social_tools_section_end',
				'type'     => 'section',
			),
		),
	);

?>