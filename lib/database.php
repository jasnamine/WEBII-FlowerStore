<?php
require_once './lib/connect.php';

// Hàm thực hiện truy vấn đến cơ sở dữ liệu
function query($sql, $data = [], $check = false) {
    global $conn;
    $result = false;
    //echo $sql;

    try {
        $statement = $conn->prepare($sql);
        if (!empty($data)) {
            $result = $statement->execute($data);
        } else {
            $result = $statement->execute();
        }
    } catch(Exception $exp) {
        echo $exp->getMessage() . '<br>';
        echo 'File: '. $exp->getFile() . '<br>';
        echo 'Line: '.$exp->getLine();
        die();
    }

    if($check){
        return $statement;
    }
    return $result;
}

// Hàm thoát các giá trị truy vấn
function escape_values($data) {
    global $conn;
    $escaped_data = [];
    foreach ($data as $key => $value) {
        $escaped_data[$key] = $conn->real_escape_string($value);
    }
    return $escaped_data;
}

// function insert($table, $data){
//     $key = array_keys($data);
//     $truong = implode(',', $key);
//     $valuetb = ':'.implode(',:', $key);

//     $sql = 'INSERT INTO' . $table . '('.$truong .')'. 'VALUES('. $valuetb .')';

//     $kq = query($sql, $data);
//     return $kq;

// }

// Hàm thực hiện thêm dữ liệu vào bảng
function insert($table, $data){
    global $conn;
  
    $columns = implode(',', array_keys($data));
    $placeholders = ':' . implode(',:', array_keys($data));

    $sql = 'INSERT INTO ' . $table . ' (' . $columns . ') VALUES (' . $placeholders . ')';

    try {
        $statement = $conn->prepare($sql);
        
        $kq = $statement->execute($data);

        return $kq;
    } catch(Exception $exp) {
        
        echo $exp->getMessage() . '<br>';
        echo 'File: '. $exp->getFile() . '<br>';
        echo 'Line: '.$exp->getLine();
        die();
    }
}

//Hàm thực hiện cập nhật dữ liệu trong bảng
function update($table, $data, $condition=''){
    
    $update = '';
    foreach($data as $key => $value){
        $update .= $key .' =:' . $key . ',';
    }

    $update = trim($update, ',');

    if(!empty($condition)){
        $sql = 'UPDATE ' . $table . ' SET ' .$update . ' WHERE ' . $condition;

    }
    else{
        $sql = 'UPDATE ' . $table . ' SET ' .$update;

    }
    $kq = query($sql, $data);
    return $kq;
}


// Hàm thực hiện xóa dữ liệu từ bảng
function delete($table, $condition=''){
    if(empty($condition)){
        $sql = 'DELETE FROM ' .$table;
    }
    else{
        $sql = 'DELETE FROM ' .$table . ' WHERE ' . $condition ;
    }

    $kq = query($sql);
    return $kq;

}

// // Hàm lấy nhiều dòng dữ liệu từ cơ sở dữ liệu
// function getRow($sql){
//     $kq = query($sql, '', true);
//     if(is_object($kq)){
//         $dataFetch = $kq -> fetchAll(PDO::FETCH_ASSOC);
//     }
//     return $dataFetch;
// }

// // Hàm lấy nhiều dòng dữ liệu từ cơ sở dữ liệu
// function getRow($sql, $params = array()) {
//     global $conn;

//     try {
//         $statement = $conn->prepare($sql);

//        // Nếu có tham số được truyền vào
//        if (!empty($params)) {
//             // Ràng buộc các giá trị trong mảng $params vào câu truy vấn
//             foreach ($params as $key => $value) {
//                 $statement->bindValue(($key + 1), $value); // Sử dụng key + 1 vì số thứ tự của tham số bắt đầu từ 1
//             }
//         }

//         // Thực thi truy vấn
//         $statement->execute();

//         // Trả về kết quả
//         return $statement->fetchAll(PDO::FETCH_ASSOC);
//     } catch(Exception $exp) {
//         echo $exp->getMessage() . '<br>';
//         echo 'File: '. $exp->getFile() . '<br>';
//         echo 'Line: '.$exp->getLine();
//         die();
//     }
// }

// Hàm lấy nhiều dòng dữ liệu từ cơ sở dữ liệu sử dụng hàm query()
function getRow($sql, $params = []) {
    // Sử dụng hàm query() để thực hiện truy vấn
    $result = query($sql, $params, true);

    // Kiểm tra nếu kết quả trả về là một đối tượng
    if(is_object($result)){
        // Sử dụng fetchAll để lấy tất cả các dòng dữ liệu và trả về kết quả
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Nếu không có kết quả, trả về mảng rỗng
    return [];
}



// Hàm lấy một dòng dữ liệu từ cơ sở dữ liệu
function oneRow($sql){
    $kq = query($sql, '', true);
    if(is_object($kq)){
        $dataFetch = $kq -> fetch(PDO::FETCH_ASSOC);
    }
    return $dataFetch;

}

// Hàm đếm số dòng dữ liệu từ cơ sở dữ liệu
function countRows($sql){
    $kq = query($sql, '', true);
    if(!empty($kq)){
        return $kq -> rowCount();
        
    }
}

// hàm kiểm tra status cho customers (banned or not)
function authenticate_customer($username) {

    $sql = "SELECT customer_status FROM customers WHERE customer_username = '$username'";
    $customer = oneRow($sql);

    if ($customer && $customer['customer_status'] === 1) {
        return true; // Trả về true nếu customer active (not banned)
    } else {
        return false; // Trả về false nếu customer không active (banned)
    }

}

// Hàm truy vấn giỏ hàng của một khách hàng
function getCart($username) {
	$sql = "SELECT * FROM orders WHERE customer_username = '$username' AND order_status = -1";
	return oneRow($sql);
}

// Hàm truy vấn chi tiết sản phẩm trong giỏ hàng
function getCartItems($orderID) {
	$sql = "SELECT * FROM order_details WHERE order_ID = $orderID";
	return getRow($sql);
}

// Hàm cập nhật số lượng của sản phẩm trong giỏ hàng
function updateCartItemQuantity($od_ID, $quantity) {
    // Chuẩn bị câu truy vấn SQL để cập nhật số lượng sản phẩm
    $sql = "UPDATE order_details SET od_quantity = :quantity WHERE od_ID = :od_ID";

    // Dữ liệu được truyền vào truy vấn
    $data = [
        ':quantity' => $quantity,
        ':od_ID' => $od_ID
    ];

    // Thực hiện truy vấn cập nhật
    $result = query($sql, $data);

    // Trả về kết quả của truy vấn (true hoặc false)
    return $result;
}

// Hàm cập nhật trường order_total-price trong bảng orders
function updateCartTotalPrice($orderID, $totalPrice) {
    // Chuẩn bị câu truy vấn SQL để cập nhật trường order_total-price
    $sql = "UPDATE orders SET order_total_price = :totalPrice WHERE order_ID = :orderID";

    // Dữ liệu được truyền vào truy vấn
    $data = [
        ':totalPrice' => $totalPrice,
        ':orderID' => $orderID
    ];

    // Thực hiện truy vấn cập nhật
    $result = query($sql, $data);

    // Trả về kết quả của truy vấn (true hoặc false)
    return $result;
}

// Hàm tạo giỏ hàng mới
function createNewCart($customerID) {
    // Chuẩn bị dữ liệu cho truy vấn
    $data = [
        ':customerID' => $customerID,
        ':orderStatus' => -1
    ];

    // Chuẩn bị câu truy vấn SQL để chèn dữ liệu vào bảng orders
    $sql = "INSERT INTO orders (customer_username, order_status) VALUES (:customerID, :orderStatus)";

    // Thực hiện truy vấn
    $result = query($sql, $data);

    // Trả về kết quả của truy vấn (true hoặc false)
    return $result;
}

// Kiểm tra xem giỏ hàng đã có sản phẩm đó hay chưa
function checkProductInCart($orderID, $prd_ID) {
    $sql = "SELECT * FROM order_details WHERE order_ID = :orderID AND prd_ID = :prd_ID";
    $params = [
        ':orderID' => $orderID,
        ':prd_ID' => $prd_ID
    ];
    $result = getRow($sql, $params);
    return !empty($result); // Trả về true nếu có sản phẩm trong giỏ hàng, ngược lại trả về false
}


?>