<?php

include('header.php');

include('db_conn.php');

$ID = $_GET['ID'];

?>

	<title>Edit Bank</title>	
</head>
<body>


<?php
if( !isset($_GET['ID']) || $_GET['ID'] == '' ) {

	echo '<div class="nok">There is something wrong with your bank ID. 
	<br>
	Please go back and click on edit link again.
	</div>';	

}
else {


		$query = 'SELECT * FROM bank WHERE ID = "'.mysqli_real_escape_string($conn, $_GET['ID']).'" LIMIT 1';
		
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		
		if(mysqli_num_rows($result) > 0){
		
		while($row = mysqli_fetch_array($result)) {


?>
<div class="button_father">
	<a href = "bank.php">
		<button class="button">Back to Bank</button>
	</a>
</div>

<h1>Editing Bank With ID <?php echo $_GET['ID']; ?></h1>

<form method="post" action="edit-bank-submit.php">

	<input type="hidden" id="ID" name="ID" value="<?php echo $_GET['ID']; ?>" >
	
<div class="form_father">
	<label for="ID">ID</label>
	<input type="text" id="ID" name="ID" readonly  value="<?php echo $row['ID']; ?>" >
</div>

<div class="quarter">

<div class="form_father">
	<label for="first_name">First Name</label>
	<input type="text" id="first_name" name="first_name" value="<?php echo $row['First Name']; ?>" >
</div>

<div class="form_father">
	<label for="last_name">Last Name</label>
	<input type="text" id="last_name" name="last_name" value="<?php echo $row['Last Name']; ?>" >
</div>

<div class="form_father">
	<label for="device">Device</label>
	<input type="text" id="device" name="device" value="<?php echo $row['Device']; ?>" >
</div>

<div class="form_father">
	<label for="history">History</label>
	<textarea id="history" name="history" rows="6" cols="25"><?php echo $row['history']; ?></textarea>	
</div>
</div>


<div class="quarter">

<div class="form_father">
	<label for="license_no">License No</label>
	<input type="text" id="license_no" name="license_no" value="<?php echo $row['License No']; ?>" >
</div>

<div class="form_father">
	<label for="app_ref">App Ref</label>
	<input type="text" id="app_ref" name="app_ref" value="<?php echo $row['App Ref']; ?>" >
</div>

</div>


<div class="quarter">

<div class="form_father">
	<label for="notes">Notes</label>
	<textarea id="notes" name="notes" rows="6" cols="25"><?php echo $row['Notes']; ?></textarea>
	
</div>

</div>


<div class="quarter">

<div class="form_father">
	<label for="OBS">OBS</label>
	<input type="text" id="OBS" name="OBS" value="<?php echo $row['OBS']; ?>" >
</div>


<div class="form_father">
	<label for="OBS">OBS_Username</label>
	<input type="text" id="OBS_Username" name="OBS_Username" value="<?php echo $row['OBS_username']; ?>" >
</div>

<div class="form_father">
	<label for="OBS">OBS_Password</label>
	<input type="text" id="OBS_Password" name="OBS_Password" value="<?php echo $row['OBS_password']; ?>" >
</div>

<div class="form_father">
	<label for="booked_for">Booked For</label>
	<input type="text" id="booked_for" name="booked_for" value="<?php echo ($is_admin = ($row['Booked For'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y H:i:s', strtotime($row['Booked For']))); ?>" >
</div>

<div class="form_father">
	<label for="test_centre">Test Centre</label>
	<input type="text" id="test_centre" name="test_centre" value="<?php echo $row['Test Centre']; ?>" >
</div>

<div class="form_father">
	<label for="booked_on">Booked On</label>
	<input type="text" id="booked_on" name="booked_on" value="<?php echo ($is_admin = ($row['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y H:i:s', strtotime($row['Booked On']))); ?>" >
	                                                                                   
</div>

<div class="form_father">
	<label for="special_code">Status</label>
	<input type="text" id="Status" name="Status" value="<?php echo $row['Status']; ?>" >
</div>

<div class="form_father">
	<button id="submit" name="submit" class="button">Update bank</button>
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