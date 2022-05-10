<?php

include('header.php');

include('db_conn.php');

include('pagination.php');


function update_balance($client_id){
	global $conn;
	$query = "UPDATE `clients` cl SET cl.`last_updated` = NOW(), cl.`Balance` = IFNULL((SELECT (IFNULL(ba.FEESUM,0) - IFNULL(pa.PAYMENTSUM,0)) AS BALANCE FROM (SELECT SUM(b.`Total FEE`) as FEESUM FROM `bookings` b WHERE b.clients_id = '{$client_id}' AND b.`Temp Booking Code` = '') ba, (SELECT SUM(p.`Payment Amount`) as PAYMENTSUM FROM `payments` p WHERE p.Clients_ID = '{$client_id}') pa),0) WHERE cl.`ID` = '{$client_id}'";
	try {
		
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
				
	} catch (\Exception $e) {
	}
	
}

function update_all_balance(){
	global $conn;
	$sql = 'SELECT * FROM clients ORDER BY ID ASC';
	try{
		$res_data = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($res_data)){
			update_balance($row['ID']);
		}
	}catch(\Exception $e){

	}
	
}

$client_id = $_REQUEST['client_id'];
$action = $_REQUEST['action'];

if(isset($action) && !empty($action)){
	switch($action){
		case "update_balance":
			if(isset($client_id) && !empty($client_id)){
				update_balance($client_id);
				echo '<div class="">Client balance successfully updated.</div>';
			}
			break;
		case "update_all_balance":
			update_all_balance();
			echo '<div class="">All Clients balance successfully updated.</div>';
			break;
	}
	
}


?>

	<title>Payments Due - Over Credit Limit</title>	
</head>
<body style="" class="zoom">

<div class="button_father">
	<a href = "index.php">
		<button class="button">Back to Home</button>
	</a>
</div>


<?php
$total_pages_sql = 'SELECT COUNT(*) FROM clients WHERE `Balance` > `credit_limit`';
$result = mysqli_query($conn,$total_pages_sql);
$totalitems = mysqli_fetch_array($result)[0];

?>


<h1>Payments Due - Over Credit Limit, <?php echo $totalitems; ?> in total</h1>
<div style="float:right;margin:20px 0px;"><a class="button ui-button ui-corner-all ui-widget" href="list-of-clients.php?action=update_all_balance" class="first">Update All</a></div>
<div id="edit_message"></div>
<div class="clear"></div>


<?php

$sql = 'SELECT * FROM clients WHERE `Balance` > `credit_limit` ORDER BY ID ASC';
$res_data = mysqli_query($conn,$sql) or die(mysqli_error($conn));

echo '<table>';
echo '
<tr>
<th>ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Address Line 1</th>
<th>Address Town</th>
<th>Address Postcode</th>
<th>Email Address</th>
<th>Telephone</th>
<th>Credit Limit</th>
<th>Balance</th>
<th>Last Updated</th>
<th>Actions</th>
</tr>
';

while($row = mysqli_fetch_array($res_data)){
            
echo '
<tr>
<td>'.$row['ID'].'</td>
<td>'.$row['First Name'].'</td>
<td>'.$row['Last Name'].'</td>
<td>'.$row['Address Line 1'].'</td>
<td>'.$row['Address Town'].'</td>
<td>'.$row['Address Postcode'].'</td>
<td>'.$row['Email Address'].'</td>
<td>'.($is_admin = ($row['Telephone'] == '0') ? '' : $row['Telephone']).'</td>
<td>'.$row['credit_limit'].'</td>
<td>'.($is_admin = ($row['last_updated'] == '0000-00-00 00:00:00') ? '' : $row['Balance']).'</td>
<td>'.($is_admin = ($row['last_updated'] == '0000-00-00 00:00:00') ? '' : date('d M Y - h:ia', strtotime($row['last_updated']))).'</td>
<td>
	<a href="list-of-clients.php?action=update_balance&client_id='.$row['ID'].'" class="first">Update</a>	
	<a href="client-statement.php?ID='.$row['ID'].'" class="first">View Statements</a>
	<a href="make-client-statement.php?ID='.$row['ID'].'" class="first">Make Statement</a>
	<a href="edit-client.php?ID='.$row['ID'].'">Edit Client</a>
	<a href="new-payment.php">New Payment</a>
</td>
</tr>
';
}

echo '
</table>
';

/*$pagination = getPaginationString($page, $totalitems, $limit, $adjacents = 3, $targetpage = "list-of-clients.php", $pagestring = "?page=");

echo $pagination;*/

include('footer.php');

?>
