<div class="searchbar">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<?php $meta_values = get_meta_values( 'ign_city', $type = 'ignition_product', $status = 'publish' ); ?>
				<span>Show me
					<strong><strong><?php global $current_category; 
						echo (empty($current_category))?'All':$current_category->cat_name; ?></strong><em></em>
						<span class="popup w176px" rel="category">
							<span class="tri"></span>
							<?php $categories = get_categories( array('type'  => 'ignition_product', 'taxonomy' => 'category','hide_empty'=>0,'exclude'=>'1,36,47,46,232,233,234') );?>
							<a href="/category/">ALL</a>
							<?php foreach ($categories as $category):?>
								<?php if (!is_numeric($category->slug)) : ?>
									<a href="/category/<?=$category->slug?>" rel="<?=$category->slug?>"><?=$category->cat_name?></a>
								<?php endif; ?>
							<?php endforeach;?>
						</span>
					</strong>
					dreams from
					<?php $place = get_query_var('place');$sort = get_query_var('sort');
					if(empty($meta_values) ) {
						$meta_values = array();
					}
						$meta_values = array_map('strtolower', $meta_values);
						$place = in_array($place, $meta_values)? $place : 0;
					?>
						<strong><strong class="uppercase"><?=!empty($place)?$place:'Anywhere'?></strong><em></em>
						<span class="popup w176px uppercase" rel="place">
							<span class="tri"></span>
							<span rel="any">Anywhere</span>
							<?php foreach($meta_values as $row):?>
								<span rel="<?=$row?>"><?=$row?></span>
							<?php endforeach;?>
						</span>
					</strong>
					sorted by
					<?php $sorts = array('popularity','newest','end-date','most-funded');
						$sort = in_array($sort, $sorts)? $sort : 0;
					?>
					<strong><strong><?=!empty($sort)?$sort:'whatever'?></strong><em></em>
						<span class="popup w176px capitalize" rel="orderby">
							<span class="tri"></span>
							<?php foreach($sorts as $row):?>
								<span rel="<?=$row?>"><?=str_replace('-',' ',$row)?></span>
							<?php endforeach;?>
						</span>
					</strong>
				</span>
			</div>
		</div>
	</div>
</div>