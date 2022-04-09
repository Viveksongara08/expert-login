jQuery(document).ready(function () {

  // login ajax
  jQuery("#expertloginform").on('submit', (function (e) {
    e.preventDefault();

    var cusername = jQuery("#cusername").val();
    var cpassword = jQuery("#cpassword").val();
    var nonce = jQuery("#nonce").val();

    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;

    if (cusername == "") {
      jQuery("#cusername").addClass("error");

    } else if (cpassword == "") {
      jQuery("#cpassword").addClass("error");
      jQuery("#cusername").removeClass("error");

    } else {

      jQuery.ajax({
        type: "post",
        dataType: "json",
        url: myAjax.ajaxurl,
        data: { action: "expert_login", cusername: cusername, cpassword: cpassword, nonce: nonce },
        success: function (response) {
          var stringified = JSON.stringify(response);
          var obj = JSON.parse(stringified);
          //  console.log(obj);
          if (obj.loggedin == true) {
            jQuery('#sucess_box').html("<span style='color:green;'>" + obj.message + "</span>");
            setTimeout(function () { window.location = obj.url; }, 3000);
          }
          else {
            jQuery('#sucess_box').html("<span style='color:red;'>" + obj.message + "</span>");

          }
        }
      });




    }


  }));

  // Registration ajax
  jQuery("#expertregister").on('submit', (function (e) {
    e.preventDefault();
    var username = jQuery("#username").val();
    var emailaddress = jQuery("#emailaddress").val();
    var password = jQuery("#password").val();
    var nonce = jQuery("#nonce").val();
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;

    if (username == "") {
      jQuery("#username").addClass('error');

    } else if (emailaddress == "") {
      jQuery("#emailaddress").addClass('error');
      jQuery("#username").removeClass("error");

    } else if (!pattern.test(emailaddress)) {
      jQuery("#emailaddress").addClass('error');
      jQuery("#username").removeClass("error");

    } else if (password == "") {
      jQuery("#password").addClass('error');
      jQuery("#emailaddress").removeClass("error");
      jQuery("#username").removeClass("error");
    } else {

      jQuery.ajax({
        type: "post",
        dataType: "json",
        url: myAjax.ajaxurl,
        data: { action: "expert_registration", username: username, emailaddress: emailaddress, password: password, nonce: nonce },
        success: function (response) {
          var stringified = JSON.stringify(response);
          var obj = JSON.parse(stringified);
          console.log(obj);
          if (obj.registerin == true) {
            jQuery('#sucess_box').html("<span style='color:green;'>" + obj.message + "</span>");
            setTimeout(function () { window.location = obj.url; }, 3000);
          }
          else {
            jQuery('#sucess_box').html("<span style='color:red;'>" + obj.message + "</span>");

          }
        }
      });
    }

  }));


  // forget password 
  jQuery("#expertforgetpassword").on('submit', (function (e) {
    e.preventDefault();
    var forgetemail = jQuery("#forgetemail").val();
    var nonce = jQuery("#nonce").val();
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;

    if (forgetemail == "") {
      jQuery("#forgetemail").addClass('error');

    } else if (!pattern.test(forgetemail)) {
      jQuery("#forgetemail").addClass('error');

    } else {
      jQuery("#forgetemail").removeClass("error");

      jQuery.ajax({
        type: "post",
        dataType: "json",
        url: myAjax.ajaxurl,
        data: { action: "expert_forgetpassword", forgetemail: forgetemail, nonce: nonce },
        success: function (response) {
          var stringified = JSON.stringify(response);
          var obj = JSON.parse(stringified);
          console.log(obj);
          if (obj.forgetin == true) {
            jQuery('#sucess_box').html("<span style='color:green;'>" + obj.message + "</span>");
            setTimeout(function () { window.location = obj.url; }, 3000);
          }
          else {
            jQuery('#sucess_box').html("<span style='color:red;'>" + obj.message + "</span>");

          }
        }
      });


    }


  }));


  // reset password 
  jQuery("#expertresetpassword").on('submit', (function (e) {
    e.preventDefault();
    var password = jQuery("#password").val();
    var confirmpassword = jQuery("#confirmpassword").val();
    var resetemail = jQuery("#resetemail").val();

    var nonce = jQuery("#nonce").val();

    if (password == "") {
      jQuery("#password").addClass('error');

    } else if (confirmpassword == "") {
      jQuery("#confirmpassword").addClass('error');
      jQuery("#password").removeClass("error");

    } else if (password != confirmpassword) {
      jQuery("#password").addClass('error');
      jQuery("#confirmpassword").addClass('error');

    } else {
      jQuery("#password").removeClass("error");
      jQuery("#confirmpassword").removeClass("error");


      jQuery.ajax({
        type: "post",
        dataType: "json",
        url: myAjax.ajaxurl,
        data: { action: "expert_resetpassword", password: password, confirmpassword: confirmpassword, resetemail: resetemail, nonce: nonce },
        success: function (response) {
          var stringified = JSON.stringify(response);
          var obj = JSON.parse(stringified);
          console.log(obj);
          if (obj.resetin == true) {
            jQuery('#sucess_box').html("<span style='color:green;'>" + obj.message + "</span>");
            setTimeout(function () { window.location = obj.url; }, 3000);
          }
          else {
            jQuery('#sucess_box').html("<span style='color:red;'>" + obj.message + "</span>");

          }
        }
      });


    }


  }));


  // Edit profile 
  jQuery("#editprofile").on('submit', (function (e) {
    e.preventDefault();

    var username = jQuery("#username").val();
    var firstname = jQuery("#firstname").val();
    var lastname = jQuery("#lastname").val();
    var email = jQuery("#email").val();
    var description = jQuery("#description").val();
    var password = jQuery("#password").val();
    var confirm_password = jQuery("#confirm_password").val();
    var nonce = jQuery("#nonce").val();

    if (firstname == "") {
      jQuery("#firstname").addClass('error');

    } else if (lastname == "") {
      jQuery("#lastname").addClass('error');
      jQuery("#firstname").removeClass("error");

    } else if (email == "") {
      jQuery("#email").addClass('error');
      jQuery("#lastname").removeClass("error");


    } else if (password != confirm_password) {
      jQuery("#password").addClass('error');
      jQuery("#confirm_password").addClass('error');

    } else {
      jQuery("#password").removeClass("error");
      jQuery("#confirmpaconfirm_passwordssword").removeClass("error");


      jQuery.ajax({
        type: "post",
        dataType: "json",
        url: myAjax.ajaxurl,
        data: {
          action: "expert_editprofile",
          username: username,
          firstname: firstname,
          lastname: lastname,
          email: email,
          description: description,
          password: password,
          confirm_password: confirm_password,
          nonce: nonce
        },
        success: function (response) {
          var stringified = JSON.stringify(response);
          var obj = JSON.parse(stringified);
          console.log(obj);
          if (obj.profilein == true) {
            jQuery('#sucess_box').html("<span style='color:green;'>" + obj.message + "</span>");
            setTimeout(function () { window.location = obj.url; }, 3000);
          }
          else {
            jQuery('#sucess_box').html("<span style='color:red;'>" + obj.message + "</span>");

          }
        }
      });


    }


  }));



});