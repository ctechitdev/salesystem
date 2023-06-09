<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ລາຍງານຍອດຂາຍຂອງສາຂາ";
$header_click = "10";

if (isset($_POST['btn_view'])) {

  $date_from = $_POST['date_from'];
  $date_to = $_POST['date_to'];
  $br_name = $_POST['br_name'];
} else {
  $date_from = date("Y-m-d");
  $date_to = date("Y-m-d");
  $br_name = "";
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

              <div class="card card-default ">

                <div class="card-body">


                  <form action="" method="post">

                    <div class="row">

                      <div class=" col-lg-12  mb-4  text-center">
                        <h2 class=" "> ສັງລວມຍອດຂາຍສາຂາ </h2>


                      </div>
                      <div class="form-group  col-lg-12">
                        <label class="text-dark font-weight-medium">ສາຂາ</label>
                        <div class="form-group">
                          <select class=" form-control font" name="br_name" id="br_name">
                            <option value=""> ເລືອກສາຂາ </option>
                            <?php
                            $stmt5 = $conn->prepare(" SELECT * FROM tbl_branch ");
                            $stmt5->execute();
                            if ($stmt5->rowCount() > 0) {
                              while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                            ?> <option value="<?php echo $row5['br_name']; ?>"> <?php echo $row5['br_name']; ?></option>
                            <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
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


                    <div class="tab-content">
                      <table id="" class="table table-product " style="width:100%">
                        <thead>
                          <tr>
                            <th>ລຳດັບ</th>
                            <th>ຊື່ສາຂາ</th>
                            <th>ຍອດຂາຍ</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php




                          $i = 1;
                          $total_bill_price = 0;
                          $stmt2 = $conn->prepare("  select sum(total_pay) as total_pay ,bs_id , br_name 
                          from tbl_bill_sale a
                          LEFT JOIN tbl_branch b on a.br_id = b.br_id 
                          where a.date_register between '$date_from' and '$date_to' and br_name like '%$br_name%'
                          group by a.br_id,br_name,bs_id
                  
                      ");
                          $stmt2->execute();
                          if ($stmt2->rowCount() > 0) {
                            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {

                              $pay_total = $row2['total_pay'];
                              $bs_id = $row2['bs_id'];
                              $br_name = $row2['br_name'];

                          ?>




                              <tr>
                                <td><?php echo "$i"; ?></td>
                                <td><?php echo $row2['br_name']; ?></td>
                                <td><?php echo number_format("$pay_total", 0, ",", ".") ?> ກີບ</td>

                              </tr>
                          <?php

                              $total_bill_price += $pay_total;
                              $i++;
                            }
                          }
                          ?>


                        </tbody>
                        <tfoot>

                          <tr>
                            <td></td>
                            <td class=""><b>ຍອດລວມ</b></td>
                            <td><b><?php echo number_format("$total_bill_price", 0, ",", ".") ?> ກີບ</b></td>
                          </tr>

                        </tfoot>
                      </table>
                    </div>

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