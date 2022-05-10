<?php

include('header.php');

include('db_conn.php');

include('pagination.php');

?>

	<title>Make Statement</title>	
</head>
<body style="">

<div class="button_father">
	<a href = "list-of-clients.php">
		<button class="button">Back to List of Clients</button>
	</a>
</div>

<h1>Make Statement</h1>

<?php

$sql_check = 'SELECT * FROM statement_points WHERE `clients_ID` = "'.mysqli_real_escape_string($conn, $_GET['ID']).'" AND date = "'.date('Y-m-d H:i:s', time()).'"';

$res_check = mysqli_query($conn,$sql_check) or die(mysqli_error($conn));

if(mysqli_num_rows($res_check) == 0){

	$sql = 'INSERT INTO statement_points(`ID`, `clients_ID`, `date`) VALUES (NULL, "'.mysqli_real_escape_string($conn, $_GET['ID']).'" , "'.date('Y-m-d H:i:s', time()).'")';

	$res_data = mysqli_query($conn,$sql) or die(mysqli_error($conn));

	if(mysqli_affected_rows($conn) > 0){
			
		mysqli_close($conn);
		?>
  <script type="text/javascript">location.href = 'list-of-clients.php';</script>
  <?php	
		//echo '<div class="ok">You successfully created new client statement.<br>
		//
		
	}
	else{
		
		echo '<div class="nok">Something went wrong. Please again.</div>';	
		
	}
		
}
else{
		
	echo '<div class="nok">You already have a statement for today.</div>';	
		
}		

?>



<?php


include('footer.php');

?>
