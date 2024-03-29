<?php

/**
 *
 * @author Jos� Correia
 *
 */
class BI
{
	public $conn;
	
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
	 * @param integer $id
	 * @param char $gender
	 * @param integer $type
	 * @return integer
	 * 
	 * gets the amount of customers that allow email marketing campaigns
	 */
	public function getCustomersEmail($id,$gender,$type)
	{
		switch ($gender)
		{
			case "A" : 	$genderFilter = "";
			break;
			default  :	$genderFilter = " and id_gender=".$this->getGender($gender);
			break;
		}
		
		$query = $this->conn->prepare("select count(num_cliente) from tb_customers where id_status<3 and confiden_email=2 and area_negocios_$type=$id $genderFilter");
		$query->execute();
		$row = $query->fetch();
		return $row[0];
	}

	/**
	 *
	 * @param integer $id
	 * @param char $gender
	 * @param integer $type
	 * @return integer
	 *
	 * gets the amount of customers that allow sms marketing campaigns
	 */
	public function getCustomersSMS($id,$gender,$type)
	{
		switch ($gender)
		{
			case "A" : 	$genderFilter = "";
			break;
			default  :	$genderFilter = " and id_gender=".$this->getGender($gender);
			break;
		}
	
		$query = $this->conn->prepare("select count(num_cliente) from tb_customers where id_status<3 and confiden_sms=2 and area_negocios_$type=$id $genderFilter");
		$query->execute();
		$row = $query->fetch();
		return $row[0];
	}
	
	/**
	 *
	 * @param integer $id
	 * @param char $gender
	 * @param integer $type
	 * @return integer
	 *
	 * gets the amount of customers that allow mms marketing campaigns
	 */
	public function getCustomersMMS($id,$gender,$type)
	{
		switch ($gender)
		{
			case "A" : 	$genderFilter = "";
			break;
			default  :	$genderFilter = " and id_gender=".$this->getGender($gender);
			break;
		}
	
		$query = $this->conn->prepare("select count(num_cliente) from tb_customers where id_status<3 and confiden_mms=2 and area_negocios_$type=$id $genderFilter");
		$query->execute();
		$row = $query->fetch();
		return $row[0];
	}

	/**
	 *
	 * @param integer $id
	 * @param char $gender
	 * @param integer $type
	 * @return integer
	 *
	 * gets the amount of customers that allow offline marketing campaigns
	 */
	public function getCustomersOffline($id,$gender,$type)
	{
		switch ($gender)
		{
			case "A" : 	$genderFilter = "";
			break;
			default  :	$genderFilter = " and id_gender=".$this->getGender($gender);
			break;
		}
	
		$query = $this->conn->prepare("select count(num_cliente) from tb_customers where id_status<3 and confiden_offline=2 and area_negocios_$type=$id $genderFilter");
		$query->execute();
		$row = $query->fetch();
		return $row[0];
	}
	
	/**
	 * 
	 * @return string
	 * 
	 * returns a string with the table body listing all the business areas
	 */
	public function getBAData()
	{
		$query = $this->conn->prepare("select id, name from tb_business_areas order by name");
		$query->execute();
		$resultado = "<tbody>";
		while ($row = $query->fetch())
		{
			$resultado .= "<tr>";
			$resultado .= "<td>".$row["name"]."</td>";
			$resultado .= "<td style='border-left: solid 1px black;''><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=1&gender=A&confid=0\",\"jumbotron\");'>";
			$resultado .= $this->getBACustomers($row["id"],"A",1)."</a></td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=1&gender=F&confid=0\",\"jumbotron\");'>";
			$resultado .= $this->getBACustomers($row["id"],"F",1)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=1&gender=M&confid=0\",\"jumbotron\");'>";
			$resultado .= $this->getBACustomers($row["id"],"M",1)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=A&confid=0\",\"jumbotron\");'>";
			$resultado .= $this->getBACustomers($row["id"],"A",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=F&confid=0\",\"jumbotron\");'>";
			$resultado .= $this->getBACustomers($row["id"],"F",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=M&confid=0\",\"jumbotron\");'>";
			$resultado .= $this->getBACustomers($row["id"],"M",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=A&confid=1\",\"jumbotron\");'>";
			$resultado .= $this->getCustomersEmail($row["id"],"A",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=F&confid=1\",\"jumbotron\");'>";
			$resultado .= $this->getCustomersEmail($row["id"],"F",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=M&confid=1\",\"jumbotron\");'>";
			$resultado .= $this->getCustomersEmail($row["id"],"M",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=A&confid=2\",\"jumbotron\");'>";
			$resultado .= $this->getCustomersSMS($row["id"],"A",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=F&confid=2\",\"jumbotron\");'>";
			$resultado .= $this->getCustomersSMS($row["id"],"F",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=M&confid=2\",\"jumbotron\");'>";
			$resultado .= $this->getCustomersSMS($row["id"],"M",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=A&confid=3\",\"jumbotron\");'>";
			$resultado .= $this->getCustomersMMS($row["id"],"A",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=F&confid=3\",\"jumbotron\");'>";
			$resultado .= $this->getCustomersMMS($row["id"],"F",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=M&confid=3\",\"jumbotron\");'>";
			$resultado .= $this->getCustomersMMS($row["id"],"M",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=A&confid=4\",\"jumbotron\");'>";
			$resultado .= $this->getCustomersOffline($row["id"],"A",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=F&confid=4\",\"jumbotron\");'>";
			$resultado .= $this->getCustomersOffline($row["id"],"F",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'><a href='#' onclick='carrega(\"../../mod_bi/models/customersBA.php?id_ba=".$row["id"]."&ba_type=2&gender=M&confid=4\",\"jumbotron\");'>";
			$resultado .= $this->getCustomersOffline($row["id"],"M",2)."</td>";			
			$resultado .= "</tr>";
		}
		$resultado .= "</tbody>";
		return $resultado;
	}
	
	/**
	 * 
	 * @param integer $id
	 * @param char $gender
	 * @param integer $type
	 * @return integer
	 * 
	 * gets the amount of customers of a specifi gender (A-All, F-Female, M-Male)
	 */
	public function getBACustomers($id,$gender,$type)
	{
		switch ($gender)
		{
			case "A" : 	$genderFilter = "";
						break;
			default  :	$genderFilter = " and id_gender=".$this->getGender($gender);
						break;
		}
		
		$query = $this->conn->prepare("select count(num_cliente) from tb_customers where id_status<3 and area_negocios_$type=$id $genderFilter");
		$query->execute();
		$row = $query->fetch();
		return $row[0];
	}
}