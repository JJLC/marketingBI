<?php

/**
 * 
 * @author José Correia
 *
 */
class Login
{
	public $conn;
	
	/**
	 * 
	 * @param string $bduser (username)
	 * @param string $bdpass (password)
	 * 
	 * connects to the database. will fail if the user don't have permissions on the database engine
	 */
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
	
	/**
	 * 
	 * @param string $bduser (username)
	 * @param string $bdpass (password)
	 * @return integer
	 * 
	 * performs the login and the returns the user id
	 */
	public function login($bduser, $bdpass)
	{
		$query = $this->conn->prepare("select * from tb_users where username='".MD5($bduser)."' and password='".MD5($bdpass)."'");
		$query->execute();
		$row = $query->fetch();
		return $row["id"];
	}
}