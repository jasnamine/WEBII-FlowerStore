const checkout_submit = document.getElementById('checkout_submit');
const checkout_form = document.getElementById('checkout_form');

function isValidEmail(email) {
    // Biểu thức chính quy để kiểm tra email
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Kiểm tra email với regex
    return emailRegex.test(email);
}

function isValidPhoneNumber(phoneNumber) {
    // Biểu thức chính quy để kiểm tra số điện thoại
    var phoneRegex = /^0\d{9}$/;

    // Kiểm tra số điện thoại với regex
    return phoneRegex.test(phoneNumber);
}

function isValidAddress(address) {
    // Biểu thức chính quy để kiểm tra địa chỉ nhà (không chấp nhận kí tự lạ)
    var addressRegex = /^[.0-9a-zA-Z\s\/,àáãạảăắằẳẵặâấầẩẫậèéẹẻẽêềếểễệđìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳỵỷỹýÀÁÃẠẢĂẮẰẲẴẶÂẤẦẨẪẬÈÉẸẺẼÊỀẾỂỄỆĐÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴỶỸÝ]+$/ug;

    // Kiểm tra địa chỉ với regex
    return addressRegex.test(address)
}

function isValidFullname(fullname) {
    // Biểu thức chính quy để kiểm tra họ tên
    var fullnameRegex = /^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*)*$/gu;

    // Kiểm tra họ tên với regex
    return fullnameRegex.test(fullname);
}

function isValidPaymentMethod(paymentMethod) {
    return (paymentMethod == 'cod' || paymentMethod == 'bank');
}

// Gán sự kiện click cho nút "Update Account"
checkout_submit.addEventListener('click', function(e) {
    e.preventDefault(); 

    var isValid = validationForm();
    // console.log("Is Form valid? " + isValid);
    if (isValid) {
        checkout_form.submit();
    }
})

function validationForm() {
    var form_valid = true;
    var errors = [];

    // Lấy giá trị từ các trường input
    var fullnameValue = document.forms['checkout_form']['fullname'].value;
    var phoneValue = document.forms['checkout_form']['phone'].value;
    var emailValue = document.forms['checkout_form']['email'].value;
    var addressValue = document.forms['checkout_form']['address'].value;
    var cityValue = document.forms['checkout_form']['city'].value;
    var districtValue = document.forms['checkout_form']['district'].value;
    var paymentMethodValue = document.forms['checkout_form']['optradio'].value;

    // console.log("fullnameValue: " + fullnameValue);
    // console.log("phoneValue: " + phoneValue);
    // console.log("emailValue: " + emailValue);
    // console.log("addressValue: " + addressValue);
    // console.log("cityValue: " + cityValue);
    // console.log("districtValue: " + districtValue);
    // console.log("paymentMethodValue: " + paymentMethodValue);
    
    // console.log("Email valid: ", isValidEmail(emailValue));
    // console.log("Phone valid: ", isValidPhoneNumber(phoneValue));
    // console.log("Fullname valid: ", isValidFullname(fullname));
    // console.log("Address valid: ", isValidAddress(addressValue));

    // Tất cả các trường input đều trống
    if (phoneValue == "" && emailValue == "" && fullnameValue == "" 
    && addressValue == "" && cityValue == "" && districtValue == "" && paymentMethodValue == "") { 
        alert('All fields are required');
        form_valid = false;
        return form_valid;
    }

    if (fullnameValue == '') {
        errors.push('Please enter a receiver name!');
    }
    else if (!isValidFullname(fullnameValue)) {
        errors.push('Your fullname contain some invalid character or not valid, please try again!');
    }

    if (phoneValue == '') {
        errors.push('Please enter a phone number!');
    } 
    else if(!isValidPhoneNumber(phoneValue)) {
        errors.push('Phone number is not valid, please try again!');
    }

    if (emailValue == '') {
        errors.push('Please enter an email address!');
    } 
    else if (!isValidEmail(emailValue)) {
        errors.push('Email is not valid, please try again!');
    }
    
    if (addressValue == '') {
        errors.push('Please enter a shipping address!');
    } 
    else if (!isValidAddress(addressValue)) {
        errors.push('Your address contain some invalid character or not valid, please try again!');
    }

    if (cityValue == '' || districtValue == '' ) {
        errors.push('The city and district address must be provided!');
    }

    if (paymentMethodValue == '' || (!isValidPaymentMethod(paymentMethodValue))) {
        errors.push('Please select payment method!');
    }

    if (errors.length > 0) {
        var errors_msg = errors.join('\n');
        alert(errors_msg);
        form_valid = false;
    }
    
    return form_valid;
}





