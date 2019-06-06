<?php
$options = get_option('fivehundred_theme_settings');
if (isset($options['home'])) {
	$project_id = $options['home'];
	$project = new ID_Project($project_id);
	$id = $project->get_project_postid();
	$settings = getSettings();
}
