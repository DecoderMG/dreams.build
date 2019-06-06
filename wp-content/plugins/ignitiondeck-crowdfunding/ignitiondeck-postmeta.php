<?php
add_action('init', 'install_ign_metaboxes');

function install_ign_metaboxes() {
	global $pagenow;
	if ($pagenow == 'post.php' || 'post-new.php') {
		add_filter('ign_cmb_meta_boxes', 'ign_meta_boxes');
		require_once('ign_metabox/init.php');
		// Include & setup custom metabox and fields
	}
}

function ign_meta_boxes(array $meta_boxes) {
	require 'languages/text_variables.php';
	$prefix = 'ign_';
	$meta_boxes[] = array(
	    'id' => 'product_meta',
	    'title' => $tr_Project,
	    'pages' => array('ignition_product'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'class' => $prefix . 'projectmeta',
	    'fields' => array(
			array(
				'name' => __('Project Type', 'ignitiondeck'),
				'desc' => __('Pledge what you want or level based campaign. If you choose pledge what you want, only the first level will be used. If you choose level based, you can create as many levels as you need.', 'ignitiondeck'),
				'id' => $prefix.'project_type',
				'class' => $prefix . 'projectmeta_left',
				'show_help' => true,
				'options' => array(
					array(
						'name' => __('Pledge what you want', 'ignitiondeck'),
						'id' => 'pwyw',
						'value' => 'pwyw'
					),
					array(
						'name' => __('Level based', 'ignitiondeck'),
						'id' => 'level-based',
						'value' => 'level-based'
					)
				),
				'type' => 'radio'
			),
			array(
				'name' => __('Campaign End Options', 'ignitiondeck'),
				'desc' => __('Choose how to handle campaign end. Leave open to keep collecting payments, closed to remove pledge button.', 'ignitiondeck'),
				'id' => $prefix.'end_type',
				'class' => $prefix . 'projectmeta_right',
				'show_help' => true,
				'options' => array(
					array(
						'name' => __('Open', 'ignitiondeck'),
						'id' => 'open',
						'value' => 'open'
					),
					array(
						'name' => __('Closed', 'ignitiondeck'),
						'id' => 'closed',
						'value' => 'closed'
					)
				),
				'type' => 'radio'
			),
			/*array(
		        'name' => __('Project Name', 'ignitiondeck'),
		        'desc' => __('Name of Project (Required)', 'ignitiondeck'),
		        'id' => $prefix . 'product_name',
		        'class' => $prefix . 'projectmeta_left',
		        'show_help' => true,
		        'type' => 'text'
		    ),*/
			array(
		        'name' => __('Stage 1 Goal', 'ignitiondeck'),
		        'desc' => __('Amount you are seeking to raise in stage 1 (required)', 'ignitiondeck'),
		        'id' => $prefix . 'fund_goal',
		        'class' => $prefix . 'projectmeta_left',
		        'show_help' => true,
		        'type' => 'text_money'
		    ),
			array(
		        'name' => __('Stage 2 Goal', 'ignitiondeck'),
		        'desc' => __('Amount you are seeking to raise in stage 2 (required)', 'ignitiondeck'),
		        'id' => $prefix . 'fund_goal2',
		        'class' => $prefix . 'projectmeta_right',
		        'show_help' => true,
		        'type' => 'text_money'
		    ),
			array(
		        'name' => __('Current Stage', 'ignitiondeck'),
		        'desc' => __('What stage your project currently is in', 'ignitiondeck'),
		        'id' => $prefix . 'stage',
		        'class' => $prefix . 'projectmeta_left',
		        'show_help' => true,
		        'type' => 'text'
		    ),
			array(
		        'name' => __('Currency', 'ignitiondeck'),
		        'desc' => __('Currency of the project', 'ignitiondeck'),
		        'id' => $prefix . 'currency',
		        'class' => $prefix . 'projectmeta_left',
		        'show_help' => true,
		        'type' => 'text'
		    ),
		    (!(function_exists('is_id_pro') && is_id_pro())) ? array('type' => '') : array(
				'name' => __('Proposed Start Date', 'ignitiondeck'),
				'desc' => __('The date the project creator wishes to start funding', 'ignitiondeck'),
				'id' => $prefix . 'start_date',
				'class' => $prefix . 'projectmeta_right',
				'show_help' => true,
				'type' => 'text_date'
			),
		    array(
		        'name' => __('Fundraising End Date', 'ignitiondeck'),
		        'desc' => __('Date funding will end (recommended)', 'ignitiondeck'),
		        'id' => $prefix . 'fund_end',
		        'class' => $prefix . 'projectmeta_left',
		        'show_help' => true,
		        'type' => 'text_date'
		    ),
		    array(
		        'name' => __('Fundraising Stage 2 End Date', 'ignitiondeck'),
		        'desc' => __('Date Stage 2 funding will end (recommended)', 'ignitiondeck'),
		        'id' => $prefix . 'fund_end2',
		        'class' => $prefix . 'projectmeta_right',
		        'show_help' => true,
		        'type' => 'text_date'
		    ),
			array(
		        'name' => __('Project Short Description', 'ignitiondeck'),
		        'desc' => __('Used in the grid, widget areas, and on the purchase form', 'ignitiondeck'),
		        'id' => $prefix . 'project_description',
		        'class' => $prefix . 'projectmeta_full',
		        'show_help' => true,
		        'type' => 'textarea_small'
		    ),
			array(
		        'name' => __('Project Long Description', 'ignitiondeck'),
		        'desc' => __('Supports HTML. Used on project pages', 'ignitiondeck'),
		        'id' => $prefix . 'project_long_description',
		        'class' => $prefix . 'projectmeta_full tinymce',
		        'show_help' => true,
		        'type' => 'textarea_medium'
		    ),
		    array(
		        'name' => __('Video Embed Code', 'ignitiondeck'),
		        'desc' => __('Video embed code using iframe or embed format (YouTube, Vimeo, etc)', 'ignitiondeck'),
		        'id' => $prefix . 'product_video',
		        'class' => $prefix . 'projectmeta_full',
		        'show_help' => true,
		        'type' => 'textarea_small'
		    ),
		    array(
		        'name' => __('State', 'ignitiondeck'),
		        'desc' => __('Location: State', 'ignitiondeck'),
		        'id' => $prefix . 'state',
		        'class' => $prefix . 'projectmeta_full',
		        'show_help' => true,
				'class' => 'required',
					'options' => array (
						array('value' => 'AL', 'name' => 'Alabama'),array('value' => 'AK', 'name' => 'Alaska'),array('value' => 'AZ', 'name' => 'Arizona'),array('value' => 'AR', 'name' => 'Arkansas'),array('value' => 'CA', 'name' => 'California'),array('value' => 'CO', 'name' => 'Colorado'),array('value' => 'CT', 'name' => 'Connecticut'),array('value' => 'DE', 'name' => 'Delaware'),array('value' => 'FL', 'name' => 'Florida'),array('value' => 'GA', 'name' => 'Georgia'),array('value' => 'HI', 'name' => 'Hawaii'),array('value' => 'ID', 'name' => 'Idaho'),array('value' => 'IL', 'name' => 'Illinois'),array('value' => 'IN', 'name' => 'Indiana'),array('value' => 'IA', 'name' => 'Iowa'),array('value' => 'KS', 'name' => 'Kansas'),array('value' => 'KY', 'name' => 'Kentucky'),array('value' => 'LA', 'name' => 'Louisiana'),array('value' => 'ME', 'name' => 'Maine'),array('value' => 'MD', 'name' => 'Maryland'),array('value' => 'MA', 'name' => 'Massachusetts'),array('value' => 'MI', 'name' => 'Michigan'),array('value' => 'MN', 'name' => 'Minnesota'),array('value' => 'MS', 'name' => 'Mississippi'),array('value' => 'MO', 'name' => 'Missouri'),array('value' => 'MT', 'name' => 'Montana'),array('value' => 'NE', 'name' => 'Nebraska'),array('value' => 'NV', 'name' => 'Nevada'),array('value' => 'NH', 'name' => 'New Hampshire'),array('value' => 'NJ', 'name' => 'New Jersey'),array('value' => 'NM', 'name' => 'New Mexico'),array('value' => 'NY', 'name' => 'New York'),array('value' => 'NC', 'name' => 'North Carolina'),array('value' => 'ND', 'name' => 'North Dakota'),array('value' => 'OH', 'name' => 'Ohio'),array('value' => 'OK', 'name' => 'Oklahoma'),array('value' => 'OR', 'name' => 'Oregon'),array('value' => 'PA', 'name' => 'Pennsylvania'),array('value' => 'RI', 'name' => 'Rhode Island'),array('value' => 'SC', 'name' => 'South Carolina'),array('value' => 'SD', 'name' => 'South Dakota'),array('value' => 'TN', 'name' => 'Tennessee'),array('value' => 'TX', 'name' => 'Texas'),array('value' => 'UT', 'name' => 'Utah'),array('value' => 'VT', 'name' => 'Vermont'),array('value' => 'VA', 'name' => 'Virginia'),array('value' => 'WA', 'name' => 'Washington'),array('value' => 'WV', 'name' => 'West Virginia'),array('value' => 'WI', 'name' => 'Wisconsin'),array('value' => 'WY', 'name' => 'Wyoming')
					),
		        'type' => 'select'
		    ),
		    array(
		        'name' => __('City', 'ignitiondeck'),
		        'desc' => __('Location: City', 'ignitiondeck'),
		        'id' => $prefix . 'city',
		        'class' => $prefix . 'projectmeta_full',
		        'show_help' => true,
		        'type' => 'text'
		    ),
		    array(
		        'name' => __('Address Latitude', 'ignitiondeck'),
		        'desc' => __('Address Latitude', 'ignitiondeck'),
		        'id' => $prefix . 'map_lat',
		        'class' => $prefix . 'projectmeta_full',
		        'show_help' => true,
		        'type' => 'text'
		    ),
		    array(
		        'name' => __('Address Longitude', 'ignitiondeck'),
		        'desc' => __('Address Longitude', 'ignitiondeck'),
		        'id' => $prefix . 'map_lng',
		        'class' => $prefix . 'projectmeta_full',
		        'show_help' => true,
		        'type' => 'text'
		    ),
		   /* array(
		        'name' => $tr_meta_first_image_name,
		        'desc' => $tr_meta_first_image_det,
		        'id' => $prefix . 'product_image1',
		        'class' => $prefix . 'projectmeta_left',
		        'show_help' => true,
		        'type' => 'file'
		    ),*/
		    /*array(
		    	'name' => 'Disable Reward Levels',
		    	'desc' => __('Check to disable reward level display. If using this option, ensure at least one product is created and linked to this project. Otherwise, it will not be possible to make a donation.', 'ignitiondeck'),
		    	'id' => $prefix.'disable_levels',
		    	'class' => $prefix.'projectmeta_full',
		    	'show_help' => true,
		    	'type' => 'checkbox'
		    ),*/
		    array(
		        'type' => 'headline1',
		        'class' => $prefix . 'projectmeta_headline1'
		    ),
		    array(
		        'type' => 'level1wraptop',
		        'class' => 'projectmeta_none'
		    ),
		    array(
		        'name' => __('Level Title', 'ignitiondeck'),
		        'id' => $prefix . 'product_title',
		        'class' => $prefix . 'projectmeta_reward_title',
		        'show_help' => false,
		        'type' => 'text'
		    ),
			array(
		        'name' => __('Level Price', 'ignitiondeck'),
		        'id' => $prefix . 'product_price',
		        'class' => $prefix . 'projectmeta_reward_price',
		        'type' => 'text_money'
		    ),
		    array(
		        'name' => __('Level Short Description', 'ignitiondeck'),
		        'desc' => __('Used in widgets sidebars, and in some cases, on the purchase form', 'ignitiondeck'),
		        'id' => $prefix . 'product_short_description',
		        'class' => $prefix . 'projectmeta_reward_desc',
		        'show_help' => true,
		        'type' => 'textarea_small'
		    ),
		    array(
		        'name' => __('Level Long Description', 'ignitiondeck'),
		        'desc' => __('For use on the project page and in level shortcodes/widgets', 'ignitiondeck'),
		        'id' => $prefix . 'product_details',
		        'class' => $prefix . 'projectmeta_reward_desc tinymce',
		        'show_help' => true,
		        'type' => 'textarea_medium'
		    ),
		    array(
		        'name' => __('Level Limit', 'ignitiondeck'),
		        'desc' => __('Restrict the number of buyers that can back this level', 'ignitiondeck'),
		        'id' => $prefix . 'product_limit',
		        'class' => $prefix . 'projectmeta_reward_limit',
		        'show_help' => true,
		        'type' => 'text_small'
		    ),
		    array(
		    	'name' => __('Level Order', 'ignitiondeck'),
		    	'desc' => __('Enter a number of 0 (first) or higher if you wish to customize the placement of this level', 'ignitiondeck'),
		    	'id' => $prefix.'projectmeta_level_order',
		    	'class' => $prefix . 'projectmeta_reward_limit',
		    	'show_help' => true,
		    	'type' => 'text_small'
		    ),
			array(
			    'type' => 'level1wrapbottom',
			    'class' => 'projectmeta_none'
			),
			array(
	            'name' => '<h4 class="ign_projectmeta_title">'.__('Additional Levels', 'ignitiondeck').'</h4>',
				'std' => '',
	            'id' => $prefix . 'level',
	            'class' => $prefix . 'projectmeta_full new_levels',
	            'show_help' => false,
	            'type' => 'product_levels'
	        ),	
	        array(
	            'name' => __('Add Level', 'ignitiondeck'),
	            'id' => $prefix . 'addlevels',
	            'class' => $prefix . 'projectmeta_full new_level',
	            'type' => 'add_levels',
	        ),
            ///lucrez1

	        array(
	            'name' => __('Digital Files', 'ignitiondeck'),
	            'id' => $prefix . 'digitalfiles',
	            'class' => $prefix . 'projectmeta_full new_level',
	            'type' => 'digitalfiles',
	        ),

            array(

                'label' => __('Name', 'ignitiondeck'),
                'value' => (isset($vars['digitals'][0]['name']) ? $vars['digitals'][0]['name'] : ''),

                'id' => 'digital_'.(0).'_name',
                'type' => 'text1',
                'class' => 'digital-level',

            ),

            ///lucrez1




	        array(
	            'type' => 'headline2',
	            'class' => $prefix . 'projectmeta_headline2'
	        ),
            array(
                'name' => __('Image 1', 'ignitiondeck'),
                'desc' => __('Image 1 - Shortcode: [project_image product="{product_number}" image="1"]', 'ignitiondeck'),
                'id' => $prefix . 'product_image1',
                'class' => $prefix . 'projectmeta_left',
                'show_help' => true,
                'type' => 'file'
            ),
			array(
		        'name' => __('Image 2', 'ignitiondeck'),
		        'desc' => __('Image 2 - Shortcode: [project_image product="{product_number}" image="2"]', 'ignitiondeck'),
		        'id' => $prefix . 'product_image2',
		        'class' => $prefix . 'projectmeta_left',
		        'show_help' => true,
		        'type' => 'file'
		    ),
			array(
		        'name' => __('Image 3', 'ignitiondeck'),
		        'desc' => __('Image 3 - Shortcode: [project_image product="{product_number}" image="3"]', 'ignitiondeck'),
		        'id' => $prefix . 'product_image3',
		        'class' => $prefix . 'projectmeta_left',
		        'show_help' => true,
		        'type' => 'file'
		    ),
			array(
		        'name' => __('Image 4', 'ignitiondeck'),
		        'desc' => __('Image 4 - Shortcode: [project_image product="{product_number}" image="4"]', 'ignitiondeck'),
		        'id' => $prefix . 'product_image4',
		        'class' => $prefix . 'projectmeta_left',
		        'show_help' => true,
		        'type' => 'file'
		    ),
			array(
	            'name' => __('FAQ', 'ignitiondeck'),
	           'desc' => __('List Project FAQs here', 'ignitiondeck'),
	            'id' => $prefix . 'faqs',
	            'class' => $prefix . 'projectmeta_full tinymce',
	            'show_help' => true,
	            'type' => 'textarea_medium'
	        ),
	        // Removed due ticket #28133
			// array(
			//     'name' => __('Project Updates', 'ignitiondeck'),
			//     'desc' => __('List Project Updates here', 'ignitiondeck'),
			//     'id' => $prefix . 'updates',
			//     'class' => $prefix . 'projectmeta_full tinymce',
			//     'show_help' => true,
			//     'type' => 'textarea_medium'
			// ),
			array(
	            'name' => __('Challenges', 'ignitiondeck'),
	           'desc' => __('List Project Challenges here', 'ignitiondeck'),
	            'id' => $prefix . 'challenges',
	            'class' => $prefix . 'projectmeta_full tinymce',
	            'show_help' => true,
	            'type' => 'textarea_medium'
	        ),
            array(
                'name' => __('Company Name', 'ignitiondeck'),
                'desc' => __('Company Name', 'ignitiondeck'),
                'id' => $prefix . 'company_name',
                'class' => $prefix . 'projectmeta_left',
                'show_help' => true,
                'type' => 'text'
            ),
            array(
                'name' => __('Company logo', 'ignitiondeck'),
                'desc' => __('Company logo', 'ignitiondeck'),
                'id' => $prefix . 'company_logo',
                'class' => $prefix . 'projectmeta_left',
                'show_help' => true,
                'type' => 'file'
            ),
            array(
                'name' => __('Company location', 'ignitiondeck'),
                'desc' => __('Company location', 'ignitiondeck'),
                'id' => $prefix . 'company_location',
                'class' => $prefix . 'projectmeta_left',
                'show_help' => true,
                'type' => 'text'
            ),
            array(
                'name' => __('Company url', 'ignitiondeck'),
                'desc' => __('Company url', 'ignitiondeck'),
                'id' => $prefix . 'company_url',
                'class' => $prefix . 'projectmeta_left',
                'show_help' => true,
                'type' => 'text'
            ),
            array(
                'name' => __('Company Facebook', 'ignitiondeck'),
                'desc' => __('Company Facebook', 'ignitiondeck'),
                'id' => $prefix . 'company_fb',
                'class' => $prefix . 'projectmeta_left',
                'show_help' => true,
                'type' => 'text'
            ),
            array(
                'name' => __('Company Twitter', 'ignitiondeck'),
                'desc' => __('Company Twitter', 'ignitiondeck'),
                'id' => $prefix . 'company_twitter',
                'class' => $prefix . 'projectmeta_left',
                'show_help' => true,
                'type' => 'text'
            ),
            array(
                'name' => __('Project Needs', 'ignitiondeck'),
                'desc' => __('List Project Needs here', 'ignitiondeck'),
                'id' => $prefix . 'project_needs',
                'class' => $prefix . 'projectmeta_full tinymce',
                'show_help' => true,
                'type' => 'textarea_medium'
            ),
		    array(
		        'name' => __('Follow on Twitter', 'ignitiondeck'), 'id' => $prefix . 'follow_twitter', 
		        'class' => $prefix . 'projectmeta_social', 'show_help' => false, 'type' => 'text'
		    ),
		    array(
		        'name' => __('Follow on Facebook', 'ignitiondeck'), 'id' => $prefix . 'follow_facebook', 
		        'class' => $prefix . 'projectmeta_social', 'show_help' => false, 'type' => 'text'
		    ),
		    array(
		        'name' => __('Follow on Google+', 'ignitiondeck'), 'id' => $prefix . 'follow_google', 
		        'class' => $prefix . 'projectmeta_social', 'show_help' => false, 'type' => 'text'
		    ),
		    array(
		        'name' => __('Follow on LinkedIn', 'ignitiondeck'), 'id' => $prefix . 'follow_in', 
		        'class' => $prefix . 'projectmeta_social', 'show_help' => false, 'type' => 'text'
		    ),
		    array(
		        'name' => __('Follow on Instagram', 'ignitiondeck'), 'id' => $prefix . 'follow_instagram', 
		        'class' => $prefix . 'projectmeta_social', 'show_help' => false, 'type' => 'text'
		    ),
		    array(
		        'name' => __('Follow on Website', 'ignitiondeck'), 'id' => $prefix . 'follow_website', 
		        'class' => $prefix . 'projectmeta_social', 'show_help' => false, 'type' => 'text'
		    ),
	    )
	);
	return apply_filters('id_postmeta_boxes', $meta_boxes);
}
?>