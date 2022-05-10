<?php

include('header.php');

include('db_conn.php');

if(isset($_POST['submit'])){

	if(1 == 1){
	
		$query_clients_id = 'SELECT * FROM clients WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['clients_id']).'"';
		
		$result_clients_id = mysqli_query($conn, $query_clients_id) or die(mysqli_error($conn));
		
		if(mysqli_num_rows($result_clients_id) > 0){
	
			$query = 'INSERT INTO payments(`Clients_ID`, `Payment Amount`, `Payment Date`, `Notes`) VALUES ("'.mysqli_real_escape_string($conn, $_POST['clients_id']).'", "'.mysqli_real_escape_string($conn, $_POST['payment_amount']).'", "'.mysqli_real_escape_string($conn, ($is_admin = ($_POST['payment_date'] == '') ? '0000-00-00 00:00:00' : date('Y-m-d H:i:s', strtotime($_POST['payment_date'])))).'", "'.mysqli_real_escape_string($conn, $_POST['notes']).'");';
			
			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
			
			mysqli_close($conn);
			
			echo '<div class="ok">You successfully added the new payment.<br>
			You will be automatically redirected to home page in 3 minutes.</div>';
			
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

?>
