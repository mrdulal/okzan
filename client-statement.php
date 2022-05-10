<?php

include('header.php');

include('db_conn.php');

include('pagination.php');

$client_id = $_GET["ID"];
$query = "select * from clients where ID = '$client_id'";
$result = mysqli_query($conn, $query);
$client = mysqli_fetch_assoc($result);

$arr = [];

$query = "select * from bookings where clients_ID = '$client_id' AND `Temp Booking Code` = ''";
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


$query = "select * from payments where Clients_ID = '$client_id'";
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

$query = "select * from statement_points where clients_ID = '$client_id'";
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

<title>Client Statement</title>
</head>

<body style="" class="zoom">

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
    ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Pupil</th>
            <th>Test FEE</th>
            <th>Date & Time</th>
            <th>Test Centre</th>
            <th>Booking Ref</th>
            <th>Total FEE</th>
            <th>Booked On</th>
            <th>Note</th>
            <th>Actions</th>
        </tr>
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
            <td><?php echo $arr[$i]["ID"]; ?></td>
            <td><?php echo $arr[$i]["pupil"]; ?></td>
            <td><?php echo $arr[$i]["test_fee"]; ?></td>
            <td><?php echo $arr[$i]["date"] != "" ? date('D d M Y - h:ia', strtotime($arr[$i]["date"])) : ""; ?></td>
            <td><?php echo $arr[$i]["test_centre"]; ?></td>
            <td><?php echo $arr[$i]["app_ref"]; ?></td>
            <td>
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
            <td><?php echo $arr[$i]["type"] == "bookings" ? date('D d M Y - h:ia', strtotime($arr[$i]["booked_on"])) : ""; ?>
            </td>
            <td><?php echo $arr[$i]["notes"]; ?></td>
            <td>
                <a href="edit-booking.php?ID=<?php echo $arr[$i]["ID"]; ?>" class="first">Edit</a>
                <a href="delete-booking.php?ID=<?php echo $arr[$i]["ID"]; ?>&type=<?php echo $arr[$i]["type"]; ?>&client_id=<?php echo $client_id; ?>"
                    class="first" onclick="return confirm('Are you sure delete this?')">Delete</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>

    <?php
    /*$pagination = getPaginationString($page, $totalitems, $limit, $adjacents = 3, $targetpage = "list-of-clients.php", $pagestring = "?page=");

echo $pagination;*/

    include('footer.php');

    ?>