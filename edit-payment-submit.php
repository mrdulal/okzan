<?php

include('header.php');

include('db_conn.php');

if(isset($_POST['submit'])){

	if(1 == 1){
	
		//$query_clients_id = 'SELECT * FROM clients WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['clients_id']).'"';
		
		//$result_clients_id = mysqli_query($conn, $query_clients_id) or die(mysqli_error($conn));
		
		//if(mysqli_num_rows($result_clients_id) > 0){
	
			$query = 'UPDATE payments SET `Clients_ID` =  "'.mysqli_real_escape_string($conn, $_POST['clients_id']).'", `Payment Amount` = "'.mysqli_real_escape_string($conn, $_POST['payment_amount']).'", `Payment Date` = "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['payment_date'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d', strtotime($_POST['payment_date'])))).'", `Notes` = "'.mysqli_real_escape_string($conn, $_POST['notes']).'" WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['ID']).'";';
			
			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
			
			
			if(mysqli_affected_rows($conn) > 0){	
			
			echo '<div class="ok">You successfully updated your payment.<br>
			You will be automtically redirected to List of Payments Page in 3 seconds.</div>';
			
			echo '<script>setTimeout(function(){ window.location.replace("list-of-payments.php");}, 3000);</script>';
			
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

?>
