$(document).ready(function () {
    const otpInputsContainer = $(".otp-card-inputs");
    const button = $(".opt-card button");
    var otp = "";

    // Define and initialize lastInputStatus
    let lastInputStatus = 0;

    otpInputsContainer.on("keyup", function (event) {
        if (event.target.tagName === "INPUT") {
            const currentElement = event.target;
            const nextElement = currentElement.nextElementSibling;
            const prevElement = currentElement.previousElementSibling;

            // Use event.key instead of event.keyCode
            if (prevElement && event.key === "Backspace") {
                if (lastInputStatus === 1) {
                    prevElement.value = "";
                    prevElement.focus();
                }
                button.attr("disabled", true);
                lastInputStatus = 1;
            } else {
                const reg = /^[0-9]+$/;
                if (!reg.test(currentElement.value)) {
                    currentElement.value = currentElement.value.replace(/\D/g, "");
                } else if (currentElement.value) {
                    otp += currentElement.value;
                    console.log(otp);
                    if (nextElement) {
                        nextElement.focus();
                    } else {
                        button.removeAttr("disabled");
                        lastInputStatus = 0;
                    }
                }
            }
        }
    });

    $("#otpForm").on("submit", function (event) {
        event.preventDefault();
        console.log("Submit");
        // AJAX request to send OTP for verification
        const otpNum = Number(otp);
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const code = urlParams.get("code");
        console.log(code);
        $.ajax({
            url: `mailVeriFunc.php?code=${code}`,
            method: "POST",
            data: { otp: otpNum, code: code },
            success: function (data) {
                alert(data);
                if (data == 'Account activated successfully') {
                    window.location.href = 'http://localhost/4thsemProj/authentication/directlogin.php';
                }else if(data == 'Incorrect OTP'){
                    console.log('stay here');
                }else if(data == 'Time is up. Please try again.'){
                    window.location.href = 'http://localhost/4thsemProj/authentication/register.php';
                }
            },
            error: function (xhr, status, error) {
                console.error("Error during OTP verification:", error);
                // Display a generic error message to the user
                alert("An unexpected error occurred. Please try again later.");
            },
        });
    });
});
