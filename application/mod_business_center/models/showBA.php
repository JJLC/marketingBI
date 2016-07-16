<?php

	session_start();
	
	require_once '../classes/business_areas.inc';
	
	$objBusinessAreas = new BusinessAreas($_SESSION["username"], $_SESSION["password"]);
	
	$objBusinessAreas->getBusinessArea($_REQUEST["id"]);
	
	$final = "<form name='BArecord'>";
	$final .= "<label for='bacode'>BA Code: <input type='text' class='form-control' id='bacode' value='".$_REQUEST["id"]."' disabled></label>";
	$final .= "<label for='baname'>Name: <input type='text' class='form-control' id='baname' value='".$objBusinessAreas->name."'></label><br/><br/>";
	$final .= "<label for='baaddress1'>Address:</label><input type='text' class='form-control' id='baaddress1' value='".$objBusinessAreas->address1."'>";
	$final .= "<input type='text' class='form-control' id='address2' value='".$objBusinessAreas->address2."'></label><br/>";
	$final .= "<label for='baplace'>Place:</label><input type='text' class='form-control' id='baplace' value='".$objBusinessAreas->place."'><br/>";	
	$final .= "<label for='bazipcode'>ZIP Code:<input type='text' class='form-control' id='bazipcode' value='".$objBusinessAreas->zipcode."'>";
	$final .= "<input type='text' class='form-control' id='bazipplace' value='".$objBusinessAreas->zipplace."'></label><br/>";
	$final .= "<label for='baphone'>Phone Number: <input type='text' class='form-control' id='baphone' value='".$objBusinessAreas->telephone."' </label>";
	$final .= "<label for='bafax'>Fax Number: <input type='text' class='form-control' id='bafax' value='".$objBusinessAreas->telefax."'></label>";
	$final .= "</form>";
	
	echo $final;
?>