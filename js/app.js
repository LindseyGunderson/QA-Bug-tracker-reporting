$(document).ready(function () {

    // valid note form
    $("#noteForm").validate({
        errorClass: "alert alert-danger",

        rules: {

            // Note title requirement
            bugTitle: {
                required: true,
                minlength: 5,
            },

            // date requirement
            date: {
                required: true,
                date: true,
            }

        },

        // error messages
        messages: {
            bugTitle: "Please enter a bbug title that is at least 5 characters long.",
            date: "Please select a date for this bug."
        },
        submitHandler: function (form) {

            form.submit();

        }
    });

    // validate sign up form
    $("#signupForm").validate({
        errorClass: "alert alert-danger",
        rules: {

            // email requirement
            signupEmail: {
                required: true,
                email: true,

            },

            // password requirement
            signupPassword: {
                required: true,
                minlength: 5,
            },

            // confirm password requirement
            signupPasswordConfirm: {
                required: true,
                minlength: 5,
            }

        },

        // error messages
        messages: {
            bugTitle: "Please enter a valid email.",
            signupPassword: "Please enter a password with at least 5 characters",
            signupPasswordConfirm: "Please enter a password with at least 5 characters"
        },
        submitHandler: function (form) {

            form.submit();

        }
    });

});