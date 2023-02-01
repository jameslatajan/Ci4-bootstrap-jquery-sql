$(document).ready(function () {
  $("#register").on("click", function () {
    var csrfname = $("#csrf").attr("name");
    var csrfval = $("#csrf").val();
    var name = $("#name").val();
    var email = $("#email").val();
    var password = $("#password").val();
    var cpassword = $("#cpassword").val();

  
    // if ($("#formid").valid() == true) {
    $("#formid").submit(function (e) {
      e.preventDefault();

      var data = {
        [csrfname]: csrfval,
        name: name,
        email: email,
        password: password,
      };

      // alert(name);

      if (cpassword == password && password != "" && name != "") {
        $.ajax({
          type: "POST",
          url: "signup",
          data: data,
          dataType: "json",
          success: function (response) {
            if (response["success"] == true) {
              iziToast.success({
                title: "Success",
                message: response["msg"],
                timeout: 2000,
                onClosed: function () {
                  window.location.replace(response["redirectTo"]);
                },
              });
            } else if (response["success"] == false) {
              iziToast.error({
                title: "Failed",
                message: response["msg"],
                timeout: 2000,
                // onClosed: function () {
                //   window.location.replace(response["redirectTo"]);
                // },
              });
            } else {
              iziToast.error({
                title: "Error",
                message: "There something wrong",
                timeout: 2000,
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
      } else {
        iziToast.error({
          title: "Failed",
          message: "Re-check your submission",
          timeout: 2000,
          // onClosed: function () {
          //   location.reload();
          // },
        });
      }
    });
    // }
  });
});
