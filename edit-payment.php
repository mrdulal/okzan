<?php

include('header.php');

include('db_conn.php');


$ID = $_GET['ID'];

?>

	<title>Edit Payment</title>	
</head>
<body>


<?php
if( !isset($_GET['ID']) || $_GET['ID'] == '' ) {

	echo '<div class="nok">There is something wrong with your payment ID. 
	<br>
	Please go back and click on edit link again.
	</div>';	

}
else {


		$query = 'SELECT * FROM payments WHERE ID = "'.mysqli_real_escape_string($conn, $_GET['ID']).'" LIMIT 1';
		
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		
		if(mysqli_num_rows($result) > 0){
		
		while($row = mysqli_fetch_array($result)) {


?>
<div class="button_father">
	<a href = "index.php">
		<button class="button">Back to Home</button>
	</a>
</div>

<h1>Editing Payment With Number <?php echo $_GET['ID']; ?></h1>

<form method="post" action="edit-payment-submit.php">

	<input type="hidden" id="ID" name="ID" value="<?php echo $_GET['ID']; ?>" >
	
<div class="form_father">
	<label for="clients_id">Client's ID</label>
	<input type="text" id="clients_id" name="clients_id" value="<?php echo $row['Clients_ID']; ?>" >
</div>

<div class="form_father">
	<label for="payment_amount">Payment Amount</label>
	<input type="text" id="payment_amount" name="payment_amount" placeholder="Format NNNN.NN Or NNNN" pattern="^\d*(\.\d{0,2})?$" value="<?php echo $row['Payment Amount']; ?>" >
</div>

<div class="form_father">
	<label for="payment_date">Payment Date</label>
	<input type="text" id="payment_date" name="payment_date" placeholder="Format d-m-Y" value="<?php echo date('d-m-Y', strtotime($row['Payment Date'])); ?>" >

<div class="form_father">
	<label for="notes">Notes</label>
	<textarea id="notes" name="notes" rows="5" cols="25"> value="<?php echo $row['Notes']; ?>"</textarea>
</div>

<div class="form_father">
	<button id="submit" name="submit" class="button">Update Payment</button>
</div>

</form>

<?php

		}

		}
		else {
		
			echo '<div class="nok">There is not existing payment with ID '.$_GET['ID'].' .
			<br>
			Please go back and try to click on edit link again.
			</div>';			
		
		}
		

}

include('footer.php');

?>