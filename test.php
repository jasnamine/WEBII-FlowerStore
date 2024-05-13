<?php
$reportUser = getFlashData("report");

if(!empty($reportUser)):
    $count = 0;
    foreach($reportUser as $items):
        $count++;
    
?>

<tr style="border-bottom: 1px solid rgb(173, 173, 173) ;">
    <td><?php echo $count ?></td>
    <td><?php echo $items['user_id'] ?></td>
    <td><?php echo $items['fullName'] ?>1</td>

    <td>
        <?php
$date1=$filterAll['date1'];
$date2=$filterAll['date2'];

$userID = $items['user_id'];
                $Order = getRaw("SELECT * FROM orders WHERE user_id = '$userID' AND order_date BETWEEN '$date1' AND '$date2'");
                if(!empty($Order)){
                    foreach($Order as $odo){
                        ?>
        <a style="color: aliceblue;" class="btn btn-info"
            href="../orders/editquotation.php?order_id=<?=$odo['order_id'] ?>"><?php echo $odo['order_id']; ?><?php echo " - " ?><?php echo $odo['order_date']; ?></a>
        </br> </br>
        <?php
                    }
                }
            ?>

    </td>
    <td>$<?php echo $items['total'] ?></td>
</tr>
<?php
endforeach;
endif;

?>