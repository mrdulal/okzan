<?php

include('header.php');

include('db_conn.php');


$ID = $_GET['pi'];

$bank_id = $_GET['ID'];


?>

<title>Edit Pupil Result</title>
</head>

<body>


    <?php
	if (!isset($_GET['pi']) || $_GET['pi'] == '') {

		echo '<div class="nok">There is something wrong with your Pupil ID. 
	<br>
	Please go back and click on edit link again.
	</div>';
	} else {


		$query = 'SELECT * FROM pupils WHERE ID  = "' . mysqli_real_escape_string($conn, $_GET['pi']) . '" LIMIT 1';

		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

		if (mysqli_num_rows($result) > 0) {

			while ($row = mysqli_fetch_array($result)) {

				$queryb = 'SELECT * FROM bank WHERE ID  = "' . mysqli_real_escape_string($conn, $_GET['ID']) . '" LIMIT 1';

				$resultb = mysqli_query($conn, $queryb) or die(mysqli_error($conn));

				if (mysqli_num_rows($resultb) > 0) {

					while ($rowb = mysqli_fetch_array($resultb)) {


	?>
    <div class="button_father">
        <!--<a href = "specific-pupils-lists.php">-->
        <!--	<button class="button">Back to specific-pupils-lists</button>-->
        <!--</a>-->
    </div>

    <h1>Editing Pupil Result With ID <?php echo $_GET['pi']; ?></h1>

    <form method="post" action="edit-results-submit.php">

        <input onclick="myFunction()" type="hidden" id="ID" name="ID" value="<?php echo $_GET['pi']; ?>">

        <div class="form_father">
            <label for="ID">ID</label>
            <input type="text" id="ID" name="B_ID" readonly value="<?php echo $row['ID']; ?>">
        </div>

        <div class="form_father">
            <label for="bankID">bankID</label>
            <input type="text" id="bankID" name="bankID" value="<?php echo $rowb['ID']; ?>">
        </div>

        <div class="quarter">
            <div class="form_father">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?php echo $row['Title']; ?>">
            </div>

            <div class="form_father">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo $rowb['First Name']; ?>">
            </div>

            <div class="form_father">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo $rowb['Last Name']; ?>">
            </div>

            <div class="form_father">
                <label for="fee">FEE</label>
                <input type="text" id="fee" name="fee" pattern="^\d*(\.\d{0,2})?$" value="<?php echo $row['FEE']; ?>">
            </div>

            <div class="form_father">
                <label for="date_of_birth">Date of Birth</label>
                <input type="text" id="date_of_birth" name="date_of_birth" value="<?php echo $row['Date of Birth']; ?>">
            </div>

            <div class="form_father">
                <label for="code">Code</label>
                <input type="text" id="code" name="code" value="<?php echo $row['Code']; ?>">
            </div>

            <div class="form_father">
                <label for="device">Device</label>
                <input type="text" id="device" name="device" value="<?php echo $row['Device']; ?>">
            </div>

            <div class="form_father">
                <label for="history">History</label>
                <textarea id="history" name="history" rows="6" cols="25"><?php echo $row['history']; ?></textarea>
            </div>
        </div>


        <div class="quarter">
            <div class="form_father">
                <label for="applied_on">Applied On</label>
                <input type="text" id="applied_on" name="applied_on"
                    value="<?php echo ($is_admin = ($row['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y H:i:s', strtotime($row['Applied On']))); ?>">
            </div>

            <div class="form_father">
                <label for="license_no">License No</label>
                <input type="text" id="license_no" name="license_no" value="<?php echo $row['License No']; ?>">
            </div>

            <div class="form_father">
                <label for="app_ref">App Ref</label>
                <input type="text" id="app_ref" name="app_ref" value="<?php echo $rowb['App Ref']; ?>">
            </div>

            <div class="form_father">
                <label for="eligible_date">Eligible Date</label>
                <input type="text" id="eligible_date" name="eligible_date" value="<?php echo $row['Eligible Date']; ?>">
            </div>

            <div class="form_father">
                <label for="theory_exp">Theory Exp</label>
                <input type="text" id="theory_exp" name="theory_exp" value="<?php echo $row['Theory Exp']; ?>">
            </div>

            <div class="form_father">
                <label for="theocert">Theory Cert</label>
                <input type="text" id="theocert" name="theocert" pattern="[0-9]+"
                    value="<?php echo $row['Theory Cert']; ?>">
            </div>

            <div class="form_father">
                <label for="address_line_1">Address Line 1</label>
                <input type="text" id="address_line_1" name="address_line_1"
                    value="<?php echo $row['Address Line 1']; ?>">
            </div>
        </div>


        <div class="quarter">
            <div class="form_father">
                <label for="address_town">Address Town</label>
                <input type="text" id="address_town" name="address_town" value="<?php echo $row['Address Town']; ?>">
            </div>

            <div class="form_father">
                <label for="address_postcode">Address Postcode</label>
                <input type="text" id="address_postcode" name="address_postcode"
                    value="<?php echo $row['Address Postcode']; ?>">
            </div>

            <div class="form_father">
                <label for="email_address">Email Address</label>
                <input type="email" id="email_address" name="email_address"
                    value="<?php echo $row['Email Address']; ?>">
            </div>

            <div class="form_father">
                <label for="telephone">Telephone</label>
                <input type="tel" id="telephone" name="telephone" value="<?php echo $row['Telephone']; ?>">
            </div>

            <div class="form_father">
                <label for="notes">Notes</label>
                <textarea id="notes" name="notes" rows="6" cols="25"><?php echo $row['Notes']; ?></textarea>

            </div>

            <div class="form_father">
                <label for="clients_id">Client's ID</label>
                <input type="text" id="clients_id" name="clients_id" value="<?php echo $row['Clients_ID']; ?>">
            </div>

        </div>


        <div class="quarter">

            <div class="form_father">
                <label for="temp_booking_date">Temp Booking Date</label>
                <input type="text" id="temp_booking_date" name="temp_booking_date"
                    value="<?php echo ($is_admin = ($row['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y H:i:s', strtotime($row['Temp Booking Date']))); ?>">
            </div>

            <div class="form_father">
                <label for="temp_booking_centre">Temp Booking Centre</label>
                <input type="text" id="temp_booking_centre" name="temp_booking_centre"
                    value="<?php echo $row['Temp Booking Centre']; ?>">
            </div>

            <div class="form_father">
                <label for="temp_booking_code">Temp Booking Code</label>
                <input type="text" id="temp_booking_code" name="temp_booking_code"
                    value="<?php echo $row['Temp Booking Code']; ?>">
            </div>

            <div class="form_father">
                <label for="OBS">OBS</label>
                <input type="text" id="OBS" name="OBS" value="<?php echo $rowb['OBS']; ?>">
            </div>

            <div class="form_father">
                <label for="booked_for">Booked For</label>
                <input type="text" id="booked_for" name="booked_for"
                    value="<?php echo ($is_admin = ($row['Booked For'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y H:i:s', strtotime($row['Booked For']))); ?>">
            </div>

            <div class="form_father">
                <label for="test_centre">Test Centre</label>
                <input type="text" id="test_centre" name="test_centre" value="<?php echo $row['Test Centre']; ?>">
            </div>

            <div class="form_father">
                <label for="booked_on">Booked On</label>
                <input type="text" id="booked_on" name="booked_on"
                    value="<?php echo ($is_admin = ($row['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y H:i:s', strtotime($row['Booked On']))); ?>">

            </div>

            <div class="form_father">
                <label for="special_code">Special Code</label>
                <input type="text" id="special_code" name="special_code" value="<?php echo $row['Special Code']; ?>">
            </div>
        </div>

        <div class="form_father">
            <label for="special_code">Status</label>
            <input type="text" id="status" name="status" value="<?php echo $row['status']; ?>">
        </div>
        </div>


        <div class="form_father">
            <button id="submit" name="submit" class="button">Update Pupil</button>
        </div>

    </form>


    <script>
    function myFunction() {
        /* Get the text field */
        var copyText = document.getElementById("ID");

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);

        /* Alert the copied text */
        alert("Copied the text: " + copyText.value);
    }
    </script>
    <?php

					}
				}
			}
		} else {

			echo '<div class="nok">There is not existing client with ID ' . $_GET['pi'] . ' .
			<br>
			Please go back and try to click on edit link again.
			</div>';
		}
	}

	include('footer.php');

	?>