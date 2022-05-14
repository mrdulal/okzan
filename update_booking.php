

<?php



include('db_conn.php');


$query = 'UPDATE bookings SET			
			`clients_id` = "' . mysqli_real_escape_string($conn, $_POST['clients_id']) . '" ,
		    `app_ref` = "' . mysqli_real_escape_string($conn, $_POST['app_ref']) . '" ,
			`Temp Booking Date` =  "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['temp_booking_date'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['temp_booking_date'])))) . '",
			`Temp Booking Centre` = "' . mysqli_real_escape_string($conn, $_POST['temp_booking_centre']) . '",
			`Booked For` = "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_for'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_for'])))) . '",
			`Test Centre` = "' . mysqli_real_escape_string($conn, $_POST['test_center']) . '" ,
			`Booked On` = "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_on'])))) . '",
			`temp_booking_booked_on` = "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['temp_booking_booked_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['temp_booking_booked_on'])))) . '" ,
			`FEE` = "' . mysqli_real_escape_string($conn, $_POST['fee']) . '" ,
			`Total FEE` = "' . mysqli_real_escape_string($conn, $_POST['total_fee']) . '" ,
		    `Special Code` = "' . mysqli_real_escape_string($conn, $_POST['special_code']) . '" ,
			`Notes` = "' . mysqli_real_escape_string($conn, $_POST['notes']) . '" 
			WHERE ID = "' . mysqli_real_escape_string($conn, $_POST['id']) . '";';

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
if ($result) {
    echo "data was updated";
} else {
    $msg = "Error: " . $query . "<br>" . mysqli_error($connection);
    echo $msg;
}
