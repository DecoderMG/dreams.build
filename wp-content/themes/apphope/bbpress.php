<?php
get_header(); ?>
<?php while ( have_posts() ) : the_post();?>
<div class="top_banner"><div class="shadow"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-6 title-column"><h1>Forum</h1></div><?php /*get_post_type()*/?>
			<div class="col-lg-6 title-right">
				<div class="row">
					<div class="col-lg-8 forum-left">
						<?php if ( bbp_allow_search() ) : ?>
							<div class="bbp-search-form"><?php bbp_get_template_part( 'form', 'search' ); ?></div>
						<?php endif; ?>
					</div>
					<div class="col-lg-4 forum-jumpto">
						<?php bbp_get_template_part( 'misc', 'jumpto' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="dream-links">
	<div class="fluid-container">
		<div class="row">
			<div class="col-fifth"><a href="/forums/#general">General</a></div>
			<div class="col-fifth"><a href="/forums/#dreams-build">Dreams.Build Platform</a></div>
			<div class="col-fifth"><a href="/forums/#whiteboard">Whiteboard</a></div>
			<div class="col-fifth"><a href="/forums/#crowdfunding">Crowdfunding</a></div>
			<div class="col-fifth"><a href="/forums/#forum-rules">Forum Rules</a></div>
		</div>
	</div>
</div>

<div class="wide_content gray"><div class="shadow"></div>
	<div class="container">
		<?php echo get_the_content(); ?>
	</div>
</div>
<?php endwhile;?>

<?php get_footer(); ?>
