<?php

include('db_conn.php');
$query_pupils_id = 'SELECT * FROM pupils WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['pupils_id']).'"';
$result_pupils_id = mysqli_query($conn, $query_pupils_id) or die(mysqli_error($conn));

if(mysqli_num_rows($result_pupils_id) > 0){
	while($row = mysqli_fetch_array($result_pupils_id)){
		echo $row['FEE'];
	}
}
else{
	echo 'Does not exist pupil with that number';	
}

?>