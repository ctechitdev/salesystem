<?php
include("../setting/checksession.php");
include("../setting/conn.php");

extract($_POST);

$stmt2 = $conn->prepare("call stp_edit_caculate_shop_stock_remain('$warehouse_id','$item_id','$sow_id');");
$stmt2->execute();
if ($stmt2->rowCount() > 0) {
    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {

        $remain_value  = $row2['remain_value'];

        if ($remain_value <= 0) {
            $remain_value = "nostock";
        }
    }
} else if (empty($stmt2->rowCount())) {
    $remain_value = "noitem";
}




if ($remain_value == "nostock") {
    $res = array("res" => "nostock");
} else if ($item_val  > $remain_value) {
    $res = array("res" => "overstock");
} else {

    $conn = null;
    include("../setting/conn.php");

        $update_data = $conn->query("
        update tbl_stock_out_warehouse_detail 
        set item_values = '$item_val'
        where sowd_id = '$sowd_id'  ");


        $res = array("res" => "success");
     
}







echo json_encode($res);
