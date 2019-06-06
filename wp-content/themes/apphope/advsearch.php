<?php global $wpdb;global $current_user;//$umeta = get_user_meta( $current_user->ID);
	/*$sql = "
	SELECT wp_users.id, contacts.identifier, meta.first_name, meta.last_name FROM wp_wsluserscontacts contacts LEFT JOIN wp_wslusersprofiles profiles ON contacts.identifier = profiles.identifier LEFT JOIN wp_users ON contacts.email = wp_users.user_email LEFT JOIN wp_usermeta meta ON meta.user_id = wp_users.id   
	WHERE contacts.user_id = '".$current_user->ID."' AND wp_users.id > 0";*/
	$sql = "SELECT wp_sHAbFYcUYmLV_users.id, contacts.identifier FROM wp_sHAbFYcUYmLV_users LEFT JOIN wp_sHAbFYcUYmLV_wsluserscontacts contacts ON contacts.email = wp_sHAbFYcUYmLV_users.user_email LEFT JOIN wp_sHAbFYcUYmLV_wslusersprofiles profiles ON contacts.identifier = profiles.identifier
	WHERE contacts.user_id = '".$current_user->ID."' GROUP BY wp_sHAbFYcUYmLV_users.id";
	$friends = $wpdb->get_results( $sql );
	$friends_num = $wpdb->num_rows;
?>
<div class="adv_search">
	<span>Advanced Search &nbsp;<i class="fa fa-angle-down"></i></span>
	<div class="adv_search_popup">
		<div class="tri"></div>
		<div class="row">
			<div class="col-lg-6">
				<div class="row atype">
					<div class="col-lg-6"><a>Stage <?=get_query_var('stage'); ?></a></div>
					<div class="col-lg-6"><select name="stage"><option value="0" <?=get_query_var('stage')==0?'selected="selected"':''?>>Any</option><option value="1" <?=get_query_var('stage')==1?'selected="selected"':''?>>Stage 1</option><option value="2" <?=get_query_var('stage')==2?'selected="selected"':''?>>Stage 2</option></select></div>
				</div>
				<div class="row atype">
					<div class="col-lg-6"><a>Goal amount</a></div>
					<div class="col-lg-6"><select name="goal"><option value="0" <?=get_query_var('goal')==0?'selected="selected"':''?>>Any</option>
						<option value="below5" <?=get_query_var('goal')=='below5'?'selected="selected"':''?>>Below 5K</option>
						<option value="above5" <?=get_query_var('goal')=='above5'?'selected="selected"':''?>>Above 5K</option>
						<option value="below25" <?=get_query_var('goal')=='below25'?'selected="selected"':''?>>Below 25K</option>
						<option value="above25" <?=get_query_var('goal')=='above25'?'selected="selected"':''?>>Above 25K</option>
						<option value="below50" <?=get_query_var('goal')=='below50'?'selected="selected"':''?>>Below 50K</option>
						<option value="above50" <?=get_query_var('goal')=='above50'?'selected="selected"':''?>>Above 50K</option>
						<option value="below100" <?=get_query_var('goal')=='below100'?'selected="selected"':''?>>Below 100K</option>
						<option value="above100" <?=get_query_var('goal')=='above100'?'selected="selected"':''?>>Above 100K</option>
					</select></div>
				</div>
				<div class="row atype">
					<div class="col-lg-6"><a>% funded</a></div>
					<div class="col-lg-6"><select name="funded"><option value="0" <?=get_query_var('funded')==0?'selected="selected"':''?>>Any</option><option value="below50" <?=get_query_var('funded')=='below50'?'selected="selected"':''?>>below 50%</option><option value="above50" <?=get_query_var('funded')=='above50'?'selected="selected"':''?>>above 50%</option><option value="above75" <?=get_query_var('funded')=='above75'?'selected="selected"':''?>>above 75%</option></select></div>
				</div>
				<?php if (is_user_logged_in()): ?>
					<?php /*<div class="row atype">
						<div class="col-lg-6"><a>Backed by me</a></div>
						<div class="col-lg-6"><input type="checkbox" class="checkbox" name="myb" value="1" <?=get_query_var('myb')=='1'?'checked="checked"':''?>  /></div>
					</div>*/?>
						<div class="row atype">
							<div class="col-lg-6"><a>Created by me/friends</a></div>
							<div class="col-lg-6">
								<select name="aut">
									<option value="0" <?=empty(get_query_var('aut'))?'selected="selected"':''?>>Any</option>
									<option value="<?=$current_user->id?>" <?=get_query_var('aut')==$current_user->id?'selected="selected"':''?>>Me</option>
								<?php foreach ( $friends as $friend ):?>
									<?php if($friend->id!=$current_user->ID):?>
										<?php $fname = get_user_meta( $friend->id, 'first_name', $single = true );$lname = get_user_meta( $friend->id, 'last_name', $single = true ); ?>
										<option value="<?=$friend->id?>" <?=get_query_var('aut')==$friend->id?'selected="selected"':''?>><?=$fname.' '.$lname;?></option>
									<?php endif;?>
								<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="row atype">
							<div class="col-lg-6"><a>Backed by me/friends</a></div>
							<div class="col-lg-6">
								<select name="backed">
									<option value="0" <?=empty(get_query_var('backed'))?'selected="selected"':''?>>Any</option>
									<option value="<?=$current_user->id?>" <?=get_query_var('backed')==$current_user->id?'selected="selected"':''?>>Me</option>
								<?php foreach ( $friends as $friend ):?>
									<?php if($friend->id!=$current_user->ID):?>
										<?php $fmeta = get_user_meta( $friend->id); ?>
										<option value="<?=$friend->id?>" <?=get_query_var('author')==$friend->id?'selected="selected"':''?>><?=$fmeta['first_name'][0].' '.$fmeta['last_name'][0];?></option>
									<?php endif;?>
								<?php endforeach;?>
								</select>
							</div>
						</div>
				<?php endif;?>
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
								<!--<a class="tag <?php if(is_array(get_query_var('tags'))) if( in_array($tag->cat_ID, get_query_var('tags'))) echo 'active';?>" rel="<?=$tag->cat_ID?>"><?=$tag->name?></a> -->
								<!--<input type="checkbox" class="check_tags" name="tags[]" <?php if(is_array(get_query_var('tags'))) if( in_array($tag->cat_ID, get_query_var('tags'))) echo 'checked="checked"';?> value="<?=$tag->cat_ID?>"> -->
							<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 adv_submit_row"><input class="button blue" name="adv_submit" type="submit" value="Search" /></div>
		</div>
	</div>
</div>