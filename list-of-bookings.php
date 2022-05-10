<?php

include('header.php');

include('db_conn.php');

include('pagination.php');

?>

	<title>List of Bookings</title>	
</head>
<body style="" class="zoom">

<div class="button_father">
	<a href = "index.php">
		<button class="button">Back to Home</button>
	</a>
</div>


<?php

$total_pages_sql = 'SELECT COUNT(*) FROM bookings';
$result = mysqli_query($conn,$total_pages_sql);
$totalitems = mysqli_fetch_array($result)[0];

?>


<h1>List of Bookings - <?php echo $totalitems; ?> in total</h1>
<div id="edit_message"></div>
<div class="clear"></div>


<?php

$sql = 'SELECT * FROM bookings ORDER BY ID DESC';
$res_data = mysqli_query($conn,$sql) or die(mysqli_error($conn));

echo '<table>';
echo '
<tr>
<th>ID</th>
<th>Temp Booking Date</th>
<th>Temp Booking Centre</th>
<th>Temp Booking Booked On</th>
<th>Temp Booking Code</th>
<th>Booked For</th>
<th>Test Centre</th>
<th>Booked On</th>

<th>FEE</th>
<th>Total FEE</th>
<th>Pupil &apos; s ID</th>
<th>Special Code</th>
<th>Notes</th>

<th>Actions</th>
</tr>
';

while($row = mysqli_fetch_array($res_data)){
            //here goes the data
            
            //echo $page;
            
echo '
<tr>
<td id="">'.$row['ID'].'</td>
<td id="'.$row['ID'].'">'.($is_admin = ($row['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Temp Booking Date']))).'</td>
<td id="'.$row['ID'].'">'.$row['Temp Booking Centre'].'</td>
    <td id="'.$row['ID'].'">'.($is_admin = ($row['temp_booking_booked_on'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y h:i:s', strtotime($row['temp_booking_booked_on']))).'</td>
<td id="'.$row['ID'].'">'.$row['Temp Booking Code'].'</td>
<td id="'.$row['ID'].'">'.($is_admin = ($row['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Booked For']))).'</td>
<td id="'.$row['ID'].'">'.$row['Test Centre'].'</td>
<td id="'.$row['ID'].'">'.($is_admin = ($row['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row['Booked On']))).'</td>
<td id="'.$row['ID'].'">'.$row['FEE'].'</td>
<td id="'.$row['ID'].'">'.$row['Total FEE'].'</td>
<td id="'.$row['ID'].'">'.$row['Pupils_ID'].'</td>
<td id="'.$row['ID'].'">'.$row['Special Code'].'</td>
<td id="'.$row['ID'].'">'.$row['Notes'].'</td>
<td>
	<a href="edit-booking.php?ID='.$row['ID'].'" class="first">Edit Booking</a>
</td>
</tr>
';
            
            
}

echo '
</table>
';

/*$pagination = getPaginationString($page, $totalitems, $limit, $adjacents = 3, $targetpage = "list-of-bookings.php", $pagestring = "?page=");

echo $pagination;*/

include('footer.php');

?>
