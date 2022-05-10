<?php

include('header.php');

include('db_conn.php');

if(isset($_POST['submit'])){

	if(1 == 1){
	
		$query_clients_id = 'SELECT * FROM clients WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['clients_id']).'"';
		
		$result_clients_id = mysqli_query($conn, $query_clients_id) or die(mysqli_error($conn));
		
		if(mysqli_num_rows($result_clients_id) < 1){
		
		$row_clients_id = mysqli_fetch_array($result_clients_id);
		
            $query = 'INSERT INTO bank(`First Name`, `Last Name`, `Device`, `history`, `License No`, `App Ref`, `Notes`, `OBS`, `OBS_username`, `OBS_password`, `Booked For`, `Test Centre`, `Booked On`, `Status`) VALUES (
			"'.mysqli_real_escape_string($conn, $_POST['first_name']).'",
			"'.mysqli_real_escape_string($conn, $_POST['last_name']).'",
			"'.mysqli_real_escape_string($conn, $_POST['device']).'",
			"'.mysqli_real_escape_string($conn, $_POST['history']).'",
			"'.mysqli_real_escape_string($conn, $_POST['license_no']).'",
			"'.mysqli_real_escape_string($conn, $_POST['app_ref']).'",
			"'.mysqli_real_escape_string($conn, $_POST['notes']).'",
			"'.mysqli_real_escape_string($conn, $_POST['OBS']).'",
			"'.mysqli_real_escape_string($conn, $_POST['OBS_Username']).'",
			"'.mysqli_real_escape_string($conn, $_POST['OBS_Password']).'",
			"'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_for'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_for'])))).'",
			"'.mysqli_real_escape_string($conn, $_POST['test_centre']).'",
			"'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_on'])))).'",
			"'.mysqli_real_escape_string($conn, $_POST['Status']).'");';	
			
			
			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
			
			mysqli_close($conn);
			
			echo '<div class="ok">You successfully added the new pupil.<br>
			You will be automatically redirected to home page in 3 seconds.</div>';
			
			echo '<script>setTimeout(function(){ window.location.replace("index.php");}, 3000);</script>';
		
		}
		else{
		
			echo '<div class="nok">Does not exist client with number '.$_POST['clients_id'].'.</div>';	
		
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
