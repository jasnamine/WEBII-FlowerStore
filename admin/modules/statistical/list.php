<?php
require_once '../lib/database.php';
require_once '../lib/session.php';

// truy vấn vào bảng users
$listOrders = getRow("SELECT 
                             c.customer_username AS Customer,
                             SUM('o.oder_total_price') AS Total,
                             o.order_status AS Status,
                             o.order_date,
                             o.order_ID,

                        CASE 
                        WHEN o.order_status = 1 THEN 'Pending'
                        WHEN o.order_status = 2 THEN 'Delivering'
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
                    GROUP BY 
                         c.customer_username, o.order_address, 'o.order_total_price', o.order_status;


");


$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>