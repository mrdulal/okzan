<?php

include('header.php');

?>

	<title>Add New Client</title>	
</head>
<body>

<div class="button_father">
	<a href = "index.php">
		<button class="button">Back to Home</button>
	</a>
</div>

<h1>Add New Client</h1>

<form method="post" action="new-client-submit.php">

<div class="form_father">
	<label for="ID">ID</label>
	<input type="text" id="ID" name="ID" required>
</div>

<div class="form_father">
	<label for="first_name">First Name</label>
	<input type="text" id="first_name" name="first_name" >
</div>

<div class="form_father">
	<label for="last_name">Last Name</label>
	<input type="text" id="last_name" name="last_name" >
</div>

<div class="form_father">
	<label for="address_line_1">Address Line 1</label>
	<input type="text" id="address_line_1" name="address_line_1" >
</div>

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
	<label for="credit_limit">Credit Limit</label>
	<input type="text" id="credit_limit" name="credit_limit" pattern="^\d*(\.\d{0,2})?$" >
</div>

<div class="form_father">
	<button id="submit" name="submit" class="button">Add New Client</button>
</div>

</form>


<?php

include('footer.php');

?>