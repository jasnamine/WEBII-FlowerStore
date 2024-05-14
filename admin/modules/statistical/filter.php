<?php
// require_once '../lib/database.php';
// require_once '../lib/session.php';
// require_once '../helpers/format.php';

//   $sql = "SELECT 
//                           c.customer_username ,
//                           SUM(o.order_total_price) AS Total,
//                           o.*

//                     FROM 
//                         orders o
//                     INNER JOIN 
//                         customers c ON o.customer_username = c.customer_username
//                     LEFT JOIN 
//                         order_details od ON o.order_ID = od.order_ID
//                     LEFT JOIN
//                         products p ON od.prd_ID = p.prd_ID
//                     WHERE o.order_status = 3
//                     ";

// if(isPost()){
//   $filterAll = filter();
//   $startDate = $filterAll['startDate'];
//   $endDate = $filterAll['endDate'];

//   if(!empty($filterAll['startDate']) && !empty($filterAll['endDate']))  {
//         $sql .= " AND order_date BETWEEN '$startDate' AND '$endDate' ";
//     }

// }
//     //$sql .= " ";

//     $sql .= " GROUP BY o.customer_username";

//     $sql .= " ORDER BY Total DESC LIMIT 5; ";


//     echo $sql;
// // $sql .=" ORDER BY order_ID DESC";
// $listOrders = getRow($sql);

// // public function getTop5Users($limit) {
// //         $query = "SELECT us.userId, us.name, us.sdt, us.ngaySinh, us.gioiTinh, 
// //                     SUM(od.thanhtien) AS sumTT, CONCAT(us.street, ', ', us.ward, ', ', us.district, ', ', us.city) AS diaChi
// //                     FROM tbl_uer AS us
// //                     LEFT JOIN tbl_order AS od ON us.userId = od.userId
// //                     GROUP BY us.userId
// //                     ORDER BY sumTT DESC
// //                     LIMIT $limit";
        
// //         $result = $this->db->select($query);
// //         return $result;
// //     }


// // public function gettongKHTheoNgay($data)
// //     {
// //         $data1 = mysqli_real_escape_string($this->db->link,$data['date1']);
// //         $data2 = mysqli_real_escape_string($this->db->link,$data['date2']);
// //         $ward = mysqli_real_escape_string($this->db->link,$data['ward']);
// //         $wardCondition="";
// //         if($ward!="")
// //         {
// //             $wardCondition= "AND user.ward='$ward'";
// //         }
// //         $query = "SELECT od.* , SUM(thanhtien) AS value_sumTT , SUM(od.quantity) AS value_count , user.name, user.userId, user.username
// //         FROM tbl_order AS od INNER JOIN tbl_uer AS user ON user.userId =od.userId
// //         WHERE ( order_time BETWEEN '$data1' AND '$data2' ) $wardCondition
// //         GROUP BY  user.userId
// //         ORDER BY value_sumTT  DESC LIMIT 5";
// //         $result = $this->db->select($query);
// //         return $result;
// //     }


?>

<?php
// require_once '../lib/database.php';
// require_once '../lib/session.php';
// require_once '../helpers/format.php';

//   $sql = "SELECT          c.*,
//                           SUM(o.order_total_price) AS Total,
//                           o.order_status AS Status,
//                           o.*,
//                     CASE 
//                     WHEN o.order_status = 1 THEN 'Pending'
//                     WHEN o.order_status = 2 THEN 'Accepted/Delivering'
//                     WHEN o.order_status = 3 THEN 'Delivered'
//                     WHEN o.order_status = 4 THEN 'Canceled'
//                     END AS Status
//                     FROM 
//                         orders o
//                     INNER JOIN 
//                         customers c ON o.customer_username = c.customer_username
//                     LEFT JOIN 
//                         order_details od ON o.order_ID = od.order_ID
//                     LEFT JOIN
//                         products p ON od.prd_ID = p.prd_ID
//                     WHERE 1 = 1 AND o.order_status = 3
//                     ";

// if(isPost()){
//   $filterAll = filter();
//   $startDate = $filterAll['startDate'];
//   $endDate = $filterAll['endDate'];

//   if(!empty($filterAll['startDate']) && !empty($filterAll['endDate']))  {
//         $sql .= " AND order_date BETWEEN '$startDate' AND '$endDate' ";
//     }

// }
//     //$sql .= " ";

//     $sql .= " GROUP BY o.customer_username";

//     $sql .= " ORDER BY Total DESC LIMIT 5 ";


//     echo $sql;
// // $sql .=" ORDER BY order_ID DESC";
// $listOrders = getRow($sql);
?>

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
    }
}

$sql .= " GROUP BY o.customer_username";
$sql .= " ORDER BY Total DESC LIMIT 5";

$listOrders = getRow($sql);
?>