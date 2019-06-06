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
            }
        });
        e.preventDefault();
    });

    $('form#signup').on('submit', function(e){
        if (!$(this).valid()) return false;
		ctrl = $(this);
        $('p.status', ctrl).show().text(ajax_auth_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_auth_object.ajaxurl,
            data: { 
                'action': 'ajaxregister', //calls wp_ajax_nopriv_ajaxregister
                'username': $('form#signup #susername').val(), 
                'password': $('form#signup #spassword').val(), 
                'email': $('form#signup #semail').val(), 
                'security': $('form#signup #security').val() },
            success: function(data){
                $('p.status', ctrl).text(data.message);
                if (data.loggedin == true){ document.location.href = ajax_auth_object.redirecturl; }
            }
        });
        e.preventDefault();
    });
    	// Client side form validation
  /* if (jQuery("#signup").length) jQuery("#signup").validate({ rules:{ confirm_spassword:{ equalTo:'#spassword' }, confirm_semail:{ equalTo:'#semail' }	}});
   if(jQuery("#login").length) jQuery("#login").validate();*/
});