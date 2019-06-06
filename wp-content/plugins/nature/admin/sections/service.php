<?php
$this->sections[] = array(
		'title'  => __( 'Service Settings', 'nature' ),
		'desc'   => __( 'This can be accessed by using the <strong>[nature-service-boxes]</strong> shortcode in your pages.', 'nature' ),
		'icon'   => 'el el-briefcase',
		  'fields' => array(
			
			 array(
				'id'       => 'service_setting_section',
				'type'     => 'section',
				'indent'   => true, 
			),
			
			//================================================left_page_list_left_column
			
			array(
				'id'          => 'service_page_left_column',
				'type'        => 'section',
				'title'       => __('Left Column'),
				'subtitle'    => __('The content of the page that column in from the left', 'nature'),
				'indent'      => true,
				
			),
				//---------------------------------------------------lplc_Box_1
				array(
					'id'          => 'lplc_Box_1',
					'type'        => 'section',
					'title'       => __('Left BOX 1'),
					'indent'      => true,
				),
				array(
					'id'       => 'lplc_Box_1_title',
					'type'     => 'text',
					'title'    => __( 'Title', 'nature' ),
					'validate' => 'html',
					'default'  => "FULLY RESPONSIVE",
				),
				array(
					'id'       => 'lplc_Box_1_desc',
					'type'     => 'textarea',
					'title'    => __( 'Description', 'nature' ),
					'validate' => 'html',
					'rows'     => 2,
					'default'  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac vehicula tortor, vitae lacinia nisi.",
				),
				array(
					'id'	   =>'lplc_Box_1_icon',
					'type' 	   => 'select',
					'title'    => __('Icon', 'nature'),
					'options'  => font_awesome_icons(),
					'class'    => 'font-awesome-icons',
					'default'  => 'fa-rocket'
				),
				array(
					'id'     => 'lplc_Box_1_end',
					'type'   => 'section',
					'indent' => false,
				),
				//---------------------------------------------------lplc_Box_2
				array(
					'id'          => 'lplc_Box_2',
					'type'        => 'section',
					'title'       => __('Left BOX 2'),
					'indent'      => true,
					
				),
				array(
					'id'       => 'lplc_Box_2_title',
					'type'     => 'text',
					'title'    => __( 'Title', 'nature' ),
					'validate' => 'html',
					'default'  => "Cool animation",
				),
				array(
					'id'       => 'lplc_Box_2_desc',
					'type'     => 'textarea',
					'title'    => __( 'Description', 'nature' ),
					'validate' => 'html',
					'rows'     => 2,
					'default'  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac vehicula tortor, vitae lacinia nisi.",
				),
				array(
					'id'	   =>'lplc_Box_2_icon',
					'type' 	   => 'select',
					'title'    => __('Icon', 'nature'),
					'options'  => font_awesome_icons(),
					'class'    => 'font-awesome-icons',
					'default'  => 'fa-magic'
				),
				array(
					'id'     => 'lplc_Box_2_end',
					'type'   => 'section',
					'indent' => false,
				),
				//---------------------------------------------------lplc_Box_3
				array(
					'id'          => 'lplc_Box_3',
					'type'        => 'section',
					'title'       => __('Left BOX 3'),
					'indent'      => true,
					
				),
				array(
					'id'       => 'lplc_Box_3_title',
					'type'     => 'text',
					'title'    => __( 'Title', 'nature' ),
					'validate' => 'html',
					'default'  => "MODERN DESIGN",
				),
				array(
					'id'       => 'lplc_Box_3_desc',
					'type'     => 'textarea',
					'title'    => __( 'Description', 'nature' ),
					'validate' => 'html',
					'rows'     => 2,
					'default'  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac vehicula tortor, vitae lacinia nisi.",
				),
				array(
					'id'	   =>'lplc_Box_3_icon',
					'type' 	   => 'select',
					'title'    => __('Icon', 'nature'),
					'options'  => font_awesome_icons(),
					'class'    => 'font-awesome-icons',
					'default'  => 'fa-leaf'
				),
				array(
					'id'     => 'lplc_Box_3_end',
					'type'   => 'section',
					'indent' => false,
				),
				//---------------------------------------------------lplc_Box_4
				array(
					'id'          => 'lplc_Box_4',
					'type'        => 'section',
					'title'       => __('Left BOX 4'),
					'indent'      => true,
					
				),
				array(
					'id'       => 'lplc_Box_4_title',
					'type'     => 'text',
					'title'    => __( 'Title', 'nature' ),
					'validate' => 'html',
					'default'  => "variant colors",
				),
				array(
					'id'       => 'lplc_Box_4_desc',
					'type'     => 'textarea',
					'title'    => __( 'Description', 'nature' ),
					'validate' => 'html',
					'rows'     => 2,
					'default'  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac vehicula tortor, vitae lacinia nisi.",
				),
				array(
					'id'	   =>'lplc_Box_4_icon',
					'type' 	   => 'select',
					'title'    => __('Icon', 'nature'),
					'options'  => font_awesome_icons(),
					'class'    => 'font-awesome-icons',
					'default'  => 'fa-pencil'
				),
				array(
					'id'     => 'lplc_Box_4_end',
					'type'   => 'section',
					'indent' => false,
				),
				
			array(
				'id'     => 'service_page_left_column_end',
				'type'   => 'section',
				'indent' => false,
			),
			//================================================left_page_list_right_column
			
			array(
				'id'          => 'service_page_right_column',
				'type'        => 'section',
				'title'       => __('Right Column'),
				'subtitle'    => __('The content of the page that column in from the right', 'nature'),
				'indent'      => true,
				
			),
				//---------------------------------------------------lprc_Box_1
				array(
					'id'          => 'lprc_Box_1',
					'type'        => 'section',
					'title'       => __('Right BOX 1'),
					'indent'      => true,
					
				),
				array(
					'id'       => 'lprc_Box_1_title',
					'type'     => 'text',
					'title'    => __( 'Title', 'nature' ),
					'validate' => 'html',
					'default'  => "Hot new design",
				),
				array(
					'id'       => 'lprc_Box_1_desc',
					'type'     => 'textarea',
					'title'    => __( 'Description', 'nature' ),
					'validate' => 'html',
					'rows'     => 2,
					'default'  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac vehicula tortor, vitae lacinia nisi.",
				),
				array(
					'id'	   =>'lprc_Box_1_icon',
					'type' 	   => 'select',
					'title'    => __('Icon', 'nature'),
					'options'  => font_awesome_icons(),
					'class'    => 'font-awesome-icons',
					'default'  => 'fa-star'
				),
				array(
					'id'     => 'lprc_Box_1_end',
					'type'   => 'section',
					'indent' => false,
				),
				//---------------------------------------------------lprc_Box_2
				array(
					'id'          => 'lprc_Box_2',
					'type'        => 'section',
					'title'       => __('Right BOX 2'),
					'indent'      => true,
					
				),
				array(
					'id'       => 'lprc_Box_2_title',
					'type'     => 'text',
					'title'    => __( 'Title', 'nature' ),
					'validate' => 'html',
					'default'  => "HTML5 & CSS3",
				),
				array(
					'id'       => 'lprc_Box_2_desc',
					'type'     => 'textarea',
					'title'    => __( 'Description', 'nature' ),
					'validate' => 'html',
					'rows'     => 2,
					'default'  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac vehicula tortor, vitae lacinia nisi.",
				),
				array(
					'id'	   =>'lprc_Box_2_icon',
					'type' 	   => 'select',
					'title'    => __('Icon', 'nature'),
					'options'  => font_awesome_icons(),
					'class'    => 'font-awesome-icons',
					'default'  => 'fa-html5'
				),
				array(
					'id'     => 'lprc_Box_2_end',
					'type'   => 'section',
					'indent' => false,
				),
				//---------------------------------------------------lprc_Box_3
				array(
					'id'          => 'lprc_Box_3',
					'type'        => 'section',
					'title'       => __('Right BOX 3'),
					'indent'      => true,
					
				),
				array(
					'id'       => 'lprc_Box_3_title',
					'type'     => 'text',
					'title'    => __( 'Title', 'nature' ),
					'validate' => 'html',
					'rows'     => 2,
					'default'  => "Easy to setup",
				),
				array(
					'id'       => 'lprc_Box_3_desc',
					'type'     => 'textarea',
					'title'    => __( 'Description', 'nature' ),
					'validate' => 'html',
					'rows'     => 2,
					'default'  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac vehicula tortor, vitae lacinia nisi.",
				),
				array(
					'id'	   =>'lprc_Box_3_icon',
					'type' 	   => 'select',
					'title'    => __('Icon', 'nature'),
					'options'  => font_awesome_icons(),
					'class'    => 'font-awesome-icons',
					'default'  => 'fa-cog'
				),
				array(
					'id'     => 'lprc_Box_3_end',
					'type'   => 'section',
					'indent' => false,
				),
				//---------------------------------------------------lprc_Box_4
				array(
					'id'          => 'lprc_Box_4',
					'type'        => 'section',
					'title'       => __('Right BOX 4'),
					'indent'      => true,
					
				),
				array(
					'id'       => 'lprc_Box_4_title',
					'type'     => 'text',
					'title'    => __( 'Title', 'nature' ),
					'validate' => 'html',
					'default'  => "dedicated support",
				),
				array(
					'id'       => 'lprc_Box_4_desc',
					'type'     => 'textarea',
					'title'    => __( 'Description', 'nature' ),
					'validate' => 'html',
					'rows'     => 2,
					'default'  => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac vehicula tortor, vitae lacinia nisi.",
				),
				array(
					'id'	   =>'lprc_Box_4_icon',
					'type' 	   => 'select',
					'title'    => __('Icon', 'nature'),
					'options'  => font_awesome_icons(),
					'class'    => 'font-awesome-icons',
					'default'  => 'fa-user'
				),
				array(
					'id'     => 'lprc_Box_4_end',
					'type'   => 'section',
					'indent' => false,
				),
				
			array(
				'id'     => 'service_page_right_column_end',
				'type'   => 'section',
				'indent' => false,
			),
			array(
				'id'       => 'service_setting_section',
				'type'     => 'section',
			),
		),
	);
?>