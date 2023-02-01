$(document).ready(function () {
  // $("#formid").validate({
  //   rules: {
  //     email: {
  //       required: true,
  //       email: true,
  //     },
  //     password: {
  //       required: true,
  //       minlength: 5,
  //     },
  //   },
  //   messages: {
  //     email: {
  //       required: "Email must not be blank",
  //       email: "You must enter a valid email",
  //     },
  //     password: {
  //       required: "Password must not be blank",
  //       minlength: "Password must contain at least 5 characters",
  //     },
  //   },
  // });

  $("#signin").on("click", function () {
    var csrfname = $("#csrf").attr("name");
    var csrfval = $("#csrf").val();
    var email = $("#email").val();
    var password = $("#password").val();

    // alert(password);

    // if ($("#formid").valid() == true) {
    $("#formid").submit(function (e) {
      e.preventDefault();

      var data = {
        [csrfname]: csrfval,
        email: email,
        password: password,
      };

      $.ajax({
        type: "POST",
        url: "signin",
        data: data,
        dataType: "json",
        success: function (response) {
          if (response["success"] == true) {
            window.location.replace(response["redirectTo"]);
          } else if (response["success"] == false) {
            iziToast.error({
              title: "Failed",
              message: response["msg"],
              timeout: 2000,
              onClosed: function () {
                location.reload();
              },
            });
          } else {
            iziToast.error({
              title: "Error",
              timeout: 2000,
              message: "There something wrong",
              onClosed: function () {
                location.reload();
              },
            });
          }
        },
        error: function (errorMessage) {
          console.log(errorMessage);
        },
      });
    });
    // }
  });
});
