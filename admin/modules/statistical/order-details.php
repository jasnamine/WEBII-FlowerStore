<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';


$filterAll = filter();

if(!empty($filterAll['username'])){
$usernameID = $filterAll['username'];

//echo "Username ID: $usernameID";

// kiểm tra xem username có tồn tại trong customers không
$userID = oneRow("SELECT customer_username, customer_fullname, customer_email, customer_phone,
customer_city, customer_district, customer_address, customer_password
FROM customers WHERE customer_username = '$usernameID'");

$sql = "SELECT 
            o.order_ID,
            o.order_date,
            o.order_status,
            o.order_total_price,
            o.order_payment_method,
            o.order_address,
            o.order_district,
            o.order_city,
            o.order_receiver,
            o.order_phone,
            o.order_email,
            c.customer_username,
            CASE 
                WHEN o.order_status = 1 THEN 'Pending'
                WHEN o.order_status = 2 THEN 'Accepted/Delivering'
                WHEN o.order_status = 3 THEN 'Delivered'
                WHEN o.order_status = 4 THEN 'Canceled'
            END AS Status,
            od.od_ID,
            od.prd_ID,
            od.od_name,
            od.od_img,
            od.od_quantity,
            od.od_price,
            (od.od_quantity * od.od_price) AS total_purchase
        FROM 
            orders o
        JOIN 
            customers c ON o.customer_username = c.customer_username
        JOIN 
            order_details od ON o.order_ID = od.order_ID
        JOIN 
            products p ON od.prd_ID = p.prd_ID
        WHERE 
            o.customer_username = '$usernameID' AND o.order_status = 3
        ";

if(isPost()){
  $filterAll = filter();
  $startDate = $filterAll['startDate'];
  $endDate = $filterAll['endDate'];

//   if(!empty($filterAll['date1']) && !empty($filterAll['date2']) && !empty($filterAll['address_province']) && !empty($filterAll['user_status'])){
//     $sql .= ' WHERE';
//   }
  if(!empty($filterAll['startDate']) && !empty($filterAll['endDate']))  {
    $sql .= " AND order_date BETWEEN '$startDate' AND '$endDate'";
  }

}
$sql .= " ORDER BY 
            c.customer_username, o.order_ID ";

$listOrders = getRow($sql);
}

// Nhóm chi tiết đơn hàng theo customer_username và order_ID
$groupedOrderDetails = [];
foreach ($listOrders as $item) {
    $groupedOrderDetails[$item['customer_username']][$item['order_ID']][] = $item;
}
?>