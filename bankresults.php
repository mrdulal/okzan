<?php

include('header.php');

include('db_conn.php');

include('pagination.php');
$ID = $_GET['ID'];

?>

<title>Bank results</title>

</head>

<body style="margin-top:0; margin-left:auto; margin-right:auto; padding: 0 5px;">

    <div class="button_father">
        <a href="index.php">
            <button class="button">Back to Home</button>
        </a>
    </div>


    <?php
    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);


    if (isset($_GET['sorting'])) {
        $sorting = $_GET['sorting'];
        $array_sort = explode('`', $sorting);

        $short = $array_sort[1];
        $short_by = $array_sort[2];
        $on_filter = "if(`" . $short . "` = '' or `" . $short . "` is null,1,0), `" . $short . "`" . $short_by;

        $client_sort = '';
    } else {
        $sorting = '';
        $client_sort = 'Clients_ID ASC';
    }


    $total_pages_sql = 'SELECT COUNT(*) FROM pupils';
    $result = mysqli_query($conn, $total_pages_sql);
    $totalitems = mysqli_fetch_array($result)[0];

    ?>

    <div class='row'>
        <div class="col">
            <h1>Bank results</h1>
        </div>
        <div class="col col2">
            <p>License No</p>
            <input type="text" class="search-filter" id="sf" />
        </div>
    </div>

    <div id="searchresult">
        <div class="resultoverlay"><img src="images/loader.gif"></div>
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

        $sql = "SELECT * FROM pupils ORDER BY " . $on_filter;
        $res_data = mysqli_query($conn, $sql) or die(mysqli_error($conn));

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
<th>
Actions
</th>

</tr>
';

        echo "</thead>";

        echo "<tbody>";
        while ($row = mysqli_fetch_array($res_data)) {
            //here goes the data

            //echo $page;

            echo '
<tr>
<td>
<a href="edit-pupil.php?ID=' . $row['ID'] . '">Edt</a>
</td>
<td>' . $row['ID'] . '</td>

<td>' . $row['First Name'] . " " . $row['Last Name'] . '</td>
<td class="currency">' . number_format($row['FEE']) . '</td>
<td class="bold">' . ($is_admin = ($row['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d.m', strtotime($row['Applied On']))) . '</td>

<td class="bold">' . $row['Code'] . '</td>
<td class="bold">' . $row['Device'] . '</td>

<td>' . strtoupper($row['License No']) . '</td>
<td>' . $row['App Ref'] . '</td>
<td class="currency">' . ($is_admin = ($row['Eligible Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row['Eligible Date']))) . '</td>
<td class="currency">' . ($is_admin = ($row['Theory Exp'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row['Theory Exp']))) . '</td>


<td class="bold" style="white-space: normal;">' . $row['Notes'] . '</td>
<td>' . $row['Clients_ID'] . '</td>
<td>' . ($is_admin = ($row['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Temp Booking Date']))) . '</td>
<td class="bold">' . $row['Temp Booking Centre'] . '</td>
<td class="bold">' . $row['Temp Booking Code'] . '</td>
<td class="bold">' . $row['OBS'] . '</td>
<td>' . ($is_admin = ($row['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Booked For']))) . '</td>
' . ($special_code = ($row['Special Code'] != '') ? '<td class="currency">' : '<td class="bold">') . '' . $row['Test Centre'] . '</td>
<td>' . $row['Special Code'] . '</td>
<td>' . ($is_admin = ($row['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row['Booked On']))) . '</td>

<td>
<a href="edit-results.php?ID=' . $ID . '&pi=' . $row['ID'] . ' ">Select</a>
</td>

</tr>
';
        }

        echo "</tbody>";
        echo '</table>';
    } else {
        if (isset($_GET['li'])) {
            $li = $_GET['li'];
        } else {
        }


        $sql = 'SELECT * FROM pupils WHERE `License No`LIKE "%' . $li . '%" ORDER BY ' . $client_sort . $sorting;
        $res_data = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        if (mysqli_num_rows($res_data) < 1) {
    ?>
    <script type="text/javascript">
    window.location.replace(
        '<?php echo "./new-pupil-results.php?no-result&li=" . $_GET["li"] . "&ID=" . $_GET["ID"]; ?>');
    </script>
    <?php
        }

        echo '<table class="hoho">';
        echo "<thead>";
        echo '
<tr>
<th>Edt</th>
<th>
Actions
</th>
<th>
Actions
</th>
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
<th>
Actions
</th>
<th>
Actions
</th>

</tr>
';
        echo "</thead>";


        echo "<tbody>";


        echo '<span id="waiting" class="digo">';
        while ($row = mysqli_fetch_array($res_data)) {
            //here goes the data

            //echo $page;

            echo '
<tr>
<td>
<a href="edit-pupil.php?ID=' . $row['ID'] . '">Edt</a>
</td>
<td>
<a href="edit-results.php?ID=' . $ID . '&pi=' . $row['ID'] . ' ">Select</a>

</td>
<td>

<span style="font-size: 16px;
    font-weight: 600;
    text-decoration: none;color:blue" class="auto-update" data-id="' . $ID . '" data-li="' . $row['ID'] . '">AutoUpdate</span>
</td>
<td>' . $row['ID'] . '</td>

<td>' . $row['First Name'] . " " . $row['Last Name'] . '</td>
<td class="currency">' . number_format($row['FEE']) . '</td>
<td class="bold">' . ($is_admin = ($row['Applied On'] == '0000-00-00 00:00:00') ? '' : date('d.m', strtotime($row['Applied On']))) . '</td>

<td class="bold">' . $row['Code'] . '</td>
<td class="bold">' . $row['Device'] . '</td>

<td>' . strtoupper($row['License No']) . '</td>
<td>' . $row['App Ref'] . '</td>
<td class="currency">' . ($is_admin = ($row['Eligible Date'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row['Eligible Date']))) . '</td>
<td class="currency">' . ($is_admin = ($row['Theory Exp'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row['Theory Exp']))) . '</td>


<td class="bold" style="white-space: normal;">' . $row['Notes'] . '</td>
<td>' . $row['Clients_ID'] . '</td>
<td>' . ($is_admin = ($row['Temp Booking Date'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Temp Booking Date']))) . '</td>
<td class="bold">' . $row['Temp Booking Centre'] . '</td>
<td class="bold">' . $row['Temp Booking Code'] . '</td>
<td class="bold">' . $row['OBS'] . '</td>
<td>' . ($is_admin = ($row['Booked For'] == '0000-00-00 00:00:00') ? '' : date('D d M Y - h:ia', strtotime($row['Booked For']))) . '</td>
' . ($special_code = ($row['Special Code'] != '') ? '<td class="currency">' : '<td class="bold">') . '' . $row['Test Centre'] . '</td> 
<td>' . $row['Special Code'] . '</td> 
<td>' . ($is_admin = ($row['Booked On'] == '0000-00-00 00:00:00') ? '' : date('d-m-y', strtotime($row['Booked On']))) . '</td>
<td>
<a href="edit-results.php?ID=' . $ID . '&pi=' . $row['ID'] . ' ">Select</a>

</td>
<td>

<span style="font-size: 16px;
    font-weight: 600;
    text-decoration: none;color:blue" class="auto-update" data-id="' . $ID . '" data-li="' . $row['ID'] . '">AutoUpdate</span>
</td>
</tr>
';
        }

        echo '</span>';
        $sorting_elesped = '';
        if ($sorting == '') {
            $sorting = '`Booked For` ASC';
            $sorting_elesped = '`Booked For` DESC';
        }


        $sql_special = 'SELECT * FROM pupils WHERE `Special Code` != \'\' AND `status` = "" ORDER BY ' . $sorting;
        $res_data_special = mysqli_query($conn, $sql_special) or die(mysqli_error($conn));


        $sql_wood_green = 'SELECT * FROM pupils WHERE `Test Centre` LIKE \'%Wood Green%\' AND `Booked For` >= "' . date('Y-m-d', time()) . '" AND `Special Code` = \'\' AND `status` = "" ORDER BY ' . $sorting;
        $res_data_wood_green = mysqli_query($conn, $sql_wood_green) or die(mysqli_error($conn));


        if ($sorting_elesped != '') {
            $sorting = '';
        }

        $sql_elapsed = 'SELECT * FROM pupils WHERE `Booked For` < "' . date('Y-m-d', time()) . '" AND `Booked For` > "0000-00-00 00:00:00" AND `Special Code` = \'\' AND `status` = "" ORDER BY ' . $sorting_elesped . $sorting;
        $res_data_elapsed = mysqli_query($conn, $sql_elapsed) or die(mysqli_error($conn));


        echo "</tbody>";
        echo '
</table>
';
    }


    //$pagination = getPaginationString($page, $totalitems, $limit, $adjacents = 3, $targetpage = "list-of-pupils.php", $pagestring = "?page=");

    //echo $pagination;
    ?>


    <?php include('footer.php');

    ?>

    <body>
        <p>Click on the button below to add new pupil</p>

        <button onclick="newresultbooking()">New Pupil</button>

        <script>
        function newresultbooking() {

            window.location.replace(
                '<?php echo "./new-pupil-results.php?no-result&li=" . $_GET["li"] . "&ID=" . $_GET["ID"]; ?>');

        }
        </script>
    </body>
    <script type=text/javascript>
    $(document).ready(function() {
        $('.auto-update').on('click', function() {
            console.log("Updating...");
            var id = $(this).attr('data-id');
            var li = $(this).attr('data-li');

            $.ajax({
                type: "POST",
                url: "./autoupdateresults.php",
                dataType: "text",
                data: {
                    id: id,
                    li: li,
                },
                success: function(response) {

                    if (response == "redirect") {
                        alert('Error');
                    } else {

                        // alert('updated');
                        //var text = li;

                        // console.log(response);
                        // copyToClipboard(text);

                        setTimeout(function() {
                            window.location.replace("bank.php");
                        }, 300);


                    }
                }

            });

            function copyToClipboard(text) {
                if (navigator.clipboard) { // default: modern asynchronous API
                    return navigator.clipboard.writeText(text);
                } else if (window.clipboardData && window.clipboardData.setData) { // for IE11
                    window.clipboardData.setData('Text', text);
                    return Promise.resolve();
                } else {
                    // workaround: create dummy input
                    const input = h('input', {
                        type: 'text'
                    });
                    input.value = text;
                    document.body.append(input);
                    input.focus();
                    input.select();
                    document.execCommand('copy');
                    input.remove();
                    return Promise.resolve();
                }
            }


        });
    });
    </script>