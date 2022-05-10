<?php

include('header.php');

include('db_conn.php');

$fee = 0.00;

$total_fee = 0.00;

?>

	<title>Pupil Details</title>	
</head>
<body>

<div class="button_father">
	<a href = "index.php">
		<button class="button">Back to Home</button>
	</a>
</div>

<h1>Pupil Details</h1>

<form method="post" action="new-booking-submit.php">

<div class="quarter">
<div class="form_father">
	<label for="pupils_id">Pupil's ID</label>
	<input type="text" id="pupils_id" name="pupils_id" pattern="[0-9]+">
</div>

<div class="form_father">
	<label for="clients_ID">Client's ID</label>
	<input type="text" id="clients_ID" name="clients_ID" value="">
</div>

<div class="form_father">
	<label for="firstname">First Name</label>
	<input type="text" id="firstname" name="firstname">
</div>

<div class="form_father">
	<label for="lastname">Last Name</label>
	<input type="text" id="lastname" name="lastname">
</div>

<div class="form_father">
	<label for="licenceno">Licence No.</label>
	<input type="text" id="licenceno" name="licenceno">
</div>

<div class="form_father">
	<label for="appreference">Application Reference</label>
	<input type="text" id="appreference" name="appreference">
</div>

<div class="form_father">
	<label for="addline1">Address Line 1</label>
	<input type="text" id="addline1" name="addline1">
</div>

<div class="form_father">
	<label for="addtown">Address Town</label>
	<input type="text" id="addtown" name="addtown">
</div>

<div class="form_father">
	<label for="addpc">Address Post Code</label>
	<input type="text" id="addpc" name="addpc">
</div>

<div class="form_father">
	<label for="telephone">Telephone</label>
	<input type="text" id="telephone" name="telephone">
</div>

<div class="form_father">
	<label for="email">Email Address</label>
	<input type="text" id="email" name="email">
</div>

</form>

<?php

include('footer.php');

?>