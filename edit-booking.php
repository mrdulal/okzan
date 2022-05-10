<?php

include('header.php');

include('db_conn.php');

$ID = $_GET['ID'];

?>

	<title>Edit Booking</title>	
</head>
<body>


<?php
if( !isset($_GET['ID']) || $_GET['ID'] == '' ) {

	echo '<div class="nok">There is something wrong with your booking ID. 
	<br>
	Please go back and click on edit link again.
	</div>';	

}
else {


		$query = 'SELECT * FROM bookings WHERE ID = "'.mysqli_real_escape_string($conn, $_GET['ID']).'" LIMIT 1';
		
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		
		if(mysqli_num_rows($result) > 0){
		
		while($row = mysqli_fetch_array($result)) {


?>
<div class="button_father">
	<a href = "index.php">
		<button class="button">Back to Home</button>
	</a>
</div>

<h1>Editing Booking With Number <?php echo $_GET['ID']; ?></h1>

<form method="post" action="edit-booking-submit.php">

	<input type="hidden" id="ID" name="ID" value="<?php echo $_GET['ID']; ?>" >
<div class="quarter">
	
<div class="form_father">
	<label for="pupils_id">Pupil's ID</label>
	<input type="text" id="pupils_id" name="pupils_id" pattern="[0-9]+" readonly value="<?php echo $row['Pupils_ID']; ?>" >
</div>

<div class="form_father">
	<label for="pupils_id">Clients ID</label>
	<input type="text" id="Clients_ID" name="Clients_ID" value="<?php echo $row['clients_id']; ?>" >
</div>
<div class="form_father">
	<label for="first_name">First Name</label>
	<input type="text" id="first_name" name="first_name" readonly value="<?php echo $row['First Name']; ?>" >
</div>
<div class="form_father">
	<label for="last_name">Last Name</label>
	<input type="text" id="last_name" name="last_name" readonly value="<?php echo $row['Last Name']; ?>" >
</div>
<div class="form_father">
	<label for="app_ref">Application Reference</label>
	<input type="text" id="app_ref" name="app_ref" value="<?php echo $row['app_ref']; ?>" >
</div>
</div>
<div class="quarter">

<div class="form_father">
	<label for="temp_booking_date">Temp Booking Date</label>
	<input type="text" id="temp_booking_date" name="temp_booking_date" placeholder="Format dd-mm-YYYY hh:mm(am/pm)" value="<?php echo ($is_admin = ($row['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y h:ia', strtotime($row['Temp Booking Date']))); ?>" >
</div>


<div class="form_father">
	<label for="temp_booking_centre">Temp Booking Centre</label>
	<input type="text" id="temp_booking_centre" name="temp_booking_centre" value="<?php echo $row['Temp Booking Centre']; ?>" >
</div>
<div class="form_father">
	<label for="temp_booking_booked_on">Temp Booking Booked On</label>
        <input type="text" id="temp_booking_booked_on" name="temp_booking_booked_on" value="<?php echo ($is_admin = ($row['temp_booking_booked_on'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y H:i:s', strtotime($row['temp_booking_booked_on']))); ?>" placeholder="Format dd-mm-YYYY hh:mm:ss" >
</div>
</div>
<div class="quarter">

<div class="form_father">
	<label for="booked_for">Booked For</label>
	<input type="text" id="booked_for" name="booked_for" placeholder="Format dd-mm-YYYY hh:mm(am/pm)" value="<?php echo ($is_admin = ($row['Booked For'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y H:i', strtotime($row['Booked For']))); ?>" >
</div>

<div class="form_father">
	<label for="test_centre">Test Centre</label>
	<input type="text" id="test_centre" name="test_centre" value="<?php echo $row['Test Centre']; ?>" >
</div>

<div class="form_father">
	<label for="booked_on">Booked On</label>
	<input type="text" id="booked_on" name="booked_on" placeholder="Format dd-mm-YYYY" value="<?php echo ($is_admin = ($row['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y H:i:s', strtotime($row['Booked On']))); ?>" >
</div>
</div>
<div class="quarter">
<div class="form_father">
	<label for="fee">Test FEE</label>
	<input type="text" class="edit_fee" id="fee" name="fee" value="<?php echo $row['FEE']; ?>" >
</div>

<div class="form_father">
	<label for="total_fee">Total FEE</label>
	<input type="text" class="edit_fee_total" id="total_fee" name="total_fee" value="<?php echo $row['Total FEE']; ?>" >
</div>

<div class="form_father">
	<label for="special_code">Special Code</label>
	<input type="text" id="special_code" name="special_code" value="<?php echo $row['Special Code']; ?>" >
</div>

<div class="form_father">
	<label for="notes">Notes</label>
	<textarea id="notes" name="notes" rows="5" cols="25"><?php echo $row['Notes']; ?></textarea>
</div>

<div class="form_father">
	<button id="submit" name="submit" class="button">Update Booking</button>
</div>

</form>

<?php

		}

		}
		else {
		
			echo '<div class="nok">There is not existing booking with ID '.$_GET['ID'].' .
			<br>
			Please go back and try to click on edit link again.
			</div>';			
		
		}
		

}

include('footer.php');

?>