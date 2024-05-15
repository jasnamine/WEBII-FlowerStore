const update_submit = document.getElementById('update_submit');
const update_form = document.getElementById('update_form');

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

// Gán sự kiện click cho nút "Update Account"
update_submit.addEventListener('click', function(e) {
    e.preventDefault(); 

    var isValid = validationForm();
    // console.log("Is Form valid? " + isValid);
    if (isValid) {
        update_form.submit();
    }
})

function validationForm() {
    var form_valid = true;
    var errors = [];

    // Lấy giá trị từ các trường input
    var phoneValue = document.forms['update_form']['phone'].value;
    var emailValue = document.forms['update_form']['email'].value;
    var addressValue = document.forms['update_form']['address'].value;
    var fullnameValue = document.forms['update_form']['fullname'].value;
    var cityValue = document.forms['update_form']['city'].value;
    var districtValue = document.forms['update_form']['district'].value;

    // console.log("phoneValue: " + phoneValue);
    // console.log("emailValue: " + emailValue);
    // console.log("addressValue: " + addressValue);
    // console.log("fullnameValue: " + fullnameValue);
    // console.log("cityValue: " + cityValue);
    // console.log("districtValue: " + districtValue);
    
    // console.log("Email valid: ", isValidEmail(emailValue));
    // console.log("Phone valid: ", isValidPhoneNumber(phoneValue));
    // console.log("Address valid: ", isValidAddress(addressValue));
    // console.log("Fullname valid: ", isValidFullname(fullname));

    if (phoneValue !== "" && !isValidPhoneNumber(phoneValue)) {
        errors.push('Phone number is not valid, please try again!');
    }

    if (emailValue !== "" && !isValidEmail(emailValue)) {
        errors.push('Email is not valid, please try again!');
    }
    
    if (addressValue !== "" && !isValidAddress(addressValue)) {
        errors.push('Your address contain some invalid character or not valid, please try again!');
    }

    if (fullnameValue !== "" && !isValidFullname(fullnameValue)) {
        errors.push('Your fullname contain some invalid character or not valid, please try again!');
    }


    if (errors.length > 0) {
        var errors_msg = errors.join('\n');
        alert(errors_msg);
        form_valid = false;
    }
    
    return form_valid;
}





