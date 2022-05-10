<?php

// Header for the utf-8 output
header('Content-Type: text/html; charset=utf-8');

// Error reporting setup
error_reporting(0);


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel='icon' href='favicon.ico' type='image/x-icon'> 
	<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'>

	<link href="src/jquery-ui.css" rel="stylesheet">	
	<link href="src/style.css" rel="stylesheet">
	
	<style>
	.row {
    display: flex;
    align-items: center;
    flex-grow: 1;
    max-width: 760px;
}
.col {
    flex-grow: 1;
    align-items: center;
    display: flex;
    flex-direction: row;
    justify-content: left !important;
    text-align: left;
}
.col.col2 {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
}

	</style>	


