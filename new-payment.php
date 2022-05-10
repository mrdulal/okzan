<?php

include('header.php');

?>

	<title>Add New Payment</title>	
</head>
<body>

<div class="button_father">
	<a href = "index.php">
		<button class="button">Back to Home</button>
	</a>
</div>

<h1>Add New Payment</h1>

<form method="post" action="new-payment-submit.php">

<div class="form_father">
	<label for="clients_id">Client's ID</label>
	<input type="text" id="clients_id" name="clients_id" >
</div>

<div class="form_father">
	<label for="payment_amount">Payment Amount</label>
	<input type="text" id="payment_amount" name="payment_amount" pattern="^\d*(\.\d{0,2})?$" >
</div>

<div class="form_father">
	<label for="payment_date">Payment Date</label>
	<input type="text" id="payment_date" name="payment_date" placeholder="dd-mm-YYYY hh:mm:ss" >

<div class="form_father">
	<label for="notes">Notes</label>
	<textarea id="notes" name="notes" rows="5" cols="25"></textarea>
</div>

<div class="form_father">
	<button id="submit" name="submit" class="button">Add New Payment</button>
</div>

</form>

<?php

include('footer.php');

?>