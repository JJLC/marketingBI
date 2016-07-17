<?php

	/**
	 * performs the login
	 */
	session_start();
	
	require_once '../classes/login.php';
	
	$objLogin = new Login($_POST["username"],$_POST["password"]);
	
	$result = $objLogin->login($_POST["username"],$_POST["password"]);
	if ($result>0)
		{
			$_SESSION["uid"] = $result;
			$_SESSION["username"] = $_POST["username"];
			$_SESSION["password"] = $_POST["password"];
			header('Location: http://'.$_SERVER["SERVER_NAME"].'/application/mod_menu/views/menu.html');
		}
		else
			header('Location: http://'.$_SERVER["SERVER_NAME"]);
?>