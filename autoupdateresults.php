<?php

include('header.php');

include('db_conn.php');

//print_r($_POST);

if(isset($_POST['id'])){
//  echo $_POST['ID'];
//  die();
$bankID="";
$fn="";
$ln="";
$app="";
$obs="";
$queryb = 'SELECT * FROM bank WHERE ID  = "'.mysqli_real_escape_string($conn, $_POST['id']).'" LIMIT 1';
		
		$resultb = mysqli_query($conn, $queryb) or die(mysqli_error($conn));
		
		if(mysqli_num_rows($resultb) > 0){
		
		while($rowb = mysqli_fetch_array($resultb)) {
			
		   $bankID  =$rowb['ID']; 
		   $fn  =$rowb['First Name']; 
		   $ln  =$rowb['Last Name'];
		   $app =$rowb['App Ref'];
		   $obs =$rowb['OBS'];
		    
		}}


	if(1 == 1){
	    
	    
	  
	
		//$query_clients_id = 'SELECT * FROM clients WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['clients_id']).'"';
		
		//$result_clients_id = mysqli_query($conn, $query_clients_id) or die(mysqli_error($conn));
		
		//if(mysqli_num_rows($result_clients_id) > 0){
	
			$query = 'UPDATE pupils SET 
			`bankID` = "'.mysqli_real_escape_string($conn, $bankID).'",
			`First Name` = "'.mysqli_real_escape_string($conn, $fn).'",
			`Last Name` = "'.mysqli_real_escape_string($conn, $ln).'",
			`App Ref` = "'.mysqli_real_escape_string($conn, $app).'",
			`OBS` = "'.mysqli_real_escape_string($conn, $obs).'"			
			WHERE ID = "'.mysqli_real_escape_string($conn, $_POST['li']).'";';
			
			$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
			
			
			
			
			echo '<div class="ok">redirect</div>';
			
			
			
			mysqli_close($conn);
			
		
		
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
