<style>

tr td:nth-child(1), tr td:nth-child(2), tr td:nth-child(3), tr td:nth-child(4), tr td:nth-child(5), tr td:nth-child(6), tr td:nth-child(7), tr td:nth-child(8), tr td:nth-child(10), tr td:nth-child(11), tr td:nth-child(12), tr td:nth-child(13), tr td:nth-child(14), tr td:nth-child(15), tr td:nth-child(16), tr td:nth-child(17), tr td:nth-child(18), tr td:nth-child(19), tr td:nth-child(20), tr td:nth-child(21), tr td:nth-child(22){
-webkit-touch-callout:none;
-webkit-user-select:none;
-khtml-user-select:none;
-moz-user-select:none;
-ms-user-select:none;
-o-user-select:none;
user-select:none;
}
</style>

<?php

include('header.php');

include('db_conn.php');

include('pagination.php');

?>

	<title>CLEAN</title>
<head>



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
        $client_sort = 'Clients_ID ASC';
}



$total_pages_sql = 'SELECT COUNT(*) FROM pupils';
$result = mysqli_query($conn,$total_pages_sql);
$totalitems = mysqli_fetch_array($result)[0];

?>

<h1>CLEAN List</h1>

<a href="specific-pupils-lists.php" class="nok" style="float:right; ">Clear All Sorting Filters</a>

<?php
if (isset($_GET['sorting'])) {
    
    $sql = "SELECT * FROM pupils ORDER BY ".$on_filter;
$res_data = mysqli_query($conn,$sql) or die(mysqli_error($conn));

echo '<table class="hoho">';
echo '
<tr>
<th>Edt</th>
<th>ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>FEE</th>
<th>Applied On</th>
<th>Code</th>
<th>
<div class="taramba_first">Device</div>
<div class="taramba_second">
<a href="specific-pupils-lists.php?sorting=`Device` ASC" class="taramba"><img src="images/up.png" title="Sort By \'Device\' Ascending"></a>
<a href="specific-pupils-lists.php?sorting=`Device` DESC" class="taramba"><img src="images/down.png" title="Sort By \'Device\' Descending"></a>
</div>
</th>
<th>License No</th>
<th>App Ref</th>
<th>Eligible Date</th>
<th>Theory Exp</th>
<th>Notes</th>
<th>Clients_ID</th>
<th>
<div class="taramba_first">Temp Booking Date</div>
<div class="taramba_second">
<a href="specific-pupils-lists.php?sorting=`Temp Booking Date` ASC" class="taramba"><img src="images/up.png" title="Sort By \'Temp Booking Date\' Ascending"></a>
<a href="specific-pupils-lists.php?sorting=`Temp Booking Date` DESC" class="taramba"><img src="images/down.png" title="Sort By \'Temp Booking Date\' Descending"></a>
</div>
</th>
<th>Temp Booking Centre</th>
<th>Temp Booking Code</th>
<th>OBS</th>
<th>Booked For</th>
<th>Test Centre</th>
<th>Special Code</th>
<th>
<div class="taramba_first">Booked On</div>
<div class="taramba_second">
<a href="specific-pupils-lists.php?sorting=`Booked On` ASC" class="taramba"><img src="images/up.png" title="Sort By \'Booked On\' Ascending"></a>
<a href="specific-pupils-lists.php?sorting=`Booked On` DESC" class="taramba"><img src="images/down.png" title="Sort By \'Booked On\' Descending"></a>
</div>
</th>
</tr>
';


while($row = mysqli_fetch_array($res_data)){
            //here goes the data
            
            //echo $page;
            
echo '
<tr>
<td>
<a href="edit-pupil.php?ID='.$row['ID'].'">Edt</a>
</td>
<td>'.$row['ID'].'</td>
<td>'.$row['First Name'].'</td>
<td>'.$row['Last Name'].'</td>
<td class="currency">'.number_format($row['FEE']).'</td>
<td class="bold">'.($is_admin = ($row['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d.m', strtotime($row['Applied On']))).'</td>
<td class="bold">'.$row['Code'].'</td>
<td class="bold">'.$row['Device'].'</td>
<td>'.strtoupper($row['License No']).'</td>
<td>'.$row['App Ref'].'</td>
<td class="currency">'.($is_admin = ($row['Eligible Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row['Eligible Date']))).'</td>
<td class="currency">'.($is_admin = ($row['Theory Exp'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row['Theory Exp']))).'</td>
<td class="bold" style="white-space: normal;">'.$row['Notes'].'</td>
<td>'.$row['Clients_ID'].'</td>
<td>'.($is_admin = ($row['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Temp Booking Date']))).'</td>
<td class="bold">'.$row['Temp Booking Centre'].'</td>
<td class="bold">'.$row['Temp Booking Code'].'</td>
<td class="bold">'.$row['OBS'].'</td>
<td>'.($is_admin = ($row['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Booked For']))).'</td>
'. ( $special_code = ($row['Special Code'] != '') ? '<td class="currency">' : '<td class="bold">').''.$row['Test Centre'].'</td>
<td>'.$row['Special Code'].'</td>
<td>'.($is_admin = ($row['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row['Booked On']))).'</td>
</tr>
';
            
            
}
echo '</table>';
    
}else{
    


$sql = 'SELECT * FROM pupils WHERE `Booked For` = "0000-00-00 00:00:0" AND `Special Code` = "" ORDER BY '.$client_sort.$sorting;
$res_data = mysqli_query($conn,$sql) or die(mysqli_error($conn));

echo '<table class="hoho">';
echo '
<tr>
<th>Edt</th>
<th>ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>FEE</th>
<th>Applied On</th>
<th>Code</th>
<th>
<div class="taramba_first">Device</div>
<div class="taramba_second">
<a href="specific-pupils-lists.php?sorting=`Device` ASC" class="taramba"><img src="images/up.png" title="Sort By \'Device\' Ascending"></a>
<a href="specific-pupils-lists.php?sorting=`Device` DESC" class="taramba"><img src="images/down.png" title="Sort By \'Device\' Descending"></a>
</div>
</th>
<th>License No</th>
<th>App Ref</th>
<th>Eligible Date</th>
<th>Theory Exp</th>
<th>Notes</th>
<th>Clients_ID</th>
<th>
<div class="taramba_first">Temp Booking Date</div>
<div class="taramba_second">
<a href="specific-pupils-lists.php?sorting=`Temp Booking Date` ASC" class="taramba"><img src="images/up.png" title="Sort By \'Temp Booking Date\' Ascending"></a>
<a href="specific-pupils-lists.php?sorting=`Temp Booking Date` DESC" class="taramba"><img src="images/down.png" title="Sort By \'Temp Booking Date\' Descending"></a>
</div>
</th>
<th>Temp Booking Centre</th>
<th>Temp Booking Code</th>
<th>OBS</th>
<th>Booked For</th>
<th>Test Centre</th>
<th>Special Code</th>
<th>
<div class="taramba_first">Booked On</div>
<div class="taramba_second">
<a href="specific-pupils-lists.php?sorting=`Booked On` ASC" class="taramba"><img src="images/up.png" title="Sort By \'Booked On\' Ascending"></a>
<a href="specific-pupils-lists.php?sorting=`Booked On` DESC" class="taramba"><img src="images/down.png" title="Sort By \'Booked On\' Descending"></a>
</div>
</th>
</tr>
';


$sorting_elesped ='';
if($sorting==''){
    $sorting = '`Booked For` ASC';
    $sorting_elesped = '`Booked For` DESC';
}
if($sorting_elesped!=''){
    $sorting='';
}
$sql_elapsed = 'SELECT * FROM pupils WHERE `App Ref` LIKE \'%CLEAN%\' ORDER BY '.$client_sort.$sorting;
$res_data_elapsed = mysqli_query($conn,$sql_elapsed) or die(mysqli_error($conn));
echo '<tr class="bocacho_elapsed"><td colspan="22" >SQUEAKY CLEAN</td></tr>';
echo '<span id="elapsed" class="digo">';
while($row_elapsed = mysqli_fetch_array($res_data_elapsed)){
            //here goes the data
            //echo $page;            
echo '
<tr>
<td><a href="edit-pupil.php?ID='.$row_elapsed['ID'].'">Edt</a></td>
<td>'.$row_elapsed['ID'].'</td>
<td>'.$row_elapsed['First Name'].'</td>
<td>'.$row_elapsed['Last Name'].'</td>
<td class="currency">'.number_format($row_elapsed['FEE']).'</td>
<td class="bold">'.($is_admin = ($row_elapsed['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d.m', strtotime($row_elapsed['Applied On']))).'</td>
<td class="bold">'.$row_elapsed['Code'].'</td>
<td class="bold">'.$row_elapsed['Device'].'</td>
<td>'.strtoupper($row_elapsed['License No']).'</td>
<td>'.$row_elapsed['App Ref'].'</td>
<td class="currency">'.($is_admin = ($row_elapsed['Eligible Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row_elapsed['Eligible Date']))).'</td>
<td class="currency">'.($is_admin = ($row_elapsed['Theory Exp'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row_elapsed['Theory Exp']))).'</td>
<td class="bold" style="white-space: normal;">'.$row_elapsed['Notes'].'</td>
<td>'.$row_elapsed['Clients_ID'].'</td>
<td>'.($is_admin = ($row_elapsed['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_elapsed['Temp Booking Date']))).'</td>
<td class="bold">'.$row_elapsed['Temp Booking Centre'].'</td>
<td class="bold">'.$row_elapsed['Temp Booking Code'].'</td>
<td class="bold">'.$row_elapsed['OBS'].'</td>
<td>'.($is_admin = ($row_elapsed['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_elapsed['Booked For']))).'</td>
'. ( $special_code = ($row_elapsed['Special Code'] != '') ? '<td class="currency">' : '<td class="bold">').''.$row_elapsed['Test Centre'].'</td>
<td>'.$row_elapsed['Special Code'].'</td>
<td>'.($is_admin = ($row_elapsed['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row_elapsed['Booked On']))).'</td>
</tr>
';            
            
}
echo '
<tr><td colspan="22" ></td></tr>
<tr><td colspan="22" ></td></tr>
';
echo '</span>';
echo '
</table>
';
}
//$pagination = getPaginationString($page, $totalitems, $limit, $adjacents = 3, $targetpage = "list-of-pupils.php", $pagestring = "?page=");
//echo $pagination;

include('footer.php');

?>
