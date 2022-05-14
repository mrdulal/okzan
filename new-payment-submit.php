<?php

include('db_conn.php');


$query_clients_id = 'SELECT * FROM clients WHERE ID = "' . mysqli_real_escape_string($conn, $_POST['clients_id']) . '"';

$result_clients_id = mysqli_query($conn, $query_clients_id) or die(mysqli_error($conn));

if (mysqli_num_rows($result_clients_id) > 0) {

	$query = 'INSERT INTO payments(`Clients_ID`, `Payment Amount`, `Payment Date`, `Notes`) VALUES ("' . mysqli_real_escape_string($conn, $_POST['clients_id']) . '", "' . mysqli_real_escape_string($conn, $_POST['payment_amount']) . '", "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['payment_date'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['payment_date'])))) . '", "' . mysqli_real_escape_string($conn, $_POST['notes']) . '");';

	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	if ($result=== TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	// mysqli_close($conn);
}
