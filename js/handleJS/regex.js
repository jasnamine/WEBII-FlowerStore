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