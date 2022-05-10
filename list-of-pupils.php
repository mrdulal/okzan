<?php

include('header.php');

include('db_conn.php');

include('pagination.php');

?>

	<title>List of Pupils</title>	
</head>
<body style="margin-left: 10px;     DISPLAY: INLINE-BLOCK;" class="zoom">

<div class="button_father">
	<a href = "index.php">
		<button class="button">Back to Home</button>
	</a>
</div>


<?php

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$limit = 20;
$offset = ($page-1) * $limit;

$total_pages_sql = 'SELECT COUNT(*) FROM pupils';
$result = mysqli_query($conn,$total_pages_sql);
$totalitems = mysqli_fetch_array($result)[0];

?>


<h1>List of Pupils - <?php echo $totalitems; ?> in total</h1>
<div id="edit_message" style= "float: none; position: fixed; right: 30px;"></div>
<div class="clear"></div>


<?php

$sql = 'SELECT * FROM pupils ORDER BY ID DESC';
$res_data = mysqli_query($conn,$sql) or die(mysqli_error($conn));

echo '<table class="oops">';
echo '
<tr>
<th>ID</th>
<th>Title</th>
<th>First Name</th>
<th>Last Name</th>
<th>FEE</th>
<th>Applied On</th>
<th>Code</th>
<th>Device</th>

<th>License No</th>
<th>App Ref</th>
<th>Theory Cert</th>
<th>Theory Exp</th>




<th>Address Line 1</th>
<th>Address Town</th>
<th>Address Postcode</th>
<th>Date of Birth</th>
<th>Notes</th>

<th>Email Address</th>
<th>Telephone</th>

<th>Eligible Date</th>

<th>Clients_ID</th>
<th>Temp Booking Date</th>
<th>Temp Booking Centre</th>
<th>Temp Booking Code</th>
<th>Booked For</th>
<th>Test Centre</th>
<th>Booked On</th>
<th>Special Code</th>
</tr>
';

while($row = mysqli_fetch_array($res_data)){
            //here goes the data
            
            //echo $page;
            
echo '
<tr>
<td>'.$row['ID'].'</td>
<td class="edit" id="pupils**`Title`**'.$row['ID'].'">'.$row['Title'].'</td>
<td class="edit" id="pupils**`First Name`**'.$row['ID'].'">'.$row['First Name'].'</td>
<td class="edit" id="pupils**`Last Name`**'.$row['ID'].'">'.$row['Last Name'].'</td>
<td class="currency edit" id="pupils**`FEE`**'.$row['ID'].'">'.number_format($row['FEE'], 0).'</td>
<td class="bold edit date AppliedOn" id="pupils**`Applied On`**'.$row['ID'].'">'.($is_admin = ($row['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d.m.Y', strtotime($row['Applied On']))).'</td>
<td class="edit" class="bold" id="pupils**`Code`**'.$row['ID'].'">'.$row['Code'].'</td>
<td class="edit" class="bold" id="pupils**`Device`**'.$row['ID'].'">'.$row['Device'].'</td>

<td class="edit license_no" id="pupils**`License No`**'.$row['ID'].'">'.strtoupper($row['License No']).'</td>
<td class="edit" id="pupils**`App Ref`**'.$row['ID'].'">'.$row['App Ref'].'</td>
<td class="edit" id="pupils**`Theory Cert`**'.$row['ID'].'">'.$row['Theory Cert'].'</td>
<td class="edit date TheoryExp" id="pupils**`Theory Exp`**'.$row['ID'].'">'.($is_admin = ($row['Theory Exp'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row['Theory Exp']))).'</td>




<td style="white-space: normal;" class="edit" id="pupils**`Address Line 1`**'.$row['ID'].'">'.$row['Address Line 1'].'</td>
<td class="edit" id="pupils**`Address Town`**'.$row['ID'].'">'.$row['Address Town'].'</td>
<td class="edit" id="pupils**`Address Postcode`**'.$row['ID'].'">'.$row['Address Postcode'].'</td>
<td class="edit date DateofBirth" id="pupils**`Date of Birth`**'.$row['ID'].'">'.($is_admin_dob = ($row['Date of Birth'] == '0000-00-00') ? '' : date('d.m.Y', strtotime($row['Date of Birth']))).'</td>
<td style="white-space: normal;" class="edit" id="pupils**`Notes`**'.$row['ID'].'">'.$row['Notes'].'</td>
<td class="edit" id="pupils**`Email Address`**'.$row['ID'].'">'.$row['Email Address'].'</td>
<td class="edit" id="pupils**`Telephone`**'.$row['ID'].'">'.$row['Telephone'].'</td>

<td class="edit date EligibleDate" id="pupils**`Eligible Date`**'.$row['ID'].'">'.($is_admin = ($row['Eligible Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row['Eligible Date']))).'</td>

<td class="edit" id="pupils**`Clients_ID`**'.$row['ID'].'">'.$row['Clients_ID'].'</td>
<td class="edit date TempBookingDate" id="pupils**`Temp Booking Date`**'.$row['ID'].'">'.($is_admin = ($row['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Temp Booking Date']))).'</td>
<td class="edit" id="pupils**`Temp Booking Centre`**'.$row['ID'].'">'.$row['Temp Booking Centre'].'</td>
<td class="edit" id="pupils**`Temp Booking Code`**'.$row['ID'].'">'.$row['Temp Booking Code'].'</td>
<td class="edit date BookedFor" id="pupils**`Booked For`**'.$row['ID'].'">'.($is_admin = ($row['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Booked For']))).'</td>
<td class="edit" id="pupils**`Test Centre`**'.$row['ID'].'">'.$row['Test Centre'].'</td>
<td class="edit date BookedOn" id="pupils**`Booked On`**'.$row['ID'].'">'.($is_admin = ($row['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row['Booked On']))).'</td>
<td class="edit" id="pupils**`Special Code`**'.$row['ID'].'">'.$row['Special Code'].'</td>
</tr>
';
            
            
}

echo '
</table>
';

/*$pagination = getPaginationString($page, $totalitems, $limit, $adjacents = 3, $targetpage = "list-of-pupils.php", $pagestring = "?page=");
echo $pagination;*/

include('footer.php');

?>
