<?php

include('header.php');

include('db_conn.php');

if(isset($_POST['submit'])){

	if(1 == 1){
	
		$query_clients_id = 'SELECT * FROM clients WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['ID']).'"';
		
		$result_clients_id = mysqli_query($conn, $query_clients_id) or die(mysqli_error($conn));
		
		if(mysqli_num_rows($result_clients_id) > 0){		
		
			echo '<div class="nok">Duplicate entry for field ID.</div>';
		
		}
		else{
	
		$query = 'INSERT INTO clients(`ID`, `First Name`, `Last Name`, `Address Line 1`, `Address Town`, `Address Postcode`, `Email Address`, `Telephone`, `credit_limit`) VALUES ("'.mysqli_real_escape_string($conn, $_POST['ID']).'", "'.mysqli_real_escape_string($conn, $_POST['first_name']).'", "'.mysqli_real_escape_string($conn, $_POST['last_name']).'", "'.mysqli_real_escape_string($conn, $_POST['address_line_1']).'", "'.mysqli_real_escape_string($conn, $_POST['address_town']).'", "'.mysqli_real_escape_string($conn, $_POST['address_postcode']).'", "'.mysqli_real_escape_string($conn, $_POST['email_address']).'", "'.mysqli_real_escape_string($conn, $_POST['telephone']).'", "'.mysqli_real_escape_string($conn, $_POST['credit_limit']).'");';
		
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		
		mysqli_close($conn);
		
		echo '<div class="ok">You successfully added the new customer.<br>
		You will be automatically redirected to home page in 3 minutes.</div>';
		
		echo '<script>setTimeout(function(){ window.location.replace("index.php");}, 3000);</script>';
		
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