<div class="col-lg-2 sidebar-menu">
	<?php global $section;?>
	<?php if($section =='campaign'):?>
		<div class="whitebox parted sidebar-campaign active">
			<a class="scroll title" style="display:block;" href="#about">About</a>
			<a class="scroll title" href="#challenges">Challenges</a>
			<a class="scroll title" href="#faq">FAQ</a>
			<a class="scroll title" href="#follow">Follow</a>
			<a class="scroll title" href="#share">Share</a>
			<a class="scroll title" href="#needs">Needs</a>
			<a class="scroll title" href="#top"><i class="fa fa-arrow-circle-o-up"></i> Back To Top</a>
		</div>
	<?php elseif($section =='updates'):?>
		<div class="whitebox parted sidebar-updates active">
			<a class="scroll title active" href="#updates">Updates</a>
			<a class="scroll title" href="#top"><i class="fa fa-arrow-circle-o-up"></i> Back To Top</a>
		</div>
	<?php elseif($section =='comments'):?>
		<div class="whitebox parted sidebar-comments active">
			<a class="scroll title active" href="#comments">Comments</a>
			<a class="scroll title" href="#top"><i class="fa fa-arrow-circle-o-up"></i> Back To Top</a>
		</div>
	<?php elseif($section =='sponsors'):?>
		<div class="whitebox parted sidebar-funders active">
			<a class="scroll title active" href="#sponsors">Sponsors</a>
			<a class="scroll title" href="#top"><i class="fa fa-arrow-circle-o-up"></i> Back To Top</a>
		</div>
	<?php elseif($section =='gallery'):?>
		<div class="whitebox parted sidebar-gallery active">
			<a class="scroll title active" href="#gallery">Gallery</a>
			<a class="scroll title" href="#top"><i class="fa fa-arrow-circle-o-up"></i> Back To Top</a>
		</div>
	<?php endif;?>
</div>