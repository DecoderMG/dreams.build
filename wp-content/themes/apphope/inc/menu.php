<?php global $current_user;?>
<ul>
    <li><a href="/forums/">Community Hub</a></li>
    <li><a href="/dashboard/?create_project=<?=$current_user->ID?>">Build Your Dream</a></li>
    <li><a href="/explore/">Sponsor a Dream</a></li>
    <?php if (is_user_logged_in()): ?>
    <?php //if (!empty($_SESSION['user'])): ?>
    <?php /*<li class="community"><a href="/community"><span><?php echo Text::get('community-menu-main'); ?></span></a>
        <div>
            <ul>
                <li><a href="/community/activity"><span><?php echo Text::get('community-menu-activity'); ?></span></a></li>
                <li><a href="/community/sharemates"><span><?php echo Text::get('community-menu-sharemates'); ?></span></a></li>
            </ul>
        </div>
    </li>*/?>
    	<li class="login">
    		<a class="user_avatar popup-action fancy" rel="<?=$current_user->ID?>" href="#profile-box"><?php echo get_avatar( $current_user->ID, 70 ); ?></a>
    		<a href="<?=wp_logout_url(get_permalink())?>"><span>Log Out</span></a>
    	</li>
    <?php else: ?>
    <li class="login"><a <?php /*href="/community"*/?> class="popup-action popup-action-login fancy" href="#login"><span>Log In</span></a> <a <?php /*href="/community"*/?> class="popup-action popup-action-signup fancy active" href="#signup"><span>Sign Up</span></a></li>
    <?php endif ?>
</ul>