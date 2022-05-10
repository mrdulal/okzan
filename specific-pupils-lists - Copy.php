<?php

include('header.php');

include('db_conn.php');

include('pagination.php');

?>

	<title>Specific Pupils Lists</title>	
     
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
        $client_sort = 'Clients_ID ASC';
}



$total_pages_sql = 'SELECT COUNT(*) FROM pupils';
$result = mysqli_query($conn,$total_pages_sql);
$totalitems = mysqli_fetch_array($result)[0];

?>

<div class='row'>
	<div class="col">
	<h1>Specific Pupils Lists</h1>
    </div>
    <div class="col col2">
    	<p>License No</p>
        <input type="text" class="search-filter" id="sf"  />
    </div>
    <div class="col">
    <div class="button_father">
	<a href = "new-pupil.php">
		<button class="button">Add New Pupil</button>
	</a>
</div>
    </div>
</div>

<div id="searchresult">
<div class="resultoverlay"><img src="images/loader.gif" ></div>
	<table class="hoho">
	<thead>
<?php
echo '
<tr>
<th>Edt</th>
<th>ID</th>

<th>First & Last Name</th>
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

?>
</thead>
	<tbody id="resultdata">
    	
    </tbody>
</table>
</div>

<a href="specific-pupils-lists.php" class="nok" style="float:right; ">Clear All Sorting Filters</a>

<?php
if (isset($_GET['sorting'])) {
    
    $sql = "SELECT * FROM pupils ORDER BY ".$on_filter;
$res_data = mysqli_query($conn,$sql) or die(mysqli_error($conn));

echo '<table class="hoho">';
echo "<thead>";
echo '
<tr>
<th>Edt</th>
<th>ID</th>

<th>First & Last Name</th>
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

echo "</thead>";

 echo "<tbody>";
while($row = mysqli_fetch_array($res_data)){
            //here goes the data
            
            //echo $page;
            
echo '
<tr>
<td>
<a href="edit-pupil.php?ID='.$row['ID'].'">Edt</a>
</td>
<td>'.$row['ID'].'</td>

<td>'.$row['First Name']." ".$row['Last Name'].'</td>
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

echo "</tbody>";
echo '</table>';
    
}else{
    


$sql = 'SELECT * FROM pupils WHERE `Booked For` = "0000-00-00 00:00:0" AND `Special Code` = "" AND `status` = "" ORDER BY '.$client_sort.$sorting;
$res_data = mysqli_query($conn,$sql) or die(mysqli_error($conn));

echo '<table class="hoho">';
echo "<thead>";
echo '
<tr>
<th>Edt</th>
<th>ID</th>

<th>First & Last Name</th>
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
echo "</thead>";


echo "<tbody>";

echo '<tr class="bocacho_waiting"><td colspan="21" >WAITING</td></tr>';
echo '<span id="waiting" class="digo">';
while($row = mysqli_fetch_array($res_data)){
            //here goes the data
            
            //echo $page;
            
echo '
<tr>
<td>
<a href="edit-pupil.php?ID='.$row['ID'].'">Edt</a>
</td>
<td>'.$row['ID'].'</td>

<td>'.$row['First Name']." ".$row['Last Name'].'</td>
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
echo '
<tr><td colspan="21" ></td></tr>
<tr><td colspan="21" ></td></tr>
';
echo '</span>';
$sorting_elesped ='';
if($sorting==''){
    $sorting = '`Booked For` ASC';
    $sorting_elesped = '`Booked For` DESC';
}


$sql_special = 'SELECT * FROM pupils WHERE `Special Code` != \'\' AND `status` = "" ORDER BY '.$sorting;
$res_data_special = mysqli_query($conn,$sql_special) or die(mysqli_error($conn));

echo '<tr class="bocacho_special"><td colspan="21" >SPECIAL</td></tr>';
echo '<span id="special" class="digo">';
while($row_special = mysqli_fetch_array($res_data_special)){
            //here goes the data
            
            //echo $page;
            
echo '
<tr>
<td><a href="edit-pupil.php?ID='.$row_special['ID'].'">Edt</a>
</td>
<td>'.$row_special['ID'].'</td>

<td>'.$row_special['First Name']." ".$row_special['Last Name'].'</td>
<td class="currency">'.number_format($row_special['FEE']).'</td>
<td class="bold">'.($is_admin = ($row_special['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d.m', strtotime($row_special['Applied On']))).'</td>

<td class="bold">'.$row_special['Code'].'</td>
<td class="bold">'.$row_special['Device'].'</td>

<td>'.strtoupper($row_special['License No']).'</td>
<td>'.$row_special['App Ref'].'</td>
<td class="currency">'.($is_admin = ($row_special['Eligible Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row_special['Eligible Date']))).'</td>
<td class="currency">'.($is_admin = ($row_special['Theory Exp'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row_special['Theory Exp']))).'</td>


<td class="bold" style="white-space: normal;">'.$row_special['Notes'].'</td>
<td>'.$row_special['Clients_ID'].'</td>
<td>'.($is_admin = ($row_special['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_special['Temp Booking Date']))).'</td>
<td class="bold">'.$row_special['Temp Booking Centre'].'</td>
<td class="bold">'.$row_special['Temp Booking Code'].'</td>
<td class="bold">'.$row['OBS'].'</td>
<td>'.($is_admin = ($row_special['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_special['Booked For']))).'</td>
'. ( $special_code = ($row_special['Special Code'] != '') ? '<td class="currency">' : '<td class="bold">').''.$row_special['Test Centre'].'</td>
<td>'.$row_special['Special Code'].'</td>
<td>'.($is_admin = ($row_special['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row_special['Booked On']))).'</td>

</tr>
';
            
            
}
echo '
<tr><td colspan="21" ></td></tr>
<tr><td colspan="21" ></td></tr>
';
echo '</span>';

$sql_not_wood_green = 'SELECT * FROM pupils WHERE `Test Centre` NOT LIKE \'%Wood Green%\' AND `Booked For` >= "'.date('Y-m-d', time()).'" AND `Special Code` = \'\' AND `status` = "" ORDER BY '.$sorting;
$res_data_not_wood_green = mysqli_query($conn,$sql_not_wood_green) or die(mysqli_error($conn));

echo '<tr class="bocacho_not_wood_green"><td colspan="21" >BOOKED - NOT Wood Green</td></tr>';
echo '<span id="not_wood_geen" class="digo">';
while($row_not_wood_green = mysqli_fetch_array($res_data_not_wood_green)){
            //here goes the data
            
            //echo $page;
            
echo '
<tr>
<td><a href="edit-pupil.php?ID='.$row_not_wood_green['ID'].'">Edt</a></td>
<td>'.$row_not_wood_green['ID'].'</td>

<td>'.$row_not_wood_green['First Name']." ".$row_not_wood_green['Last Name'].'</td>
<td class="currency">'.number_format($row_not_wood_green['FEE']).'</td>
<td class="bold">'.($is_admin = ($row_not_wood_green['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d.m', strtotime($row_not_wood_green['Applied On']))).'</td>

<td class="bold">'.$row_not_wood_green['Code'].'</td>
<td class="bold">'.$row_not_wood_green['Device'].'</td>

<td>'.strtoupper($row_not_wood_green['License No']).'</td>
<td>'.$row_not_wood_green['App Ref'].'</td>
<td class="currency">'.($is_admin = ($row_not_wood_green['Eligible Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row_not_wood_green['Eligible Date']))).'</td>
<td class="currency">'.($is_admin = ($row_not_wood_green['Theory Exp'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row_not_wood_green['Theory Exp']))).'</td>


<td class="bold" style="white-space: normal;">'.$row_not_wood_green['Notes'].'</td>
<td>'.$row_not_wood_green['Clients_ID'].'</td>
<td>'.($is_admin = ($row_not_wood_green['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_not_wood_green['Temp Booking Date']))).'</td>
<td class="bold">'.$row_not_wood_green['Temp Booking Centre'].'</td>
<td class="bold">'.$row_not_wood_green['Temp Booking Code'].'</td>
<td class="bold">'.$row_not_wood_green['OBS'].'</td>
<td>'.($is_admin = ($row_not_wood_green['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_not_wood_green['Booked For']))).'</td>
'. ( $special_code = ($row_not_wood_green['Special Code'] != '') ? '<td class="currency">' : '<td class="bold">').''.$row_not_wood_green['Test Centre'].'</td>
<td>'.$row_not_wood_green['Special Code'].'</td>
<td>'.($is_admin = ($row_not_wood_green['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row_not_wood_green['Booked On']))).'</td>

</tr>
';
            
            
}
echo '
<tr><td colspan="21" ></td></tr>
<tr><td colspan="21" ></td></tr>
';
echo '</span>';

$sql_wood_green = 'SELECT * FROM pupils WHERE `Test Centre` LIKE \'%Wood Green%\' AND `Booked For` >= "'.date('Y-m-d', time()).'" AND `Special Code` = \'\' AND `status` = "" ORDER BY '.$sorting;
$res_data_wood_green = mysqli_query($conn,$sql_wood_green) or die(mysqli_error($conn));

echo '<tr class="bocacho_wood_green"><td colspan="21" >BOOKED - WOOD GREEN</td></tr>';
echo '<span id="wood_green" class="digo">';
while($row_wood_green = mysqli_fetch_array($res_data_wood_green)){
            //here goes the data
            
            //echo $page;
            
echo '
<tr>
<td><a href="edit-pupil.php?ID='.$row_wood_green['ID'].'">Edt</a></td>
<td>'.$row_wood_green['ID'].'</td>

<td>'.$row_wood_green['First Name']." ".$row_wood_green['Last Name'].'</td>
<td class="currency">'.number_format($row_wood_green['FEE']).'</td>
<td class="bold">'.($is_admin = ($row_wood_green['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d.m', strtotime($row_wood_green['Applied On']))).'</td>

<td class="bold">'.$row_wood_green['Code'].'</td>
<td class="bold">'.$row_wood_green['Device'].'</td>

<td>'.strtoupper($row_wood_green['License No']).'</td>
<td>'.$row_wood_green['App Ref'].'</td>
<td class="currency">'.($is_admin = ($row_wood_green['Eligible Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row_wood_green['Eligible Date']))).'</td>
<td class="currency">'.($is_admin = ($row_wood_green['Theory Exp'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row_wood_green['Theory Exp']))).'</td>


<td class="bold" style="white-space: normal;">'.$row_wood_green['Notes'].'</td>
<td>'.$row_wood_green['Clients_ID'].'</td>
<td>'.($is_admin = ($row_wood_green['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_wood_green['Temp Booking Date']))).'</td>
<td class="bold">'.$row_wood_green['Temp Booking Centre'].'</td>
<td class="bold">'.$row_wood_green['Temp Booking Code'].'</td>
<td class="bold">'.$row_wood_green['OBS'].'</td>
<td>'.($is_admin = ($row_wood_green['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_wood_green['Booked For']))).'</td>
'. ( $special_code = ($row_wood_green['Special Code'] != '') ? '<td class="currency">' : '<td class="bold">').''.$row_wood_green['Test Centre'].'</td>
<td>'.$row_wood_green['Special Code'].'</td>
<td>'.($is_admin = ($row_wood_green['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row_wood_green['Booked On']))).'</td>

</tr>
';
            
            
}
echo '
<tr><td colspan="21" ></td></tr>
<tr><td colspan="21" ></td></tr>
';
echo '</span>';

if($sorting_elesped!=''){
    $sorting='';
}

$sql_elapsed = 'SELECT * FROM pupils WHERE `Booked For` < "'.date('Y-m-d', time()).'" AND `Booked For` > "0000-00-00 00:00:00" AND `Special Code` = \'\' AND `status` = "" ORDER BY '.$sorting_elesped.$sorting;
$res_data_elapsed = mysqli_query($conn,$sql_elapsed) or die(mysqli_error($conn));

echo '<tr class="bocacho_elapsed"><td colspan="21" >ELAPSED</td></tr>';
echo '<span id="elapsed" class="digo">';
while($row_elapsed = mysqli_fetch_array($res_data_elapsed)){
            //here goes the data
            
            //echo $page;
            
echo '
<tr>
<td><a href="edit-pupil.php?ID='.$row_elapsed['ID'].'">Edt</a></td>
<td>'.$row_elapsed['ID'].'</td>
<td>'.$row_elapsed['First Name']." ".$row_elapsed['Last Name'].'</td>
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
<tr><td colspan="21" ></td></tr>
<tr><td colspan="21" ></td></tr>
';
echo '</span>';

echo "</tbody>";
echo '
</table>
';
}
//$pagination = getPaginationString($page, $totalitems, $limit, $adjacents = 3, $targetpage = "list-of-pupils.php", $pagestring = "?page=");

//echo $pagination;

include('footer.php');

?>
