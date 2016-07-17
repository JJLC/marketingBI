<?php

/**
 *
 * @author José Correia
 *
 */
class Customers
{
	public $conn;
	
	/**
	 * 
	 * @param integer $id
	 * @return string
	 * 
	 * gets the name of a business area
	 */
	private function getCustomerBA($id)
	{
		$query = $this->conn->prepare("select name from tb_business_areas where id=$id");
		$query->execute();
		$row = $query->fetch();
		return $row["name"];
	}
	
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
	 * @return string
	 * 
	 * gets the list of all customers, and return a string the table body
	 */
	public function getCustomersList()
	{
		$query = $this->conn->prepare("select * from tb_customers");
		$query->execute();
		$resultado = "<tbody>";
		while ($row = $query->fetch())
		{
			$resultado .= "<tr>";
			$resultado .= "<td>".$row["num_cliente"]."</td>";
			$resultado .= "<td>".$row["nome"]." ".$row["apelido"]."</td>";
			$resultado .= "<td>".$row["localidade"]."</td>";
			$resultado .= "<td>".$this->getCustomerBA($row["area_negocios_2"])."</td>";
			$resultado .= "<td>&nbsp;</td>";
			$resultado .= "<td>";
			$resultado .= "<img src='/images/icons/data_view.png' />";
			$resultado .= "</td>";
			$resultado .= "</tr>";
		}
		$resultado .= "</tbody>";
		return $resultado;
	}
}