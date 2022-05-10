<?php
include('header.php');
include('db_conn.php');

$id = $_REQUEST['ID'];
$type = $_REQUEST['type'];
$client_id = $_REQUEST['client_id'];
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "";
switch($type){
	case "bookings":
		$sql = "DELETE FROM bookings WHERE ID = '{$id}'";
		break;
	case "payments";
		$sql = "DELETE FROM payments WHERE ID = '{$id}'";
		break;
	case "statement_points";
		$sql = "DELETE FROM statement_points WHERE ID = '{$id}'";
		break;
}

// sql to delete a record
//$sql = "DELETE FROM clients WHERE ID = '{$id}'";

if ($conn->query($sql) === TRUE) {
	
  ?>
  <script type="text/javascript">location.href = 'client-statement.php?ID=<?php echo $client_id; ?>';</script>
  <?php
  
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();


include('footer.php');
?>
