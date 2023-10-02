$(document).ready(function () {
    // validate fields in the login form
    $('#login-form').validate({
        rules: {
            Password: {
                minlength: 6,
            } 
        }
    });

    $('#login-form').on('submit', function (e) {
        e.preventDefault();
        if($(this).valid()){
            $.ajax({
                type: 'post',
                url: '../controller/login.php',
                data: $('#login-form').serialize(),
                success: function (data) {
                    data = JSON.parse(data);
                    data = data.message;
                    
                    if(data == "success"){
                        window.location.href = 'panel.php'; 
                    } else if(data == "email-not-found"){
                        $('#login .msg').html("<p class='error'>User does not exist.</p>").show();
                    } else if(data == "incorrect-access"){
                        $('#login .msg').html("<p class='error'>Email or password is incorrect.</p>").show();
                    } else{
                        $('#login .msg').html("<p class='error'>Something went wrong. User login failed.</p>").show();
                    } 
                }
            });
        }
    });

    // validate fields in the register form
    $('#registration-form').validate({
        rules: {
            Password: {
                minlength: 6,
            },
            Confirm_Password: {
                minlength: 6,
                equalTo: "#password"
            }
        }
    });
    $('#registration-form').on('submit', function (e) {
        e.preventDefault();
        if($(this).valid()){
            $.ajax({
                type: 'post',
                url: '../controller/register.php',
                data: $('#registration-form').serialize(),
                success: function (data) {
                    data = JSON.parse(data);
                    data = data.message;
                    
                    if(data == "success"){
                        $('#register').html("<p class='success'><span><i class='fa fa-check'></i> Awesome! </span> Your account has been successfully created.</p>");
                    } else if(data == "password-error"){
                        $('#register .msg').html("<p class='error'>Password does not match. Please try again.</p>").show();
                    } else if(data == "exists"){
                        $('#register .msg').html("<p class='error'>User already exists.</p>").show();
                    } else{
                        $('#register .msg').html("<p class='error'>Something went wrong. User registration failed.</p>").show();
                    } 
                    
                }
            });
        }
    });
    // validate fields in the forget password form
    $('#forgotpassword-form').validate({
        rules: {
            Old_Password: {
                minlength: 6,
            },
            New_Password: {
                minlength: 6,
            },
            Confirm_New_Password: {
                minlength: 6,
                equalTo: "#newpassword"
            }
        }
    });
    $('#forgotpassword-form').on('submit', function (e) {
        e.preventDefault();
        if($(this).valid()){
            $.ajax({
                type: 'post',
                url: '../controller/forgot-password.php',
                data: $('#forgotpassword-form').serialize(),
                success: function (data) {
                    data = JSON.parse(data);
                    data = data.message;
                    
                    if(data == "success"){
                        $('#forgotpassword-form').html("<p class='success'><span><i class='fa fa-check'></i> Awesome! </span> Your password has been changed.</p>");
                    } else if(data == "email-not-found"){
                        $('#forgotpassword-form .msg').html("<p class='error'>User does not exist.</p>").show();
                    } else if(data == "incorrect-old-pass"){
                        $('#forgotpassword-form .msg').html("<p class='error'>Old password is incorrect.</p>").show();
                    } else{
                        $('#forgotpassword-form .msg').html("<p class='error'>Something went wrong. Failed to reset password.</p>").show();
                    } 
                }
            });
        }
    });

    $('#logout').on('click', function (e) {
        e.preventDefault();
            $.ajax({
                type: 'post',
                url: '../controller/logout.php',
                success: function (data) {
                    data = JSON.parse(data);
                    data = data.message;

                    if(data == "success"){
                        window.location.href = 'index.html'; 
                    }
                }
            });
    });
    
    $('#forgot-password').click(function() {
        window.location.href = 'forgot-password.html'; 
    });
    $('#back-to-login').click(function() {
        window.location.href = 'index.html'; 
    });

    // Function to show the hidden register form when the login button/link is clicked
    $('.register-btn').click(function() {
        $('#buttons .register-btn').addClass('active');
        $('h1, #buttons, #register').fadeIn();
        $('#buttons .login-btn').removeClass('active');
        $('#login, #forgotpassword').hide();
    });

    // Function to show the hidden login form when the register button/link is clicked
    $('.login-btn').click(function() {
        $('#buttons .login-btn').addClass('active');
        $('h1, #buttons, #login').fadeIn();
        $('#buttons .register-btn').removeClass('active');
        $('#register, #forgotpassword').hide();
    });

});