<?php

	// company configurations
	if (!defined("COMPANY_NAME")) define("COMPANY_NAME","José João Leitão Correia");
	if (!defined("COMPANY_NIF")) define("COMPANY_NIF","167143298");

	// database configurations
	if (!defined("BBDD")) define("BBDD","mkt_bi");
	if (!defined("BDSERVER")) define("BDSERVER","localhost");
	if (!defined("BDTYPE")) define("BDTYPE","mysql");

	// server configurations
	if (!defined("TIMEZONE")) define("TIMEZONE","Europe/Lisbon");
	
	// APIS configurations
	if (!defined("NIFAPI")) define("NIFAPI","c2b0e2adf09a6b30b8d363639619d17c");
	if (!defined("EGOIAPI")) define ("EGOIAPI","66a72c653ee94a9e05cf061b473aa06c3c75c2c4");
	
	// defining paths
	if (!defined("CONFIG_URL")) define("CONFIG_URL","http://".$_SERVER["HTTP_HOST"]."/config");
	if (!defined("APPLICATION")) define("APPLICATION",$_SERVER["DOCUMENT_ROOT"]."/application");
	if (!defined("APP_URL")) define("APP_URL","http://".$_SERVER["HTTP_HOST"]."/application");
	if (!defined("LIBRARIES")) define("LIBRARIES","http://".$_SERVER["HTTP_HOST"]."/libraries");
	if (!defined("IMAGES")) define("IMAGES","http://".$_SERVER["HTTP_HOST"]."/images");
?>