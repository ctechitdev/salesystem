<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ລາຍງານເບີກສິນຄ້າໜ້າຮ້ານ";
$header_click = "10";

if (isset($_POST['btn_view'])) {

    $date_from = $_POST['date_from'];
    $date_to = $_POST['date_to'];
} else {
    $date_from = date("Y-m-d");
    $date_to = date("Y-m-d");
}


?>


<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php

    include("../setting/callcss.php");

    ?>

</head>
<script src="../plugins/nprogress/nprogress.js"></script>

<body class="navbar-fixed sidebar-fixed" id="body">


    <div class="wrapper">

        <?php include "menu.php"; ?>

        <div class="page-wrapper">

            <?php include "header.php"; ?>

            <div class="content-wrapper">
                <div class="content">

                    <div class="row">
                        <div class="col-xl-12">

                            <div class="card card-default">

                                <div class="card-body">
                                    <div class="tab-content">

                                        <form action="" method="post">

                                            <div class="row">

                                                <div class=" col-lg-12  mb-4  text-center">
                                                    <h2 class=" "> ລາຍການເບີກສິນຄ້າເພື່ອຂາຍ </h2>


                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="firstName">ຈາກວັນທີ</label>
                                                        <input type="date" class="form-control" id="date_from" name="date_from" value="<?php echo "$date_from"; ?>" />
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="firstName">ຫາວັນທີ</label>
                                                        <input type="date" class="form-control" id="date_to" name="date_to" value="<?php echo "$date_to"; ?>" />
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="d-flex justify-content-end mt-6">
                                                <button type="submit" name="btn_view" class="btn btn-primary mb-2 btn-pill">ສະແດງ</button>
                                            </div>

                                            <table id="dashboardremain" class="table table-product " style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>ລຳດັບ</th>
                                                        <th>ຊື່ສິນຄ້າ</th>
                                                        <th>ເບີກອອກຮ້ານ</th>
                                                        <th>ຊື່ສາງ</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php

                                                    $stmt2 = $conn->prepare("    
                                                    select sum(item_values) as item_values,a.item_id ,item_name,wh_name from tbl_deburse_item_pre_sale_detail a 
                                                    left join tbl_deburse_item_pre_sale d on d.dips_id = a.dips_id 
                                                    left join tbl_warehouse b on d.wh_id = b.wh_id 
                                                    left join tbl_item_data c on a.item_id = c.item_id 
                                                    where d.date_register between '$date_from' and '$date_to' 
                                                    group by a.item_id,item_name,wh_name

                                                    ");
                                                    $stmt2->execute();

                                                    if ($stmt2->rowCount() > 0) {
                                                        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {

                                                    ?>

                                                            <tr>
                                                                <td><?php echo $row2['item_id']; ?> </td>
                                                                <td><?php echo $row2['item_name']; ?> </td>
                                                                <td><?php echo $row2['item_values']; ?> </td>
                                                                <td><?php echo $row2['wh_name']; ?> </td>


                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    $conn = null;
                                                    include("../setting/conn.php");
                                                    ?>




                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>




                    </div>

                    <?php include "footer.php"; ?>

                </div>
            </div>



            <?php include("../setting/calljs.php"); ?>


</body>

</html>