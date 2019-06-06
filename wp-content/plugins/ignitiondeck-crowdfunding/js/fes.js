Array.prototype.diff = function(a) {
	return this.filter(function(i) {return a.indexOf(i) < 0;});
};

jQuery(document).ready(function() {
	calc_percents();
	function calc_percents(){
		//jQuery('.wp-switch-editor.switch-html').trigger('click');
		var vars = new Array('project_name','project_short_description', 'project_category','project_ga','project_fa','project_video','project_levels','project_level_price[]','project_level_limit[]', 'level_description[]','project_level_title[]',  'project_map_lat', 'project_map_lng','company_name', 'company_logo', 'company_location', 'company_url', 'company_fb', 'company_twitter', 'project_hero', 'project_image2', 'project_image3', 'project_image4','project_follow_twitter', 'project_follow_facebook', 'project_follow_google', 'project_follow_in', 'project_follow_website', 'project_follow_instagram');
		var for_created = new Array('project_goal', 'project_goal2', 'project_currency', 'project_start', 'project_end', 'project_end2');
		for (var i = 0; i < for_created.length; i++) {
			if(jQuery('input[name='+for_created[i]+']').length) vars.push(for_created[i]);
		}

		var tests = new Array();
		var fields = (jQuery('#project_long_description').val()=='') ? jQuery('.form-row input,.form-row select,#project_map_lng,#project_map_lat,#project_short_description') : jQuery('.form-row input,.form-row textarea,.form-row select,#project_map_lng,#project_map_lat');
		var i = 0;

		if(jQuery('input[name=company_logo_exist]').val()==1) {tests.push('company_logo');i++;}
		if(jQuery('input[name=project_hero_exist]').val()==1) {tests.push('project_hero');i++;}
		if(jQuery('input[name=project_image2_exist]').val()==1) {tests.push('project_image2');i++;}
		if(jQuery('input[name=project_image3_exist]').val()==1) {tests.push('project_image3');i++;}
		if(jQuery('input[name=project_image4_exist]').val()==1) {tests.push('project_image4');i++;}
		jQuery.each(fields, function(k, v) {
			var name = jQuery(this).attr('name');
			var value = jQuery(this).val();
			if (value != '' && value != undefined && value != 0 && (vars.indexOf(name) > -1)) {
				i++;tests.push(name);
			}
		});
		if(jQuery('#project_long_description_ifr').contents().find('body').find('p').length) {
			if(jQuery('#project_long_description_ifr').contents().find('body').find('p').text().length){
				tests.push('project_long_description');
				jQuery('textarea[name="project_long_description"]').val(
					jQuery('#project_long_description_ifr').contents().find('body').html()
				);
				i++;
			}
			if(jQuery('#project_faq_ifr').contents().find('body').find('p').text().length){
				tests.push('project_faq');i++;
			}
			if(jQuery('#project_challenges_ifr').contents().find('body').find('p').text().length){
				tests.push('project_challenges');i++;
			}
			if(jQuery('#project_needs_ifr').contents().find('body').find('p').text().length){
				tests.push('project_needs');
				i++;
			}
			console.log('321');
		}
		else{
			var newvars = jQuery('#project_long_description,#project_faq, #project_challenges,#project_needs')
			jQuery.each(newvars, function(k, v) {
				var name = jQuery(this).attr('name');
				var value = jQuery(this).val();
				if (value != '' && value != undefined && value != 0) {
					i++;tests.push(name);
				}
			});
		}

		//var perce = Math.round(i*100/(vars.length+9));
		if(i>50) i=50;

		var perce = Math.round(i*100/50);

		console.log(perce);
		console.log(i+'---'+vars.length);
		console.log(vars.diff(tests));//tests
		//jQuery('.wp-switch-editor.switch-html').trigger('click');
		jQuery('.project-topstats .green').text(perce+'%');
		jQuery('.project-topstats .progress .progress-bar-success').css('width',perce+'%');
	}
	var clkBtn;
	jQuery('input[name="project_fesubmit"]').click(function(e) {
		clkBtn = jQuery(this).attr('name');
	});
	jQuery('input[name="project_fesave"]').click(function(e) {
		clkBtn = jQuery(this).attr('name');
	});
	jQuery.each(jQuery('select[name="project_fund_type"] option'), function() {
		if (jQuery(this).attr('disabled') == 'disabled') {
			jQuery(this).remove();
		}
	});
	if (jQuery('select[name="project_fund_type"] option').length == 1) {
		jQuery('select[name="project_fund_type"]').closest('li').remove();
	}
	/*setTimeout(function () {
	 calc_percents();
	 }, 5000);*/
	jQuery('form#fes input,form#fes textarea,form#fes select').on('change', function(){
		calc_percents();
	});
	jQuery('form#fes input,form#fes textarea,form#fes select').on('focus', function(){
		calc_percents();
	});
	jQuery('form#fes').on('click','.form-level .remove_block',function(){
		if (confirm("Are you sure you want to remove the incentive? If there have been donations to this incentive, you will still be responsible for fulfilling those orders!")) {
			jQuery(this).parents('.form-level').remove();
			var project_levels = jQuery('#fes input[name="project_levels"]').val() - 1;
			jQuery('#fes input[name="project_levels"]').val(project_levels);
		}
	});
	jQuery('form#fes ').on('click','.form-level-clone .remove_block',function(){
		if (confirm("Are you sure you want to remove the incentive? If there have been donations to this incentive, you will still be responsible for fulfilling those orders!")) {
			jQuery(this).parents('.form-level').remove();
			var project_levels = jQuery('#fes input[name="project_levels"]').val() - 1;
			jQuery('#fes input[name="project_levels"]').val(project_levels);
		}
	});
	jQuery('form#fes ').on('click','.digital-level .remove_block',function(e){
		if (confirm("Are you sure you want to remove the file?")) {
			jQuery(this).parents('.digital-level').remove();
			var digital_levels = jQuery('#fes input[name="digital_levels"]').val() - 1;
			jQuery('#fes input[name="digital_levels"]').val(digital_levels);
			jQuery('form#fes .digital-level').each(function(){
				var ind = jQuery(this).index()-1;
				jQuery(this).find('input[type=file]').attr('name', 'digital_file_'+ind);
				jQuery(this).find('input.hfile').attr('name', 'digital_hfile_'+ind);
				jQuery(this).find('.file_removed input').attr('name', 'digital_'+ind+'_file_removed');jQuery(this).find('.file_removed input').attr('id', 'digital_'+ind+'_file_removed');
				jQuery(this).find('.remove_image').attr('name', 'digital_file_'+ind);

			})
		}
	});
	jQuery(document).on('keyup', '.number-field', function(e) {
		// If value is less than 0, then convert it back to 0 not allowing user to enter -ve values
		if (parseFloat(jQuery(this).val()) < 0) {
			jQuery(this).val('0');
		}
	});
	jQuery('form#fes').submit(function(e) {

		//console.log('fes submit');
		var btnID = clkBtn;
		var noError = true;
		jQuery('.digitalfile:not(.na)').each(function(){
			//console.log('checking');
			//if(jQuery(this)[0].files[0].length){
			var fle = jQuery(this)[0].files[0];
			//console.log('filesize:'+fle.size);
			if(fle && fle.size > 1024*1024*100) {
				alert('The maximum file size is 100mb');
				noError = false;
			} else {
				//all good
			}
			//}
		})

		if (btnID == "project_fesubmit") {
			//console.log('submit');
			if (jQuery('textarea[name="project_long_description"]:visible').length == 0) {
				// MCE Mode
				jQuery('.wp-switch-editor.switch-html').click();
				var mceMode = true;
			}
			else if (jQuery('textarea[name="level_long_description[]"]:visible').length == 0) {
				jQuery('.wp-switch-editor.switch-html').click();
				var mceMode = true;
			}
			else {
				var mceMode = false;
			}
			jQuery('textarea[name="project_long_description"]').change();

			//e.preventDefault();
			var required = jQuery('.form-row .required');
			jQuery.each(required, function(k, v) {
				var value = jQuery(this).val();
				if (value == '' || value == undefined) {
					noError = false;
					jQuery(this).addClass('error');
					jQuery(this).parents('.form-row').find('label').addClass('lerror');
				}
				else {
					jQuery(this).removeClass('error');
					jQuery(this).parents('.form-row').find('label').removeClass('lerror');
					//console.log(jQuery(this).val());
				}
				if (mceMode == true) {
					//console.log('clickback');
					jQuery('.wp-switch-editor.switch-tmce').click();
				}
			});

			if(jQuery('#project_start').length && jQuery('#project_end').length && jQuery('#project_end2').length){
				var project_start = jQuery('#project_start').val().split('/');
				var project_start_date = new Date(project_start[2], project_start[0], project_start[1]);
				var project_end = jQuery('#project_end').val().split('/');
				var project_end_date = new Date(project_end[2], project_end[0], project_end[1]);
				var project_end2 = jQuery('#project_end2').val().length?jQuery('#project_end2').val().split('/'):0;
				var project_end2_date = project_end2?new Date(project_end2[2], project_end2[0], project_end2[1]):0;
				if(project_end2_date && project_end2_date <=project_end_date){
					jQuery('#project_end,#project_end2').addClass('error');
					noError = false;
				}
				if(project_end_date <=project_start_date){
					jQuery('#project_end,#project_start').addClass('error');
					noError = false;
				}
				if(project_end2_date && project_end2_date <=project_start_date){
					jQuery('#project_end2,#project_start').addClass('error');
					noError = false;
				}
			}
			console.log('mceMode:'+mceMode);
			// if there are errors, scroll to the first error
			if (!noError) {
				var firstErrorElement = jQuery('.error').get(0);var fl; fl=0;
				if(jQuery('.error').length){
					if(jQuery(firstErrorElement).is(':visible')){}
					else {jQuery(firstErrorElement).show();fl=1;}
					var classes = jQuery(firstErrorElement).parents('.fes_section').attr('class');
					classes= classes.replace("fes_section", "");classes= classes.replace("active", "");classes= classes.replace(" ", "");
					jQuery('.whitebox.parted .title[rel="'+classes+'"]').trigger('click');
					var firstElementOffset = jQuery(firstErrorElement).offset().top - 55;
					if(fl){
						if(firstErrorElement.nodeName.toLowerCase()=='textarea'){
							firstElementOffset = firstElementOffset - 200;
						}
					}
					jQuery("html, body").animate({ scrollTop: firstElementOffset }, 500);
					console.log(firstErrorElement.nodeName.toLowerCase());
					if(fl) jQuery(firstErrorElement).hide();
				}
				//console.log(firstElementOffset);
			}
			
			 if(noError == true && jQuery('form#fes').find('input[name="verified_stripe"]').val() == 0){
			 //check stripe account conection
			 jQuery('.dashboard-sidebar').find('a[rel="payment_account"]').trigger('click');
			 jQuery('.warning_stripe').show();
			 noError = false;
			 console.log('stripe');
			 }
			 

			//console.log(noError);
			return noError;
		} else {
			//never trigger errors on save
			var noError = true;
			return noError;
		}
	});
	if (jQuery('.id-fes-form-wrapper').length) {
		jQuery
		('.id-fes-form-wrapper .date').datepicker({});
	}
	var disableLevels = jQuery('input[name="disable_levels"]').attr('checked');
	showLevels(disableLevels);
	jQuery('input[name="disable_levels"]').click(function() {
		disableLevels = jQuery('input[name="disable_levels"]').attr('checked');
		showLevels(disableLevels);
	});
	var minLevels = jQuery('input[name="project_levels"]').attr('min');
	jQuery('#fes input[name="project_levels"]').change(function() {
		var fesLevels = countLevels();
		var newLevels = jQuery(this).val();
		if (jQuery.isNumeric(newLevels)) {
			levelChange = newLevels - fesLevels;
			formLevel(fesLevels, levelChange);
		}
		else {
			jQuery(this).val(fesLevels);
		}
		if (jQuery(this).val() < minLevels) {
			jQuery(this).val(minLevels);
		}
	});
	jQuery('#fes input[name="digital_levels"]').change(function() {
		var fesLevels = jQuery('#fes .digital-level:visible').length;
		var newLevels = jQuery(this).val();
		if (jQuery.isNumeric(newLevels)) {
			levelChange = newLevels - fesLevels;
			console.log(fesLevels+'-'+newLevels+'--'+levelChange);
			formDigitalLevel(fesLevels, levelChange);
		}
		/*else {
		 jQuery(this).val(fesLevels);
		 }
		 if (jQuery(this).val() < minLevels) {
		 jQuery(this).val(minLevels);
		 }*/
	});
	var thumbs = jQuery('#fes input[type="file"]');
	jQuery.each(jQuery(thumbs), function(k,v) {
		var url = jQuery(this).data('url');
		//console.log(url);
		if (url && url.length > 0) {
			var name = jQuery(this).attr('name');
			jQuery(this).after('<p class="image_url" data-url="' + url + '">' + url + '</p>');
			jQuery(this).replaceWith('<span class="image_swap"><img class="project_image" src="' + url + '"/><br/><a name="' + name + '" href="#" class="remove_image">Remove</a> | <a href="#" class="show_url" data-url="' + url + '">Show URL</a></span>');
			jQuery('#fes .remove_image').click(function(e) {
				e.preventDefault();
				var name = jQuery(this).attr('name');
				jQuery(this).parent('.image_swap').replaceWith('<input type="file" name="' + name + '" class="' + name.replace("[","").replace("]","").replace("_","") + '" accept="image/*"/>');
				jQuery('#' + name + '_removed').val('yes');
			});
		}
	});
	jQuery('body').on('change', '#fes input[type="file"]', function(e) {
		console.log('image value: ', jQuery(this).val(), ', name: ', jQuery(this).attr('name'));
		if (jQuery(this).val() !== "") {
			var name = jQuery(this).attr('name');
			jQuery('#' + name + '_removed').val('no');
		}
	});
	jQuery('#fes .show_url').click(function(e) {
		e.preventDefault();
		var text = jQuery(this).text();
		var thisURL = jQuery(this).data('url');
		if (text == 'Show URL') {
			jQuery(this).text('Hide URL');
		}
		else {
			jQuery(this).text('Show URL');
		}
		jQuery('#fes .image_url[data-url="' + thisURL + '"]').toggle();
	});
});
function showLevels(disableLevels) {
	if (disableLevels == 'checked') {
		jQuery('#project_levels').closest('.fes_section').hide();
	}
	else {
		/*jQuery('#project_levels').closest('.fes_section').show();*/
	}
}
function countLevels() {
	var fesLevels = jQuery('#fes .form-level:visible').length;
	return fesLevels;
}
function formLevel(fesLevels, levelChange) {
	//console.log(levelChange);
	if (levelChange < 0) {
		levelChange = Math.abs(levelChange);
		for (i = 1; i <= levelChange; i++) {
			jQuery('#fes .form-level:visible').last().toggle();
		}
	}
	else {
		for (i = 1; i <= levelChange; i++) {
			var clone = jQuery('#fes .form-level-clone').clone();
			jQuery(clone).removeClass('form-level-clone').addClass('form-level');
			//jQuery(clone).find('input').attr('id', '');
			jQuery(clone).find('input').removeAttr('disabled');
			//console.log(jQuery('#fes .form-level:hidden'));
			if (jQuery('#fes .form-level:hidden').length > 0) {
				jQuery('#fes .form-level:hidden').first().toggle();
			}
			else {
				// add clone
				jQuery('#fes .form-level-clone').last().before(clone);
				// clear text and values
				var last = jQuery('#fes .form-level').size();
				var cloneIn = jQuery('#fes .form-level').last();
				var cloneInput = jQuery(cloneIn).find('input');
				var cloneTextArea = jQuery(cloneIn).find('textarea');
				jQuery.each(cloneInput, function() {
					jQuery(this).val('');
				});
				jQuery.each(cloneTextArea, function() {
					jQuery(this).text('');
				});
				jQuery(clone).find('input.project_level_1_title').attr('id', 'project_level_' + last + '_title').removeClass().addClass('required');
				jQuery(clone).find('input.project_level_1_price').attr('id', 'project_level_' + last + '_price').removeClass().addClass('required number-field');
				jQuery(clone).find('input.project_level_1_limit').attr('id', 'project_level_' + last + '_limit').removeClass().add('number-field');
				jQuery(clone).find('input.project_level_1_description').attr('id', 'project_level_' + last + '_description').removeClass().addClass('required');
				jQuery(clone).find('textarea.project_level_1_long_description').attr('id', 'project_level_' + last + '_long_description').removeClass()/*.addClass('required')*/;
				jQuery(clone).find('#project_level_1_long_description-html').attr('id', 'project_level_' + last + '_long_description-html');
				jQuery(clone).find('#project_level_1_long_description-tmce').attr('id', 'project_level_' + last + '_long_description-tmce');
				jQuery(clone).find('#wp-project_level_1_long_description-wrap').attr('id', 'wp-project_level_' + last + '_long_description-wrap');
				jQuery(clone).find('#wp-project_level_1_long_description-editor-tools').attr('id', 'wp-project_level_' + last + '_long_description-editor-tools');
				jQuery(clone).find('label[for="project_level_1_long_description"]').attr('for', 'project_level_' + last + '_long_description');
				jQuery(clone).find('a.insert-media.add_media').attr('data-editor', 'project_level_' + last + '_long_description');
				jQuery(clone).find('#wp-project_level_1_long_description-media-buttons').attr('id', 'wp-project_level_' + last + '_long_description-media-buttons');
				// Changing id for fund type dropdown
				jQuery(clone).find('label[for="level_project_fund_type_1"]').attr('for', 'level_project_fund_type_' + last).removeClass();
				jQuery(clone).find('select.level_project_fund_type_1').attr('id', 'level_project_fund_type_' + last).removeClass();

				tinyMCE.execCommand('mceAddEditor', false, 'project_level_' + last + '_long_description');
				tinyMCE.execCommand('mceAddControl', false, 'project_level_' + last + '_long_description');
				quicktags( { buttons: "strong,em,link,block,del,ins,img,ul,ol,li,code,more,close", id: 'project_level_' + last + '_long_description',id: 'project_level_clone' + last + '_long_description' } );
				QTags._buttonsInit();
			}
		}
	}
}
function formDigitalLevel(fesLevels, levelChange) {
	//console.log(levelChange);
	if (levelChange < 0) {
		levelChange = Math.abs(levelChange);
		for (i = 1; i <= levelChange; i++) {
			jQuery('#fes .digital-level:visible').last().toggle();
		}
	}
	else {
		for (i = 1; i <= levelChange; i++) {
			var clone = jQuery('#fes .digital-level-clone').clone();
			jQuery(clone).removeClass('digital-level-clone').addClass('digital-level');
			//jQuery(clone).find('input').attr('id', '');
			jQuery(clone).find('input').removeAttr('disabled');
			//console.log(jQuery('#fes .form-level:hidden'));
			if (jQuery('#fes .digital-level:hidden').length > 0) {
				jQuery('#fes .digital-level:hidden').first().toggle();
			}
			else {
				// add clone
				jQuery('#fes .digital-level-clone').last().before(clone);
				// clear text and values
				var last = jQuery('#fes .digital-level').size()-1;
				var cloneIn = jQuery('#fes .digital-level').last();
				var cloneInput = jQuery(cloneIn).find('input');
				var cloneTextArea = jQuery(cloneIn).find('textarea');
				jQuery.each(cloneInput, function() {jQuery(this).val('');});
				jQuery.each(cloneTextArea, function() {jQuery(this).text('');});
				jQuery(clone).find('input#digital_1_name').attr('id', 'digital_' + last + '_name').removeClass().addClass('required');
				jQuery(clone).find('input#digital_1_description').attr('id', 'digital_' + last + '_description').removeClass().addClass('required');
				jQuery(clone).find('input#digital_sponsor_lock_1').val('digital_sponsor_lock_' + last);
				jQuery(clone).find('input#digital_sponsor_lock_1').attr('id', 'digital_' + last + '_sponsor_lock').removeClass();
				jQuery(clone).find('input[type=file]').attr('id', 'digital_' + last + '_file').addClass('required').removeClass('na');
				jQuery(clone).find('input[type=file]').attr('name', 'digital_file_'+last);
				jQuery(clone).find('label[for="digital_1_name"]').attr('for', 'digital_' + last + '_name');
				jQuery(clone).find('label[for="digital_1_description"]').attr('for', 'digital_' + last + '_description');
				jQuery(clone).find('label[for="digital_sponsor_lock_1"]').attr('for', 'digital_' + last + '_sponsor_lock');
				jQuery(clone).find('label[for="digital_1_file"]').attr('for', 'digital_' + last + '_file');

			}
		}
	}
}