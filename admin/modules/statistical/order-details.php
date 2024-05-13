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
    SUM(p.prd_price * od.od_quantity) AS total_purchase,
    p.*,
    od.*,
    o.*,
    od.*,
    c.*,
    o.order_status AS Status,
    CASE 
        WHEN o.order_status = 1 THEN 'Pending'
        WHEN o.order_status = 2 THEN 'Accepted/Delivering'
        WHEN o.order_status = 3 THEN 'Delivered'
        WHEN o.order_status = 4 THEN 'Canceled'
    END AS Status
FROM 
    orders o
INNER JOIN 
customers c ON o.customer_username = c.customer_username
JOIN 
    order_details od ON o.order_ID = od.order_ID
JOIN 
    products p ON od.prd_ID = p.prd_ID
WHERE 
    o.customer_username = '$usernameID'
";
    

echo $sql;

$listOrders = getRow($sql);

}



?>