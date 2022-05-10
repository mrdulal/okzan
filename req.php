<?php
include('db_conn.php');
$sql="SELECT * FROM `pupils` WHERE  `License No` LIKE '%".$_POST['look']."%'" ;
$res_data = mysqli_query($conn,$sql) or die(mysqli_error($conn));
$data=array();
while($row = mysqli_fetch_assoc($res_data)){
	
	$row['Booked On']=$row['Booked On'] == '0000-00-00 00:00:00' ? '' : date('d-m-y', strtotime($row['Booked On']));
	
	$row['Booked For']=($row['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Booked For']));
	
	
	$row['Temp Booking Date'] =($row['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Temp Booking Date']));
	
	$row['Theory Exp']=($row['Theory Exp'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row['Theory Exp']));
	
	$row['Eligible Date']=($row['Eligible Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row['Eligible Date']));
	$row['Applied On']=($row['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d.m', strtotime($row['Applied On']));
	array_push($data,$row);	 
}
echo json_encode($data);
die();
?>