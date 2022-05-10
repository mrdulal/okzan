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
<?php

$sql = 'SELECT * FROM pupils WHERE `Booked For` = \'0000-00-00 00:00:00\' AND `Special Code` = \'\' AND `status` = ""  ORDER BY Clients_ID ASC';
$res_data = mysqli_query($conn,$sql) or die(mysqli_error($conn));

echo '<table class="hoho">';
echo '
<tr>
<th>ID</th>

<th>First Name</th>
<th>Last Name</th>
<th>FEE</th>
<th>Applied On</th>

<th>Code</th>
<th>Device</th>

<th>License No</th>
<th>App Ref</th>
<th>Eligible Date</th>
<th>Theory Exp</th>


<th>Notes</th>
<th>Clients_ID</th>
<th>Temp Booking Date</th>
<th>Temp Booking Centre</th>

<th>Booked For</th>
<th>Test Centre</th>
<th>Booked On</th>
<th>Special Code</th>
</tr>
';


echo '<tr class="bocacho_waiting"><td colspan="19" >WAITING</td></tr>';
echo '<span id="waiting" class="digo">';
while($row = mysqli_fetch_array($res_data)){
            //here goes the data
            
            //echo $page;
            
echo '
<tr>
<td>'.$row['ID'].'</td>

<td>'.$row['First Name'].'</td>
<td>'.$row['Last Name'].'</td>
<td class="currency">'.number_format($row['FEE']).'</td>
<td class="bold">'.($is_admin = ($row['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d.m', strtotime($row['Applied On']))).'</td>

<td class="bold">'.$row['Code'].'</td>
<td class="bold">'.$row['Device'].'</td>

<td>'.strtoupper($row['License No']).'</td>
<td>'.$row['App Ref'].'</td>
<td class="currency">'.($is_admin = ($row['Eligible Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row['Eligible Date']))).'</td>
<td class="currency">'.($is_admin = ($row['Theory Exp'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row['Theory Exp']))).'</td>


<td class="bold" style="white-space: normal;">'.$row['Notes'].'</td>
<td>'.$row['Clients_ID'].'</td>
<td>'.($is_admin = ($row['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Temp Booking Date']))).'</td>
<td class="bold">'.$row['Temp Booking Centre'].'</td>

<td>'.($is_admin = ($row['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Booked For']))).'</td>
'. ( $special_code = ($row['Special Code'] != '') ? '<td class="currency">' : '<td class="bold">').''.$row['Test Centre'].'</td>
<td>'.($is_admin = ($row['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row['Booked On']))).'</td>
<td>'.$row['Special Code'].'</td>
</tr>
';
            
            
}
echo '
<tr><td colspan="19" ></td></tr>
<tr><td colspan="19" ></td></tr>
';
echo '</span>';


$sql_special = 'SELECT * FROM pupils WHERE `Special Code` != \'\'  AND `status` = "" ORDER BY `Booked For` ASC ';
$res_data_special = mysqli_query($conn,$sql_special) or die(mysqli_error($conn));

echo '<tr class="bocacho_special"><td colspan="19" >SPECIAL</td></tr>';
echo '<span id="special" class="digo">';
while($row_special = mysqli_fetch_array($res_data_special)){
            //here goes the data
            
            //echo $page;
            
echo '
<tr>
<td>'.$row_special['ID'].'</td>

<td>'.$row_special['First Name'].'</td>
<td>'.$row_special['Last Name'].'</td>
<td class="currency">'.number_format($row_special['FEE']).'</td>
<td class="bold">'.($is_admin = ($row_special['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d.m', strtotime($row_special['Applied On']))).'</td>

<td class="bold">'.$row_special['Code'].'</td>
<td class="bold">'.$row_special['Device'].'</td>

<td>'.strtoupper($row_special['License No']).'</td>
<td>'.$row_special['App Ref'].'</td>
<td class="currency">'.($is_admin = ($row_special['Eligible Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row_special['Eligible Date']))).'</td>
<td class="currency">'.($is_admin = ($row_special['Theory Exp'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row_special['Theory Exp']))).'</td>


<td class="bold" style="white-space: normal;">'.$row_special['Notes'].'</td>
<td>'.$row_special['Clients_ID'].'</td>
<td>'.($is_admin = ($row_special['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_special['Temp Booking Date']))).'</td>
<td class="bold">'.$row_special['Temp Booking Centre'].'</td>

<td>'.($is_admin = ($row_special['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_special['Booked For']))).'</td>
'. ( $special_code = ($row_special['Special Code'] != '') ? '<td class="currency">' : '<td class="bold">').''.$row_special['Test Centre'].'</td>
<td>'.($is_admin = ($row_special['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row_special['Booked On']))).'</td>
<td>'.$row_special['Special Code'].'</td>
</tr>
';
            
            
}
echo '
<tr><td colspan="19" ></td></tr>
<tr><td colspan="19" ></td></tr>
';
echo '</span>';


$sql_not_wood_green = 'SELECT * FROM pupils WHERE `Test Centre` NOT LIKE \'%Wood Green%\' AND `Booked For` >= "'.date('Y-m-d', time()).'" AND `Special Code` = \'\'  AND `status` = "" ORDER BY `Booked For` DESC ';
$res_data_not_wood_green = mysqli_query($conn,$sql_not_wood_green) or die(mysqli_error($conn));

echo '<tr class="bocacho_not_wood_green"><td colspan="19" >BOOKED - NOT Wood Green</td></tr>';
echo '<span id="not_wood_geen" class="digo">';
while($row_not_wood_green = mysqli_fetch_array($res_data_not_wood_green)){
            //here goes the data
            
            //echo $page;
            
echo '
<tr>
<td>'.$row_not_wood_green['ID'].'</td>

<td>'.$row_not_wood_green['First Name'].'</td>
<td>'.$row_not_wood_green['Last Name'].'</td>
<td class="currency">'.number_format($row_not_wood_green['FEE']).'</td>
<td class="bold">'.($is_admin = ($row_not_wood_green['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d.m', strtotime($row_not_wood_green['Applied On']))).'</td>

<td class="bold">'.$row_not_wood_green['Code'].'</td>
<td class="bold">'.$row_not_wood_green['Device'].'</td>

<td>'.strtoupper($row_not_wood_green['License No']).'</td>
<td>'.$row_not_wood_green['App Ref'].'</td>
<td class="currency">'.($is_admin = ($row_not_wood_green['Eligible Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row_not_wood_green['Eligible Date']))).'</td>
<td class="currency">'.($is_admin = ($row_not_wood_green['Theory Exp'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row_not_wood_green['Theory Exp']))).'</td>


<td class="bold" style="white-space: normal;">'.$row_not_wood_green['Notes'].'</td>
<td>'.$row_not_wood_green['Clients_ID'].'</td>
<td>'.($is_admin = ($row_not_wood_green['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_not_wood_green['Temp Booking Date']))).'</td>
<td class="bold">'.$row_not_wood_green['Temp Booking Centre'].'</td>

<td>'.($is_admin = ($row_not_wood_green['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_not_wood_green['Booked For']))).'</td>
'. ( $special_code = ($row_not_wood_green['Special Code'] != '') ? '<td class="currency">' : '<td class="bold">').''.$row_not_wood_green['Test Centre'].'</td>
<td>'.($is_admin = ($row_not_wood_green['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row_not_wood_green['Booked On']))).'</td>
<td>'.$row_not_wood_green['Special Code'].'</td>
</tr>
';
            
            
}
echo '
<tr><td colspan="19" ></td></tr>
<tr><td colspan="19" ></td></tr>
';
echo '</span>';


$sql_wood_green = 'SELECT * FROM pupils WHERE `Test Centre` LIKE \'%Wood Green%\' AND `Booked For` >= "'.date('Y-m-d', time()).'" AND `Special Code` = \'\'  AND `status` = "" ORDER BY `Booked For` DESC ';
$res_data_wood_green = mysqli_query($conn,$sql_wood_green) or die(mysqli_error($conn));

echo '<tr class="bocacho_wood_green"><td colspan="19" >BOOKED - WOOD GREEN</td></tr>';
echo '<span id="wood_green" class="digo">';
while($row_wood_green = mysqli_fetch_array($res_data_wood_green)){
            //here goes the data
            
            //echo $page;
            
echo '
<tr>
<td>'.$row_wood_green['ID'].'</td>

<td>'.$row_wood_green['First Name'].'</td>
<td>'.$row_wood_green['Last Name'].'</td>
<td class="currency">'.number_format($row_wood_green['FEE']).'</td>
<td class="bold">'.($is_admin = ($row_wood_green['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d.m', strtotime($row_wood_green['Applied On']))).'</td>

<td class="bold">'.$row_wood_green['Code'].'</td>
<td class="bold">'.$row_wood_green['Device'].'</td>

<td>'.strtoupper($row_wood_green['License No']).'</td>
<td>'.$row_wood_green['App Ref'].'</td>
<td class="currency">'.($is_admin = ($row_wood_green['Eligible Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row_wood_green['Eligible Date']))).'</td>
<td class="currency">'.($is_admin = ($row_wood_green['Theory Exp'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row_wood_green['Theory Exp']))).'</td>


<td class="bold" style="white-space: normal;">'.$row_wood_green['Notes'].'</td>
<td>'.$row_wood_green['Clients_ID'].'</td>
<td>'.($is_admin = ($row_wood_green['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_wood_green['Temp Booking Date']))).'</td>
<td class="bold">'.$row_wood_green['Temp Booking Centre'].'</td>

<td>'.($is_admin = ($row_wood_green['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_wood_green['Booked For']))).'</td>
'. ( $special_code = ($row_wood_green['Special Code'] != '') ? '<td class="currency">' : '<td class="bold">').''.$row_wood_green['Test Centre'].'</td>
<td>'.($is_admin = ($row_wood_green['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row_wood_green['Booked On']))).'</td>
<td>'.$row_wood_green['Special Code'].'</td>
</tr>
';
            
            
}
echo '
<tr><td colspan="19" ></td></tr>
<tr><td colspan="19" ></td></tr>
';
echo '</span>';


$sql_elapsed = 'SELECT * FROM pupils WHERE `Booked For` < "'.date('Y-m-d', time()).'" AND `Booked For` > "0000-00-00 00:00:00" AND `Special Code` = \'\'  AND `status` = "" ORDER BY `Booked For` DESC ';
$res_data_elapsed = mysqli_query($conn,$sql_elapsed) or die(mysqli_error($conn));

echo '<tr class="bocacho_elapsed"><td colspan="19" >ELAPSED</td></tr>';
echo '<span id="elapsed" class="digo">';
while($row_elapsed = mysqli_fetch_array($res_data_elapsed)){
            //here goes the data
            
            //echo $page;
            
echo '
<tr>
<td>'.$row_elapsed['ID'].'</td>

<td>'.$row_elapsed['First Name'].'</td>
<td>'.$row_elapsed['Last Name'].'</td>
<td class="currency">'.number_format($row_elapsed['FEE']).'</td>
<td class="bold">'.($is_admin = ($row_elapsed['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d.m', strtotime($row_elapsed['Applied On']))).'</td>

<td class="bold">'.$row_elapsed['Code'].'</td>
<td class="bold">'.$row_elapsed['Device'].'</td>

<td>'.strtoupper($row_elapsed['License No']).'</td>
<td>'.$row_elapsed['App Ref'].'</td>
<td class="currency">'.($is_admin = ($row_elapsed['Eligible Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row_elapsed['Eligible Date']))).'</td>
<td class="currency">'.($is_admin = ($row_elapsed['Theory Exp'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row_elapsed['Theory Exp']))).'</td>


<td class="bold" style="white-space: normal;">'.$row_elapsed['Notes'].'</td>
<td>'.$row_elapsed['Clients_ID'].'</td>
<td>'.($is_admin = ($row_elapsed['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_elapsed['Temp Booking Date']))).'</td>
<td class="bold">'.$row_elapsed['Temp Booking Centre'].'</td>

<td>'.($is_admin = ($row_elapsed['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row_elapsed['Booked For']))).'</td>
'. ( $special_code = ($row_elapsed['Special Code'] != '') ? '<td class="currency">' : '<td class="bold">').''.$row_elapsed['Test Centre'].'</td>
<td>'.($is_admin = ($row_elapsed['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-Y', strtotime($row_elapsed['Booked On']))).'</td>
<td>'.$row_elapsed['Special Code'].'</td>
</tr>
';
            
            
}
echo '
<tr><td colspan="19" ></td></tr>
<tr><td colspan="19" ></td></tr>
';
echo '</span>';


echo '
</table>
';

//$pagination = getPaginationString($page, $totalitems, $limit, $adjacents = 3, $targetpage = "list-of-pupils.php", $pagestring = "?page=");

//echo $pagination;

include('footer.php');

?>
