var $ = jQuery.noConflict();
jQuery(function($) {
	"use strict";
	// preloader
	$(window).load(function() {
		$("#preloader").delay(500).fadeOut("slow");
		setTimeout(function(){$("#logo h1").addClass("animated fadeInDown")},1000);
		setTimeout(function(){$("#logo img").addClass("animated fadeInDown")},1000);
		setTimeout(function(){$("#logo p").addClass("animated fadeInDown")},1300);
		setTimeout(function(){$("#textslider").addClass("animated fadeInDown")},1600);
		setTimeout(function(){$(".description .uptodown").addClass("animated fadeInDown")},1900);
		setTimeout(function(){$(".description .jump").addClass("animated fadeInUp")},2100);
		setTimeout(function(){$(".description .downtoup").addClass("animated fadeInDown")},2400);
		setTimeout(function(){$(".left .arrow a").addClass("animated fadeInLeft")},3000);
		setTimeout(function(){$(".bottom .arrow a").addClass("animated fadeInUp")},3300);
		setTimeout(function(){$(".right .arrow a").addClass("animated fadeInRight")},3600);
    })
	
	// jumper
	var beepOne = $("#beep")[0];$(".description .jump").mouseenter(function() {beepOne.play();});
	
	// textslider
	$("#textslider").superslides({
		play: 6000, // 6 seconds between each slide
		animation: "fade",
		animation_speed: "slow",
		pagination: false,
		usekeyboard: false
	});
			
	// popup
	$(".popup-modal").each(function() {
		$('.popup-modal').magnificPopup({
			type: 'inline',
			preloader: false,
			focus: '#username',
			modal: true
        });
	});
	
	// subscribe
	$("#subscribe-form").each(function() {
		$("#subscribe-form").ajaxForm( {
			target: "#subscribe .message",
			success: function() { 
				$("#subscribe-form").slideUp("slow");
				$("#subscribe .waiting").delay(100).fadeIn("slow");
				$("#subscribe .waiting").delay(500).fadeOut("slow");
				$("#subscribe .message").delay(1500).slideDown("slow");
			}
		});
	});
	
	// mailchimp
	$("#mailchimp").each(function() {
		var $form = $('.mailchimp');
		$('#mailchimp .submit').on('click', function(event) {
			if (event)
				event.preventDefault();
			register($form);
		});
		function register($form) {
			$.ajax({
				type: $form.attr('method'),
				url: $form.attr('action'),
				data: $form.serialize(),
				cache: false,
				dataType: 'json',
				contentType: "application/json; charset=utf-8",
				error: function(err) {
					$('#mailchimp .message').hide().html('<p class="error"> Could not connect to server. Please try again later.</p>').fadeIn("slow");
					$("#mailchimp .message").delay(1500).slideDown("slow");
				},
				success: function(data) {
					
					if (data.result != "success") {
						var message = data.msg.substring(4);
						$("#mailchimp .message").delay(0).slideUp("fast");
						$("#mailchimp .waiting").delay(0).slideDown("slow");
						$("#mailchimp .waiting").delay(600).slideUp("fast");
						$("#mailchimp .message").delay(1500).slideDown("slow");
						setTimeout(function() {
							$("#mailchimp .message").html('<p class="error alert alert-danger"> ' + message + '</p>');
						}, 1500);
					
					} else {
						var message = data.msg.substring(4);
						$("#mailchimp .message").delay(0).slideUp("fast");
						$(".mailchimp").delay(1000).slideUp("slow");
						$("#mailchimp .waiting").delay(100).fadeIn("slow");
						$("#mailchimp .waiting").delay(500).fadeOut("slow");
						$("#mailchimp .message").delay(1500).slideDown("slow");
						setTimeout(function() {
							$('#mailchimp .message').html('<p class="success alert alert-success">' + 'Awesome! We sent you a confirmation email.' + '</p>');
						}, 1500);
					}
				}
			});
		}
	});
	
	// contact form
	$("#contactForm").each(function() {
		$("#contactForm").submit(function(e) {
			e.preventDefault();
			$.ajax({
				url: $("#template_path_contact").val()+"/inc/contact.php",
				data: "name="+ escape($("#contactName").val()) +"&email=" + escape($("#contactEmail").val()) + "&phone=" + escape($("#contactPhone").val()) + "&message="+escape($("#contactMessage").val()),
				dataType: "json",
				success: function(resp) {
					$("#contactName, #contactEmail, #contactMessage").removeClass("error");

					if(resp.success == 1){
						$("#modalContent").text(resp.message);
						$("#contact .waiting").delay(100).fadeIn("slow");
						$("#contact .waiting").delay(500).fadeOut("slow");
						$("#contact .message").delay(1500).slideDown("slow");
						$("#contactForm").slideUp("slow");
						$("#contactName, #contactEmail, #contactMessage, #contactPhone").val("");
					}
					else {
						if(resp.errorCode == 1){
							$("#contactName").addClass("error").focus();
						}
						else if(resp.errorCode == 2){
							$("#contactEmail").addClass("error").focus();
						}
						else if(resp.errorCode == 3){
							$("#contactMessage").addClass("error").focus();
						}	
					}					
				}
			});
			return false;
		});
	});
	
	// countdown
	$(".countdown").countEverest({
		//Set your target date here!
		day: 29,
		month: 12,
		year: 2015
	});
	//  nice scroll
	var nice = $('.container').getNiceScroll();
	$('.container').niceScroll({cursorborder:"0px solid #ffffff",cursorcolor:"#000000",mousescrollstep:"10",scrollspeed:"120",horizrailenabled:false});
});	