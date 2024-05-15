const login_submit = document.getElementById('login_submit');
const login_form = document.getElementById('login_form');

  login_submit.addEventListener('click', function(e){
      e.preventDefault();
      var isValid = validationForm();
      if (isValid == true) {
          // alert('Login successfully!');
          login_form.submit();
      }
  })


  // Hàm kiểm tra tên người dùng
  function isValidUsername(username) {
      // Biểu thức chính quy để kiểm tra tên người dùng
      var usernameRegex = /^[a-zA-Z0-9_]{1,32}$/;
      
      // Kiểm tra tên người dùng với regex
      return usernameRegex.test(username);
  }

  function isValidPassword(password) {
      // Biểu thức chính quy để kiểm tra mật khẩu
      var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$^&*+=])[A-Za-z\d@#$^&*+=]{8,20}$/;

      // Kiểm tra mật khẩu với regex
      return passwordRegex.test(password);
  }

  function validationForm() {
      var form_valid = true;
      var errors = [];

      var username = document.forms['login_form']['username'].value;
      var password = document.forms['login_form']['password'].value;

    //   console.log("username: " + username);
    //   console.log("password: " + password);

    //   console.log("Username valid: ", isValidUsername(username)); 
    //   console.log("Password valid: ", isValidPassword(password));

      // Tất cả các trường input đều trống
      if (username === '' && password === '') {
          alert('All fields are required');
          form_valid = false;
          return form_valid;
      }

      if (username === '') {
          errors.push('Please enter an username!');
          // form_valid = false;
      }
      else if (!(isValidUsername(username))) {
          errors.push('You have entered an invalid username or password!');
          // form_valid = false;
      }

      if (password === '') {
          errors.push('Please enter a password!');
          // form_valid = false;
      }
      else if (!(isValidPassword(password))) {
          errors.push('You have entered an invalid username or password!');
          // form_valid = false;
      }

      if (errors.length > 0) {
          var errors_msg = errors.join('\n');
          alert(errors_msg);
          return form_valid = false;
      }
      else return form_valid = true;

  }