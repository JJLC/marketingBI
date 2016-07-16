<?php

	session_start();
	
	require_once '../classes/business_areas.inc';
	
	$objBusinessAreas = new BusinessAreas($_SESSION["username"], $_SESSION["password"]);
	
	$final = "<table id='tableBA' class='table table-striped' style='display: block; overflow-y:scroll; width: 100%; height: 500px;'>";
	$final .= "<thead>";
	$final .= "<tr>";
	$final .= "<th>Cod</th>";
	$final .= "<th>".utf8_encode("Business Area Name")."</th>";
	$final .= "<th>".utf8_encode("Place")."</th>";
	$final .= "<th>".utf8_encode("City")."</th>";
	$final .= "</tr>";
	$final .= utf8_encode($objBusinessAreas->listBusinessAreas());
	$final .= "</table>";
	
	echo $final;
?>