<?php

include('header.php');

include('db_conn.php');

?>

	<title>Add New Pupil</title>	
</head>
<body>

<div class="button_father">
	<a href = "bank.php">
		<button class="button">Back to Bank</button>
	</a>
</div>

<h1>Add to Bank </h1>

<form method="post" action="new-bank-submit.php">

<div class="quarter">

<div class="form_father">
	<label for="first_name">First Name</label>
	<input type="text" id="first_name" name="first_name"  >
</div>

<div class="form_father">
	<label for="last_name">Last Name</label>
	<input type="text" id="last_name" name="last_name"  >
</div>

<div class="form_father">
	<label for="device">Device</label>
	<input type="text" id="device" name="device"  >
</div>

<div class="form_father">
	<label for="history">History</label>
	<textarea id="history" name="history" rows="6" cols="25"></textarea>	
</div>
</div>


<div class="quarter">

<div class="form_father">
	<label for="license_no">License No</label>
	<input type="text" id="license_no" name="license_no"  >
</div>

<div class="form_father">
	<label for="app_ref">App Ref</label>
	<input type="text" id="app_ref" name="app_ref"  >
</div>

</div>


<div class="quarter">

<div class="form_father">
	<label for="notes">Notes</label>
	<textarea id="notes" name="notes" rows="6" cols="25"></textarea>
	
</div>

</div>


<div class="quarter">

<div class="form_father">
	<label for="OBS">OBS</label>
	<input type="text" id="OBS" name="OBS"  >
</div>


<div class="form_father">
	<label for="OBS">OBS_Username</label>
	<input type="text" id="OBS_Username" name="OBS_Username"  >
</div>

<div class="form_father">
	<label for="OBS">OBS_Password</label>
	<input type="text" id="OBS_Password" name="OBS_Password"  >
</div>

<div class="form_father">
	<label for="booked_for">Booked For</label>
	<input type="text" id="booked_for" name="booked_for" >
</div>

<div class="form_father">
	<label for="test_centre">Test Centre</label>
	<input type="text" id="test_centre" name="test_centre"  >
</div>

<div class="form_father">
	<label for="booked_on">Booked On</label>
	<input type="text" id="booked_on" name="booked_on" >
	                                                                                   
</div>

<div class="form_father">
	<label for="special_code">Status</label>
	<input type="text" id="Status" name="Status"  >
</div>

<div class="form_father">
	<button id="submit" name="submit" class="button">Add to bank</button>
</div>

</form>

<?php


include('footer.php');

?>