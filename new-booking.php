<?php

include('header.php');

include('db_conn.php');

$fee = 0.00;

$total_fee = 0.00;

$ID = $_GET['ID'];
date_default_timezone_set('Europe/London');
?>

	<title>Add New Booking</title>	
</head>
<body>

<?php
if(isset($_GET['ID'])) {

	echo '<div class="nok">URL WITH ID 
	<br>
	
	</div>';	




		$query = 'SELECT * FROM pupils WHERE ID = "'.mysqli_real_escape_string($conn, $_GET['ID']).'" LIMIT 1';
		
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

		if(mysqli_num_rows($result) > 0){
		
		while($row = mysqli_fetch_array($result)) {


?>

<div class="button_father">
	<a href = "index.php">
		<button class="button">Back to Home</button>
	</a>
</div>

<h1>Add New Booking</h1>

<form method="post" action="new-booking-submit.php">



<div class="quarter">

<input type="hidden" id="pupils_iD" name="pupils_id" value="<?php echo $_GET['ID']; ?>" >

<div class="form_father">
	<label for="pupils_id">Pupil ID</label>
	<input type="text" id="pupils_id" name="pupils_id"   value="<?php echo $row['ID']; ?>" >
</div>

<div class="form_father">
	<label for="clients_ID">Client ID</label>
	<input type="text" id="clients_ID" name="clients_ID" value="<?php echo $row['Clients_ID']; ?>">
</div>

<div class="form_father">
	<label for="firstname">First Name</label>
	<input type="text" id="firstname" name="firstname" value="<?php echo $row['First Name']; ?>">
</div>

<div class="form_father">
	<label for="lastname">Last Name</label>
	<input type="text" id="lastname" name="lastname" value="<?php echo $row['Last Name']; ?>">
</div>

<div class="form_father">
	<label for="temp_booking_date">Temp Booking Date</label>
	<input type="text" id="temp_booking_date" name="temp_booking_date" placeholder="Format dd-mm-YYYY hh:mm(am/pm)" >
</div>
</div>

<div class="form_father">
	<label for="temp_booking_centre">Temp Booking Centre</label>
	<input type="text" id="temp_booking_centre" name="temp_booking_centre" >
</div>

<div class="form_father">
	<label for="temp_booking_code">Temp Booking Code</label>
	<input type="text" id="temp_booking_code" name="temp_booking_code" >
</div>

<div class="form_father">
	<label for="booked_for">Booked For</label>
	<input type="text" id="booked_for" name="booked_for" placeholder="Format dd-mm-YYYY hh:mm(am/pm)" >
</div>

<div class="form_father">
	<label for="test_centre">Test Centre</label>
	<input type="text" id="test_centre" name="test_centre" >
</div>
</div>


<div class="quarter">
<div class="form_father">
	<label for="booked_on">Booked On</label>
        <input type="text" id="booked_on" name="booked_on" value="<?php echo date('d-m-Y H:i:s'); ?>" placeholder="Format dd-mm-YYYY hh:mm:ss" >
</div>
    <div class="form_father">
	<label for="temp_booking_booked_on">Temp Booking Booked On</label>
        <input type="text" id="temp_booking_booked_on" name="temp_booking_booked_on" value="<?php echo date('d-m-Y H:i:s'); ?>" placeholder="Format dd-mm-YYYY hh:mm:ss" >
</div>

<div class="form_father">
	<label for="fee">Test FEE</label>
	<input type="text" id="fee" name="fee" value="<?php echo $row['FEE']; ?>">
</div>

<div class="form_father">
	<label for="total_fee">Total FEE</label>
	<input type="text" id="total_fee" name="total_fee" value="<?php echo (INT)$row['FEE'] + (INT)50; ?>">
</div>

<div class="form_father">
	<label for="special_code">Special Code</label>
	<input type="text" id="special_code" name="special_code">
</div>

<div class="form_father">
	<label for="notes">Notes</label>
	<textarea id="notes" name="notes" rows="5" cols="25"></textarea>
</div>
</div>

<div class="form_father">
	<button id="submit" name="submit" class="button">Add New Booking</button>
</div>

</form>

<?php
}}}else
{

?>




<div class="button_father">
	<a href = "index.php">
		<button class="button">Back to Home</button>
	</a>
</div>

<h1>Add New Booking</h1>

<form method="post" action="new-booking-submit.php">



<div class="quarter">

<input type="hidden" id="pupils_iD" name="pupils_id" value="<?php echo $_GET['ID']; ?>" >

<div class="form_father">
	<label for="pupils_id">Pupil ID</label>
	<input type="text" id="pupils_id" name="pupils_id"   value="<?php echo $row['ID']; ?>" >
</div>

<div class="form_father">
	<label for="clients_ID">Client ID</label>
	<input type="text" id="clients_ID" name="clients_ID" value="<?php echo $row['Clients_ID']; ?>">
</div>

<div class="form_father">
	<label for="firstname">First Name</label>
	<input type="text" id="firstname" name="firstname" value="<?php echo $row['First Name']; ?>">
</div>

<div class="form_father">
	<label for="lastname">Last Name</label>
	<input type="text" id="lastname" name="lastname" value="<?php echo $row['Last Name']; ?>">
</div>

<div class="form_father">
	<label for="temp_booking_date">Temp Booking Date</label>
	<input type="text" id="temp_booking_date" name="temp_booking_date" placeholder="dd-mm-YYYY hh:mm(am/pm)" >
</div>
</div>

<div class="form_father">
	<label for="temp_booking_centre">Temp Booking Centre</label>
	<input type="text" id="temp_booking_centre" name="temp_booking_centre" >
</div>

<div class="form_father">
	<label for="temp_booking_code">Temp Booking Code</label>
	<input type="text" id="temp_booking_code" name="temp_booking_code" >
</div>

<div class="form_father">
	<label for="booked_for">Booked For</label>
	<input type="text" id="booked_for" name="booked_for" placeholder="dd-mm-YYYY hh:mm(am/pm)" >
</div>

<div class="form_father">
	<label for="test_centre">Test Centre</label>
	<input type="text" id="test_centre" name="test_centre" >
</div>
</div>


<div class="quarter">
<div class="form_father">
	<label for="booked_on">Booked On</label>
        <input type="text" id="booked_on" name="booked_on" value="<?php echo date('d-m-Y H:i:s'); ?>" placeholder="dd-mm-YYYY hh:mm:ss" >
</div>
    <div class="form_father">
	<label for="temp_booking_booked_on">Temp Booking Booked On</label>
        <input type="text" id="temp_booking_booked_on" name="temp_booking_booked_on" placeholder="dd-mm-YYYY hh:mm:ss" >
</div>

<div class="form_father">
	<label for="fee">Test FEE</label>
	<input type="text" id="fee" name="fee">
</div>

<div class="form_father">
	<label for="total_fee">Total FEE</label>
	<input type="text" id="total_fee" name="total_fee">
</div>

<div class="form_father">
	<label for="special_code">Special Code</label>
	<input type="text" id="special_code" name="special_code">
</div>

<div class="form_father">
	<label for="notes">Notes</label>
	<textarea id="notes" name="notes" rows="5" cols="25"></textarea>
</div>
</div>

<div class="form_father">
	<button id="submit" name="submit" class="button">Add New Booking</button>
</div>

</form>

<?php
}

include('footer.php');
?>
