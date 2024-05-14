<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';

$filterAll = filter();

if(!empty($filterAll['id'])){
    $orderID = $filterAll['id'];

// truy vấn vào bảng users
$listOrders = getRow("SELECT o.*,
                             p.*,
                             c.*,
                             od.*,
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
                    WHERE
                        od.order_ID = $orderID
                    GROUP BY
                        o.order_ID, od.od_ID, c.customer_username
");


if(!empty($listOrders)){
        setFlashData('order-detail', $listOrders);
        
    }
    else{
        redirect('order.php');
    }

}


$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>