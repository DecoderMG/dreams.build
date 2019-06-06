function idsocial_fblogin(user, override) {
  jQuery.ajax({
    url: idf_ajaxurl,
    type: 'POST',
    data: {action: 'idsocial_fblogin', User: user, Override: override},
    success: function(res) {
      //console.log(res);
      if (res == '1') {
    		if (jQuery('#idsocial-is-admin-login').val() == "yes") {
              window.location = jQuery('#idsocial-redirect-to').val();
    		}
    		else {
    		  window.location = '/dashboard';
    		}
      }
    }
  });
}

function idsocial_fblogin_check() {
  FB.getLoginStatus(function(response) {
    console.log(response);
    var status = response.status;
    idsocial_fblogin_handler(status);
  });
}

function idsocial_fblogin_handler(status, override) {
  if (status === 'connected') {
    console.log('Logged into FB.');
    FB.api('/me', {fields: 'name,email'}, function(me) {
      //console.log(JSON.stringify(me));
      idsocial_fblogin(me, override); 
    });
  }
  else {
    //console.log('Not logged into FB.');
    //FB.login();
  }
}

function idsocial_fblogin_callback(response) {
  console.log(response);
  var status = response.status;
  idsocial_fblogin_handler(status, 1);
}