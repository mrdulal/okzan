<?php

include('header.php');

include('db_conn.php');

include('pagination.php');

$client_id = $_GET["ID"];
$query = "SELECT * FROM clients where ID = '$client_id'";
$result = mysqli_query($conn, $query);
$client = mysqli_fetch_assoc($result);

$arr = [];

// $query = "SELECT * FROM bookings where clients_id = '$client_id' AND `Temp Booking Code` = ''";
$query = "SELECT * FROM bookings where clients_id = '$client_id' OR `Temp Booking Code` = ''";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $arr_row = [];
    $arr_row["ID"] = $row["ID"];
    $arr_row["pupil"] = $row["First Name"] . " " . $row["Last Name"];
    $arr_row["test_fee"] = $row["FEE"];
    $arr_row["date"] = $row["Booked For"];
    $arr_row["test_centre"] = $row["Test Centre"];
    $arr_row["app_ref"] = $row["app_ref"];
    $arr_row["total_fee"] = $row["Total FEE"];
    $arr_row["booked_on"] = $row["Booked On"];
    $arr_row["notes"] = $row["Notes"];
    $arr_row["type"] = "bookings";
    array_push($arr, $arr_row);
}

// die;

$query = "SELECT * FROM payments where clients_id = '$client_id'";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $arr_row = [];
    $arr_row["ID"] = $row["ID"];
    $arr_row["pupil"] = "";
    $arr_row["test_fee"] = "";
    $arr_row["date"] = "";
    $arr_row["test_centre"] = "Paid £" . $row["Payment Amount"] . " " . date('d M Y', strtotime($row["Payment Date"]));
    $arr_row["total_fee"] = "-" . $row["Payment Amount"];
    $arr_row["booked_on"] = $row["Payment Date"];
    $arr_row["notes"] = $row["Notes"];
    $arr_row["type"] = "payments";
    array_push($arr, $arr_row);
}

$query = "SELECT * FROM statement_points where clients_id = '$client_id'";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $arr_row = [];
    $arr_row["ID"] = $row["ID"];
    $arr_row["pupil"] = "";
    $arr_row["test_fee"] = "";
    $arr_row["date"] = "";
    $arr_row["test_centre"] = "BALANCE " . date('d M Y, H:i:s', strtotime($row["date"]));
    $arr_row["total_fee"] = "";
    $arr_row["booked_on"] = $row["date"];
    $arr_row["notes"] = "";
    $arr_row["type"] = "statement_points";
    array_push($arr, $arr_row);
}

function date_sort($ele1, $ele2)
{
    $date1 = strtotime($ele1["booked_on"]);
    $date2 = strtotime($ele2["booked_on"]);
    $type1 = $ele1["type"];
    $type2 = $ele2["type"];

    if ($type1 == "bookings") {
        $type1 = 1;
    }

    if ($type1 == "payments") {
        $type1 = 2;
    }

    if ($type1 == "statement_points") {
        $type1 = 3;
    }

    if ($date1 - $date2 != 0) {
        return $date1 <=> $date2;
    } else {
        return $type1 <=> $type2;
    }
}

usort($arr, 'date_sort');
?>



<body class="zoom">
    <div class="button_father">
        <a href="list-of-clients.php">
            <button class="button">Back to Clients</button>
        </a>
    </div>
    <?php
    $total_pages_sql = 'SELECT COUNT(*) FROM clients';
    $result = mysqli_query($conn, $total_pages_sql);
    $totalitems = mysqli_fetch_array($result)[0];

    ?>


    <h1>Statement for: <span style="color:red;"><?php echo $client["ID"] . "  >   " . $client["First Name"]; ?></span>
    </h1>
    <div id="edit_message"></div>
    <div class="clear"></div>


    <?php

    $sql = 'SELECT * FROM clients ORDER BY ID ASC';
    $res_data = mysqli_query($conn, $sql) or die(mysqli_error($conn));


    // echo "<pre>";
    // print_r($arr);
    // echo "</pre>";
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <table class="table  table-hover table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="align-middle py-3">ID</th>
                            <th class="align-middle py-3">Pupil</th>
                            <th class="align-middle py-3">Test FEE</th>
                            <th class="align-middle py-3">Date & Time</th>
                            <th class="align-middle py-3">Test Centre</th>
                            <th class="align-middle py-3">Booking Ref</th>
                            <th class="align-middle py-3">Total FEE</th>
                            <th class="align-middle py-3">Booked On</th>
                            <th class="align-middle py-3">Note</th>
                            <th class="align-middle py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($arr); $i++) {
                        ?>
                            <tr style="color: <?php
                                                if ($arr[$i]["type"] == "bookings") {
                                                    echo 'black';
                                                }
                                                if ($arr[$i]["type"] == "payments") {
                                                    echo 'blue';
                                                }
                                                if ($arr[$i]["type"] == "statement_points") {
                                                    echo 'red';
                                                }
                                                ?>;">
                                <td class="align-middle"><?php echo $arr[$i]["ID"]; ?></td>
                                <td class="align-middle"><?php echo $arr[$i]["pupil"]; ?></td>
                                <td class="align-middle"><?php echo $arr[$i]["test_fee"]; ?></td>
                                <td class="align-middle">
                                    <?php echo $arr[$i]["date"] != "" ? date('D d M Y - h:ia', strtotime($arr[$i]["date"])) : ""; ?>
                                </td>
                                <td class="align-middle"><?php echo $arr[$i]["test_centre"]; ?></td>
                                <td class="align-middle"><?php echo $arr[$i]["app_ref"]; ?></td>
                                <td class="align-middle">
                                    <?php
                                    if ($arr[$i]["type"] != "statement_points") {
                                        echo $arr[$i]["total_fee"];
                                    } else {
                                        $statement = 0;
                                        for ($j = 0; $j < $i; $j++) {
                                            if ($arr[$j]["type"] != "statement_points") {
                                                $statement += floatval($arr[$j]["total_fee"]);
                                            }
                                        }
                                        echo $statement;
                                    }
                                    ?>
                                </td>
                                <td class="align-middle">
                                    <?php echo $arr[$i]["type"] == "bookings" ? date('D d M Y - h:ia', strtotime($arr[$i]["booked_on"])) : ""; ?>
                                </td>
                                <td class="align-middle"><?php echo $arr[$i]["notes"]; ?></td>
                                <td class="align-middle">
                                    <!-- <a class="first  " href="edit-booking.php?ID=<?php // echo $arr[$i]["ID"]; 
                                                                                        ?>">OLD Edit</a> -->
                                    <a class="first model_form " data-id="<?php echo $arr[$i]["ID"]; ?>" data-bs-toggle="modal" data-bs-target="#edit-<?php echo $arr[$i]["ID"]; ?>">Edit</a>

                                    <a href="delete-booking.php?ID=<?php echo $arr[$i]["ID"]; ?>&type=<?php echo $arr[$i]["type"]; ?>&client_id=<?php echo $client_id; ?>" class="first" onclick="return confirm('Are you sure delete this?')">Delete</a>
                                </td>
                                <div id="form_modal" class="modal " tabindex="-1" aria-labelledby="editbookinglabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editbookinglabel"><span id="pop_title">Edit</span>Booking With Number
                                                    <?php echo $arr[$i]["ID"]; ?> </h4>
                                                </h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <form method="post" action="#">

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="mb-3">
                                                                <input class="form-control" type="hidden" id="ID" name="ID" value="<?php echo $arr[$i]["ID"]; ?>">
                                                                <label for="pupils_id">Pupil's ID</label>
                                                                <input class="form-control" type="text" id="pupils_id" name="pupils_id" pattern="[0-9]+" readonly value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="Clients_ID">Clients ID</label>
                                                                <input class="form-control" type="text" id="Clients_ID" name="Clients_ID" value="">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="first_name">First Name</label>
                                                                <input class="form-control" type="text" id="first_name" name="first_name" readonly value="">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="last_name">Last Name</label>
                                                                <input class="form-control" type="text" id="last_name" name="last_name" readonly value="">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="app_ref">Application Reference</label>
                                                                <input class="form-control" type="text" id="app_ref" name="app_ref" value="">
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-3">

                                                            <label for="temp_booking_date">Temp Booking Date</label>
                                                            <div class="input-group mb-3">

                                                                <input class="form-control" type="text" id="temp_booking_date" name="temp_booking_date" placeholder="Format dd-mm-YYYY hh:mm(am/pm)" value="">
                                                            </div>


                                                            <div class="mb-3">
                                                                <label for="temp_booking_centre">Temp Booking Centre</label>
                                                                <input class="form-control" type="text" id="temp_booking_centre" name="temp_booking_centre" value="">
                                                            </div>
                                                            <label for="temp_booking_booked_on">Temp Booking Booked
                                                                On</label>
                                                            <div class="input-group mb-3">

                                                                <input class="form-control" type="text" id="temp_booking_booked_on" name="temp_booking_booked_on" value="" placeholder="Format dd-mm-YYYY hh:mm:ss">
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-3">

                                                            <label for="booked_for">Booked For</label>
                                                            <div class="input-group mb-3">
                                                                <input class="form-control" type="text" id="booked_for" name="booked_for" placeholder="Format dd-mm-YYYY hh:mm(am/pm)" value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="test_centre">Test Center</label>
                                                                <input class="form-control" type="text" id="test_centre" name="test_centre" value="">
                                                            </div>



                                                            <label for="booked_on">Booked On</label>
                                                            <div class="input-group mb-3">

                                                                <input type="text" class="form-control" id="booked_on" name="booked_on" placeholder="Format dd-mm-YYYY" aria-describedby="button-addon2" value="">
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-3">

                                                            <div class="mb-3">
                                                                <label for="fee">Test FEE</label>
                                                                <input class="form-control" type="text" class="edit_fee" id="fees" name="fee" value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="total_fee">Total FEE</label>
                                                                <input class="form-control" type="text" class="edit_fee_total" id="total_fee" name="total_fee" value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="special_code">Special Code</label>
                                                                <input class="form-control" type="text" id="special_code" name="special_code" value="">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="notes">Notes</label>
                                                                <textarea class="form-control" id="notes" name="notes" rows="5" cols="25"></textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <a href="#" name="form_data" class="button form_data">Update
                                                                    Booking</a>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </form>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-2">
                <a href="#" class="btn btn-success sticky_class" data-bs-toggle="modal" data-bs-target="#add-booking">Add New Payment</a>

                <div id="add-booking" class="modal " tabindex="-1" aria-labelledby=addbooking" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addbooking">Add New Payment</h4>
                                </h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">


                                <form method="post" action="#">
                                    <div class="mb-3">
                                        <label for="clients_id">Client's ID</label>
                                        <input type="text" class="form-control" name="clients_id" id="clients_id" value="<?php echo $client_id; ?>" readonly>
                                    </div>

                                    <div class="mb-3">

                                        <label for="payment_amount">Payment Amount</label>
                                        <input type="text" class="form-control" id="payment_amount" name="payment_amount" pattern="^\d*(\.\d{0,2})?$">
                                    </div>

                                    <label for="payment_date">Payment Date</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="payment_date" name="payment_date" placeholder="dd-mm-YYYY hh:mm:ss">
                                    </div>


                                    <div class="mb-3">
                                        <label for="notes">Notes</label>
                                        <textarea id="messages" class="form-control" name="notes" rows="5" cols="25"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <a id="addnewpayment" href="#" class="btn btn-success btn-block">Add New Payment</a>
                                    </div>

                                </form>


                            </div>
                        </div>
                    </div>
                </div>






            </div>
        </div>
    </div>
    <script src="src/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


    <script>
        $(document).ready(function() {

            //add new payment
            $("#addnewpayment").click(function(e) {
                e.preventDefault();
                var clients_id = $("#clients_id").val();
                var payment_amount = $("#payment_amount").val();
                var payment_date = $("#payment_date").val();
                var messagenotes = $.trim($("textarea#notes").val());
                var message = $('textarea#messages').val();
                //check the input fields
                if (clients_id == "" || payment_amount == "" || payment_date == "" || message == "") {
                    alert("Please fill all the fields");
                } else {
                    $.ajax({
                        url: "new-payment-submit.php",
                        method: "POST",
                        data: {
                            clients_id: clients_id,
                            payment_amount: payment_amount,
                            payment_date: payment_date,
                            notes: message
                        },
                        success: function(data) {
                            alert(data);
                            $("#add-booking").modal("hide");
                            location.reload();
                        }
                    });
                }
            });





            //Edit
            $(document).on('click', '.model_form', function() {
                var myModal = new bootstrap.Modal(document.getElementById('form_modal'), {
                    keyboard: false
                });
                myModal.show();

                var id = $(this).data('id');

                //ajax call for fetching data
                $.ajax({
                    url: "fetch_booking.php",
                    method: "GET",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(data) {

                        var len = data.length;
                        for (i = 0; i < len; i++) {

                            $('#form_modal').find('#ID').val(data[i].id);
                            $('#form_modal').find('#pupils_id').val(data[i].pupils_id);
                            $('#form_modal').find('#Clients_ID').val(data[i].clients_id);
                            $('#form_modal').find('#first_name').val(data[i].first_name);
                            $('#form_modal').find('#last_name').val(data[i].last_name);
                            $('#form_modal').find('#app_ref').val(data[i].app_ref);
                            $('#form_modal').find('#temp_booking_date').val(data[i].temp_booking_date);
                            $('#form_modal').find('#temp_booking_centre').val(data[i].temp_booking_centre);
                            $('#form_modal').find('#temp_booking_booked_on').val(data[i].temp_booking_booked_on);
                            $('#form_modal').find('#booked_for').val(data[i].booked_for);
                            $('#form_modal').find('#test_centre').val(data[i].test_center);
                            $('#form_modal').find('#booked_on').val(data[i].booked_on);
                            $('#form_modal').find('#fees').val(data[i].fee);
                            $('#form_modal').find('#total_fee').val(data[i].total_fee);
                            $('#form_modal').find('#special_code').val(data[i].special_code);
                            $('#form_modal').find('#notes').val(data[i].notes);
                        }
                    }
                });

            });





            // update the form_data
            $(document).on('click', '.form_data', function(e) {
                e.preventDefault();
                var myModal = new bootstrap.Modal(document.getElementById('form_modal'), {
                    keyboard: false
                });

                var id = $('#form_modal').find('#ID').val();

                $.ajax({
                    url: "update_booking.php",
                    method: "POST",
                    data: {
                        id: id,
                        pupils_id: $("#pupils_id").val(),
                        clients_id: $("#Clients_ID").val(),
                        first_name: $("#first_name").val(),
                        last_name: $("#last_name").val(),
                        app_ref: $("#app_ref").val(),
                        temp_booking_date: $("#temp_booking_date").val(),
                        temp_booking_centre: $("#temp_booking_centre").val(),
                        temp_booking_booked_on: $("#temp_booking_booked_on").val(),
                        booked_for: $("#booked_for").val(),
                        test_center: $("#test_centre").val(),
                        booked_on: $("#booked_on").val(),
                        fee: $("#fees").val(),
                        total_fee: $("#total_fee").val(),
                        special_code: $("#special_code").val(),
                        notes: $("#notes").val()
                    },
                    success: function(data) {
                        //redirect to specific page
                        alert("Booking Updated");
                        location.reload();
                        // window.location.href = "list-of-bookings.php";
                    }
                });


            });
        });
    </script>



    <?php
    /*$pagination = getPaginationString($page, $totalitems, $limit, $adjacents = 3, $targetpage = "list-of-clients.php", $pagestring = "?page=");

echo $pagination;*/

    include('footer.php');

    ?>