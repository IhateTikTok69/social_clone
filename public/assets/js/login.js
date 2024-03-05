$(document).ready(function () {
    $("#emailInput").on("input", function () {
        var email = $(this).val();
        emailMsg(isValidEmail(email));
    });

    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        var validProviders = ["gmail.com", "outlook.com", "yahoo.com"];

        if (emailRegex.test(email)) {
            // Extract domain from the email address
            var domain = email.split("@")[1];

            // Check if the domain is in the list of valid providers
            return validProviders.includes(domain);
        }

        return false;
    }

    function emailMsg(isValid) {
        var checkResult = $("#emailInput");
        if (isValid) {
            checkResult.addClass("success");
            checkResult.removeClass("danger");
        } else {
            checkResult.addClass("danger");
            checkResult.removeClass("success");
        }
    }

    $("#passwordInput").on("input", function () {
        var password = $(this).val();
        passMsg(isValidPassword(password));
    });

    function isValidPassword(password) {
        return password.length > 8;
    }

    function passMsg(isValid) {
        var checkResult = $("#passwordInput");
        var messageElement = $("#passwordValidationMessage");
        if (isValid) {
            checkResult.addClass("success");
            checkResult.removeClass("danger");
            messageElement.text("Valid password length").css("display", "none");
        } else {
            checkResult.addClass("danger");
            checkResult.removeClass("success");
            messageElement
                .text("Password must be more than 8 characters")
                .css("color", "red");
        }
    }
});
