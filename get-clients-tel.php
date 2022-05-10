<?php

include('db_conn.php');
$query_clients_id = 'SELECT * FROM clients WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['clients_id']).'"';
$result_clients_id = mysqli_query($conn, $query_clients_id) or die(mysqli_error($conn));
if(mysqli_num_rows($result_clients_id) > 0){
	while($row = mysqli_fetch_array($result_clients_id)){
		echo $row['Telephone'];
		
	}
}
else{
	echo 'Client does not exist';	
}

function rem($str){
	$result=preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $str);
	return $result;
}

?>
