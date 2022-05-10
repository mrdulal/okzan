<?php

include('header.php');

include('db_conn.php');

if(isset($_POST['submit'])){

	if(1 == 1){
	
		//$query_clients_id = 'SELECT * FROM clients WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['clients_id']).'"';
		
		//$result_clients_id = mysqli_query($conn, $query_clients_id) or die(mysqli_error($conn));
		
		//if(mysqli_num_rows($result_clients_id) > 0){
	
			$query = 'UPDATE bank SET
			`First Name` = "'.mysqli_real_escape_string($conn, $_POST['first_name']).'",
			`Last Name` = "'.mysqli_real_escape_string($conn, $_POST['last_name']).'",
			`Device` = "'.mysqli_real_escape_string($conn, $_POST['device']).'",
			`history` = "'.mysqli_real_escape_string($conn, $_POST['history']).'",
			`License No` = "'.mysqli_real_escape_string($conn, $_POST['license_no']).'",
			`App Ref` = "'.mysqli_real_escape_string($conn, $_POST['app_ref']).'",
			`Notes` = "'.mysqli_real_escape_string($conn, $_POST['notes']).'",
			`OBS` = "'.mysqli_real_escape_string($conn, $_POST['OBS']).'",
			`OBS_username` = "'.mysqli_real_escape_string($conn, $_POST['OBS_Username']).'",
			`OBS_password` = "'.mysqli_real_escape_string($conn, $_POST['OBS_Password']).'",
			`Booked For` = "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_for'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_for'])))).'",
			`Test Centre` = "'.mysqli_real_escape_string($conn, $_POST['test_centre']).'",
			`Booked On` = "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['booked_on'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['booked_on'])))).'",
			`Status` = "'.mysqli_real_escape_string($conn, $_POST['Status']).'"			
			WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['ID']).'";';
			
			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
			
			
			if(mysqli_affected_rows($conn) > 0){	
			
			echo '<div class="ok">You successfully updated your pupil.<br>
			You will be automtically redirected to List of Bank in 300 miliseconds.</div>';
			
			echo '<script>setTimeout(function(){ window.location.replace("bank.php");}, 300);</script>';
			
			mysqli_close($conn);
			
			}
			else {
			
				echo '<div class="nok">Update is unsuccessful.</div>';	
			
			}
		
		//}
		//else{
		
			//echo '<div class="nok">Does not exist client with number '.$_POST['clients_id'].'.</div>';	
		
		//}
	
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
