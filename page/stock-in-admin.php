<?php
include("../setting/checksession.php");
include("../setting/conn.php");

$header_name = "ຮັບເຄື່ອງເຂົ້າສາງ";
$header_click = "2";


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

            <?php

            include "header.php";
            ?>
            <div class="content-wrapper">
                <div class="content">
                    <div class="row no-gutters">
                        <div class="col-lg-4 col-xxl-3">


                            <div class="card card-default chat-left-sidebar" style="height: 100%;">

                                <div class="form-status-holder"></div>

                                <div class="card-default ">
                                    <div class="card-header">



                                        <div class="form-group  col-lg-12">
                                            <img src="../images/Kp-Logo.png" width="100%" height="100%" alt="Mono">

                                        </div>

                                        <div class="row">

                                            <form method="post" class="contact-form card-header px-0  text-center"
                                                id="scanitemfrom">

                                                <input type="hidden" id="po_id" name="po_id" class="form-control"
                                                    value='<?php echo "$po_id"; ?>' autofocus>



                                                <div class="input-group px-5 mt-1">
                                                    <label class="text-dark font-weight-medium"> ສະແກນບາໂຄດ </label>
                                                </div>
                                                <div class="input-group px-5 p-4">
                                                    <input type="text" id="box_barcode" name="box_barcode"
                                                        class="form-control" autofocus required>
                                                </div>




                                                <div class="form-group  col-lg-12">
                                                    <label class="text-dark font-weight-medium">
                                                        <button type="submit" name="btn_add" id="btn_add"
                                                            class="btn btn-primary mb-2 btn-pill">ສະແກນ </button>
                                                    </label>

                                                </div>



                                            </form>


                                        </div>


                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-lg-8 col-xxl-9">

                            <form method="post" id="submittrack">


                                <div class="card card-default chat-right-sidebar text-center">

                                    <h2 class="mt-4 "> ສະແກນສິນຄ້າເຂົ້າສາງ </h2>


                                    <div class="form-group col-lg-12 mt-4">
                                        <div class="form-group">

                                            <select class=" form-control font" name="wh_id" id="wh_id" required>
                                                <option value=""> ເລືອກສາງ </option>
                                                <?php
                                                $stmt5 = $conn->prepare(" SELECT * FROM tbl_warehouse where br_id ='$br_id'  ");
                                                $stmt5->execute();
                                                if ($stmt5->rowCount() > 0) {
                                                    while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                <option value="<?php echo $row5['wh_id']; ?>">
                                                    <?php echo $row5['wh_name']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mt-6">
                                        <button type="submit" class="btn btn-primary mb-2 btn-pill">ຮັບເຂົ້າສາງ</button>
                                    </div>



                                    <div class="card-body pb-0 " data-simplebar style="height: 350px;">

                                        <div class="card-body">

                                            <table id="" class="table table-hover table-product" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>ເລກລຳດັບ</th>
                                                        <th>ຊື່ສິນຄ້າ</th>
                                                        <th>ເພີ່ມເຂົ້າສາງ</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    <?php
                                                    $stmt4 = $conn->prepare("select a.item_id,item_name,sum(item_values) as item_values 
                                                    from tbl_stock_in_warehouse_detail_pre a
                                                    left join tbl_item_data b on a.item_id = b.item_id
                                                    where add_by='$id_users' 
                                                    group by item_name,a.item_id ");
                                                    $stmt4->execute();
                                                    $i = 1;
                                                    if ($stmt4->rowCount() > 0) {
                                                        while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
                                                            $item_id = $row4['item_id'];
                                                            $item_name = $row4['item_name'];
                                                            $item_values = $row4['item_values'];


                                                            $x = 1;
                                                    ?>

                                                    <tr>



                                                        <td><?php echo "$i"; ?></td>
                                                        <input type="hidden" name="item_id[]"
                                                            id="item_id<?php echo $x; ?>"
                                                            value='<?php echo "$item_id"; ?>' class="form-control">

                                                        <td>
                                                            <?php
                                                                    echo mb_strimwidth("$item_name", 0, 50, "...");

                                                                    ?>

                                                        </td>
                                                        <td>
                                                            <?php
                                                                    echo "$item_values";
                                                                    ?>

                                                            <input type="hidden" name="item_values[]"
                                                                id="item_values<?php echo $x; ?>"
                                                                value='<?php echo "$item_values"; ?>'
                                                                class="form-control">


                                                        </td>

                                                        <td>
                                                            <div class="dropdown">
                                                                <a class="dropdown-toggle icon-burger-mini" href="#"
                                                                    role="button" id="dropdownMenuLink"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false" data-display="static">
                                                                </a>

                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuLink">
                                                                    <a rel="facebox"
                                                                        href="../modal/edit-stock-in-admin-pre.php?id=<?php echo $row4['item_id']; ?>"
                                                                        class="dropdown-item">ແກ້ໄຂ</a>
                                                                    <a class="dropdown-item" type="button"
                                                                        id="delstockinpre"
                                                                        data-id='<?php echo $row4['item_id']; ?>'
                                                                        class="btn btn-danger btn-sm">ລຶບ</a>

                                                                </div>
                                                            </div>
                                                        </td>


                                                    </tr>



                                                    <?php

                                                            $i++;
                                                            $x++;
                                                        }
                                                    }
                                                    ?>



                                                </tbody>
                                            </table>

                                        </div>


                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <div class="content-wrapper">
                <div class="content">
                    <!-- For Components documentaion -->


                    <div class="card card-default">

                        <div class="card-body">
                            <h4 class="text-dark">ລາຍການໂອນສິນຄ້າເຂົ້າສາງ</h4>
                            <table id="productsTable4" class="table table-hover table-product" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ເລກທີ</th>
                                        <th>ຊື່ສາງ</th>
                                        <th>ບິນອ້າງອີງ</th>
                                        <th>ສິນຄ້າເພິີ່ມເຂົ້າ</th>
                                        <th>ວັນທີ່</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php


                                    $stmt5 = $conn->prepare(" select a.siw_id,siw_bill_number,a.date_register,count(siwd_id) as count_item,wh_name 
                                    from tbl_stock_in_warehouse a
                                    left join tbl_stock_in_warehouse_detail b on a.siw_id = b.siw_id
                                    left join tbl_warehouse c on a.wh_id = c.wh_id
                                    where a.add_by ='$id_users'
                                    group by a.siw_id 
                                    order by  a.siw_id desc ");
                                    $stmt5->execute();
                                    $b = 1;
                                    if ($stmt5->rowCount() > 0) {
                                        while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {

                                    ?>

                                    <tr>
                                        <td><?php echo $row5['siw_id']; ?></td>
                                        <td><?php echo $row5['wh_name']; ?></td>
                                        <td><?php echo $row5['siw_bill_number']; ?></td>
                                        <td><?php echo $row5['count_item']; ?></td>
                                        <td><?php echo $row5['date_register']; ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" data-display="static">
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item"
                                                        href="edit-stock-in-admin.php?siw_id=<?php echo $row5['siw_id']; ?>">ແກ້ໄຂ</a>
                                                    <a class="dropdown-item" type="button" id="delstockin"
                                                        data-id='<?php echo $row5['siw_id']; ?>'
                                                        class="btn btn-danger btn-sm">ລຶບ</a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>


                                    <?php
                                            $b++;
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>
                    </div>


                </div>

            </div>

            <?php include "footer.php"; ?>
        </div>
    </div>




    <?php include("../setting/calljs.php"); ?>

    <script>
    $(function() {
        $('a[rel*=facebox]').facebox();
    });



    $(document).on("submit", "#updatestockadminpre", function() {
        $.post("../query/update-stock-in-admin-item-pre.php", $(this).serialize(), function(data) {
            if (data.res == "success") {

                let timerInterval
                Swal.fire({
                    icon: 'success',
                    title: 'ສຳເລັດ',
                    html: 'ແກ້ໄຂສຳເລັດ',
                    // timer: 10000,
                    timerProgressBar: true,
                    showConfirmButton: true,
                    showCloseButton: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    location.reload();
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })

            } else if (data.res == "error") {

                Swal.fire(
                    'ແຈ້ງເຕືອນ',
                    'ບໍ່ສາມາເຮັດລາຍການໄດ້',
                    'error'
                )

                setTimeout(
                    function() {
                        location.reload();
                    }, 1000);

            } else if (data.res == "notenoughtmoney") {

                Swal.fire(
                    'ແຈ້ງເຕືອນ',
                    'ຮັບເງິນບໍ່ພໍ',
                    'error'
                )


            }
        }, 'json');

        return false;
    });


    $(document).on("submit", "#submittrack", function() {
        $.post(
            "../query/confirm-add-stock-out-admin.php",
            $(this).serialize(),
            function(data) {
                if (data.res == "errorwarehouse") {
                    Swal.fire(" ແຈ້ງເຕືອນ",
                        "ບໍ່ມີສິນຄ້າ",
                        "error");
                } else if (data.res == "success") {
                    Swal.fire("ສຳເລັດ", "ເພີ່ມເຄື່ອງເຂົ້າສາງສຳເລັດ", "success");

                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            },
            "json"
        );

        return false;
    });

    // add item Data 
    $(document).on("submit", "#scanitemfrom", function() {
        $.post("../query/scan-stock-in-admin.php", $(this).serialize(), function(data) {
            if (data.res == "success") {

                location.reload();
            } else if (data.res == "limit") {
                Swal.fire(
                    'ແຈ້ງເຕືອນ',
                    'ສິນຄ້າ ' + data.limit_item.toUpperCase() + ' ບໍ່ສາມາດເພິ່ມເກີນໃບບິນ',
                    'error'
                )
                setTimeout(
                    function() {
                        location.reload();
                    }, 2000);
            } else if (data.res == "nofound") {
                Swal.fire(
                    'ແຈ້ງເຕືອນ',
                    'ລະຫັດສິນຄ້າ ' + data.item_code.toUpperCase() + ' ບໍ່ມີໃນລະບົບ',
                    'error'
                )
                setTimeout(
                    function() {
                        location.reload();
                    }, 2000);
            } else if (data.res == "nostock") {
                Swal.fire(
                    'ແຈ້ງເຕືອນ',
                    'ລະຫັດສິນຄ້າ ' + data.item_code.toUpperCase() + ' ບໍ່ມີໃນສາງ',
                    'error'
                )
                setTimeout(
                    function() {
                        location.reload();
                    }, 2000);
            } else if (data.res == "noorder") {
                Swal.fire(
                    'ແຈ້ງເຕືອນ',
                    'ລະຫັດສິນຄ້າ ' + data.item_code.toUpperCase() + ' ບໍ່ມີການຈັດຊື້',
                    'error'
                )
                setTimeout(
                    function() {
                        location.reload();
                    }, 2000);
            }
        }, 'json');

        return false;
    });


    // add track check Data
    $(document).on("submit", "#submittrack", function() {
        $.post(
            "../query/confirm-add-stock-in-addmin.php",
            $(this).serialize(),
            function(data) {
                if (data.res == "nowarehouse") {
                    Swal.fire(" ແຈ້ງເຕືອນ",
                        "ກະລຸນາເລືອກສາງ",
                        "error");
                } else if (data.res == "success") {
                    Swal.fire("ສຳເລັດ", "ເພີ່ມເຄື່ອງເຂົ້າສາງສຳເລັດ", "success");

                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                }
            },
            "json"
        );

        return false;
    });


    // Delete item
    $(document).on("click", "#delstockin", function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            type: "post",
            url: "../query/delete-stock-in-admin.php",
            dataType: "json",
            data: {
                id: id
            },
            cache: false,
            success: function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ລຶບຂໍ້ມູນສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            window.location.href = 'stock-in-admin.php';
                        }, 1000);

                } else if (data.res == "used") {
                    Swal.fire(
                        'ນຳໃຊ້ແລ້ວ',
                        'ບໍ່ສາມາດລຶບໄດ້ເນື່ອງຈາກນຳໃຊ້ໄປແລ້ວ',
                        'error'
                    )
                }

            },
            error: function(xhr, ErrorStatus, error) {
                console.log(status.error);
            }

        });
        return false;
    });

    // Delete item
    $(document).on("click", "#delstockinpre", function(e) {
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            type: "post",
            url: "../query/delete-detail-stock-in-pre-admin.php",
            dataType: "json",
            data: {
                id: id
            },
            cache: false,
            success: function(data) {
                if (data.res == "success") {
                    Swal.fire(
                        'ສຳເລັດ',
                        'ລຶບຂໍ້ມູນສຳເລັດ',
                        'success'
                    )
                    setTimeout(
                        function() {
                            location.reload();
                        }, 1000);

                } else if (data.res == "used") {
                    Swal.fire(
                        'ນຳໃຊ້ແລ້ວ',
                        'ບໍ່ສາມາດລຶບໄດ້ເນື່ອງຈາກນຳໃຊ້ໄປແລ້ວ',
                        'error'
                    )
                }

            },
            error: function(xhr, ErrorStatus, error) {
                console.log(status.error);
            }

        });
        return false;
    });



    function addRow() {
        $("#addRowBtn").button("loading");

        var tableLength = $("#productTable tbody tr").length;

        var tableRow;
        var arrayNumber;
        var count;

        if (tableLength > 0) {
            tableRow = $("#productTable tbody tr:last").attr('id');
            arrayNumber = $("#productTable tbody tr:last").attr('class');
            count = tableRow.substring(3);
            count = Number(count) + 1;
            arrayNumber = Number(arrayNumber) + 1;
        } else {
            // no table row
            count = 1;
            arrayNumber = 0;
        }

        $.ajax({
            url: '../query/item_list.php',
            type: 'post',
            dataType: 'json',
            success: function(response) {
                $("#addRowBtn").button("reset");



                var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +


                    '<td>' +
                    '<div class="form-group">ລາຍການທີ: ' + count +
                    '<div class="row p-2">' +

                    '<div class="col-lg-3">' +
                    '<div class="form-group">' +
                    '<label for="firstName">ຊື່ສິນຄ້າ</label>' +


                    '<select class="form-control" name="item_name[]" id="item_name' + count + '" >' +
                    '<option value="">ເລືອກສິນຄ້າ</option>';
                $.each(response, function(index, value) {
                    tr += '<option value="' + value[0] + '">' + value[1] + '</option>';
                });
                tr += '</select>' +

                    '</div>' +
                    '</div>' +

                    '<div class="form-group  col-lg-3">' +
                    '<label class="text-dark font-weight-medium">ຈຳນວນ</label>' +
                    '<div class="form-group">' +
                    '<input type="number" step ="any" name="item_value[]" id="item_value' + count +
                    '" autocomplete="off" class="form-control" />' +
                    '</div>' +
                    '</div>' +

                    '<div class="form-group  col-lg-3">' +
                    '<label class="text-dark font-weight-medium">ລາຄາລວມ</label>' +
                    '<div class="form-group">' +
                    '<input type="number" step ="any" name="price_total[]" id="price_total' + count +
                    '" autocomplete="off" class="form-control" />' +
                    '</div>' +
                    '</div>' +




                    '<div class="col-lg-3">' +

                    '<div class="form-group p-6">' +
                    '<button type="button" class="btn btn-primary btn-flat removeProductRowBtn"   onclick="addRow(' +
                    count + ')"> <i class="mdi mdi-briefcase-plus"></i></button>' +

                    '<button type="button" class="btn btn-danger removeProductRowBtn ml-1" type="button" onclick="removeProductRow(' +
                    count + ')"><i class="mdi mdi-briefcase-remove"></i></i></button>' +

                    '</div>' +
                    '</div>' +







                    '</div>' +
                    '</div>' +




                    '</td>' +


                    '</tr>';
                if (tableLength > 0) {
                    $("#productTable tbody tr:last").after(tr);
                } else {
                    $("#productTable tbody").append(tr);
                }

            } // /success
        }); // get the product data

    } // /add row

    function removeProductRow(row = null) {
        if (row) {
            $("#row" + row).remove();


            subAmount();
        } else {
            alert('error! Refresh the page again');
        }
    }
    </script>

    <!--  -->


</body>

</html>