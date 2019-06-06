jQuery(document).ready(function($) {
    // Show the login dialog box on click
    /*$('a#show_login').on('click', function(e){
        $('body').prepend('<div class="login_overlay"></div>');
        $('form#login').fadeIn(500);
        $('div.login_overlay, form#login a.close').on('click', function(){
            $('div.login_overlay').remove();
            $('form#login').hide();
        });
        e.preventDefault();
    });*/

    // Perform AJAX login on form submit
    $('form#login').on('submit', function(e){
        if (!$(this).valid()) return false;
		ctrl = $(this);
        $('p.status', ctrl).show().text(ajax_auth_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_auth_object.ajaxurl,
            data: { 
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #username').val(), 
                'password': $('form#login #password').val(), 
                'rememberme': $('form#login #rememberme:checked').length?$('form#login #rememberme:checked').val():'', 
                'security': $('form#login #security').val() },
            success: function(data){
                $('p.status', ctrl).text(data.message);
                if (data.loggedin == true){   document.location.href = ajax_auth_object.redirecturl;   }
            },
            error: function(data){$('p.status', ctrl).text('Wrong username or password.');}
        });
        e.preventDefault();
    });

    $('form#signupForm').on('submit', function(e){
        e.preventDefault();
        if (!$(this).valid()) return false;
		ctrl = $(this);
        $('p.status', ctrl).show().text(ajax_auth_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_auth_object.ajaxurl,
            data: { 
                'action': 'ajaxregister', //calls wp_ajax_nopriv_ajaxregister
                'username': $('form#signupForm #susername').val(), 
                'password': $('form#signupForm #spassword').val(), 
                'email': $('form#signupForm #semail').val(), 
                'signonsecurity': $('form#signupForm #signonsecurity').val() },
            success: function(data){
                $('p.status', ctrl).text(data.message);
                if (data.loggedin == true){ document.location.href = ajax_auth_object.redirecturl; }
            }
        });
    });
    	// Client side form validation
/*if (jQuery("#signup").length) jQuery("#signup").validate({ rules:{ confirm_spassword:{ required: true,minlength: 5,equalTo:'#spassword' }, confirm_semail:{ required: true,equalTo:'#semail' }	}});*/


// validate signup form on keyup and submit
		if(jQuery("#signupForm").length) $("#signupForm").validate({
			rules: {
				susername: {required: true,minlength: 5},
				spassword: {required: true,minlength: 5},
				confirm_spassword: {required: true, minlength: 5, equalTo: "#spassword"},
				semail: {required: true,email: true},
				confirm_semail: {	required: true, email: true, equalTo: "#semail"}
			}
		});
		
		
   if(jQuery("#login").length) jQuery("#login").validate();
});