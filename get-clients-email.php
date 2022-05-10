<?php

include('db_conn.php');
$query_clients_id = 'SELECT * FROM clients WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['clients_id']).'"';
$result_clients_id = mysqli_query($conn, $query_clients_id) or die(mysqli_error($conn));
if(mysqli_num_rows($result_clients_id) > 0){
	while($row = mysqli_fetch_array($result_clients_id)){
		echo $row['Email Address'];
	}
}
else{
	echo 'Does not exist pupil with that number';	
}

?>