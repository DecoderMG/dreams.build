<div class="col-lg-3" id="post-<?php the_ID(); ?>">
	<div class="gridbox">
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'grid-thumb' ); ?>
		<img class="image" src="<?=$image[0]?>" />
		<div class="box">
			<?php global $authordata; ?>
			<div class="avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 68 ); ?><div class="name"><?php the_author(); ?></div></div>
			<a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a>
			<?php if ($post->post_type == 'ignition_product') {
					//echo apply_filters('the_content', get_post_meta($post->ID, 'ign_project_long_description', true));
					echo apply_filters('the_content', get_post_meta($post->ID, 'ign_project_description', true));
				}else {
					the_excerpt();
					//echo '123'.apply_filters('the_content', get_post_meta($post->ID, 'ign_project_description', true));
				}?>
			<div class="bottom">
				<div class="bottom-inner">
					<?php $summary = the_project_summary($post->ID);?>
					<div class="progress-sum"><?=$summary->total;?></div><div class="progress-goal"><strong><?=$summary->goal;?></strong> goal</div>
		    		<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
		aria-valuemin="0" aria-valuemax="100" style="width:<?=$summary->percentage?>%"></div></div>
		    		<div class="progress-percent"><strong>%<?=$summary->percentage?></strong> funded</div><div class="progress-days"><strong><?=$summary->days_left?> </strong> to go</div><div class="progress-stage"><strong>Stage <?=$summary->stage?>/</strong>2</div>
		    	</div>
			</div>
		</div>
	</div>
</div>

<?php /*<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if(is_archive() || is_search() || is_home() || is_page_template('home.php')){
			get_template_part('entry','summary');
		} else {
			get_template_part('entry','content');
		}
		?>
		<?php 
		if ( is_single() ) {
			get_template_part( 'entry-footer', 'single' ); 
		} else {
			//get_template_part( 'entry-footer' ); 
		}
	?>
</div>*/?>