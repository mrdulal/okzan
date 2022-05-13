<?php

// require clipboard function in php 
// require 'Clipboard.php';
/////////////////////////////
include('header.php');

include('db_conn.php');

if (isset($_POST['submit'])) {

	if (1 == 1) {

		$query_clients_id = 'SELECT * FROM clients WHERE ID = "' . mysqli_real_escape_string($conn, $_POST['clients_id']) . '"';


		$result_clients_id = mysqli_query($conn, $query_clients_id) or die(mysqli_error($conn));

		if (mysqli_num_rows($result_clients_id) > 0) {

			$row_clients_id = mysqli_fetch_array($result_clients_id);

			$query = 'INSERT INTO pupils(`bankID`, `Title`, `First Name`, `Last Name`, `FEE`, `Date of Birth`, `Code`, `Device`, `Applied On`, `License No`, `App Ref`, `Eligible Date`, `Theory Exp`, `Theory Cert`, `Address Line 1`, `Address Town`, `Address Postcode`, `Email Address`, `Telephone`, `Notes`, `Clients_ID`, `Temp Booking Date`, `Temp Booking Centre`, `Temp Booking Code`, `OBS`,`Booked For`, `Test Centre`, `Booked On`, `Special Code`) VALUES ("' . mysqli_real_escape_string($conn, $_POST['bankID']) . '","' . mysqli_real_escape_string($conn, $_POST['title']) . '", "' . mysqli_real_escape_string($conn, $_POST['first_name']) . '", "' . mysqli_real_escape_string($conn, $_POST['last_name']) . '", "' . mysqli_real_escape_string($conn, $_POST['fee']) . '", "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['date_of_birth'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d', strtotime($_POST['date_of_birth'])))) . '", "' . mysqli_real_escape_string($conn, $_POST['code']) . '", "' . mysqli_real_escape_string($conn, $_POST['device']) . '", "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['applied_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['applied_on'])))) . '", "' . mysqli_real_escape_string($conn, $_POST['license_no']) . '", "' . mysqli_real_escape_string($conn, $_POST['app_ref']) . '", "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['eligible_date'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['eligible_date'])))) . '", "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['theory_exp'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['theory_exp'])))) . '", "' . mysqli_real_escape_string($conn, $_POST['theocert']) . '", "' . mysqli_real_escape_string($conn, $_POST['address_line_1']) . '", "' . mysqli_real_escape_string($conn, $_POST['address_town']) . '", "' . mysqli_real_escape_string($conn, $_POST['address_postcode']) . '", "' . rem(mysqli_real_escape_string($conn, $_POST['email_address'])) . '", "' . rem(mysqli_real_escape_string($conn, $_POST['telephone'])) . '", "' . mysqli_real_escape_string($conn, $_POST['notes']) . '", "' . mysqli_real_escape_string($conn, $row_clients_id['ID']) . '", "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['temp_booking_date'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['temp_booking_date'])))) . '", "' . mysqli_real_escape_string($conn, $_POST['temp_booking_centre']) . '", "' . mysqli_real_escape_string($conn, $_POST['temp_booking_code']) . '", "' . mysqli_real_escape_string($conn, $_POST['OBS']) . '", "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_for'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_for'])))) . '", "' . mysqli_real_escape_string($conn, $_POST['test_centre']) . '", "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_on'])))) . '", "' . mysqli_real_escape_string($conn, $_POST['special_code']) . '");';

			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));





			//get current ID after save
			$query_id = 'SELECT * FROM pupils WHERE ID = "' . mysqli_insert_id($conn) . '"';

			$result_id = mysqli_query($conn, $query_id) or die(mysqli_error($conn));

			$row_id = mysqli_fetch_array($result_id);

			echo "<pre>";
			// var_dump($row_id["ID"]);



			mysqli_close($conn);



			// die;
			echo '<div class="ok">You successfully added the new pupil.<br>
			You will be automatically redirected to Bank page in 500 miliseconds.</div>';

			//get current id after saved
			$insert_id = $row_id["ID"];

			// copy insert_id 

			if (!empty($insert_id)) {
				// return to new-pupil-results.php with insert_id
				header("Refresh:0.5; url=new-pupil-results.php?id=" . $insert_id);
			}
			// echo '<script>setTimeout(function(){ window.location.replace("bank.php");}, 500);</script>';
		} else {

			echo '<div class="nok">Does not exist client with number ' . $_POST['clients_id'] . '.</div>';
		}
	} else {

		echo '<div class="nok">All fields are required. Please go back and fill them.</div>';
	}
} else {

	echo '<div class="nok">There is something wrong. Please try to fill the form again.</div>';
}

include('footer.php');

function rem($str)
{
	$result = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $str);
	return $result;
}