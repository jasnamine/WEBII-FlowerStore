document.addEventListener('DOMContentLoaded', function() {
    updateCartTotal();

    // Lắng nghe sự kiện khi có số lượng thay đổi
    document.querySelectorAll('.quantity input').forEach(function(input) {
        input.addEventListener('change', function() {
            updateTotal(this); // Gọi hàm cập nhật giá trị cho sản phẩm đang thay đổi
        });
    });
});

// Khi người dùng nhấn nút "Process to Checkout"
document.querySelector('button[name="checkout"]').addEventListener('click', function() {
    // Lấy giá trị tổng số tiền từ phần tử hiển thị
    var totalPrice = document.getElementById('cart-total').querySelector('span:last-child').innerText;

    // Loại bỏ các ký tự không phải là số và chuyển đổi thành số nguyên
    totalPrice = parseInt(totalPrice.replace(/\D/g, ''));

    // Đặt giá trị tổng số tiền vào trường input ẩn
    document.getElementById('total-price').value = totalPrice;
});


// Hàm cập nhật giá trị tổng tiền cho từng sản phẩm
function updateTotal(input) {
    var quantity = parseInt(input.value);
    var price = parseFloat(input.closest('tr').querySelector('.price').innerText.replace(/\D/g,
    '')); // Lấy giá trị giá sản phẩm và loại bỏ ký tự không phải là số
    var total = quantity * price;

    // Hiển thị giá trị tổng tiền với định dạng và đơn vị tiền tệ
    input.closest('tr').querySelector('.total').innerText = numberWithCommas(total) + ' VND';
    updateCartTotal();
}

// Hàm thêm dấu phân cách phần ngàn
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Hàm cập nhật tổng giá trị của giỏ hàng
function updateCartTotal() {
    var total = 0;
    document.querySelectorAll('.total').forEach(function(item) {
        var price = parseFloat(item.innerText.replace(/\D/g, ''));
        total += price;
    });

    // Cập nhật giá trị vào phần tổng của mục giỏ hàng
    document.getElementById('cart-total').querySelector('span:last-child').innerText = numberWithCommas(total) + ' VND';
}

// Hàm tăng giá trị quantity khi bấm nút "+"
function increaseQuantity(button) {
    var input = button.parentElement.previousElementSibling;
    var currentValue = parseInt(input.value);
    input.value = currentValue + 1;
    updateTotal(input);
}

// Hàm giảm giá trị quantity khi bấm nút "-"
function decreaseQuantity(button) {
    var input = button.parentElement.nextElementSibling;
    var currentValue = parseInt(input.value);
    if (currentValue > 1) {
        input.value = currentValue - 1;
        updateTotal(input);
    }
}

function confirmDelete(itemId,orderId) {
    if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?")) {
        // Nếu người dùng xác nhận xóa, gửi yêu cầu xóa sản phẩm vào PHP
        window.location.href = 'delete_cart.php?order_ID=' + orderId + '&od_ID=' + itemId;
    } else {
        // Nếu không, không làm gì cả
        return false;
    }
}

