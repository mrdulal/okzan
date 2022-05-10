<?php

include('header.php');

include('db_conn.php');


$ID = $_GET['ID'];

?>

	<title>Edit Client</title>	
</head>
<body>


<?php
if( !isset($_GET['ID']) || $_GET['ID'] == '' ) {

	echo '<div class="nok">There is something wrong with your client ID. 
	<br>
	Please go back and click on edit link again.
	</div>';	

}
else {


		$query = 'SELECT * FROM clients WHERE ID = "'.mysqli_real_escape_string($conn, $_GET['ID']).'" LIMIT 1';
		
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		
		if(mysqli_num_rows($result) > 0){
		
		while($row = mysqli_fetch_array($result)) {


?>
<div class="button_father">
	<a href = "index.php">
		<button class="button">Back to Home</button>
	</a>
</div>

<h1>Editing Client With Number <?php echo $_GET['ID']; ?></h1>

<form method="post" action="edit-client-submit.php">

	<input type="hidden" id="ID" name="ID" value="<?php echo $_GET['ID']; ?>" >
	
<div class="form_father">
	<label for="ID">ID</label>
	<input type="text" id="ID" name="ID" readonly  value="<?php echo $row['ID']; ?>" >
</div>

<div class="form_father">
	<label for="first_name">First Name</label>
	<input type="text" id="first_name" name="first_name" value="<?php echo $row['First Name']; ?>" >
</div>

<div class="form_father">
	<label for="last_name">Last Name</label>
	<input type="text" id="last_name" name="last_name" value="<?php echo $row['Last Name']; ?>" >
</div>

<div class="form_father">
	<label for="address_line_1">Address Line 1</label>
	<input type="text" id="address_line_1" name="address_line_1" value="<?php echo $row['Address Line 1']; ?>" >
</div>

<div class="form_father">
	<label for="address_town">Address Town</label>
	<input type="text" id="address_town" name="address_town" value="<?php echo $row['Address Town']; ?>" >
</div>

<div class="form_father">
	<label for="address_postcode">Address Postcode</label>
	<input type="text" id="address_postcode" name="address_postcode" value="<?php echo $row['Address Postcode']; ?>" >
</div>

<div class="form_father">
	<label for="email_address">Email Address</label>
	<input type="email" id="email_address" name="email_address" value="<?php echo $row['Email Address']; ?>" >
</div>

<div class="form_father">
	<label for="telephone">Telephone</label>
	<input type="tel" id="telephone" name="telephone" pattern="[0-9]+" value="<?php echo $row['Telephone']; ?>" >
</div>

<div class="form_father">
	<label for="credit_limit">Credit Limit</label>
	<input type="text" id="credit_limit" name="credit_limit" pattern="^\d*(\.\d{0,2})?$" value="<?php echo $row['credit_limit']; ?>" >
</div>

<div class="form_father">
	<button id="submit" name="submit" class="button">Update Client</button>
</div>

</form>

<?php

		}

		}
		else {
		
			echo '<div class="nok">There is not existing client with ID '.$_GET['ID'].' .
			<br>
			Please go back and try to click on edit link again.
			</div>';			
		
		}
		

}

include('footer.php');

?>