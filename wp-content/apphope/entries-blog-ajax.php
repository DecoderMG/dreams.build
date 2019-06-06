<?php $i=0; if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $i++;$loop->the_post();?>
	<?php if($i===1||$i===4):?><div class="row"><?php endif;?>
	<div class="col-lg-<?=($i<4)?'4':'3';?>">
		<div class="entry-content">
			<?php if(has_post_thumbnail()):?>
				<a href="<?=the_permalink();?>"><figure class="featured-thumbnail"><span class="img-wrap"><?=the_post_thumbnail();?></span></figure></a>
			<?php endif;?>
			<div class="desc">
				<h2><?php the_title();?></h2>
				<?php the_excerpt();?>
			</div>
		</div>
	</div>
	<?php if($i===3||$i===7):?></div><?php endif;?>
<?php endwhile;endif; ?>