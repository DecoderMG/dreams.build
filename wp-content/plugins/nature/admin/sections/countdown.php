<?php
$this->sections[] = array(
	'title'  => __( 'Countdown Settings', 'nature' ),
	'desc'   => __( 'This can be accessed by using the <strong>[nature-countdown-counter]</strong> shortcode in your pages.', 'nature' ),
	'icon'   => 'el el-calendar',
	  'fields' => array(
		array(
			'id'       => 'countdown_section',
			'type'     => 'section',
			'indent'   => true, 
		),
		array(
			'id'	   =>'countdown_icon',
			'type' 	   => 'select',
			'title'    => __('Countdown Icon', 'nature'),
			'subtitle' => __('choose your countdown icon for this section <strong>[nature-countdown-icon]</strong>', 'nature'),
			'options'  => font_awesome_icons(),
			'class'    => 'font-awesome-icons',
			'default'  => 'fa-calendar'
		),
		array(
			'id'       => 'countdown_date',
			'type'     => 'date',
			'title'    => __( 'Countdown Date', 'nature' ),
			'subtitle' => __( 'Date that we are counting down to mm/dd/yyyy<p><strong>NOTE: please go to Settings>General>Date Format>Custom> fill field m/d/Y and then save it for right work timer.</strong>', 'nature' ),
			'placeholder' => '01/01/2017'
		),
		array(
			'id'=>'countdown_labels',
			'type' => 'text',
			'title' => __('Labels', 'nature'),
			'subtitle'=> __('The labels of the individual countdown items. Comma separated list.', 'nature'),
			'default' 	=> 'Days,Day,Hours,Hour,Minutes,Minute,Seconds,Seconds',
		),
		 array(
			'id'       => 'countdown_section_end',
			'type'     => 'section',
		),
	),
);
?>