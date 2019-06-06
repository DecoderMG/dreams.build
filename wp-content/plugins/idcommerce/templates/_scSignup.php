<?php

global $current_user;
get_currentuserinfo();
$user_id = $current_user->ID;
$stripe_account = md_sc_account($user_id);

if($stripe_account->details_submitted != true){
	$check_creds = '';
}

?>

<li class="md-box half">
	<div class="md-profile stripe-settings">
		<h3><?php _e('Stripe', 'memberdeck') ?></h3>
		<p><?php _e('Some description about stripe', 'memberdeck') ?></p>
		<p><a <?php echo (empty($check_creds) ? 'href="https://connect.stripe.com/oauth/authorize?response_type=code&amp;client_id='.$client_id.'&amp;scope=read_write&amp;state='.$user_id.'"' : ''); ?> class="<?php echo $button_style; ?>">
			<span><?php echo (!empty($check_creds) ? '<i class="fa fa-check"></i> '.__('Connected!', 'memberdeck') : __('Connect with Stripe', 'memberdeck')); ?></span>
		</a></p>
		<?php if(!empty($check_creds) ):?>
		<p>Click <a href="/dashboard/?sc_delete=yes" class="disconnect"><strong>Disconnect Stripe</strong></a> to remove the Stripe account from the site</p>
		<?php endif;?>
	</div>
</li>
<script type="text/javascript">
	jQuery('.disconnect').on('click',function(){
		if (confirm("Are you sure?")) {
		  return true;
		}
		return false;
	})
</script>