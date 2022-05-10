<?php

include('header.php');

include('db_conn.php');
if(isset($_POST['submit'])){

	if(1 == 1){
	
	
			$query = 'UPDATE bookings SET			
			`clients_id` = "'.mysqli_real_escape_string($conn, $_POST['Clients_ID']).'" ,
			`app_ref` = "'.mysqli_real_escape_string($conn, $_POST['app_ref']).'" ,
			`Temp Booking Date` =  "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['temp_booking_date'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['temp_booking_date'])))).'",
			`Temp Booking Centre` = "'.mysqli_real_escape_string($conn, $_POST['temp_booking_centre']).'",
			`Booked For` = "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_for'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_for'])))).'",
			`Test Centre` = "'.mysqli_real_escape_string($conn, $_POST['test_centre']).'" ,
			`Booked On` = "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_on'])))).'",
			`temp_booking_booked_on` = "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['temp_booking_booked_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['temp_booking_booked_on'])))).'" ,
			`FEE` = "'.mysqli_real_escape_string($conn, $_POST['fee']).'" ,
			`Total FEE` = "'.mysqli_real_escape_string($conn, $_POST['total_fee']).'" , `Special Code` = "'.mysqli_real_escape_string($conn, $_POST['special_code']).'" ,
			`Notes` = "'.mysqli_real_escape_string($conn, $_POST['notes']).'" 
			WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['ID']).'";';
			
			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                        $data_1update = mysqli_affected_rows($conn);
			
			if($data_1update){	
			
			echo '<div class="ok">You successfully updated your booking.<br>
			You will be automtically redirected to List of Bookings Page in 3 seconds.</div>';
			
			echo '<script>setTimeout(function(){ window.location.replace("list-of-bookings.php");}, 3000);</script>';
			
			mysqli_close($conn);
			
			}
			else {
			
				echo '<div class="nok">Update is unsuccessful.</div>';	
			
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

?>
