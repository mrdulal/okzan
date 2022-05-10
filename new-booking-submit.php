<?php

include('header.php');

include('db_conn.php');

if(isset($_POST['submit'])){

	if(1 == 1){
	
		$query_pupils_id = 'SELECT * FROM pupils WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['pupils_id']).'"';
		
		$result_pupils_id = mysqli_query($conn, $query_pupils_id) or die(mysqli_error($conn));
		
		if(mysqli_num_rows($result_pupils_id) > 0){	
	
			$query = 'INSERT INTO bookings(`Temp Booking Date`, `Temp Booking Centre`, `Temp Booking Code`, `Booked For`, `Test Centre`, `Booked On`, `temp_booking_booked_on`, `FEE`, `Total FEE`, `Pupils_ID`, `Special Code`, `Notes`, `clients_id`, `First Name`, `Last Name`) VALUES ("'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['temp_booking_date'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['temp_booking_date'])))).'", "'.mysqli_real_escape_string($conn, $_POST['temp_booking_centre']).'", "'.mysqli_real_escape_string($conn, $_POST['temp_booking_code']).'", "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_for'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_for'])))).'", "'.mysqli_real_escape_string($conn, $_POST['test_centre']).'", "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_on'])))).'", "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['temp_booking_booked_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['temp_booking_booked_on'])))).'", "'.mysqli_real_escape_string($conn, $_POST['fee']).'", "'.mysqli_real_escape_string($conn, $_POST['total_fee']).'", "'.mysqli_real_escape_string($conn, $_POST['pupils_id']).'", "'.mysqli_real_escape_string($conn, $_POST['special_code']).'", "'.mysqli_real_escape_string($conn, $_POST['notes']).'", "'. rem($_POST['clients_ID']).'","'.rem($_POST['firstname']).'","'.rem($_POST['lastname']).'");';
			
			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));			
			
			$query_update = 'UPDATE pupils SET `Temp Booking Date` = "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['temp_booking_date'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['temp_booking_date'])))).'", `Temp Booking Centre` = "'.mysqli_real_escape_string($conn, $_POST['temp_booking_centre']).'", `Temp Booking Code` = "'.mysqli_real_escape_string($conn, $_POST['temp_booking_code']).'", `Booked For` = "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_for'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_for'])))).'", `Test Centre` = "'.mysqli_real_escape_string($conn, $_POST['test_centre']).'", `Booked On` = "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_on'])))).'", `FEE` = "'.mysqli_real_escape_string($conn, $_POST['fee']).'", `Special Code` = "'.mysqli_real_escape_string($conn, $_POST['special_code']).'" WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['pupils_id']).'"; ';
			
			$result_update = mysqli_query($conn, $query_update) or die(mysqli_error($conn));
			
			mysqli_close($conn);
			
			echo '<div class="ok">You successfully added the new booking.<br>
			You will be automatically redirected to home page in 3 minutes.</div>';
			
			echo '<script>setTimeout(function(){ window.location.replace("index.php");}, 3000);</script>';
		
		}
		else{
			/*$query = 'INSERT INTO bookings(`Temp Booking Date`, `Temp Booking Centre`, `Temp Booking Code`, `Booked For`, `Test Centre`, `Booked On`, `temp_booking_booked_on`, `FEE`, `Total FEE`, `Pupils_ID`, `Special Code`, `Notes`, `clients_ID`, `First Name`, `Last Name`) VALUES ("'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['temp_booking_date'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['temp_booking_date'])))).'", "'.mysqli_real_escape_string($conn, $_POST['temp_booking_centre']).'", "'.mysqli_real_escape_string($conn, $_POST['temp_booking_code']).'", "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_for'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_for'])))).'", "'.mysqli_real_escape_string($conn, $_POST['test_centre']).'", "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_on'])))).'", "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['temp_booking_booked_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['temp_booking_booked_on'])))).'", "'.mysqli_real_escape_string($conn, $_POST['fee']).'", "'.mysqli_real_escape_string($conn, $_POST['total_fee']).'", "'.mysqli_real_escape_string($conn, $_POST['pupils_id']).'", "'.mysqli_real_escape_string($conn, $_POST['special_code']).'", "'.mysqli_real_escape_string($conn, $_POST['notes']).'", "'.mysqli_real_escape_string($conn, $_POST['clients_ID']).'","'.mysqli_real_escape_string($conn, $_POST['firstname']).'","'.mysqli_real_escape_string($conn, $_POST['lastname']).'");';
			
			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
			mysqli_close($conn);
			echo '<div class="ok">You successfully added the new booking.<br>
			You will be automatically redirected to home page in 3 minutes.</div>';
			
			echo '<script>setTimeout(function(){ window.location.replace("index.php");}, 3000);</script>';*/
			echo '<div class="nok">Does not exist pupil with number '.$_POST['pupils_id'].'.</div>';	
		
		}		
	
	}
	else{
	
		echo '<div class="nok">All fields are required. Please go back and fill them.</div>';		
	
	}


}
else{

	echo '<div class="nok">There is something wrong. Please try to fill the form again.</div>';
	
}
 
include('footer.php');
function rem($str){
	$result=preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $str);
	return $result;
}
?>