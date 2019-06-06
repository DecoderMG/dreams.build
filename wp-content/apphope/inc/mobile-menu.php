<?php global $current_user;?>
<div class="mobile-menu-div">
	<a class="mobile-item" href="/forums/">Community Hub</a>
	<a class="mobile-item" href="/dashboard/?create_project=<?=$current_user->ID?>">Build Your Dream</a>
	<a class="mobile-item" href="/explore/">Sponsor a Dream</a>
	<div id="mobile-search-bar" <?php if(!empty($_POST['query'])) echo 'class="active"';?>>
		<?php $current_category = get_queried_object();?>
		<form action="/category/<?=get_query_var('cat')?$current_category->slug:''; ?>" method="post">
		<input type="text" name="query" value="<?php echo htmlspecialchars($_POST['query']); ?>" />
		</form>
	</div>
</div>