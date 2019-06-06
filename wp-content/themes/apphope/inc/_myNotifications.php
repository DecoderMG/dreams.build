<?php
$fields = array(
	'notify_create_project',
	'notify_update_project',
	'notify_publish_project',
	'notify_forum_answer',
	'registration_email',
	'welcome_email',
	'purchase_receipt',
	'preorder_receipt',
	'product_renewal_email',
	'reset_password',
	'password_changed',
	'account_deleted',
	'project_new',
	'project_approved',
	'project_live',
	'project_rejected',
	'project_funded',
	'project_not_funded',
	'project_stage_change',
	'project_complete_stage2',
	'project_new_comment',
	'project_sponsor_new_update',
	'project_sponsor_failed',
	'project_sponsor_stage_change',
	'project_sponsor_complete_stage2',
	'project_sponsor_innovator_comment',
	'project_sponsor_innovator_update',
	'funding_reaches_50',
	'funding_reaches_75',
	'notify_forum_answer',
	'receive_weekly',
	'receive_occasional',
);
global $current_user;
?>

<?php if ($_POST && isset($_POST['notifications'])) {
	$notifications = $_POST['notifications'];
//	 print_r($fields);
	foreach($fields as $field) {
		if (isset($notifications[$field]) && $notifications[$field] == 1) {
			$value = 1;
		} else {
			$value = 0;
		}
//		 echo $field . ' -> ' .$value . '<br />';
//		add_user_meta( $current_user->ID, $field, $value );
		update_user_meta($current_user->ID, $field, $value);
		// echo $field;
	}
}

$umeta = get_user_meta( $current_user->ID);
?>
<?php get_template_part('inc/dash', ''); ?>
<form id="edit-profile" name="edit-profile" method="POST" action="/dashboard/?notifications=1">
<div class="row mt"><div class="col-lg-2 dashboard-sidebar">
			<div class="whitebox parted">
				<a href="#your_dream" class="scroll title">YOUR DREAM</a>
				<a href="#forum" class="scroll title">FORUM</a>
				<a href="#dreamsbuild" class="scroll title">DREAMS.BUILD</a>
			</div>
			<input class="button blue" name="submit" type="submit" value="Save">
		</div>
		<div class="col-lg-10"><div class="whitebox">
<?php global $current_user, $wpdb; ?>
<div class="dashboard-block">
	<a name="your_dream"></a>

	<h3>Project (for innovator):</h3>
	<label class="radio_label">
		<input class="radio" <?=($umeta['project_new'][0]==1 && isset($umeta['project_new']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[project_new]" value="1" />Dream was submitted for review
	</label>

	<label class="radio_label">
		<input class="radio" <?=($umeta['project_approved'][0]==1 && isset($umeta['project_approved']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[project_approved]" value="1" />Dream was approved and live
	</label>

	<label class="radio_label">
		<input class="radio" <?=($umeta['project_rejected'][0]==1 && isset($umeta['project_rejected']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[project_rejected]" value="1" />Dream was rejected
	</label>

	<label class="radio_label">
		<input class="radio" <?=($umeta['funding_reaches_50'][0]==1 && isset($umeta['funding_reaches_50']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[funding_reaches_50]" value="1" />Funding reached 50%
	</label>

	<label class="radio_label">
		<input class="radio" <?=($umeta['funding_reaches_75'][0]==1 && isset($umeta['funding_reaches_75']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[funding_reaches_75]" value="1" />Funding reached 75%
	</label>

	<label class="radio_label">
		<input class="radio" <?=($umeta['project_not_funded'][0]==1 && isset($umeta['project_not_funded']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[project_not_funded]" value="1" />Created dream is not successfully funded
	</label>

	<label class="radio_label">
		<input class="radio" <?=($umeta['project_funded'][0]==1 && isset($umeta['project_funded']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[project_funded]" value="1" />Created dream is successfully funded
	</label>

	<label class="radio_label">
		<input class="radio" <?=($umeta['project_complete_stage2'][0]==1 && isset($umeta['project_complete_stage2']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[project_complete_stage2]" value="1" />Dream finished Stage 2
	</label>

	<label class="radio_label">
		<input class="radio" <?=($umeta['project_new_comment'][0]==1 && isset($umeta['project_new_comment']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[project_new_comment]" value="1" />New comment on a dream
	</label>

	<h3>Project (for Sponsor):</h3>
	<label class="radio_label">
		<input class="radio" <?=($umeta['project_sponsor_new_update'][0]==1 && isset($umeta['project_sponsor_new_update']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[project_sponsor_new_update]" value="1" />Sponsored dream posted an update
	</label>

	<label class="radio_label">
		<input class="radio" <?=($umeta['project_sponsor_failed'][0]==1 && isset($umeta['project_sponsor_failed']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[project_sponsor_failed]" value="1" />Sponsored dream is not successfully funded
	</label>

	<label class="radio_label">
		<input class="radio" <?=($umeta['project_sponsor_stage_change'][0]==1 && isset($umeta['project_sponsor_stage_change']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[project_sponsor_stage_change]" value="1" />Sponsored dream has progressed from Stage 1 to Stage 2
	</label>

	<label class="radio_label">
		<input class="radio" <?=($umeta['project_sponsor_complete_stage2'][0]==1 && isset($umeta['project_sponsor_complete_stage2']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[project_sponsor_complete_stage2]" value="1" />Sponsored dream finished Stage 2
	</label>

	<label class="radio_label">
		<input class="radio" <?=($umeta['purchase_receipt'][0]==1 && isset($umeta['purchase_receipt']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[purchase_receipt]" value="1" />Confirmation and receipt for a sponsored dream
	</label>


	<label class="radio_label">
		<input class="radio" <?=($umeta['project_sponsor_innovator_comment'][0]==1 && isset($umeta['project_sponsor_innovator_comment']))?'checked="checked"':'';?>
			   type="checkbox" name="notifications[project_sponsor_innovator_comment]" value="1" />New comment on a sponsored dream
	</label>

<!--	<h3>Platform:</h3>-->
<!--	<label class="radio_label">-->
<!--		<input class="radio" --><?//=($umeta['project_sponsor_complete_stage2'][0]==0||!isset($umeta['project_sponsor_complete_stage2']))?'checked="checked"':'';?>
<!--			   type="checkbox" name="notifications[project_sponsor_complete_stage2]" value="1" />Forgotten password-->
<!--	</label>-->








<!--	<label class="radio_label"><input class="radio" --><?//=$umeta['notify_update_project'][0]==0||!isset($umeta['notify_update_project'])?'checked="checked"':'';?><!-- type="checkbox" name="notifications[notify_update_project]" value="1" />The dream is updated</label>-->

<!--	<label class="radio_label"><input class="radio" --><?//=$umeta['notify_publish_project'][0]==0||!isset($umeta['notify_publish_project'])?'checked="checked"':'';?><!-- type="checkbox" name="notifications[notify_publish_project]" value="1" />The dream is published</label><br/>-->

<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['registration_email'][0]==0||!isset($umeta['registration_email']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[registration_email]" value="1" />--><?php //_e('Registration Email (Paypal)', 'memberdeck'); ?><!--</label>-->

<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['welcome_email'][0]==0||!isset($umeta['welcome_email']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[welcome_email]" value="1" />--><?php //_e('Welcome Email', 'memberdeck'); ?><!--</label>-->

<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['purchase_receipt'][0]==0||!isset($umeta['purchase_receipt']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[purchase_receipt]" value="1" />--><?php //_e('Confirmation and receipt for the sponsored dream', 'memberdeck'); ?><!--</label>-->

<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['preorder_receipt'][0]==0||!isset($umeta['preorder_receipt']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[preorder_receipt]" value="1" />--><?php //_e('Pre-Order Receipt', 'memberdeck'); ?><!--</label>-->
<!---->
<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['product_renewal_email'][0]==0||!isset($umeta['product_renewal_email']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[product_renewal_email]" value="1" />--><?php //_e('Product Renewal Notification Email', 'memberdeck'); ?><!--</label>-->
<!---->
<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['reset_password'][0]==0||!isset($umeta['reset_password']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[reset_password]" value="1" />--><?php //_e('Forgotten password', 'memberdeck'); ?><!--</label>-->
<!---->
<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['password_changed'][0]==0||!isset($umeta['password_changed']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[password_changed]" value="1" />--><?php //_e('Password changed', 'memberdeck'); ?><!--</label>-->
<!---->
<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['account_deleted'][0]==0||!isset($umeta['account_deleted']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[account_deleted]" value="1" />--><?php //_e('Account deleted', 'memberdeck'); ?><!--</label>-->
<!---->
<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['project_approved'][0]==0||!isset($umeta['project_approved']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[project_approved]" value="1" />--><?php //_e('Dream approved and live', 'memberdeck'); ?><!--</label>-->

<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['project_live'][0]==0||!isset($umeta['project_live']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[project_live]" value="1" />--><?php //_e('Dream is Live', 'memberdeck'); ?><!--</label>-->

<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['project_rejected'][0]==0||!isset($umeta['project_rejected']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[project_rejected]" value="1" />--><?php //_e('Dream has been rejected', 'memberdeck'); ?><!--</label>-->

<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['project_funded'][0]==0||!isset($umeta['project_funded']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[project_funded]" value="1" />--><?php //_e('Created dream is successfully funded', 'memberdeck'); ?><!--</label>-->

<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['project_not_funded'][0]==0||!isset($umeta['project_not_funded']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[project_not_funded]" value="1" />--><?php //_e('Created dream is not successfully funded', 'memberdeck'); ?><!--</label>-->

<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['project_stage_change'][0]==0||!isset($umeta['project_stage_change']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[project_stage_change]" value="1" />--><?php //_e('Dream moves from stage one to stage two', 'memberdeck'); ?><!--</label>-->

<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['project_complete_stage2'][0]==0||!isset($umeta['project_complete_stage2']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[project_complete_stage2]" value="1" />--><?php //_e('Created dream finished Stage 2', 'memberdeck'); ?><!--</label>-->
<!---->
<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['project_new_comment'][0]==0||!isset($umeta['project_new_comment']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[project_new_comment]" value="1" />--><?php //_e('New comment on the dream', 'memberdeck'); ?><!--</label>-->
<!---->
<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['project_sponsor_new_update'][0]==0||!isset($umeta['project_sponsor_new_update']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[project_sponsor_new_update]" value="1" />--><?php //_e('Sponsored dream posts an update', 'memberdeck'); ?><!--</label>-->
<!---->
<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['project_sponsor_failed'][0]==0||!isset($umeta['project_sponsor_failed']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[project_sponsor_failed]" value="1" />--><?php //_e('Sponsored dream has failed', 'memberdeck'); ?><!--</label>-->
<!---->
<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['project_sponsor_stage_change'][0]==0||!isset($umeta['project_sponsor_stage_change']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[project_sponsor_stage_change]" value="1" />--><?php //_e('Sponsored dream moves from Stage 1 to Stage 2', 'memberdeck'); ?><!--</label>-->
<!---->
<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['project_sponsor_complete_stage2'][0]==0||!isset($umeta['project_sponsor_complete_stage2']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[project_sponsor_complete_stage2]" value="1" />--><?php //_e('Sponsored dream finished Stage 2', 'memberdeck'); ?><!--</label>-->
<!---->
<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['project_sponsor_innovator_comment'][0]==0||!isset($umeta['project_sponsor_innovator_comment']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[project_sponsor_innovator_comment]" value="1" />--><?php //_e('New comment on the sponsored dream', 'memberdeck'); ?><!--</label>-->

<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['project_sponsor_innovator_update'][0]==0||!isset($umeta['project_sponsor_innovator_update']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[project_sponsor_innovator_update]" value="1" />--><?php //_e('Sponsot - Project Has Been Updated', 'memberdeck'); ?><!--</label>-->

<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['funding_reaches_50'][0]==0||!isset($umeta['funding_reaches_50']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[funding_reaches_50]" value="1" />--><?php //_e('Funding reaches 50%', 'memberdeck'); ?><!--</label>-->
<!---->
<!--	<label class="radio_label"><input class="radio" --><?//=($umeta['funding_reaches_75'][0]==0||!isset($umeta['funding_reaches_75']))?'checked="checked"':'';?><!-- type="checkbox" name="notifications[funding_reaches_75]" value="1" />--><?php //_e('Funding reaches 75%', 'memberdeck'); ?><!--</label>-->



</div>
<div class="dashboard-block">
<a name="forum"></a>
<h3>Forum Notifications</h3>
<label class="radio_label"><input class="radio" <?=($umeta['notify_forum_answer'][0]==1)?'checked="checked"':'';?> type="checkbox" name="notifications[notify_forum_answer]" value="1" /> Someone answers my question</label><br/>
</div>
<div class="dashboard-block nb">
<a name="dreamsbuild"></a>
<h3>Updates From Dreams.Build</h3>
<label class="radio_label"><input class="radio" <?=($umeta['receive_weekly'][0]==1)?'checked="checked"':'';?> type="checkbox" name="notifications[receive_weekly]" value="1" /> Receive weekly emails</label>
<label class="radio_label"><input class="radio" <?=($umeta['receive_occasional'][0]==1)?'checked="checked"':'';?> type="checkbox" name="notifications[receive_occasional]" value="1" /> Receive occasional emails</label><br/>
</div>
</div>

</div></div>
</form>