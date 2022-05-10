<?php

include('header.php');

include('db_conn.php');

include('pagination.php');

?>

	<title>List of Payments</title>	
</head>
<body style="" class="zoom">

<div class="button_father">
	<a href = "index.php">
		<button class="button">Back to Home</button>
	</a>
</div>


<?php
$total_pages_sql = 'SELECT COUNT(*) FROM payments';
$result = mysqli_query($conn,$total_pages_sql);
$totalitems = mysqli_fetch_array($result)[0];

?>


<h1>List of Payments - <?php echo $totalitems; ?> in total</h1>
<div id="edit_message"></div>
<div class="clear"></div>


<?php

$sql = 'SELECT * FROM payments ORDER BY ID DESC';
$res_data = mysqli_query($conn,$sql) or die(mysqli_error($conn));

echo '<table>';
echo '
<tr>
<th>ID</th>
<th>Client &apos; s ID</th>
<th>Payment Amount</th>
<th>Payment Date</th>
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
<td id="'.$row['ID'].'">'.$row['Clients_ID'].'</td>
<td id="'.$row['ID'].'">'.$row['Payment Amount'].'</td>
<td id="'.$row['ID'].'">'.($is_admin = ($row['Payment Date'] == '0000-00-00') ? '' : date('d M Y', strtotime($row['Payment Date']))).'</td>
<td id="'.$row['ID'].'">'.$row['Notes'].'</td>
<td>
	<a href="edit-payment.php?ID='.$row['ID'].'" class="first">Edit Payment</a>
</td>
</tr>
';
            
            
}

echo '
</table>
';

/*$pagination = getPaginationString($page, $totalitems, $limit, $adjacents = 3, $targetpage = "list-of-payments.php", $pagestring = "?page=");

echo $pagination;*/

include('footer.php');

?>
