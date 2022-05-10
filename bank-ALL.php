<?php

include('header.php');

include('db_conn.php');

?>

	<title>BANK</title>	
</head>
<body style="margin-left:auto; margin-right:auto; padding: 0 20px;">

<div class="button_father">
	<a href = "index.php">
		<button class="button">Back to Home</button>
	</a>
</div>


<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
if (isset($_GET['sorting'])) {
	$sorting = $_GET['sorting'];
        $array_sort = explode('`',$sorting);
        
        $short = $array_sort[1];
        $short_by = $array_sort[2];
        $on_filter = "if(`".$short."` = '' or `".$short."` is null,1,0), `".$short."`".$short_by;
       
        $client_sort='';
} else {
	$sorting = '';
        $client_sort = '`Booked On` DESC';
}

$total_pages_sql = 'SELECT COUNT(*) FROM bank';
$result = mysqli_query($conn,$total_pages_sql);
$totalitems = mysqli_fetch_array($result)[0];

?>

<h1>BANK</h1>

<a href="bank-all.php" class="nok" style="float:right; ">Clear All Sorting Filters</a>

<?php
if (isset($_GET['sorting'])) {
    
    $sql = "SELECT * FROM bank ORDER BY ".$on_filter;
$res_data = mysqli_query($conn,$sql) or die(mysqli_error($conn));

echo '<table class="hoho">';
echo '
<tr>
<th>Edt</th>
<th>ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>License No</th>
<th>App Ref</th>
<th>Notes</th>
<th>
<div class="taramba_first">Booked For</div>
<div class="taramba_second">
<a href="bank-all.php?sorting=`Temp Booking Date` ASC" class="taramba"><img src="images/up.png" title="Sort By \'Temp Booking Date\' Ascending"></a>
<a href="bank-all.php?sorting=`Temp Booking Date` DESC" class="taramba"><img src="images/down.png" title="Sort By \'Temp Booking Date\' Descending"></a>
</div>
</th>
<th>Test Centre</th>
<th>OBS</th>
<th>OBS_user</th>
<th>OBS_pass</th>
<th>Status</th>
<th>
<div class="taramba_first">Booked On</div>
<div class="taramba_second">
<a href="bank-all.php?sorting=`Booked On` ASC" class="taramba"><img src="images/up.png" title="Sort By \'Booked On\' Ascending"></a>
<a href="bank-all.php?sorting=`Booked On` DESC" class="taramba"><img src="images/down.png" title="Sort By \'Booked On\' Descending"></a>
</div>
<th>Actions</th>
</th>
</tr>
';


while($row = mysqli_fetch_array($res_data)){
            
echo '
<tr>
<td>
<a href="edit-bank.php?ID='.$row['ID'].'">Edt</a>
</td>
<td>'.$row['ID'].'</td>
<td>'.$row['First Name'].'</td>
<td>'.$row['Last Name'].'</td>
<td>'.strtoupper($row['License No']).'</td>
<td>'.$row['App Ref'].'</td>
<td class="bold" style="white-space: normal;">'.$row['Notes'].'</td>
<td>'.($is_admin = ($row['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Booked For']))).'</td>
<td class="bold">'.$row['Test Centre'].'</td>
<td class="bold">'.$row['OBS'].'</td>
<td class="bold">'.$row['OBS_username'].'</td>
<td class="bold">'.$row['OBS_password'].'</td>
<td>'.$row['Status'].'</td>
<td>'.($is_admin = ($row['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-y- h:ia', strtotime($row['Booked On']))).'</td>
<td>
	<a href="new-page-here">Update/Add</a>
</td>
</tr>
';         
}
echo '</table>';
    
}else{
    


$sql = 'SELECT * FROM bank ORDER BY '.$client_sort.$sorting;
$res_data = mysqli_query($conn,$sql) or die(mysqli_error($conn));

echo '<table class="hoho">';
echo '
<tr>
<th>Edt</th>
<th>ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>License No</th>
<th>App Ref</th>
<th>Notes</th>
<th>
<div class="taramba_first">Booked For</div>
<div class="taramba_second">
<a href="bank-all.php?sorting=`Booked For` ASC" class="taramba"><img src="images/up.png" title="Sort By \'Booked For\' Ascending"></a>
<a href="bank-all.php?sorting=`Booked For` DESC" class="taramba"><img src="images/down.png" title="Sort By \'Booked For\' Descending"></a>
</div>
</th>
<th>Test Centre</th>
<th>OBS</th>
<th>OBS_user</th>
<th>OBS_pass</th>
<th>Status</th>
<th>
<div class="taramba_first">Booked On</div>
<div class="taramba_second">
<a href="bank-all.php?sorting=`Booked On` ASC" class="taramba"><img src="images/up.png" title="Sort By \'Booked On\' Ascending"></a>
<a href="bank-all.php?sorting=`Booked On` DESC" class="taramba"><img src="images/down.png" title="Sort By \'Booked On\' Descending"></a>
</div>
<th>Actions</th>
</th>
</tr>
';


while($row = mysqli_fetch_array($res_data)){
            
echo '
<tr>
<td>
<a href="edit-bank.php?ID='.$row['ID'].'">Edt</a>
</td>
<td>'.$row['ID'].'</td>
<td>'.$row['First Name'].'</td>
<td>'.$row['Last Name'].'</td>
<td>'.strtoupper($row['License No']).'</td>
<td>'.$row['App Ref'].'</td>
<td class="bold" style="white-space: normal;">'.$row['Notes'].'</td>
<td>'.($is_admin = ($row['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Booked For']))).'</td>
<td class="bold">'.$row['Test Centre'].'</td>
<td class="bold">'.$row['OBS'].'</td>
<td class="bold">'.$row['OBS_username'].'</td>
<td class="bold">'.$row['OBS_password'].'</td>
<td>'.$row['Status'].'</td>
<td>'.($is_admin = ($row['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-y - h:ia', strtotime($row['Booked On']))).'</td>
<td>
	<a href="new-page-here">Update/Add</a>
</td>
</tr>
';          
}

echo '
</table>
';
}
include('footer.php');
?>
