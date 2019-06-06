<?php
/*
Things we will need
user info (before or after reg?)
*/

/*
Meta Keys:

FAQ
Update
T&C

*/
class ID_FES {

	var $form;
	var $vars;

	function __construct($form = null, $vars = null) {
		if (empty($form)) {
			$this->form = array();
			$this->form[] = array(
				'before' => '<div class="fes_section basics active"><div class="creation_block bordered"><h3>Basics</h3><p>Hey! Thank you for choosing Dreams.Build as your platform of choice. You’re well on your way to funding success. However;  let’s hammer out the specifics before you get started.. No worries, you’ll be able to submit your project for review after filling out your project details using this form.<br></p><p>The requirements to having a project on our platform are:<br></p><ul><li class="list-style-type: circle;">You must be a legal adult in the region of your dream.</li><li>You are a permanent resident of your respective region.</li><li>You have a bank account in a region we <a href="https://dreams.build/faqs/view/17908/" target="_blank">cover</a>, business or personal address, and a government-issued ID, all issued by the country you’re starting a project under.</li><li>You must have a major credit or debit card. If you run your project as an individual, the linked bank account must belong to the person who verified their identity for your project.</li></ul><br><p>Before you can save a project draft you must fill in:<br></p><ul><li>Project Title</li><li>Project brief</li><li>Funding amounts for Stage 1 and stage 2</li><li>Funding timeline for both stages</li></ul><br><p>The project card preview will update once you save a draft. We encourage that you save a draft and share it with your friends for feedback before submitting your dream to us.</p></div><div class="creation_block"><h4>Project Title</h4>',
				//'label' => __('Project Title', 'ignitiondeck'),
				'value' => (isset($vars['project_name']) ? $vars['project_name'] : ''),
				'name' => 'project_name',
				'id' => 'project_name',
				'type' => 'text',
				//'misc' =>'title="Tip coming soon"',
				'errors' => (isset($vars['errors']['project_name']) ? $vars['errors']['project_name'] : ''),
				'class' => 'required',
				'wclass' => 'form-row'
				);
			$this->form[] = array(
					'before'=>'<h4>Dream Tweet</h4><p class="gray_info">brief description, elevator pitch</p>',
					/*'label' => __('Project Short Description', 'ignitiondeck'),*/
					'value' => (isset($vars['project_short_description']) ? $vars['project_short_description'] : ''),
					'name' => 'project_short_description',
					'id' => 'project_short_description',
					'misc' => 'rows="4" title="Keep it simple and Sweet. Follow KISS principles - Keep It Stupid Simple."',
					'type' => 'textarea',
					'errors' => (isset($vars['errors']['project_short_description']) ? $vars['errors']['project_short_description'] : ''),
					'class' => 'required',
					'wclass' => 'form-row',
					'after' => '<p class="textarea_feedback"></p>'
					);
//				echo '<pre>';
//                print_r($vars);
//                echo '</pre>';
			$this->form[] = array(
				'before'=>'<h4>Project Category</h4>',
				/*'label' => __('Project Category', 'ignitiondeck'),*/
				'value' => (isset($vars['project_category']) ? $vars['project_category'] : ''),
				'name' => 'project_category',
				'id' => 'project_category',
				'class'=>'required',
				'taxonomy' => 'category',
				// 'taxonomy' => 'project_category',
				'taxonomy_type' => 'ignition_product',
				'type' => 'select',
				'misc' => 'title="Specify product type"',
				'errors' => (isset($vars['errors']['project_category']) ? $vars['errors']['project_category'] : ''),
				'wclass' => 'form-row pretty_dropdown'
				);

				$args = array(
					'type' => 'ignition_product',
					'taxonomy' => 'post_tag',
					'hide_empty' => false,
					'exclude' => '39,40,19'
				);
				$tags = get_categories($args);
				$tag_form = array(
					'before'=>'<h4>Project Tags</h4>',
					'value' => (isset($vars['project_tags']) ? $vars['project_tags'] : ''),
					'name' => 'project_tags',
					'id' => 'project_tags',
					'type' => 'select_multiple',
					//'misc' => 'title="Tip coming soon"',
					'errors' => (isset($vars['errors']['project_tags']) ? $vars['errors']['project_tags'] : ''),
					'wclass' => 'form-row'
				);
				$tag_options = array();
				$tag_options[] = array('value' => '', 'title' => '');
				foreach ($tags as $tag) {
					$tag_options[] = array('value' => $tag->cat_ID, 'title' => $tag->name);
				}
				$tag_form['options'] = $tag_options;
				$this->form[] = $tag_form;
				
			if (empty($vars['status']) || strtoupper($vars['status']) !== 'PUBLISH') {	
				$this->form[] = array(
						'before' => '<h4>Funding Goal</h4><p class="gray_info">Currency will be set based off connected Stripe account\'s default currency. Currency defaults to USD until Stripe account is linked and project is saved to a draft or submitted.<br><br><strong>Stage one</strong> funding is All-Or-Nothing funding, you must hit your funding goal in order to recieve your funds. <br><strong>Stage two</strong> is all supportive funding, meaning any funds raised in stage 2 you will keep even if you do not hit your funding goal. <br><br>Still confused? Read <a href="https://dreams.build/two-stage-funding-benefits-crowdfunding/">this short article</a> on Two-stage funding before proceeding.<br><br>YOU WILL ONLY PROGRESS TO STAGE TWO IS YOU\'RE SUCCESSFULLY FUNDED IN STAGE ONE.</p>',
						'label' => __('Stage 1', 'ignitiondeck'),
						'value' => (isset($vars['project_goal']) ? $vars['project_goal'] : ''),
						'name' => 'project_goal',
						'id' => 'project_goal',
						'type' => 'number',
						'misc' => 'title="If you have not connected Stripe, you will have to connect Stripe and save a draft for currency to be updated."',
						'errors' => (isset($vars['errors']['project_goal']) ? $vars['errors']['project_goal'] : ''),
						'class' => 'required',
						'wclass' => 'form-row floated',
						'misc' => 'step="any" min="0"'
						);
				$this->form[] = array(
						'label' => __('Stage 2', 'ignitiondeck'),
						'value' => (isset($vars['project_goal2']) ? $vars['project_goal2'] : ''),
						'name' => 'project_goal2',
						'id' => 'project_goal2',
						'type' => 'number',
						'misc' => 'title="Think long term and big scale. Remember, you do not have to hit this goal in order to retain funds raised in stage two."',
						'errors' => (isset($vars['errors']['project_goal2']) ? $vars['errors']['project_goal2'] : ''),
						'class' => '',
						'wclass' => 'form-row floated',
						'misc' => 'step="any" min="0"'
						);
				$this->form[] = array(
						'before' => '<h4>Funding Duration</h4><p class="gray_info">Project start is used to signal the start date of your project. All projects on the Dreams.Build platform are reviewed before going live and the start date helps us better correlate with your schedule. As we will not publish your project until the start date.</p>',
						'label' => __('Start Date', 'ignitiondeck'),
						'value' => (isset($vars['project_start']) ? $vars['project_start'] : ''),
						'name' => 'project_start',
						'id' => 'project_start',
						'type' => 'text',
						'misc' => 'title="Tip: It\'s best to give us 24 - 48 hours to review your project. You can always reach out to get a status update as well!"',
						'errors' => (isset($vars['errors']['project_start']) ? $vars['errors']['project_start'] : ''),
						'class' => 'required date',
						'wclass' => 'form-row floated'
						);
				$this->form[] = array(
						'label' => __('End Date', 'ignitiondeck'),
						'value' => (isset($vars['project_end']) ? $vars['project_end'] : ''),
						'name' => 'project_end',
						'id' => 'project_end',
						'type' => 'text',
						'misc' => 'title="Tip: Funding in crowdfunding is like a bell curve. The most active times are at launch and near the end. Capitalize on this with your funding period."',
						'errors' => (isset($vars['errors']['project_end']) ? $vars['errors']['project_end'] : ''),
						'class' => 'required date',
						'wclass' => 'form-row floated'
						);
				$this->form[] = array(
						'label' => __('End Date (Stage 2)', 'ignitiondeck'),
						'value' => (isset($vars['project_end2']) ? $vars['project_end2'] : ''),
						'name' => 'project_end2',
						'id' => 'project_end2',
						'type' => 'text',
						'misc' => 'title="Tip: Don\'t be afraid to set a long term Stage two funding duration. It\s meant to be long term and keep you in the spot light. Use it to show progress since stage one."',
						'errors' => (isset($vars['errors']['project_end2']) ? $vars['errors']['project_end2'] : ''),
						'class' => 'date',
						'wclass' => 'form-row floated'
						);
				/*$this->form[] = array(
					'before' => '<div class="fes_section"><div class="form-row half"><h3>'.apply_filters('fes_campaign_end_options_label', __('Campaign End Options', 'ignitiondeck')).'</h3>'
					);*/
				//$this->form[] = apply_filters('fes_project_end_type_before', $vars);
				/*$this->form[] = array(
						'label' => __('Close on End', 'ignitiondeck'),
						'name' => 'project_end_type',
						'id'	=> 'closed',
						'type' => 'radio',
						'value' => 'closed',
						'wclass' => 'half radio',
						'misc' => ((isset($vars['project_end_type']) && $vars['project_end_type'] == 'closed') || !isset($vars['project_end_type']) ? 'checked="checked"' : '')
						);
				$this->form[] = array(
						'label' => __('Leave Open', 'ignitiondeck'),
						'name' => 'project_end_type',
						'id' => 'open',
						'type' => 'radio',
						'value' => 'open',
						'wclass' => 'half radio',
						'misc' => (isset($vars['project_end_type']) && $vars['project_end_type'] == 'open' ? 'checked="checked"' : ''),
						);*/
				//$this->form[] = apply_filters('fes_project_end_type_after', $vars);
				/*$this->form[] = array(
						'before' => '</div></div>'
					);*/
			}
			else if(strtoupper($vars['status']) == 'PUBLISH' && $vars['stage'] < 2){
				
				$this->form[] = array(
						'before' => '<h4>Stage 2 funding goal and duration</h4>',
						'label' => __('Stage 2', 'ignitiondeck'),
						'value' => (isset($vars['project_goal2']) ? $vars['project_goal2'] : ''),
						'name' => 'project_goal2',
						'id' => 'project_goal2',
						'type' => 'number',
						'misc' => 'title="Think long term and big scale. Remember, you do not have to hit this goal in order to retain funds raised in stage two."',
						'errors' => (isset($vars['errors']['project_goal2']) ? $vars['errors']['project_goal2'] : ''),
						'class' => '',
						'wclass' => 'form-row floated',
						'misc' => 'step="any" min="0"'
						);
				$this->form[] = array(
						'label' => __('End Date (Stage 2)', 'ignitiondeck'),
						'value' => (isset($vars['project_end2']) ? $vars['project_end2'] : ''),
						'name' => 'project_end2',
						'id' => 'project_end2',
						'type' => 'text',
						'misc' => 'title="Tip: Don\'t be afraid to set a long term Stage two funding duration. It\s meant to be long term and keep you in the spot light. Use it to show progress since stage one."',
						'errors' => (isset($vars['errors']['project_end2']) ? $vars['errors']['project_end2'] : ''),
						'class' => 'date',
						'wclass' => 'form-row floated'
						);
				$this->form[] = array(
						'before' => '<h4>Stage 1 funding goals and end date</h4><p>Stage 1: '.$vars['project_goal'].'</p>'.
						'<p>Start Date: '.$vars['project_start'].'</p>'.
						'<p>Stage 1 End Date: '.$vars['project_end'].'</p>'
						);
				
			} else {
				$this->form[] = array(
						'before' => '<h4>Funding Goal</h4><p>Stage 1: '.$vars['project_goal'].'</p>'.
						'<p>Stage 2: '.$vars['project_goal2'].'</p>'.
						'<p>Start Date: '.$vars['project_start'].'</p>'.
						'<p>Stage 1 End Date: '.$vars['project_end'].'</p>'.
						'<p>Stage 2 End Date: '.$vars['project_end2'].'</p>'
						);
			}
			$this->form[] = array(
					'before' => '</div></div><div class="fes_section details"><div class="creation_block bordered"><h3>'.apply_filters('fes_project_details_label', __('Project Details', 'ignitiondeck')).'</h3><p>Within this tab you will be setting all of your projects finer details. Within your description make sure you cover what you stated in your projects’ video. This helps users who did not watch your video better understand your idea. The project YouTube URL should be the full http://youtube.com/url address.<br><br>You can format the project FAQs anyway you please, but we recommend bolding the questions and starting all answers with “A.” <br><br>While the project challenges section is not required, we advise you fill it in. It is a location to express to backers the hurdles you will overcome and help them understand any delays that may occur. <br><br>The project needs section is not required but is a good place to mention where your raised funds will be allocated post funding. Make sure to include needs/expenses for both stages.</p></div><div class="creation_block">',
					'label' => __('Project Long Description', 'ignitiondeck'),
					'value' => (isset($vars['project_long_description']) ? $vars['project_long_description'] : ''),
					'name' => 'project_long_description',
					'id' => 'project_long_description',
					'type' => 'wpeditor',
					'mediabuttons' => true,
					//'misc' => 'title="Tip coming soon"',
					'errors' => (isset($vars['errors']['project_long_description']) ? $vars['errors']['project_long_description'] : ''),
					'wclass' => 'form-row wpeditor',
					'class' => 'required'
					);
			$this->form[] = array(
				'label' => __('Project Video (Link to Youtube video)', 'ignitiondeck'),
				'value' => (isset($vars['project_video']) ? $vars['project_video'] : ''),
				'name' => 'project_video',
				'id' => 'project_video',
				'type' => 'text',
				//'misc' => 'title="Tip coming soon"',
				'errors' => (isset($vars['errors']['project_video']) ? $vars['errors']['project_video'] : ''),
				'wclass' => 'form-row'
			);
			$this->form[] = array(
					'label' => __('Project FAQ', 'ignitiondeck'),
					'value' => (isset($vars['project_faq']) ? $vars['project_faq'] : ''),
					'name' => 'project_faq',
					'id' => 'project_faq',
					'type' => 'wpeditor',
					//'misc' => 'title="Tip coming soon"',
					'errors' => (isset($vars['errors']['project_faq']) ? $vars['errors']['project_faq'] : ''),
					'wclass' => 'form-row wpeditor'
					);
			$this->form[] = array(
					'label' => __('Project Challenges', 'ignitiondeck'),
					'value' => (isset($vars['project_challenges']) ? $vars['project_challenges'] : ''),
					'name' => 'project_challenges',
					'id' => 'project_challenges',
					'type' => 'wpeditor',
					//'misc' => 'title="Tip coming soon"',
					'errors' => (isset($vars['errors']['project_challenges']) ? $vars['errors']['project_challenges'] : ''),
					'wclass' => 'form-row wpeditor'
					);
			/*$this->form[] = array(
					'label' => __('Digital Files', 'ignitiondeck'),
					'value' => (isset($vars['project_collective_benefits']) ? $vars['project_collective_benefits'] : ''),
					'name' => 'project_collective_benefits',
					'id' => 'project_collective_benefits',
					'type' => 'wpeditor',
					'misc' => 'title="Tip coming soon"',
					'errors' => (isset($vars['errors']['project_collective_benefits']) ? $vars['errors']['project_collective_benefits'] : ''),
					'wclass' => 'form-row wpeditor'
					);
			$this->form[] = array(
					'label' => __('Incentives', 'ignitiondeck'),
					'value' => (isset($vars['project_individual_rewards']) ? $vars['project_individual_rewards'] : ''),
					'name' => 'project_individual_rewards',
					'id' => 'project_individual_rewards',
					'type' => 'wpeditor',
					'misc' => 'title="Tip coming soon"',
					'errors' => (isset($vars['errors']['project_individual_rewards']) ? $vars['errors']['project_individual_rewards'] : ''),
					'wclass' => 'form-row wpeditor'
					);*/
			/*$this->form[] = array(
					'label' => __('Business Plan', 'ignitiondeck'),
					'value' => (isset($vars['project_business_plan']) ? $vars['project_business_plan'] : ''),
					'name' => 'project_business_plan',
					'id' => 'project_business_plan',
					'type' => 'wpeditor',
					'misc' => 'title="Tip coming soon"',
					'errors' => (isset($vars['errors']['project_business_plan']) ? $vars['errors']['project_business_plan'] : ''),
					'wclass' => 'form-row wpeditor'
					);*/
					$this->form[] = array(
					'label' => __('Project Needs', 'ignitiondeck'),
					'value' => (isset($vars['project_needs']) ? $vars['project_needs'] : ''),
					'name' => 'project_needs',
					'id' => 'project_needs',
					'type' => 'wpeditor',
					'misc' => 'title="Tip coming soon"',
					'errors' => (isset($vars['errors']['project_needs']) ? $vars['errors']['project_needs'] : ''),
					'wclass' => 'form-row wpeditor'
					);
					
			$this->form[] = array(
				'before' => '</div></div><div class="fes_section analytics"><div class="creation_block bordered"><h3>Analytics</h3><p></div><div class="creation_block"><h4>Google Analytics ID</h4>',
				'value' => (isset($vars['project_ga']) ? $vars['project_ga'] : ''),
				'name' => 'project_ga',
				'id' => 'project_ga',
				'type' => 'text',
				'misc' =>'title="UA-XXXXXXXX-X"',
				'errors' => (isset($vars['errors']['project_ga']) ? $vars['errors']['project_ga'] : ''),
				'class' => '',
				'wclass' => 'form-row'
				);
				$this->form[] = array(
				'before' => '<h4>Facebook Pixel ID</h4>',
				'value' => (isset($vars['project_fa']) ? $vars['project_fa'] : ''),
				'name' => 'project_fa',
				'id' => 'project_fa',
				'type' => 'text',
				'misc' =>'title="XXXXXXXXXXXXXXXX"',
				'errors' => (isset($vars['errors']['project_fa']) ? $vars['errors']['project_fa'] : ''),
				'class' => '',
				'wclass' => 'form-row'
				);
			$this->form[] = array(
					'before' => '</div></div><div class="fes_section location"><div class="creation_block bordered"><h3>Project Location</h3><p>This location will be displayed on the project page and will allow sponsors to find it via location search. Make sure it is as accurate/up-to-date as possible, we will be looking at this when reviewing your project.</p></div><div class="creation_block">'
					);
			$this->form[] = array(
					'before' => '<p class="form-row"><label for="search_new_places">Search Places</label><input type="text" placeholder="Search New Places" id="search_new_places" value="'.$vars['search_new_places'].'" autofocus></p><div id="map_container"><div id="map_canvas"></div></div>',
					'value' => (isset($vars['project_map_lat']) ? $vars['project_map_lat'] : '0'),'type' => 'hidden','wclass' => 'hide',
					'name' => 'project_map_lat','id' => 'project_map_lat'
				);
			$this->form[] = array(
					'value' => (isset($vars['project_map_lng']) ? $vars['project_map_lng'] : '0'),'type' => 'hidden','wclass' => 'hide',
					'name' => 'project_map_lng','id' => 'project_map_lng',
					'after' => '<p><a class="btn btn-blue" id="plot_marker">Select Place</a></p>'
				);
			$this->form[] = array(
					'label' => __('City / Town', 'ignitiondeck'),
					'value' => (isset($vars['project_city']) ? $vars['project_city'] : ''),
					'name' => 'project_city','id' => 'project_city',
					'type' => 'text',
					'wclass' => 'form-row half left'
				);
			$this->form[] = array(
					'label' => __('State / Province / Region / Municipality', 'ignitiondeck'),
					'value' => (isset($vars['project_state']) ? $vars['project_state'] : ''),
					'name' => 'project_state','id' => 'project_state',
					'type' => 'text',
					'wclass' => 'form-row half'
				);
			$this->form[] = array(
					'label' => __('Country', 'ignitiondeck'),
					'value' => (isset($vars['project_country']) ? $vars['project_country'] : ''),
					'name' => 'project_country','id' => 'project_country',
					'type' => 'text',
					'wclass' => 'form-row',
					'after' => '</div></div>'
				);
				
			if (isset($vars['status']) && strtoupper($vars['status']) == 'PUBLISH') {
				$this->form[] = array(
						'before' => '<div class="fes_section updates"><p>You can add multiple updates per dream. You can only add one update at a time however, so please keep this in mind as you plan you project updates.</p><div class="creation_block">'
						);
				$this->form[] = apply_filters('fes_updates_before', $vars);
				$this->form[] = apply_filters('fes_updates_form', array(
						'label' => __('Project Updates', 'ignitiondeck'),
						'value' => (isset($vars['project_updates']) ? $vars['project_updates'] : ''),
						'name' => 'project_updates',
						'id' => 'project_updates',
						'type' => 'wpeditor',
						'mediabuttons' => true,
						//'misc' => 'title="Tip coming soon"',
						//'errors' => (isset($vars['errors']['project_updates']) ? $vars['errors']['project_updates'] : ''),
						'wclass' => 'form-row wpeditor'
						));
				$this->form[] = apply_filters('fes_updates_after', $vars);
				$this->form[] = array(
						'after' => '</div></div>'
						);
			}
			$this->form[] = array(
					'before' => '<div class="fes_section images"><div class="creation_block bordered"><h3>'.apply_filters('fes_project_images_label', __('Project Images', 'ignitiondeck')).'</h3><p>You can assign up to one featured image and three additional gallery images. <br><br>The featured image will be displayed on your project card and if you do not link a video, it will replace your video.</p></div><div class="creation_block">',
					'label' => __('Featured Image', 'ignitiondeck'),
					'value' => (isset($vars['project_hero']) ? $vars['project_hero'] : ''),
					'misc' => (isset($vars['project_hero']) ? 'data-url="'.$vars['project_hero'].'" accept="image/*"' : 'accept="image/*"'),
					'name' => 'project_hero',
					'id' => 'project_hero',
					'type' => 'file',
					'errors' => (isset($vars['errors']['project_hero']) ? $vars['errors']['project_hero'] : ''),
					'wclass' => 'form-row half left'
					);
			$this->form[] = array(
					'value' => 'no',
					'name' => 'project_hero_removed',
					'id' => 'project_hero_removed',
					'type' => 'hidden',
					'wclass' => 'hide'
				);
			$this->form[] = array(
					'value' => (!empty($vars['project_hero']) ? 1:0),
					'name' => 'project_hero_exist','id' => 'project_hero_exist',
					'type' => 'hidden','wclass' => 'hide'
				);
            $this->form[] = array(
                'value' => (!empty($vars['project_image1']) ? 1:0),
                'name' => 'project_image1_exist','id' => 'project_image1_exist',
                'type' => 'hidden','wclass' => 'hide'
            );
			$this->form[] = array(
					'label' => __('Project Image 2', 'ignitiondeck'),
					'value' => (isset($vars['project_image2']) ? $vars['project_image2'] : ''),
					'misc' => (isset($vars['project_image2']) ? 'data-url="'.$vars['project_image2'].'" accept="image/*"' : 'accept="image/*"'),
					'name' => 'project_image2',
					'id' => 'project_image2',
					'type' => 'file',
					'errors' => (isset($vars['errors']['project_image2']) ? $vars['errors']['project_image2'] : ''),
					'wclass' => 'form-row half'
					);
			$this->form[] = array(
					'value' => 'no',
					'name' => 'project_image2_removed',
					'id' => 'project_image2_removed',
					'type' => 'hidden',
					'wclass' => 'hide'
				);
			$this->form[] = array(
					'value' => (!empty($vars['project_image2']) ? 1:0),
					'name' => 'project_image2_exist','id' => 'project_image2_exist',
					'type' => 'hidden','wclass' => 'hide'
				);
			$this->form[] = array(
					'label' => __('Project Image 3', 'ignitiondeck'),
					'value' => (isset($vars['project_image3']) ? $vars['project_image3'] : ''),
					'misc' => (isset($vars['project_image3']) ? 'data-url="'.$vars['project_image3'].'" accept="image/*"' : 'accept="image/*"'),
					'name' => 'project_image3',
					'id' => 'project_image3',
					'type' => 'file',
					'errors' => (isset($vars['errors']['project_image3']) ? $vars['errors']['project_image3'] : ''),
					'wclass' => 'form-row half left'
					);
			$this->form[] = array(
					'value' => 'no',
					'name' => 'project_image3_removed',
					'id' => 'project_image3_removed',
					'type' => 'hidden',
					'wclass' => 'hide'
				);
			$this->form[] = array(
					'value' => (!empty($vars['project_image3']) ? 1:0),
					'name' => 'project_image3_exist','id' => 'project_image3_exist',
					'type' => 'hidden','wclass' => 'hide'
				);
			$this->form[] = array(
					'label' => __('Project Image 4', 'ignitiondeck'),
					'value' => (isset($vars['project_image4']) ? $vars['project_image4'] : ''),
					'misc' => (isset($vars['project_image4']) ? 'data-url="'.$vars['project_image4'].'" accept="image/*"' : 'accept="image/*"'),
					'name' => 'project_image4',
					'id' => 'project_image4',
					'type' => 'file',
					'errors' => (isset($vars['errors']['project_image4']) ? $vars['errors']['project_image4'] : ''),
					'wclass' => 'form-row half'
					);
			$this->form[] = array(
					'value' => 'no',
					'name' => 'project_image4_removed',
					'id' => 'project_image4_removed',
					'type' => 'hidden',
					'wclass' => 'hide'
				);
			$this->form[] = array(
					'value' => (!empty($vars['project_image4']) ? 1:0),
					'name' => 'project_image4_exist','id' => 'project_image4_exist',
					'type' => 'hidden','wclass' => 'hide'
				);
			
			$this->form[] = array(
				'before' => '</div></div><div class="fes_section team"><div class="creation_block bordered"><h3>'.apply_filters('fes_team_information_label', __('Team Information', 'ignitiondeck')).'</h3><p>We use the team section for support and verification on our end. Please provide the most up to date information you can. If you are an individual and not part of a wider company, please input your individual information. </p></div><div class="creation_block">',
				'label' => __('Company Name', 'ignitiondeck'),
				'value' => (isset($vars['company_name']) ? $vars['company_name'] : ''),
				'name' => 'company_name',
				'id' => 'company_name',
				'type' => 'text',
				'misc' => 'title="Full legal name of company. EX: Application Hope LLC."',
				'errors' => (isset($vars['errors']['company_name']) ? $vars['errors']['company_name'] : ''),
				//'class' => 'required',
				'wclass' => 'form-row half left'
			);
			$this->form[] = array(
				'label' => __('Company Logo', 'ignitiondeck'),
				'value' => (isset($vars['company_logo']) ? $vars['company_logo'] : ''),
				'misc' => (isset($vars['company_logo']) ? 'data-url="'.$vars['company_logo'].'" accept="image/*"' : 'accept="image/*"'),
				'name' => 'company_logo',
				'id' => 'company_logo',
				'type' => 'file',
				'errors' => (isset($vars['errors']['company_logo']) ? $vars['errors']['company_logo'] : ''),
				'wclass' => 'form-row half',
				);
			$this->form[] = array(
					'value' => 'no',
					'name' => 'company_logo_removed',
					'id' => 'company_logo_removed',
					'type' => 'hidden',
					'wclass' => 'hide'
				);
			$this->form[] = array(
					'value' => (!empty($vars['company_logo']) ? 1:0),
					'name' => 'company_logo_exist','id' => 'company_logo_exist',
					'type' => 'hidden','wclass' => 'hide'
				);
			$this->form[] = array(
				'label' => __('Company Location', 'ignitiondeck'),
				'value' => (isset($vars['company_location']) ? $vars['company_location'] : ''),
				'name' => 'company_location',
				'id' => 'company_location',
				'type' => 'text',
				'misc' => 'title="Full address."',
				'errors' => (isset($vars['errors']['company_location']) ? $vars['errors']['company_location'] : ''),
				//'class' => 'required',
				'wclass' => 'form-row half left'
			);
			$this->form[] = array(
				'label' => __('Company URL', 'ignitiondeck'),
				'value' => (isset($vars['company_url']) ? $vars['company_url'] : ''),
				'name' => 'company_url',
				'id' => 'company_url',
				'type' => 'text',
				'misc' => 'title="Complete URL to company website. EX: www.dreams.build"',
				'errors' => (isset($vars['errors']['company_url']) ? $vars['errors']['company_url'] : ''),
				//'class' => 'required',
				'wclass' => 'form-row half'
			);
			$this->form[] = array(
				'label' => __('Company Facebook', 'ignitiondeck'),
				'value' => (isset($vars['company_fb']) ? $vars['company_fb'] : ''),
				'name' => 'company_fb',
				'id' => 'company_fb',
				'type' => 'text',
				//'misc' => 'title="Tip coming soon"',
				'class' => '',
				'errors' => (isset($vars['errors']['company_fb']) ? $vars['errors']['company_fb'] : ''),
				'wclass' => 'form-row half left'
			);
			$this->form[] = array(
				'label' => __('Company Twitter', 'ignitiondeck'),
				'value' => (isset($vars['company_twitter']) ? $vars['company_twitter'] : ''),
				'name' => 'company_twitter',
				'id' => 'company_twitter',
				'type' => 'text',
				//'misc' => 'title="Tip coming soon"',
				'errors' => (isset($vars['errors']['company_twitter']) ? $vars['errors']['company_twitter'] : ''),
				'class' => '',
				'wclass' => 'form-row half'
			);
			$this->form[] = array(
					'before' => '</div></div><div class="fes_section social"><div class="creation_block bordered"><h3>Social Links</h3><p>Creating and linking social media profiles to your project is a good idea. It provides you with better outreach and links to your different social media accounts and will be displayed on the project page. We recommend linking accounts to all of the major social media platforms. <br><br>If you have a website dedicated to your project provide the link and we will add it to the project page. The more inbound links you have to your project page and project website will help your ranking and visibility on search engines.</p></div><div class="creation_block">',
					'label' => __('Twitter', 'ignitiondeck'),
					'value' => (isset($vars['project_follow_twitter']) ? $vars['project_follow_twitter'] : ''),
					'name' => 'project_follow_twitter',
					'id' => 'project_follow_twitter',
					'type' => 'text',/*'class' => 'required',*/
					//'misc' => 'title="Tip coming soon"',
					'errors' => (isset($vars['errors']['project_follow_twitter']) ? $vars['errors']['project_follow_twitter'] : ''),
					'wclass' => 'form-row half left'
				);
			$this->form[] = array(
					'label' => __('Facebook', 'ignitiondeck'),
					'value' => (isset($vars['project_follow_facebook']) ? $vars['project_follow_facebook'] : ''),
					'name' => 'project_follow_facebook',
					'id' => 'project_follow_facebook',
					'type' => 'text',/*'class' => 'required',*/
					//'misc' => 'title="Tip coming soon"',
					'errors' => (isset($vars['errors']['project_follow_facebook']) ? $vars['errors']['project_follow_facebook'] : ''),
					'wclass' => 'form-row half'
				);
			$this->form[] = array(
					'label' => __('Google+', 'ignitiondeck'),
					'value' => (isset($vars['project_follow_google']) ? $vars['project_follow_google'] : ''),
					'name' => 'project_follow_google',
					'id' => 'project_follow_google',
					'type' => 'text',/*'class' => 'required',*/
					//'misc' => 'title="Tip coming soon"',
					'errors' => (isset($vars['errors']['project_follow_google']) ? $vars['errors']['project_follow_google'] : ''),
					'wclass' => 'form-row half left'
				);
			$this->form[] = array(
					'label' => __('LinkedIn', 'ignitiondeck'),
					'value' => (isset($vars['project_follow_in']) ? $vars['project_follow_in'] : ''),
					'name' => 'project_follow_in',
					'id' => 'project_follow_in',
					'type' => 'text',/*'class' => 'required',*/
					//'misc' => 'title="Tip coming soon"',
					'errors' => (isset($vars['errors']['project_follow_in']) ? $vars['errors']['project_follow_in'] : ''),
					'wclass' => 'form-row half'
				);
			$this->form[] = array(
					'label' => __('Website', 'ignitiondeck'),
					'value' => (isset($vars['project_follow_website']) ? $vars['project_follow_website'] : ''),
					'name' => 'project_follow_website',
					'id' => 'project_follow_website',
					'type' => 'text',/*'class' => 'required',*/
					//'misc' => 'title="Tip coming soon"',
					'errors' => (isset($vars['errors']['project_follow_website']) ? $vars['errors']['project_follow_website'] : ''),
					'wclass' => 'form-row half left'
				);
			$this->form[] = array(
					'label' => __('Instagram', 'ignitiondeck'),
					'value' => (isset($vars['project_follow_instagram']) ? $vars['project_follow_instagram'] : ''),
					'name' => 'project_follow_instagram',
					'id' => 'project_follow_instagram',
					'type' => 'text',/*'class' => 'required',*/
					//'misc' => 'title="Tip coming soon"',
					'errors' => (isset($vars['errors']['project_follow_instagram']) ? $vars['errors']['project_follow_instagram'] : ''),
					'wclass' => 'form-row half'
				);
			/*$this->form[] = array(
					'before' => '<div class="fes_section">',
					'label' => __('Disable Levels', 'ignitiondeck'),
					'value' => '1',
					'name' => 'disable_levels',
					'id' => 'disable_levels',
					'type' => 'checkbox',
					'wclass' => 'form-row inline',
					'misc' => (isset($vars['disable_levels']) && $vars['disable_levels'] == '1' ? 'checked="checked"' : ''),
					'after' => '</div>'
					);*/
			$this->form[] = array(
					'before' => '</div></div><div class="fes_section levels">'
					);
			$this->form[] = array(
					'before' => '<div class="creation_block bordered"><h3>'.apply_filters('fes_project_reward_levels_label', __('Project Incentives', 'ignitiondeck')).'</h3><p>Incentives are optional but we recommend offering between 5 - 15 incentives. Make sure to layer them across multiple price points. You will be able to set the quantity amount so you can control your production. You may see an extra incentive appear at the bottom of your incentives list when you save a draft. The system places it here to allow sponsors who want to donate to your project without selecting an incentive. Make sure all Incentives conform to our <a href="https://dreams.build/faqs/view/17910/" target="_blank">rules</a>.<br></p></div><div class="creation_block">',
					'label' => __('Number of Levels', 'ignitiondeck'),
					'value' => (isset($vars['project_levels']) ? $vars['project_levels'] : '1'),
					'name' => 'project_levels',
					'id' => 'project_levels',
					//'type' => 'number',
					'type' => 'hidden',
					'wclass' => 'form-row half hide',
					'class' => 'required',
					'misc' => (isset($vars['project_levels']) && isset($vars['status']) && strtoupper($vars['status']) == 'PUBLISH' ? 'min="'.$vars['project_levels'].'"' : 'min="1"')
					);
				if (empty($vars['project_levels']) || $vars['project_levels'] == 1) {
					if (!isset($vars['status']) || strtoupper($vars['status']) !== 'PUBLISH') {
						$this->form[] = array(
						'before' => '<div class="form-level">',
						'label' => __('Incentive Title', 'ignitiondeck'),
						'value' => (isset($vars['levels'][0]['title']) ? $vars['levels'][0]['title'] : 'No Incentive, just sponsoring'),
						'name' => 'project_level_title[]',
						'id' => 'project_level_1_title',
						'type' => 'text',
                            'readonly' => 'readonly',
						//'misc' => 'title="Tip coming soon"',
						'wclass' => 'form-row',
						//'class' => 'required'
						);
						$this->form[] =array(
							'label' => __('Incentive Price', 'ignitiondeck'),
							'value' => (isset($vars['levels'][0]['price']) ? $vars['levels'][0]['price'] : '0'),
							'name' => 'project_level_price[]',
							'id' => 'project_level_1_price',
							'type' => 'text',
                            'readonly' => 'readonly',
							'misc' => 'title="Tip coming soon"',
							'wclass' => 'form-row half left',
							'class' => '',
							'misc' => 'step="any" min="0"'
							);
						$this->form[] = array(
							'label' => __('Incentive Limit', 'ignitiondeck'),
							'value' => (isset($vars['levels'][0]['limit']) ? $vars['levels'][0]['limit'] : '0'),
							'name' => 'project_level_limit[]',
							'id' => 'project_level_1_limit',
							'type' => 'text',
                            'readonly' => 'readonly',
							//'misc' => 'title="Tip coming soon"',
							'wclass' => 'form-row half'
							);
						// Project fund type for single level project
						if (isset($vars['fund_types'])) {
							$fund_type_args = array(
								'label' => __('Incentive Fund Type', 'ignitiondeck'),
								'name' => 'project_fund_type[]',
								'id' => 'level_project_fund_type_1',
								'type' => 'select',
								//'misc' => 'title="Tip coming soon"',
								'wclass' => 'form-row pretty_dropdown',
								'value' => (isset($vars['levels'][0]['fund_type']) ? $vars['levels'][0]['fund_type'] : '')
							);
							$fund_type_args['options'] = array();
							// Pushing both the options, removing on checks then
							$option = array('value' => 'capture', 'title' => 'Immediately Deliver Funds');
							array_push($fund_type_args['options'], $option);
							$option = array('value' => 'preauth', 'title' => '100% Threshold');
							array_push($fund_type_args['options'], $option);

							if ($vars['fund_types'] == 'capture' || $vars['fund_types'] == 'c_sub') {
								// Remove 'preauth' (100% Threshold) option
								for ($i=0 ; $i < count($fund_type_args['options']) ; $i++) { 
									if ($fund_type_args['options'][$i]['value'] == 'preauth') {
										$removal_index = $i;
									}
								}
								if (isset($removal_index)) {
									unset($fund_type_args['options'][$removal_index]);
									unset($removal_index);
								}
							}
							if ($vars['fund_types'] == 'preauth') {
								// Remove the 'capture' (Immediately Deliver Funds) option
								for ($i=0 ; $i < count($fund_type_args['options']) ; $i++) { 
									if ($fund_type_args['options'][$i]['value'] == 'capture') {
										$removal_index = $i;
									}
								}
								if (isset($removal_index)) {
									unset($fund_type_args['options'][$removal_index]);
									unset($removal_index);
								}
							}
							$fund_type_args['options'] = apply_filters('ide_fund_options', $fund_type_args['options']);
							$this->form[] = $fund_type_args;
						}
					}
					else {
						$this->form[] = array(
								'before' => '<div class="form-level"><a class="remove_block" id="test id23" title="Remove Incentive"><i class="fa fa-times" aria-hidden="true"></i></a>',
								'label' => __('Incentive Title', 'ignitiondeck'),
								'value' => (isset($vars['levels'][0]['title']) ? $vars['levels'][0]['title'] : ''),
								'name' => 'project_level_title[]',
								'id' => 'project_level_1_title',
								'type' => 'hidden',
								'wclass' => 'form-row hidden',
								'class' => 'required'
								);
							$this->form[] = array(
								'label' => __('Incentive Price', 'ignitiondeck'),
								'value' => (isset($vars['levels'][0]['price']) ? $vars['levels'][0]['price'] : ''),
								'name' => 'project_level_price[]',
								'id' => 'project_level_1_price',
								'type' => 'hidden',
                                'readonly' => 'readonly',
								'wclass' => 'form-row half left hidden',
								'class' => ''
								);
							$this->form[] = array(
								'label' => __('Incentive Limit', 'ignitiondeck'),
								'value' => (isset($vars['levels'][0]['limit']) ? $vars['levels'][0]['limit'] : ''),
								'name' => 'project_level_limit[]',
								'id' => 'project_level_1_limit',
								'type' => 'hidden',
                                'readonly' => 'readonly',
								'wclass' => 'form-row half hidden'
								);
					}
					
					$this->form[] =array(
						'label' => __('Estimated Delivery Date', 'ignitiondeck'),
						'value' => (isset($vars['levels'][0]['short']) ? $vars['levels'][0]['short'] : 'Now'),
						'name' => 'level_description[]',
						'id' => 'project_level_1_description',
                        'readonly' => 'readonly',
						'type' => 'text',
						'wclass' => 'form-row'
						);
					$this->form[] =array(
						'label' => __('Incentive Description', 'ignitiondeck'),
						'value' => (isset($vars['levels'][0]['long']) ? $vars['levels'][0]['long'] : 'No Incentive, just sponsoring'),
						'name' => 'level_long_description[]',
						'id' => 'project_level_1_long_description',
						'type' => 'textarea',
                        'readonly' => 'readonly',
						'wclass' => 'form-row',
						'after' => '</div>'
						);
				}
				else if (isset($vars['project_levels']) && $vars['project_levels'] > 1) {
					for ($i = 0; $i <= $vars['project_levels'] - 1; $i++) {
						if (!isset($vars['status']) || strtoupper($vars['status']) !== 'PUBLISH') {
							$this->form[] = array(
								'before' => '<div class="form-level"><a class="remove_block" id="id12" title="Remove Incentive"><i class="fa fa-times" aria-hidden="true"></i></a>',
								'label' => __('Incentive Title', 'ignitiondeck'),
								'value' => (isset($vars['levels'][$i]['title']) ? $vars['levels'][$i]['title'] : ''),
								'name' => 'project_level_title[]',
								'id' => 'project_level_'.($i + 1).'_title',
								'type' => 'text',
								'wclass' => 'form-row',
								'class' => 'required'
								);
							$this->form[] = array(
								'label' => __('Incentive Price', 'ignitiondeck'),
								'value' => (isset($vars['levels'][$i]['price']) ? $vars['levels'][$i]['price'] : ''),
								'name' => 'project_level_price[]',
								'id' => 'project_level_'.($i + 1).'_price',
								'type' => 'number',
								'wclass' => 'form-row half left',
								'class' => 'required',
								'misc' => 'step="any" min="0"'
								);
							$this->form[] = array(
								'label' => __('Incentive Limit', 'ignitiondeck'),
								'value' => (isset($vars['levels'][$i]['limit']) ? $vars['levels'][$i]['limit'] : ''),
								'name' => 'project_level_limit[]',
								'id' => 'project_level_'.($i + 1).'_limit',
								'type' => 'number',
								'wclass' => 'form-row half'
								);
							// Project fund type for multi level project, separate for each level
							/*if (isset($vars['fund_types'])) {
								$this->form[] = array(
									'label' => __('Incentive Fund Type', 'ignitiondeck'),
									'name' => 'project_fund_type[]',
									'id' => 'level_project_fund_type_'.($i + 1),
									'type' => 'select',
									'wclass' => 'form-row pretty_dropdown',
									'value' => (isset($vars['levels'][$i]['fund_type']) ? $vars['levels'][$i]['fund_type'] : 'capture'),
									'options' => apply_filters('ide_fund_options', array(
										array('value' => 'capture', 'title' => 'Immediately Deliver Funds', 'misc' => ($vars['fund_types'] == 'preauth' ? 'disabled="disabled"' : '')), 
										array('value' => 'preauth', 'title' => '100% Threshold', 'misc' => ($vars['fund_types'] == 'capture' || $vars['fund_types'] == 'c_sub' ? 'disabled="disabled"' : '')),))
									);
							}*/
						}
						else {
							$this->form[] = array(
								'before' => '<div class="form-level"><a class="remove_block" title="Remove Incentive"><i class="fa fa-times" aria-hidden="true"></i></a><p><strong>Incentive Title:</strong> '.$vars['levels'][$i]['title'].'</p>',
								'label' => __('Incentive Title', 'ignitiondeck'),
								'value' => (isset($vars['levels'][$i]['title']) ? $vars['levels'][$i]['title'] : ''),
								'name' => 'project_level_title[]',
								'id' => 'project_level_'.($i + 1).'_title',
								'type' => 'hidden',
								'wclass' => 'form-row hidden',
								'class' => 'required'
								);
							$this->form[] = array(
								'before' => '<p><strong>Incentive Price:</strong> '.$vars['levels'][$i]['price'].'</p>',
								'label' => __('Incentive Price', 'ignitiondeck'),
								'value' => (isset($vars['levels'][$i]['price']) ? $vars['levels'][$i]['price'] : ''),
								'name' => 'project_level_price[]',
								'id' => 'project_level_'.($i + 1).'_price',
								'type' => 'hidden',
								'wclass' => 'form-row half left hidden',
								'class' => ''
								);
							$this->form[] = array(
								'label' => __('Incentive Limit', 'ignitiondeck'),
								'value' => (isset($vars['levels'][$i]['limit']) ? $vars['levels'][$i]['limit'] : ''),
								'name' => 'project_level_limit[]',
								'id' => 'project_level_'.($i + 1).'_limit',
								'type' => 'hidden',
								'wclass' => 'form-row half hidden'
								);
						}
						$this->form[] = array(
							'label' => __('Estimated Delivery Date', 'ignitiondeck'),
							'value' => (isset($vars['levels'][$i]['short']) ? $vars['levels'][$i]['short'] : ''),
							'name' => 'level_description[]',
							'id' => 'project_level_'.($i + 1).'_description',
							'type' => 'text',
							'wclass' => 'form-row'
							);
						$this->form[] = array(
							'label' => __('Incentive Description', 'ignitiondeck'),
							'value' => (isset($vars['levels'][$i]['long']) ? $vars['levels'][$i]['long'] : ''),
							'name' => 'level_long_description[]',
							'id' => 'project_level_'.($i + 1).'_long_description',
							'type' => 'wpeditor',
							'wclass' => 'form-row wpeditor',
							'after' => '</div>'
							);
					}
				}
				$this->form[] = array(
					'before' => '<div class="form-level-clone  "><a class="remove_block" id="id23" title="Remove Incentive"><i class="fa fa-times" aria-hidden="true"></i></a>',
					'label' => __('Incentive Title', 'ignitiondeck'),
					'name' => 'project_level_title[]',
					'id' => 'project_level_1_title',
					'type' => 'text',
					'wclass' => 'form-row',
					'misc' => 'disabled="disabled"'
					);
				$this->form[] = array(
					'label' => __('Incentive Price', 'ignitiondeck'),
					'name' => 'project_level_price[]',
					'id' => 'project_level_1_price',
					'type' => 'number',
					'wclass' => 'form-row half left',
					'misc' => 'disabled="disabled" step="any" min="0"'
					);
				$this->form[] = array(
					'label' => __('Incentive Limit', 'ignitiondeck'),
					'name' => 'project_level_limit[]',
					'id' => 'project_level_1_limit',
					'type' => 'number',
					'wclass' => 'form-row half',
					'misc' => 'disabled="disabled"'
					);
				// Project fund type if is set
				if (isset($vars['fund_types'])) {
					$fund_type_args = array(
						'label' => __('Incentive Fund Type', 'ignitiondeck'),
						'name' => 'project_fund_type[]',
						'id' => 'level_project_fund_type_1',
						'type' => 'hidden',
						//'wclass' => 'form-row',
						// 'value' => (isset($vars['levels'][0]['fund_type']) ? $vars['levels'][0]['fund_type'] : '')
					);
					$fund_type_args['options'] = array();
					// Pushing both the options, removing on checks then
					$option = array('value' => 'capture', 'title' => 'Immediately Deliver Funds');
					array_push($fund_type_args['options'], $option);
					$option = array('value' => 'preauth', 'title' => '100% Threshold');
					array_push($fund_type_args['options'], $option);

					if ($vars['fund_types'] == 'capture' || $vars['fund_types'] == 'c_sub') {
						// Remove 'preauth' (100% Threshold) option
						for ($i=0 ; $i < count($fund_type_args['options']) ; $i++) { 
							if ($fund_type_args['options'][$i]['value'] == 'preauth') {
								$removal_index = $i;
							}
						}
						if (isset($removal_index)) {
							unset($fund_type_args['options'][$removal_index]);
							unset($removal_index);
						}
					}
					if ($vars['fund_types'] == 'preauth') {
						// Remove the 'capture' (Immediately Deliver Funds) option
						for ($i=0 ; $i < count($fund_type_args['options']) ; $i++) { 
							if ($fund_type_args['options'][$i]['value'] == 'capture') {
								$removal_index = $i;
							}
						}
						if (isset($removal_index)) {
							unset($fund_type_args['options'][$removal_index]);
							unset($removal_index);
						}
					}
					$fund_type_args['options'] = apply_filters('ide_fund_options', $fund_type_args['options']);
					$this->form[] = $fund_type_args;
				}
				$this->form[] = array(
					'label' => __('Estimated Delivery Date', 'ignitiondeck'),
					'name' => 'level_description[]',
					'id' => 'project_level_1_description',
					'type' => 'text',
					//'errors' => (isset($vars['errors']['company_name']) ? $vars['errors']['company_name'] : ''),
					'wclass' => 'form-row'
					);
				$this->form[] = array(
					'label' => __('Incentive Description', 'ignitiondeck'),
					'name' => 'level_long_description[]',
					'id' => 'project_level_1_long_description',
					'type' => 'wpeditor',
					//'errors' => (isset($vars['errors']['company_name']) ? $vars['errors']['company_name'] : ''),
					'wclass' => 'form-row wpeditor',
					'after' => '</div>'
					);
				$this->form[] = array(
					'after' => '</div><div style="text-align:center;"><a class="btn btn-navy large add-level">Add New Incentive</a></div></div>'
					);
					$this->form[] = array(
						'before' => '<div class="fes_section digital"><div class="creation_block bordered"><h3>Digital Files</h3><p>Digital Files are optional but serve as a good way to extend your projects reach outside of Incentives. These files are accessible to everyone even if they have not contributed to your project. By offering some digital files you can enable people who can not give financially, a way to provide flyers or allow them into an open beta. Keep in mind all digital files are limited to 100MBs in size. <br><br> If you have large digital files and it seems to be taking a long time to submit your project for review or as a draft, no worries, the system is currently uploading the files and will proceed once they have been successfully uploaded. Make sure all Digital Files conform to our <a href="https://dreams.build/faqs/view/17910/" target="_blank">rules</a>. </p><br><br><p>NOTE: If we find that your account is hosting illegal or malicious software, you will not receive a warning, your account will be permanently banned and deleted from our service.</p></div><div class="creation_block">'/*.print_r($vars['digitals'],true)*/,
						'label' => __('Number of Levels', 'ignitiondeck'),
						'value' => (!empty($vars['digital_levels']) ? $vars['digital_levels'] : 0),
						'name' => 'digital_levels',
						'id' => 'digital_levels',
						'type' => 'hidden',
						'wclass' => 'form-row half hide',
						//'class' => 'required',
						'misc' => 'min="0"',
						//'errors' => (!empty($vars['errors']['digital_file']) ? $vars['errors']['digital_file'] : ''),
					);
					for ($i = 0; $i < $vars['digital_levels']; $i++) {
						$this->form[] = array(
							'before' => '<div class="digital-level"><a class="remove_block" title="Remove Digital File"><i class="fa fa-times" aria-hidden="true"></i></a>',
							'label' => __('Name', 'ignitiondeck'),
							'value' => (isset($vars['digitals'][$i]['name']) ? $vars['digitals'][$i]['name'] : ''),
							'name' => 'digital_name[]',
							'id' => 'digital_'.($i).'_name',
							'type' => 'text',
							'wclass' => 'form-row',
							//'class' => 'required'
							);
						$this->form[] = array(
							'label' => __('Description', 'ignitiondeck'),
							'value' => (isset($vars['digitals'][$i]['description']) ? $vars['digitals'][$i]['description'] : ''),
							'name' => 'digital_description[]',
							'id' => 'digital_'.($i).'_description',
							'type' => 'text',
							'wclass' => 'form-row',
							//'class' => 'required'
							);
						$this->form[] = array(
							'before' => '<div style="padding-left: 30px; margin-bottom: 20px;">',
							'label' => __('Allow only Sponsors to download?', 'ignitiondeck'),
							'value' => 'digital_sponsor_lock_'.$i,
							'name' => 'digital_sponsor_lock[]',
							'id' => 'digital_'.($i).'_sponsor_lock',
							'type' => 'checkbox',
							'wclass' => 'checkbox abc-checkbox',
							'misc' => (isset($vars['digitals'][$i]['sponsor_lock']) ? $vars['digitals'][$i]['sponsor_lock'] : ''),
							'after' => '</div>'
							);
						$this->form[] = array(
							'label' => __('Upload File', 'ignitiondeck'),
							'value' => (isset($vars['digitals'][$i]['file']) ? $vars['digitals'][$i]['file'] : ''),
							'misc' => (isset($vars['digitals'][$i]['file']) ? 'data-url="'.$vars['digitals'][$i]['file'].'" ' : ''),
							'name' => 'digital_file_'.$i,
							'id' => 'digital_'.($i).'_file',
							'type' => 'file',
							'errors' => (isset($vars['errors']['digital_file_'.$i]) ? $vars['errors']['digital_file_'.$i] : ''),
							'class' =>'digitalfile',
							'wclass' => 'form-row',
							'after' => '<input type="hidden" class="hfile" name="digital_hfile_'.$i.'" value="'.$vars['digitals'][$i]['file'].'" /><hr>'
						);
						$this->form[] = array(
							'value' => 'no',
							'name' => 'digital_'.($i).'_file_removed',
							'id' => 'digital_'.($i).'_file_removed',
							'type' => 'hidden',
							'wclass' => 'hide file_removed',
							'after' => '</div>'
						);
					}
					
				$this->form[] = array(
					'before' => '<div class="digital-level-clone"><a class="remove_block" title="Remove Digital File"><i class="fa fa-times" aria-hidden="true"></i></a>',
					'label' => __('Name', 'ignitiondeck'),
					'name' => 'digital_name[]',
					'id' => 'digital_1_name',
					'type' => 'text',
					'wclass' => 'form-row',
					'misc' => 'disabled="disabled"'
					);
				$this->form[] = array(
					'label' => __('Description', 'ignitiondeck'),
					'name' => 'digital_description[]',
					'id' => 'digital_1_description',
					'type' => 'text',
					'wclass' => 'form-row'
					);
				/*$this->form[] = array(
							'label' => __('Allow only Sponsors to download?', 'ignitiondeck'),
							'value' => ($vars['digitals'][$i]['sponsors_lock'] == 'checked') ? 'checked' : '',
							'name' => 'digital_sponsor_lock[]',
							'id' => 'digital_'.($i).'_sponsor_lock',
							'type' => 'checkbox',
							'wclass' => 'checkbox',
							'misc' => ($vars['digitals'][$i]['sponsors_lock'] == 'checked') ? 'checked' : ''
							); */
					$this->form[] = array(
							'before' => '<div style="padding-left: 30px; margin-bottom: 20px;">',
							'label' => __('Allow only Sponsors to download?', 'ignitiondeck'),
							'value' => 'digital_sponsor_lock_1',
							'id' => 'digital_sponsor_lock_1',
							'name' => 'digital_sponsor_lock[]',
							'type' => 'checkbox',
							'wclass' => 'checkbox abc-checkbox',
							'misc' => (isset($vars['digitals'][1]['sponsor_lock']) ? $vars['digitals'][1]['sponsor_lock'] : ''),
							'after' => '</div>'
							);
					$this->form[] = array(
						'label' => __('Upload File', 'ignitiondeck'),
						'misc' => 'accept="image/*"',
						'name' => 'digital_file_x',
						'id' => 'digital_x_file',
						'type' => 'file',
						'wclass' => 'form-row',
						'class' =>'digitalfile na',
						'after'=>'</div>',
					);
				$this->form[] = 	array(
					'after' => '<div style="text-align:center;"><a class="btn btn-navy large add-digital-level">Add New File</a></div>'
					);
                $this->form[] = 	array(
                    'after' => '</div></div>'
                );
                $this->form[] = array(
                    'before' => '<div class="fes_section payment_account"><div class="creation_block bordered"><h3>Payment Account</h3><p>We use Stripe as our payment processor. In order to host a project on our site you must have a Verified Stripe account. You will NOT be allowed to submit a project for funding unless you have a Stripe account linked to your dreams.build account. <br><br>If you have already linked your Stripe account you will be able to verify your information below. If you have not linked your Stripe account you can link it with the button below. If you do not have a Stripe account no worries, you will be prompted to sign in or create one after clicking the button! <br><br>By linking your Stripe account to our platform you agree to allow us access to your Stripe account information, create payments, and customers on your behalf. We must have this permission in order to transfer money into your account upon successful funding. By linking your account you agree to Stripe’s <a href="https://stripe.com/us/connect-account/legal">Connected Account Agreement</a> and <a href="https://stripe.com/us/legal">Terms of Service</a>.</p></div><div class="creation_block">'/*.print_r($vars['digitals'],true)*/,
                    'label' => __('Number of Levels', 'ignitiondeck'),
                    'value' => (!empty($vars['payment_account']) ? $vars['payment_account'] : 0),
                    'name' => 'payment_account',
                    'id' => 'payment_account',
                    'type' => 'hidden',
                    'wclass' => 'form-row half hide',
                    //'class' => 'required',
                    //'errors' => (!empty($vars['errors']['digital_file']) ? $vars['errors']['digital_file'] : ''),
                );

                global $current_user;
                get_currentuserinfo();
                $user_id = $current_user->ID;
                $check_creds = md_sc_creds($user_id);
                $stripe_account = md_sc_account($user_id);

                if($check_creds && $stripe_account->details_submitted == true){
//                    die(print_r($stripe_account));

                    $this->form[] = 	array(
                        'after' => '<p>Acount is verified <input type="hidden" name="verified_stripe" value="1" </p>'
                    );

                    $this->form[] = 	array(
                        'after' => '<p>Acount name: '. $stripe_account->display_name .'</p>'
                    );
                    $this->form[] = 	array(
                        'after' => '<p>Acount email: '. $stripe_account->email .'</p>'
                    );
					$this->form[] = 	array(
                        'after' => '<p>Default Currency (Currency for your project): '. strtoupper($stripe_account->default_currency) .'</p>'
                    );
                    $this->form[] = 	array(
                        'after' => '<p><a href="/dashboard/?sc_delete=yes" class="btn btn-blue" id="plot_marker">Disconnect Stripe</a></p>'
                    );
					
					$this->form[] = array(
                    'label' => __('Number of Levels', 'ignitiondeck'),
                    'value' => strtoupper($stripe_account->default_currency),
                    'name' => 'project_currency',
                    'id' => 'project_currency',
                    'type' => 'hidden',
                    'wclass' => 'form-row half hide',
                    //'class' => 'required',
                    //'errors' => (!empty($vars['errors']['digital_file']) ? $vars['errors']['digital_file'] : ''),
                );
                } else {
                    $sc_settings = get_option('md_sc_settings');
                    if (!empty($sc_settings)) {
                        $sc_settings = maybe_unserialize($sc_settings);
                        if (is_array($sc_settings)) {
                            $client_id = $sc_settings['client_id'];
                            $dev_client_id = $sc_settings['dev_client_id'];
                            $dev_mode = $sc_settings['dev_mode'];
                            if ($dev_mode == 1) {
                                $client_id = $dev_client_id;
                            }

                            $html_pupup = '<div id="myModal" class="modal fade" role="dialog">';
                            $html_pupup .= '<div class="modal-dialog">';
                            $html_pupup .= '<div class="modal-content">';
                            $html_pupup .= '<div class="modal-header">';
                            $html_pupup .= '<button type="button" class="close" data-dismiss="modal">&times;</button>';
                            $html_pupup .= '<h4 class="modal-title">Connect Stripe Account</h4></div>';
                            $html_pupup .= '<div class="modal-body"><p>Warning. Your progress will be lost without saving a draft. Are you sure to leave this page?</p></div>';
                            $html_pupup .= '<div class="modal-footer"><button  class="btn btn-default" data-dismiss="modal">Cancel</button>';
                            $html_pupup .= '<a href="https://connect.stripe.com/oauth/authorize?response_type=code&amp;client_id='.$client_id.'&amp;scope=read_write&amp;state='.$user_id.'" class="btn btn-default">Continue</a></div>';
                            $html_pupup .= '</div></div></div>';
                            $this->form[] = 	array(
                                'after' => $html_pupup
                            );
                        }
                    }

                    $this->form[] = 	array(
                        'after' => '<p class="alert-danger warning_stripe" style="display: none;">You need to connect a stripe account</p>'
                    );
                    $this->form[] = 	array(
                        'after' => '<input type="hidden" name="verified_stripe" value="0">'
                    );

                    $this->form[] = 	array(
                        'after' => '<p><button type="button" class="btn btn-blue" data-toggle="modal" data-target="#myModal">Connect with Stripe</button></p>'
                    );
					
					$this->form[] = array(
                    'label' => __('Number of Levels', 'ignitiondeck'),
                    'value' => 'USD',
                    'name' => 'project_currency',
                    'id' => 'project_currency',
                    'type' => 'hidden',
                    'wclass' => 'form-row half hide',
                    //'class' => 'required',
                    //'errors' => (!empty($vars['errors']['digital_file']) ? $vars['errors']['digital_file'] : ''),
                );

                }

				$this->form[] = 	array(
					'after' => '</div></div>'
					);
				$this->form[] = 	array(
					'after' => '</div></div></div>'
					);
				$submit_button = array(
					//'value' => (isset($vars['status']) && strtoupper($vars['status']) == 'PUBLISH' ? __('Update', 'ignitiondeck') : __('Update Submission', 'ignitiondeck')),
					'value' => 'Save & Continue',
					'name' => 'project_fesubmit',
					'type' => 'submit',
					'class' => 'project_fesubmit',
					'wclass' => 'form-row'
					);
			if (empty($vars['status']) || strtoupper($vars['status']) == 'DRAFT') {
				$this->form[] = array(
					'value' => (empty($vars['status']) ? __('Save Draft', 'ignitiondeck') : __('Update Draft', 'ignitiondeck')),
					'name' => 'project_fesave',
					'class' => 'project_fesave',
					'type' => 'submit',
					'wclass' => 'form-row half left'
					);
				$submit_button['value'] = __('Submit for Review', 'ignitiondeck');
				$submit_button['wclass'] = 'form-row half';
			}
            	$this->form[] = $submit_button;
			if (isset($vars['post_id']) && $vars['post_id'] > 0) {
				$this->form[] = array(
					'value' => $vars['post_id'],
					'name' => 'project_post_id',
					'type' => 'hidden');
			}
		}
		else {
			$this->form = $form;
		}
		$this->vars = $vars;
	}

	function display_form() {
		$id_form = new ID_Form($this->form);
		$output = $id_form->build_form($this->vars);
		return $output;
	}
}
?>