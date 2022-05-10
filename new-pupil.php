<?php

include('header.php');

include('db_conn.php');
if (isset($_GET["no-result"]) && !empty($_GET['ID'])) {
    $queryb = 'SELECT * FROM bank WHERE ID  = "' . mysqli_real_escape_string($conn, $_GET['ID']) . '" LIMIT 1';
    $resultb = mysqli_query($conn, $queryb) or die(mysqli_error($conn));
    if (mysqli_num_rows($resultb) > 0) {
        $k = mysqli_fetch_array($resultb);
		$bankID  =$k['ID'];
        $fn  =$k['First Name'];
        $ln  =$k['Last Name'];
        $license_no  =$k['License No'];
        $app =$k['App Ref'];
        $obs =$k['OBS'];
    }
}
?>

	<title>Add New Pupil</title>	
</head>
<body>

<div class="button_father">
	<a href = "index.php">
		<button class="button">Back to Home</button>
	</a>
</div>

<h1>Add New Pupil</h1>

<form method="post" action="new-pupil-submit.php">

<div class="form_father">
	<label for="bankID">Bank ID</label>
	<input type="text" id="bankID" name="bankID" autocomplete="new-password" value="<?php echo (isset($bankID))?$bankID:''; ?>" />
</div>

<div class="quarter">
<div class="form_father">
	<label for="title">Title</label>
	<select type="text" id="title" name="title">
		<option></option>
		<option>Mr</option>
		<option>Mrs</option>
		<option>Miss</option>
	</select>
</div>

<div class="form_father">
	<label for="first_name">First Name</label>
	<input type="text" id="first_name" name="first_name" autocomplete="new-password" value="<?php echo (isset($fn))?$fn:''; ?>" />
</div>

<div class="form_father">
	<label for="last_name">Last Name</label>
	<input type="text" id="last_name" name="last_name" autocomplete="new-password" value="<?php echo (isset($ln))?$ln:''; ?>" />
</div>

<div class="form_father">
	<label for="fee">FEE</label>
	<input type="text" id="fee" name="fee" placeholder="NNNN.NN Or NNNN" pattern="^\d*(\.\d{0,2})?$">
</div>

<div class="form_father">
	<label for="date_of_birth">Date of Birth</label>
	<input type="text" id="date_of_birth" name="date_of_birth" placeholder="dd.mm.YYYY" autocomplete="new-password">
</div>

<div class="form_father">
	<label for="code">Code</label>
	<input type="text" id="code" name="code">
</div>

<div class="form_father">
	<label for="device">Device</label>
	<input type="text" id="device" name="device">
</div>
</div>


<div class="quarter">
<div class="form_father">
	<label for="applied_on">Applied On</label>
	<input type="text" id="applied_on" name="applied_on" value="<?php echo date('d-m-Y'); ?>" placeholder="dd.mm.YYYY"  autocomplete="new-password">
</div>

<div class="form_father">
	<label for="license_no">License No</label>
	<input type="text" id="license_no" name="license_no" value="<?php echo (isset($license_no))?$license_no:''; ?>" />
</div>

<div class="form_father">
	<label for="app_ref">App Ref</label>
	<input type="text" id="app_ref" name="app_ref"  value="<?php echo (isset($app))?$app:''; ?>" />
</div>

<div class="form_father">
	<label for="eligible_date">Eligible Date</label>
	<input type="text" id="eligible_date" name="eligible_date" placeholder="dd-mm-YYYY" autocomplete="new-password">
</div>

<div class="form_father">
	<label for="theory_exp">Theory Exp</label>
	<input type="text" id="theory_exp" name="theory_exp" placeholder="dd-mm-YYYY" autocomplete="new-password">
</div>

<div class="form_father">
	<label for="theocert">Theory Cert</label>
	<input type="text" id="theocert" name="theocert" pattern="[0-9]+" autocomplete="new-password">
</div>

<div class="form_father">
	<label for="address_line_1">Address Line 1</label>
	<input type="text" id="address_line_1" name="address_line_1" >
</div>
</div>


<div class="quarter">
<div class="form_father">
	<label for="address_town">Address Town</label>
	<input type="text" id="address_town" name="address_town" >
</div>

<div class="form_father">
	<label for="address_postcode">Address Postcode</label>
	<input type="text" id="address_postcode" name="address_postcode" >
</div>

<div class="form_father">
	<label for="email_address">Email Address</label>
	<input type="email" id="email_address" name="email_address" >
</div>

<div class="form_father">
	<label for="telephone">Telephone</label>
	<input type="tel" id="telephone" name="telephone" pattern="[0-9]+" >
</div>

<div class="form_father">
	<label for="notes">Notes</label>
	<textarea id="notes" name="notes" rows="6" cols="25"></textarea>
</div>

<div class="form_father">
	<label for="clients_id">Client's ID</label>
	<input type="text" list="clients" id="clients_id" name="clients_id" autocomplete="off" >
	<datalist id="clients"> 
	  <option value="ZZZZZ">	 	  
	</datalist>	
	
</div>

</div>

<div class="quarter">

<div class="form_father">
	<label for="temp_booking_date">Temp Booking Date</label>
	<input type="text" id="temp_booking_date" name="temp_booking_date" placeholder="dd-mm-YYYY hh:mm(am/pm)">
</div>

<div class="form_father">
	<label for="temp_booking_centre">Temp Booking Centre</label>
	<input type="text" id="temp_booking_centre" name="temp_booking_centre">
</div>

<div class="form_father">
	<label for="temp_booking_code">Temp Booking Code</label>
	<input type="text" id="temp_booking_code" name="temp_booking_code">
</div>

<div class="form_father">
	<label for="OBS">OBS</label>
	<input type="text" id="OBS" name="OBS" value="<?php echo (isset($obs))?$obs:''; ?>" />
</div>

<div class="form_father">
	<label for="booked_for">Booked For</label>
	<input type="text" id="booked_for" name="booked_for" placeholder="dd-mm-YYYY hh:mm(am/pm)">
</div>

<div class="form_father">
	<label for="test_centre">Test Centre</label>
	<input type="text" id="test_centre" name="test_centre">
</div>

<div class="form_father">
	<label for="booked_on">Booked On</label>
	<input type="text" id="booked_on" name="booked_on" placeholder="dd-mm-YYYY hh:mm:ss">
</div>

<div class="form_father">
	<label for="special_code">Special Code</label>
	<input type="text" id="special_code" name="special_code">
</div>
</div>
<div style="clear: both;"></div>

<br>

<div class="form_father">
	<button id="submit" name="submit" class="button">Add New Pupil</button>
</div>

</form>

<?php


include('footer.php');

?>