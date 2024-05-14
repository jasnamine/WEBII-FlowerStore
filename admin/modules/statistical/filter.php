<?php
require_once '../lib/database.php';
require_once '../lib/session.php';
require_once '../helpers/format.php';

$sql = "SELECT 
            c.customer_username,
            SUM(o.order_total_price) AS Total,
            c.customer_email,
            c.customer_phone
        FROM 
            orders o
        INNER JOIN 
            customers c ON o.customer_username = c.customer_username
        WHERE 
            o.order_status = 3";

if (isPost()) {
    $filterAll = filter();
    $startDate = $filterAll['startDate'];
    $endDate = $filterAll['endDate'];

    if (!empty($startDate) && !empty($endDate)) {
        $sql .= " AND o.order_date BETWEEN '$startDate' AND '$endDate'";
        setFlashData('old', $filterAll);
    }
}

$sql .= " GROUP BY o.customer_username";
$sql .= " ORDER BY Total DESC LIMIT 5";

$listOrders = getRow($sql);
$old = getFlashData('old');
?>