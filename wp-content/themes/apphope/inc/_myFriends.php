<h3>Social</h3>

<?php global $current_user, $wpdb; 
	
	$socials = $wpdb->get_results( 
	"SELECT id, provider FROM wp_sHAbFYcUYmLV_wslusersprofiles
	WHERE user_id = ".$current_user->ID.' ORDER BY provider asc');
	$social_array = array();
	foreach ( $socials as $row ) { $social_array[] = strtolower($row->provider);}

if($_GET['remove']&&in_array($_GET['remove'], $social_array) ){
	$social_array = array_diff($social_array, array($_GET['remove']));
	$deleted = $_GET['remove'];
	$wpdb->delete( 'wp_sHAbFYcUYmLV_wslusersprofiles', array( 'user_id' => $current_user->ID, 'provider' => $deleted), array( '%d','%s' ) );
	$wpdb->delete( 'wp_sHAbFYcUYmLV_wsluserscontacts', array( 'user_id' => $current_user->ID, 'provider' => $deleted), array( '%d','%s' ) );
}
$authenticate_base_url = site_url( 'wp-login.php', 'login_post' ) 
                                        . ( strpos( site_url( 'wp-login.php', 'login_post' ), '?' ) ? '&' : '?' ) 
                                                . "action=wordpress_social_authenticate&mode=link&";

$redirect_to = wsl_get_current_url();?>
<?php if(!empty($social_array)){
	echo '<div class="row row-social">';
	echo '<div class="col-lg-4"><img style="vertical-align:middle;width:16px;height:16px;" src="/wp-content/plugins/wordpress-social-login/assets/img/16x16/facebook.png"> ';
	if(in_array('facebook', $social_array)) echo 'Facebook account is connected. <a class="button blue" href="/dashboard/?friends=1&remove=facebook">Disconnect Facebook</a>';
	elseif($deleted=='facebook') echo 'Facebook account is disconnected.';
	else echo 'Facebook account is not connected. <a class="button blue" href="'. apply_filters( 'wsl_render_auth_widget_alter_authenticate_url', $authenticate_base_url . "provider=Facebook&redirect_to=" . urlencode( $redirect_to ), 'Facebook', 'login', $redirect_to, 0 ). '">Connect Facebook</a>';
	
	echo '</div><div class="col-lg-4"><img style="vertical-align:middle;width:16px;height:16px;" src="/wp-content/plugins/wordpress-social-login/assets/img/16x16/google.png"> ';
	
	if(in_array('google', $social_array)) echo 'Google account is connected. <a class="button blue" href="/dashboard/?friends=1&remove=google">Disconnect Google</a>';
	elseif($deleted=='google') echo 'Google account is disconnected.';
	else echo 'Google account is not connected. <a class="button blue" href="'. apply_filters( 'wsl_render_auth_widget_alter_authenticate_url', $authenticate_base_url . "provider=Google&redirect_to=" . urlencode( $redirect_to ), 'Google', 'login', $redirect_to, 0 ). '">Connect Google</a>';
	
	echo '</div><div class="col-lg-4"><img style="vertical-align:middle;width:16px;height:16px;" src="/wp-content/plugins/wordpress-social-login/assets/img/16x16/twitter.png"> ';
	
	if(in_array('twitter', $social_array)) echo 'Twitter account is connected. <a class="button blue" href="/dashboard/?friends=1&remove=twitter">Disconnect Twitter</a>';
	elseif($deleted=='twitter') echo 'Twitter account is disconnected.';
	else echo 'Twitter account is not connected. <a class="button blue" href="'. apply_filters( 'wsl_render_auth_widget_alter_authenticate_url', $authenticate_base_url . "provider=Twitter&redirect_to=" . urlencode( $redirect_to ), 'Twitter', 'login', $redirect_to, 0 ). '">Connect Twitter</a>';
	
	echo '</div>
	</div>';
}
else{
	echo '<p>Social accounts are not connected. Just log in using your social accounts.</p>';
}
?>
<?php $sql = "SELECT wp_sHAbFYcUYmLV_users.id, contacts.identifier FROM wp_sHAbFYcUYmLV_users LEFT JOIN wp_sHAbFYcUYmLV_wsluserscontacts contacts ON contacts.email = wp_sHAbFYcUYmLV_users.user_email LEFT JOIN wp_sHAbFYcUYmLV_wslusersprofiles profiles ON contacts.identifier = profiles.identifier
	WHERE contacts.user_id = '".$current_user->ID."' AND wp_sHAbFYcUYmLV_users.id!= '".$current_user->ID."' GROUP BY wp_sHAbFYcUYmLV_users.id";
	$friends = $wpdb->get_results( $sql );
	$friends_arr = array(0);
	foreach($friends as $f) $friends_arr[] = $f->id;
	?>
	<br/><a name="created"></a><h3>Friends Projects: Created</h3>
<?php 
    $args = array( 'suppress_filters' => true,'post_type' => 'ignition_product', 'posts_per_page' => 4,'order'=>'DESC','post_status'=>'publish','orderby'=>'date', 'author__in' => $friends_arr );
    $loop = new WP_Query($args);
    if ($loop -> have_posts()) : 
    	while ($loop -> have_posts()) : $loop -> the_post();
    		get_template_part('entry');
			endwhile;
		else:?><p>No projects found</p><?php endif;wp_reset_postdata();?>

	<br/><a name="backed"></a><h3>Friends Projects: Backed</h3>
<?php 
	$misc = ' WHERE user_id = IN ('.implode(',', $friends_arr).')';$listed = array();$wp_ids = array(0);
	$orders = ID_Member_Order::get_orders(null, null, $misc);
	if (!empty($orders)) {
		$mdid_orders = array();
		foreach ($orders as $order) {
			$mdid_order = mdid_by_orderid($order->id);
			if (!empty($mdid_order)) {$mdid_orders[] = $mdid_order;}
		}
		if (!empty($mdid_orders)) {
			$id_orders = array();
			foreach ($mdid_orders as $payment) {
				$order = new ID_Order($payment->pay_info_id);$the_order = $order->get_order();
				if (!empty($the_order)) { $id_orders[] = $the_order;}
			}
		}
		foreach ($id_orders as $id_order) {
			$project = new ID_Project($id_order->product_id);
			if(!in_array($id_order->product_id, $listed)){
				$listed[] = $id_order->product_id;$wp_ids[] = $project->get_project_postid();
			}
		}
	}
    $args = array( 'suppress_filters' => true,'post_type' => 'ignition_product', 'posts_per_page' => 4,'order'=>'DESC','post_status'=>'publish','orderby'=>'date', 'post__in' => $wp_ids);
	 

    $loop = new WP_Query($args);
    if ($loop -> have_posts()) : 
    	while ($loop -> have_posts()) : $loop -> the_post();
    		get_template_part('entry');
			endwhile;
		else:?><p>No projects found</p><?php endif;wp_reset_postdata();?>