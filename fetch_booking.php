<?php

include('db_conn.php');

header('Content-Type: application/json');
$query = 'SELECT * FROM bookings WHERE ID = "' . mysqli_real_escape_string($conn, $_GET['id']) . '"LIMIT 1';

$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// $row =  mysqli_fetch_array($result);

// echo "<pre>";
// var_dump($row);

// die;
$value = array();
while ($row = mysqli_fetch_array($result)) {

    //get the data from the database
    $value[] = array(
        'id' => $row['ID'],
        'pupils_id' => $row['Pupils_ID'],
        'clients_id' =>   $row['clients_id'],
        'first_name' => $row['First Name'],
        'last_name' => $row['Last Name'],
        'app_ref' => $row['app_ref'],
        'temp_booking_date'  =>   $row['Temp Booking Date'],
        'temp_booking_code'  =>   $row['Temp Booking Code'],
        'temp_booking_center'  =>  $row['Temp Booking Centre'],
        'booked_for' => $row['Booked For'],
        'test_center' => $row['Test Centre'],
        'booked_on' =>   $row['Booked On'],
        'temp_booking_booked_on' =>     $row['temp_booking_booked_on'],
        'fee' =>    $row['FEE'],
        'total_fee' => $row['Total FEE'],
        'special_code' =>    $row['Special Code'],
        'notes' => $row['Notes'],
        'obs' => $row['OBS'],
    );
}


echo json_encode($value);
