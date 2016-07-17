<?php

	session_start();

	require_once '../classes/customers.php';

	$objCustomers = new Customers($_SESSION["username"], $_SESSION["password"]);
	
	$final = "<table id='tableBA' class='table table-striped' style='display: block; overflow-y:scroll; width: 100%; height: 500px;'>";
	$final .= "<thead>";
	$final .= "<tr>";
	$final .= "<th>".utf8_encode("Customer No.")."</th>";
	$final .= "<th>".utf8_encode("Name")."</th>";
	$final .= "<th>".utf8_encode("Place")."</th>";
	$final .= "<th>".utf8_encode("Business Area")."</th>";
	$final .= "<th>".utf8_encode("Confid.")."</th>";
	$final .= "<th>&nbsp;</th>";
	$final .= "</tr>";
	$final .= utf8_encode($objCustomers->getCustomersList());
	$final .= "</table>";
	
	echo $final;
	
?>