<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';

$sql = "SELECT o.order_ID AS ID,
                          c.customer_username AS Customer,
                          o.order_address AS Address,
                          SUM(od.od_quantity) AS Amount,
                          SUM(od.od_price) AS TotalPrice,
                          o.order_status AS Status,
                          o.*,
                          c.*,
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
                    LEFT JOIN 
                        order_details od ON o.order_ID = od.order_ID
                    LEFT JOIN
                        products p ON od.prd_ID = p.prd_ID
                    WHERE 1=1";
// echo '<pre>';b
// print_r($listUssers);
// echo '</pre>'; 
if(isPost()){
  $filterAll = filter();
  $startDate = $filterAll['startDate'];
  $endDate = $filterAll['endDate'];
  $district = $filterAll['district'];
  $status = $filterAll['status'];
//   if(!empty($filterAll['date1']) && !empty($filterAll['date2']) && !empty($filterAll['address_province']) && !empty($filterAll['user_status'])){
//     $sql .= ' WHERE';
//   }
  if(!empty($filterAll['startDate']) && !empty($filterAll['endDate']))  {
    $sql .= " AND order_date BETWEEN '$startDate' AND '$endDate'";
  }
  if(!empty($filterAll['district'])){
    $sql .= " AND order_district ='$district'";
  }
  if(!empty($filterAll['status'])){
    $sql .= " AND order_status ='$status'";
  }
  setFlashData('old', $filterAll);
}

// echo $sql;
  $sql .= " AND o.order_status IN (1, 2, 3, 4)";
$sql .= " GROUP BY order_ID, c.customer_username, o.order_address, 'o.order_total_price', o.order_status";

// $sql .=" ORDER BY order_ID DESC";
$listOrders = getRow($sql);
$old = getFlashData('old');

?>