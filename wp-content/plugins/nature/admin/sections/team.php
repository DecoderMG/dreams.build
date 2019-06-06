<?php
$this->sections[] = array(
		'title'  => __( 'Team Settings', 'nature' ),
		'desc'   => __( 'This can be accessed by using the <strong>[nature-about-team]</strong> shortcode in your pages.', 'nature' ),
		'icon'   => 'el el-group',
		  'fields' => array(
			array(
				'id'       => 'team_section',
				'type'     => 'section',
				'indent'   => true, // Indent all options below until the next 'section' option is set.
			),
			array(
				'id'          => 'team_boxes',
				'type'        => 'slides',
				'title'       => __('Team Boxes', 'nature'),
				'placeholder' => array(
					'title'           => __('This is a title', 'nature'),
					'description'     => __('Description Here', 'nature'),
					'url'             => __('no need to fill', 'nature')
				),
				'default' => array(
					0 => array(
						'image'  =>  'http://placehold.it/340x340',
						'title' => '<h3>Steven Milius</h3><h4>Developer</h4>',
						'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac vehicula tortor, vitae lacinia nisi.</p>',
						'url' => '#',
						'sort' => 0
						),
					1 => array(
						'image'  =>  'http://placehold.it/340x340',
						'title' => '<h3>Steven Milius</h3><h4>Developer</h4>',
						'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac vehicula tortor, vitae lacinia nisi.</p>',
						'url' => '#',
						'sort' => 1
						),
					2 => array(
						'image'  =>  'http://placehold.it/340x340',
						'title' => '<h3>Steven Milius</h3><h4>Developer</h4>',
						'description' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ac vehicula tortor, vitae lacinia nisi.</p>',
						'url' => '#',
						'sort' => 2
						),
				)
			),
			array(
				'id'       => 'end_team_section',
				'type'     => 'section',
			),
		),
	);
?>