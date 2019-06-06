<?php global $current_user, $vars, $postpro_id;$umeta = get_user_meta( $current_user->ID);?>
<?php $title = empty($vars['project_name'])?'New Dream':$vars['project_name']; //get_the_title();?>
<?php $desc = empty($vars['project_short_description'])? 'Description':$vars['project_short_description'];//esc_html(get_post_meta($post->ID, 'ign_project_description',true));?>
<?php $image = empty($vars['project_hero'])?'':$vars['project_hero'];//wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'grid-thumb' ); ?>
<?php $summary = $postpro_id ? the_project_summary($postpro_id) : 0;//the_project_summary($post->ID); 
	$summary_int = $postpro_id ? intval(str_replace(',','',str_replace('$','',$summary->goal))) : 0;//intval(str_replace(',','',str_replace('$','',$summary->goal)));
	$total = $postpro_id ? $summary->total : 0;//$summary->total;
	$goal = $postpro_id ? $summary->goal : 0;//$summary->goal;
	$perc = $postpro_id ? $summary->percentage : 0;//$summary->percentage;
	$stage = $postpro_id ? $summary->stage : 0;//$summary->stage;
	$days_left = $postpro_id ? $summary->days_left : 0;//$summary->days_left;
?>
<div class="col-lg-3" >
	<div class="gridbox">
		<img class="image" src="<?=$image/*[0]*/?>" />
		<div class="box">
			<?php global $authordata; ?>
			<div class="avatar"><?=get_avatar( $current_user->ID, 68 ); ?><div class="name"><?= empty($current_user) ? get_the_title() : $umeta['first_name'][0] . ' ' . $umeta['last_name'][0]; ?></div></div>
			<a><h5><?=$title?></h5></a>
			<p><?=$desc?></p>
			<div class="bottom">
				<div class="bottom-inner smaller">
					<div class="progress-sum"><?=$total;?></div><div class="progress-goal <?=($summary_int>1000000)?'small':''?>"><strong><?=$goal;?></strong> goal</div>
		    		<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?=$perc?>%"></div></div>
		    		<div class="progress-percent"><strong>%<?=$perc?></strong> funded</div><div class="progress-days"><strong><?=$days_left?> </strong> to go</div><div class="progress-stage"><strong>Stage <?=$stage?>/</strong>2</div>
		    	</div>
			</div>
		</div>
	</div>
</div>