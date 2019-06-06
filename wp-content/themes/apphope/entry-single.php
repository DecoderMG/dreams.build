<div class="post" id="post-<?php the_ID(); ?>">
	<div class="gridbox">
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large'); ?>
		<?php if($image != '' || $image != null):?>
			<img class="image" href="<?php the_permalink(); ?>" src="<?=$image[0]?>" />
		<?php else: ?>
			<img class="image" href="<?php the_permalink(); ?>" src="https://dreams.build/wp-content/themes/apphope/img/noimage.jpg" />
		<?php endif; ?>
		<div class="box">
			<?php $aurl = get_author_posts_url( get_the_author_meta( 'ID' ) );$user_firstname = get_the_author_meta('user_firstname');$user_lastname = get_the_author_meta('user_lastname');?>
			<div class="avatar"><a href="<?=$aurl?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 68 ); ?></a><div class="name"><a href="<?=$aurl?>"><?=(empty($user_firstname))?get_the_author():$user_firstname.' '.$user_lastname;?></a></div></div>
			<a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
			<p><?php if ($post->post_type == 'ignition_product') {
					echo esc_html(get_post_meta($post->ID, 'ign_project_description',true));
				}else {
					the_excerpt();
				}?>
				</p>
			<div class="bottom">
				<div class="bottom-inner">
					<?php $summary = the_project_summary($post->ID); $summary_int = intval(str_replace(',','',str_replace('$','',$summary->goal)));?>
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
</div>