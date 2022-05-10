<?php

include('header.php');

include('db_conn.php');

$text_active = $_POST['text_active'];
$id_active = $_POST['id_active'];
$is_date = $_POST['is_date'];


if($is_date == 1){

$text_active = str_replace(' - ', ' ', $_POST['text_active']);

	$text_active = date( 'Y-m-d H:i:s' , strtotime($text_active));

}

$explode = explode('**', $id_active);


if(!is_numeric($explode[2])){
	echo($injection = '"'.$explode[2].'"');
}
else{
	echo($injection = $explode[2]);

}

	
		$query = 'UPDATE '.$explode[0].' SET '.$explode[1].' = "'.mysqli_real_escape_string($conn, $text_active).'" WHERE ID = '.$injection;
		
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		
		if(mysqli_affected_rows($conn) > 0){		
		
			echo 'ok';
		
		}
		else{
		
			echo 'Something went wrong with saving updated value.';
		
		}


mysqli_close($conn);

include('footer.php');

?>