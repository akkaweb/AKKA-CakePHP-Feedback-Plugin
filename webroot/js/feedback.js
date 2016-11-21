$(document).ready(function () {
  $('#akka-feedback').show("slow");
  $('form#akka-feedback-form').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var fieldset = form.find('fieldset');
    var loading = form.find('.loading');
    var success = form.find('.alert-success');
    var error = form.find('.alert-danger');

    var name = form.find("input#name").val();
    var email = form.find("input#email").val();
    var phone = form.find("input#phone").val();
    var feedback = form.find("textarea#feedback").val();
    var recaptcha = form.find("textarea#g-recaptcha-response").val();

    var data = {name: name, email: email, phone: phone, feedback: feedback, recaptcha: recaptcha};

    fieldset.hide();
    loading.show();
    error.hide();

    $.ajax({
      type: "POST",
      url: form.attr('action'),
      data: data,
      dataType: "json",
      success: function (data) {
        loading.hide();
        if(data.feedback.error){
            success.hide();
            error.show().text(data.feedback.error);
            fieldset.show();
        }else{            
            error.hide();
            success.show().text("Your feedback has been submitted successfully. Thank you!");
        }
      },
      error: function () {
        success.hide();
        error.show("There was an error submitting your feedback. Please try again!");
        fieldset.show();
      }
    });
  });
});
