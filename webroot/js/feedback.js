$(document).ready(function () {
  $('form#akka-feedback-form').submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var fieldset = form.find('fieldset');
    var loading = form.find('.loading');
    var success = form.find('.alert-success');
    var error = form.find('.alert-error');

    var name = form.find("input#name").val();
    var email = form.find("input#email").val();
    var feedback = form.find("textarea#feedback").val();

    var data = {name: name, email: email, feedback: feedback};

    fieldset.hide();
    loading.show();

    $.ajax({
      type: "POST",
      url: form.attr('action'),
      data: data,
      dataType: "json",
      success: function () {
        loading.hide();
        error.hide();
        success.show().text("Your feedback has been submitted successfully. Thank you!");
      },
      error: function () {
        success.hide();
        error.show("There was an error submitting your feedback. Please try again!");
        fieldset.show();
      }
    });
  });
});
