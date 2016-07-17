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
	 * @param char $id (id of gender)
	 * @return string
	 *
	 * returns the gender of a customer
	 */
	private function getGender($id)
	{
		$query = $this->conn->prepare("select id from tb_genders where sigla='$id'");
		$query->execute();
		$row = $query->fetch();
		return $row[0];
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
	
	/**
	 * 
	 * @param integer $id_ba (id of business area)
	 * @param integer $ba_type (type of business area)
	 * @param char $gender (gender of customer)
	 * @param integer $confid (confidentiality)
	 * @return string
	 * 
	 * gets a list of customers by business area, gender and confidentiality, and returns a string with the tbody
	 */
	public function getLisBACustomer($id_ba, $ba_type, $gender, $confid)
	{
		switch ($gender)
		{
			case "A" : 	$genderFilter = "";
						break;
			default  :	$genderFilter = " and id_gender=".$this->getGender($gender);
						break;
		}
		
		switch ($confid)
		{
			case 0 : 	$confidFilter = "";
						break;
			case 1 :	$confidFilter = " and confiden_email=2";
						break;
			case 2 :	$confidFilter = " and confiden_sms=2";
						break;
			case 3 :	$confidFilter = " and confiden_mms=2";
						break;
			case 4 :	$confidFilter = " and confiden_offline=2";
						break;
		}
		
		$SQLstring = "select * from tb_customers where area_negocios_$ba_type=$id_ba $genderFilter $confidFilter";
		$query = $this->conn->prepare("select * from tb_customers where area_negocios_$ba_type=$id_ba $genderFilter $confidFilter");
		$query->execute();
		$resultado = "<tbody>";
		while ($row = $query->fetch())
		{
			$resultado .= "<tr>";
			$resultado .= "<td>".$row["num_cliente"]."</td>";
			$resultado .= "<td>".$row["nome"]." ".$row["apelido"]."</td>";
			$resultado .= "<td>".$row["localidade"]."</td>";
			$resultado .= "<td>".$this->getCustomerBA($row["area_negocios_2"])."</td>";
			$resultado .= "<td>".$this->getCustomerBA($row["area_negocios_1"])."</td>";
			$resultado .= "<td>&nbsp;</td>";
			$resultado .= "<td>";
			$resultado .= "<img src='/images/icons/data_view.png' />";
			$resultado .= "</td>";
			$resultado .= "</tr>";
		}
		$resultado .= "<t/body>";
		return $resultado;
	}
}