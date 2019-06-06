<div class="gridbox-post" id="post-<?=$post_id?>">
	<div class="gridbox">
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large'); ?>
		<?php if($image != '' || $image != null):?>
			<img class="image" src="<?=$image[0]?>" />
		<?php else: ?>
			<img class="image" src="https://dreams.build/wp-content/themes/apphope/img/noimage.jpg" />
		<?php endif; ?>
		<div class="box">
			<?php global $authordata; ?>
			<?php $aurl = get_author_posts_url( $current_user->ID );$user_firstname = get_the_author_meta('user_firstname');$user_lastname = get_the_author_meta('user_lastname');?>
			<div class="avatar"><a href="<?=$aurl?>"><?php echo get_avatar( $current_user->ID, 68 ); ?><?php /*<img src="<?=get_stylesheet_directory_uri()?>/img/avatar.jpg">*/?></a><div class="name"><a href="<?=$aurl?>"><?php echo $current_user->user_firstname.' '.$current_user->user_lastname ?></a></div></div>
			<a href="<?=$permalink?>"><h5><?=get_the_title($post_id); ?></h5></a>
			<p><?php echo esc_html(get_post_meta($post_id, 'ign_project_description',true));?></p>
			<div class="bottom">
				<div class="bottom-inner">
					<?php $summary = the_project_summary($post_id); $summary_int = intval(str_replace(',','',str_replace('$','',$summary->goal)));?>
					<?php if(strtolower(get_post_status($post_id)) == 'publish') {?>
					<div class="progress-sum"><?=$summary->total;?></div><div class="progress-goal <?=($summary_int>1000000)?'small':''?>"><strong><?=$summary->goal;?></strong> goal</div>
		    		<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
						aria-valuemin="0" aria-valuemax="100" style="width:<?=$summary->percentage?>%"></div></div>
					<div class="progress-percent"><strong>%<?=$summary->percentage?></strong> funded</div><div class="progress-days"><strong><?=$summary->days_left?> </strong> to go</div><div class="progress-stage"><strong>Stage <?=$summary->stage?>/</strong>2</div>
					<?php } else if(strtolower(get_post_status($post_id)) == 'draft') {?>
					<div class="progress-days" style="line-height: 65px; font-size: 15px;"><strong>Project in draft</strong></div>
					<?php } else {?>
						<?php if(($summary->successful == 1 && $summary->stage == 1 && $summary->successful && $summary->days_left == 0 ) || ($summary->stage == 2)) {?>
						<p style="margin-top: 5px; font-size: 15px;"><strong style="color:#5cb85c;">Project successful:</strong><br>Raised <?php echo "$summary->total";?> of <?php echo "$summary->goal";?> goal</p>
						<?php } else {?>
						<p style="margin-top: 5px; font-size: 15px;"><strong style="color:#ff0000;">Project unsuccessful:</strong><br>Raised <?php echo "$summary->total";?> of <?php echo "$summary->goal";?> goal</p>
						<?php }?>
					<?php }?>
				</div>
			</div>
		</div>
	</div>

	<div class="buttons">
		<?php if($summary->percentage=='100'):?>
		<?php endif;?>

		<?php if( ($summary->successful == 1 && $summary->stage == 1 && $summary->successful && $summary->days_left == 0 ) || ($summary->stage == 2) ): ?>
			<a class="button green" title="Export Orders" href="<?=md_get_durl().$prefix.'export_project='.$post_id?>">EXPORT</a>
		<?php endif;?>

		<a class="button blue" title="Edit Project" href="<?=md_get_durl().$prefix.'edit_project='.$post_id?>">EDIT</a>
		<a class="button gray" title="View Project" href="<?=$permalink?>">VIEW</a>
		<a class="button orange" title="Analytics" href="<?=md_get_durl().$prefix.'analytics='.$post_id?>">ANALYTICS</a>
	<?php if ($post->post_author == $current_user->ID && strtoupper($status) != 'PUBLISH' && !$summary->successful) { ?>
		<!--<a class="button red" style="padding: 0 23px; line-height: 40px;" onclick="return confirm('Are you SURE you want to delete this post?')" href="<?php echo get_delete_post_link( $post->ID ) ?>">Delete</a> -->
	<?php } ?>

	</div>

</div>

<?php /*
<li class="myprojects column-3 author-<?php echo $post->post_author; ?>" data-author="<?php echo $post->post_author; ?>">
	<div class="myproject_wrapper">
      <div class="project-item">
          <div class="project-thumb image" style="<?php echo (!empty($thumb) ? 'background-image: url('.$thumb.');' : ''); ?>"></div>
          <div title="Project Status" class="project-status <?php echo strtolower($status); ?>">
             <?php echo (strtoupper($status) == 'PUBLISH' ? __('PUBLISHED', 'memberdeck') : $status); ?>
          </div>
          <div class="project-item-wrapper <?php echo strtolower($status); ?>">
              <div class="option-list">
              <?php 
              $actions = '<a title="Edit Project" href="'.md_get_durl().$prefix.'edit_project='.$post_id.'"><i class="fa fa-edit"></i></a>';
              $actions .= '<a title="Upload File" href="'.md_get_durl().$prefix.'project_files='.$post_id.'"><i class="fa fa-cloud-upload"></i></a>';
              $actions .= '<a title="View Project" href="'.$permalink.'"><i class="fa fa-eye"></i></a>';
              $actions .= '<a title="Export Orders" href="'.md_get_durl().$prefix.'export_project='.$post_id.'"><i class="fa fa-share-square-o"></i></a>';
              echo apply_filters('id_myprojects_actions', $actions, $post, $user_id);
              ?>
              </div>
         </div>
         <div title="Project Name" class="project-name"><?php echo get_the_title($post_id); ?></div>
         <div class="project-funded"><?php echo $project_raised; ?> <?php _e('Raised', 'ignitiondeck'); ?></div>
      </div>
    </div>
</li>*/?>