const register_submit = document.getElementById('register_submit');
const register_form = document.getElementById('register_form');

register_submit.addEventListener('click', function(e){
    e.preventDefault();
    var isValid = validationForm();
    if (isValid == true) {
        // alert('Register successfully!');
        register_form.submit();
    }
})

// Hàm kiểm tra tên người dùng
function isValidUsername(username) {
    // Biểu thức chính quy để kiểm tra tên người dùng
    var usernameRegex = /^[a-zA-Z0-9_]{1,32}$/;
    
    // Kiểm tra tên người dùng với regex
    return usernameRegex.test(username);
}

function isValidEmail(email) {
    // Biểu thức chính quy để kiểm tra email
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Kiểm tra email với regex
    return emailRegex.test(email);
}

function isValidPassword(password) {
    // Biểu thức chính quy để kiểm tra mật khẩu
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$^&*+=])[A-Za-z\d@#$^&*+=]{8,20}$/;

    // Kiểm tra mật khẩu với regex
    return passwordRegex.test(password);
}

function confirmPassword(password, confirm_password) {
    // Kiểm tra xem mật khẩu và mật khẩu xác nhận có trùng khớp không
    return password === confirm_password;
}

function validationForm() {
    var form_valid = true;
    var errors = [];

    var username = document.forms['register_form']['username'].value;
    var email    = document.forms['register_form']['email'].value;
    var password = document.forms['register_form']['password'].value;
    var confirm_password = document.forms['register_form']['confirm-password'].value;

    // console.log("username: " + username);
    // console.log("email: " + email);
    // console.log("password: " + password);
    // console.log("password: " + confirm_password);

    // console.log("Username valid: ", isValidUsername(username)); 
    // console.log("Email valid: ", isValidEmail(email));
    // console.log("Password valid: ", isValidPassword(password));
    // console.log("Confirm Password valid: ", confirmPassword(password, confirm_password));

    // Tất cả các trường input đều trống
    if (username === '' && email === '' && password === '' && confirm_password === '') {
        alert('All fields are required');
        form_valid = false;
        return form_valid;
    }

    if (username === '') {
        errors.push('Please enter an username!');
        // form_valid = false;
    }
    else if (!(isValidUsername(username))) {
        errors.push('Username has invalid character, please try again!');
        // form_valid = false;
    }

    if (email === '') {
        errors.push('Please enter an email address!');
        // form_valid = false;
    }
    else if (!(isValidEmail(email))) {
        errors.push('Email is not valid, please try again!');
        // form_valid = false;
    }

    if (password === '') {
        errors.push('Please enter a password!');
        // form_valid = false;
    }
    else if (!(isValidPassword(password))) {
        errors.push('Password is invalid, please follow the instruction and try again!');
        // form_valid = false;
    }

    if (confirm_password === '') {
        errors.push('Please enter a confirm password!');
        // form_valid = false;
    }
    else if (!(confirmPassword(password, confirm_password))) {
        errors.push('The confirm password does not match the password you entered.');
        // form_valid = false;
    }

    if (errors.length > 0) {
        var errors_msg = errors.join('\n');
        alert(errors_msg);
        return form_valid = false;
    }
    else return form_valid = true;

}

