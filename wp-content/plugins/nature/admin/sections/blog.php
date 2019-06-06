<?php
$this->sections[] = array(
		'title'  => __( 'Blog Settings', 'nature' ),
		'desc'   => __( 'This can be accessed by using the <strong>[nature-blog-posts]</strong> shortcode in your pages.', 'nature' ),
		'icon'   => 'el el-pencil',
		'fields' => array(
			array(
				'id'       => 'blogs_section',
				'type'     => 'section',
				'indent'   => true, 
			),
			array(
				'id'	   =>'blog_icon',
				'type' 	   => 'select',
				'title'    => __('Blog Icon', 'nature'),
				'subtitle' => __('choose your blog icon for this section <strong>[nature-blog-icon]</strong>', 'nature'),
				'options'  => font_awesome_icons(),
				'class'    => 'font-awesome-icons',
				'default'  => 'fa-newspaper-o'
			),
			array(
				'id'       => 'post_count',
				'type'     => 'spinner', 
				'title'    => __('Post Count', 'nature'),
				'subtitle' => __('The number of posts to display on Blog page','nature'),
				'default'  => '2',
				'min'      => '1',
				'step'     => '1',
				'max'      => '10',
			),
			array(
				'id'       => 'post_type',
				'type'     => 'select',
				'data'     => 'post_types',
				'title'    => __('Post Type', 'nature'), 
				'subtitle' => __('For properly working: We offer use the default (Posts).', 'nature'),
				'default'  => 'post',
			),
			array(
				'id'       => 'post_category',
				'type'     => 'select',
				'data'     => 'categories',
				'title'    => __('Post Category', 'nature'), 
				'subtitle' => __('Please choose the appropriate category.', 'nature'),
				'default'  => '1',
				'required' => array( 'post_type', "=", 'post' ),
			),
			array(
				'id'       => 'blogs_section_end',
				'type'     => 'section',
			),
		),
	);
?>