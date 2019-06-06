<div class="col-lg-3 line-links">
	<h6>Popular Help Articles</h6>
	 <?php $args = array( 'post_type' => 'faq', 'post_status'=>'publish', 'meta_query' => array(array('key' => 'popular_article','value'   => 'YES','compare'	=> 'LIKE')));
	 $the_query = new WP_Query( $args );
	 if ( $the_query->have_posts() ): $i=0;while ($the_query-> have_posts() ) : $the_query->the_post();$i++;?>
	 	<a href="/faqs/view/<?php the_ID(); ?>"><?php the_title(); ?></a>
	<?php endwhile;endif;?>
</div>