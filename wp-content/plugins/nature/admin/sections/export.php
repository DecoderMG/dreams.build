<?php
$this->sections[] = array(
	'title'  => __( 'Import / Export', '' ),
	'desc'   => __( 'Import and Export your nature settings from file, text or URL.', '' ),
	'icon'   => 'el-icon-refresh',
	'fields' => array(
		array(
			'id'         => 'opt-import-export',
			'type'       => 'import_export',
			'title'      => 'Import Export',
			'subtitle'   => 'Save and restore your nature options',
			'full_width' => false,
		),
	),
);

$this->sections[] = array(
	'icon'   => 'el el-list-alt',
	'title'  => __( 'Documentation', 'nature' ),
	'fields' => array(
		array(
			'id'       => 'document_content_nature',
			'type'     => 'raw',
			'markdown' => true,
			'content'  => file_get_contents( dirname( __FILE__ ) . '/README.html' )
		),
	),
);
$this->sections[] = array(
	'icon'   => 'el el-list-alt',
	'title'  => __( 'Changelog', 'nature' ),
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'changelog_nature',
			'type'     => 'raw',
			'markdown' => true,
			'content'  => file_get_contents( plugins_url() . '/nature/changelog.txt' )
		),
	),
);
$this->sections[] = array(
	'icon'   => 'el el-ok',
	'title'  => __( 'Credits', 'nature' ),
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'credit_content_nature',
			'type'     => 'raw',
			'markdown' => true,
			'content'  => file_get_contents( dirname( __FILE__ ) . '/CREDITS.html' )
		),
	),
);
$this->sections[] = array(
	'icon'   => 'el el-smiley',
	'title'  => __( 'Thank you', 'nature' ),
	'subsection' => true,
	'fields' => array(
		array(
			'id'       => 'support_content_nature',
			'type'     => 'raw',
			'markdown' => true,
			'content'  => file_get_contents( dirname( __FILE__ ) . '/SUPPORT.html' )
		),
	),
);

?>