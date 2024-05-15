<?php
    if (isset($_REQUEST['order_ID']) && (isset($_REQUEST['canceled'])) || isset($_REQUEST['delivered'])) {
        $order_ID = $_REQUEST['order_ID'];
        if ($_REQUEST['canceled'] == true) {
            $status = '4';
        } else if ($_REQUEST['delivered'] == true) {
            $status = '3';
        }
        echo 'GET Order ID: '. $order_ID;
        echo 'Canceled status: ' . $_REQUEST['canceled'];
        echo 'Order Status: '. $order['order_status'];
        echo 'Set order status into canceled?'; 
        updateOrderStatus($order_ID,$status);
        // header('Location: order_details.php?order_ID='.$order_ID);
    }
?>