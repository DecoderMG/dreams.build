<div class="col-lg-10 faq-sidebar">
	<div class="whitebox parted">
		<?php global $categories,$gcats;$cur_cat = get_query_var('category')?get_query_var('category'):'all';$categories = get_categories(array('type'  => 'faq', 'taxonomy' => 'faq_category','hide_empty'=>0,'orderby'=>'name','order'  =>'ASC'));?>
		<?php foreach($categories as $category) if($category->parent == 0) $gcats[] = $category;?>
		<?php $i=0;foreach($gcats as $category): ?>
			<a <?=($cur_cat==$category->slug)?'':'href="/faqs/'.$category->slug.'"';?> class="title <?=($cur_cat==$category->slug)?'active current':''?>"><?=$category->cat_name?></a>
			<div class="part <?=($cur_cat==$category->slug)?'active':'';?>">
				<?php foreach($categories as $subcategory): if($subcategory->parent == $category->cat_ID):?>
					<a href="#cat<?=$subcategory->cat_ID?>" class="scroll"><?=$subcategory->cat_name?></a>
				<?php endif;endforeach;?>
			</div>
		<?php $i++;endforeach;?>
	</div>
</div>
<div class="col-lg-2"></div>