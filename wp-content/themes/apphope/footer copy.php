<?php/** The template for displaying the footer */?>
<footer class="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h4>Dream Categories</h4>
				<div class="row footer-links">
					<?php $categories = get_categories( array('type'  => 'ignition_product', 'taxonomy' => 'category','hide_empty'=>0,'exclude'=>'1,36') );
						$count = count($categories);
						$collection1 = array_slice($categories, 0, ceil($count / 2), true);
						$collection2 = array_diff_key($categories, $collection1);
					 ?> 
					<div class="col-lg-6">
						<?php foreach ($collection1 as $category):?>
							<a href="<?=get_category_link( $category->term_id )?>"><?=$category->cat_name?></a>
						<?php endforeach;?>
					</div>
					<div class="col-lg-6">
						<?php foreach ($collection2 as $category):?>
							<a href="<?=get_category_link( $category->term_id )?>"><?=$category->cat_name?></a>
						<?php endforeach;?>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row footer-links">
					<div class="col-lg-4">
						<h4>About Us</h4>
						<a href="<?=get_permalink(39); ?>">About Us</a>
						<a href="">Blog</a>
						<a href="<?=get_permalink(8); ?>">FAQ</a>
						<a href="<?=get_permalink(42); ?>">Privacy Policy</a>
						<a href="<?=get_permalink(44); ?>">Terms of Service</a>
					</div>
					<div class="col-lg-4">
						<h4>Help</h4>
						<a href="<?=get_permalink(12); ?>">Guidebook</a>
						<a href="<?=get_permalink(46); ?>">Support</a>
						<a href="">Forum</a>
					</div>
					<div class="col-lg-4">
						<h4>Social</h4>
						<a target="_blank" href=""> <em class="fa fa-facebook"></em> Facebook</a>
						<a target="_blank" href=""><em class="fa fa-twitter"></em> Twitter</a>
						<a target="_blank" href=""> <em class="fa fa-google-plus"></em> Google+</a>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<form class="signup-form">
							<label>Sign Up</label>
							<div class="row">
								<div class="col-lg-10">
									<input type="text" name="email" class="input" placeholder="Your Email Here" />
								</div>
								<div class="col-lg-2">
									<input type="submit" class="submit" name="" value="&gt;" />
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<hr class="divider" />
		<div class="row copy">
			<div class="col-lg-6">
				<a href="/"><img src="<?=get_stylesheet_directory_uri()?>/img/logo-white.png" width="195" height="33" class="logo" /></a>
				<p>&copy; <?=date('Y')?> Application Hope, LLC.</p>
			</div>
			<div class="col-lg-6 badges">
				<img src="<?=get_stylesheet_directory_uri()?>/img/etrust.png" alt="etrust" width="142" height="45" />
				<img src="<?=get_stylesheet_directory_uri()?>/img/bbb.png" alt="bbb" width="100" height="38" />
			</div>
		</div>
	</div>
</footer>
<?php get_template_part('inc/login-box', ''); ?>
<?php get_template_part('inc/signup-box', ''); ?>
<?php get_template_part('inc/profile-box', ''); ?>
<?php wp_footer(); ?>
</body>
</html>