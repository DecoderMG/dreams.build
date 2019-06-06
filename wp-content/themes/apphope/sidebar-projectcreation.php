<?php global $poststatus;?>
<div class="whitebox parted">
	<a rel="basics" class="title active">Basics</a>
	<a rel="details" class="title">Details</a>
	<a rel="analytics" class="title">Analytics</a>
	<a rel="location" class="title">Location</a>
	<?php if (($poststatus && $poststatus=='publish')&&!isset($_GET['create_project'])):?>
		<a rel="updates" class="title">Updates</a>
	<?php endif;?>
	<a rel="images" class="title">Images</a>
	<a rel="team" class="title">Team</a>
	<a rel="social" class="title">Social</a>
	<a rel="levels" class="title">Incentives</a>
	<a rel="digital" class="title">Digital Files</a>
	<a rel="payment_account" class="title">Payment Account</a>
</div>