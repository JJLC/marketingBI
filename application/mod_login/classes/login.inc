<?php

class Login
{
	public $conn;
	
	public function __construct($bduser, $bdpass)
	{
		require_once '../../../config/config.php';
		
		$dsn = BDTYPE.":dbname=".BBDD.";host=".BDSERVER;
		try
		{
			$this->conn = new PDO($dsn, $bduser, $bdpass);
		}
		catch (PDOException $e)
		{
			echo 'Connection failed: ' . $e->getMessage();
		}
	}
	
	public function login($bduser, $bdpass)
	{
		$query = $this->conn->prepare("select * from tb_users where username='".MD5($bduser)."' and password='".MD5($bdpass)."'");
		$query->execute();
		$row = $query->fetch();
		return $row["id"];
	}
}