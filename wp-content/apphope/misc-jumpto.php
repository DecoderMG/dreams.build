<strong>Category <i class="fa fa-angle-down"></i></strong>
<span class="popup w230px">
	<span class="tri"></span>
	<?php $args = array(
	'type' => 'post', 'parent' => '36', 'hide_empty' => 1, 'taxonomy' => 'category',
	'pad_counts'=> false ); $categories = get_categories( $args ); ?>
	<?php foreach ($categories as $category): ?>
		<a class="bbp-forum-title" href="/blog/category/<?=$category->category_nicename;?>"><?=$category->cat_name;?></a>
	<?php endforeach; ?>
</span>