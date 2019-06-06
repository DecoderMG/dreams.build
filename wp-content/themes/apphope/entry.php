<div class="category-post" id="post-<?php the_ID(); ?>">
	<div class="gridbox">
		<?php
			if ($post->post_type == 'ignition_product') { 
				$metaimg1 = new stdClass;
				foreach(get_post_meta( $post->ID ) as $k => $v )
				$metaimg1->$k = $v[0];
				$img1 =  $metaimg1->ign_product_image1;
				if ($img1) {	
					echo "<img src='$img1' alt='' class='image'>";
				} else{
					$url = get_stylesheet_directory_uri();
					echo "<img src='".$url."/img/noimage.jpg' alt='' class='image'>";
				}
			}
		?>		
		<div class="box">
			<?php global $authordata; ?>

			<div class="avatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), 68 ); ?><div class="name"><?php the_author(); ?></div></div>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h5><?php the_title(); ?></h5></a>
			<p><?php if ($post->post_type == 'ignition_product') {
					//echo apply_filters('the_content', get_post_meta($post->ID, 'ign_project_long_description', true));
					echo esc_html(get_post_meta($post->ID, 'ign_project_description',true));
				}else {
					the_excerpt();
					//echo '123'.apply_filters('the_content', get_post_meta($post->ID, 'ign_project_description', true));
				}?>
				</p>
			<div class="bottom">
				<div class="bottom-inner">
					<?php $summary = the_project_summary($post->ID); $summary_int = intval(str_replace(',','',str_replace('$','',$summary->goal)));?>
					<div class="progress-sum"><?=$summary->total;?></div><div class="progress-goal <?=($summary_int>1000000)?'small':''?>"><strong><?=$summary->goal;?></strong> goal</div>
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