<?php

include('header.php');

include('db_conn.php');

if (isset($_POST['submit'])) {



	//  echo $_POST['ID'];
	//  die();
	if (1 == 1) {

		//$query_clients_id = 'SELECT * FROM clients WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['clients_id']).'"';

		//$result_clients_id = mysqli_query($conn, $query_clients_id) or die(mysqli_error($conn));

		//if(mysqli_num_rows($result_clients_id) > 0){

		$query = 'UPDATE pupils SET
			`bankID` =  "' . mysqli_real_escape_string($conn, $_POST['bankID']) . '",		
			`Title` =  "' . mysqli_real_escape_string($conn, $_POST['title']) . '",
			`First Name` = "' . mysqli_real_escape_string($conn, $_POST['first_name']) . '",
			`Last Name` = "' . mysqli_real_escape_string($conn, $_POST['last_name']) . '",
			`FEE` = "' . mysqli_real_escape_string($conn, $_POST['fee']) . '",
			`Date of Birth` =  "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['date_of_birth'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d', strtotime($_POST['date_of_birth'])))) . '",
			`Code` = "' . mysqli_real_escape_string($conn, $_POST['code']) . '",
			`Device` = "' . mysqli_real_escape_string($conn, $_POST['device']) . '",
			`history` = "' . mysqli_real_escape_string($conn, $_POST['history']) . '",
			`Applied On` =  "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['applied_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['applied_on'])))) . '",
			`License No` = "' . mysqli_real_escape_string($conn, $_POST['license_no']) . '",
			`App Ref` = "' . mysqli_real_escape_string($conn, $_POST['app_ref']) . '",
			`Eligible Date` =  "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['eligible_date'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['eligible_date'])))) . '",
			`Theory Exp` = "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['theory_exp'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['theory_exp'])))) . '",
			`Theory Cert` = "' . mysqli_real_escape_string($conn, $_POST['theocert']) . '",
			`Address Line 1` = "' . mysqli_real_escape_string($conn, $_POST['address_line_1']) . '",
			`Address Town` = "' . mysqli_real_escape_string($conn, $_POST['address_town']) . '",
			`Address Postcode` = "' . mysqli_real_escape_string($conn, $_POST['address_postcode']) . '",
			`Email Address` = "' . rem(mysqli_real_escape_string($conn, $_POST['email_address'])) . '" ,
			`Telephone` = "' . rem(mysqli_real_escape_string($conn, $_POST['telephone'])) . '",
			`Notes` = "' . mysqli_real_escape_string($conn, $_POST['notes']) . '",
			`Clients_ID` = "' . mysqli_real_escape_string($conn, $_POST['clients_id']) . '",
			`Temp Booking Date` = "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['temp_booking_date'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['temp_booking_date'])))) . '",
			`Temp Booking Centre` = "' . mysqli_real_escape_string($conn, $_POST['temp_booking_centre']) . '",
			`Temp Booking Code` = "' . mysqli_real_escape_string($conn, $_POST['temp_booking_code']) . '",
			`OBS` = "' . mysqli_real_escape_string($conn, $_POST['OBS']) . '",
			`Booked For` = "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_for'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_for'])))) . '",
			`Test Centre` = "' . mysqli_real_escape_string($conn, $_POST['test_centre']) . '",
			`Booked On` = "' . mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_on'])))) . '",
			`Special Code` = "' . mysqli_real_escape_string($conn, $_POST['special_code']) . '",	
			`status` = "' . mysqli_real_escape_string($conn, $_POST['status']) . '"			
			WHERE ID = "' . mysqli_real_escape_string($conn, $_POST['ID']) . '";';

		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));


		if (mysqli_affected_rows($conn) > 0) {

			echo '<div class="ok">You successfully updated your pupil.<br>
			You will be automtically redirected to Bank in 200 milliseconds.</div>';

			echo '<script>setTimeout(function(){ window.location.replace("bank.php");}, 200);</script>';

			mysqli_close($conn);
		} else {

			echo '<div class="nok">Update is unsuccessful.</div>';
		}

		//}
		//else{

		//echo '<div class="nok">Does not exist client with number '.$_POST['clients_id'].'.</div>';	

		//}

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