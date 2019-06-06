<div class="adv_search">
	<span>Advanced Search &nbsp;<i class="fa fa-angle-down"></i></span>
	<div class="adv_search_popup">
		<div class="tri"></div>
		<div class="row">
			<div class="col-lg-6">
				<div class="row atype">
					<div class="col-lg-6"><a>Staff Picks</a></div>
					<div class="col-lg-6"><select><option>Live Projects</option></select></div>
				</div>
				<div class="row atype">
					<div class="col-lg-6"><a>Starred</a></div>
					<div class="col-lg-6"><select><option>Amount Pledged</option></select></div>
				</div>
				<div class="row atype">
					<div class="col-lg-6"><a>Backed by friends</a></div>
					<div class="col-lg-6"><select><option>Goal</option></select></div>
				</div>
				<div class="row atype">
					<div class="col-lg-6"><a>Projects I’ve backed</a></div>
					<div class="col-lg-6"><select><option>% Raised</option></select></div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row tags">
					<div class="col-lg-1"></div>
					<div class="col-lg-2"><strong>Tags:</strong></div>
					<div class="col-lg-9">
						<?php $args = array('type' => 'ignition_product','taxonomy' => 'post_tag','hide_empty' => true,'exclude' => '39,40');
							$tags = get_categories($args);
							foreach ($tags as $tag):?>
								<a class="tag"><?=$tag->name?></a>
							<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>