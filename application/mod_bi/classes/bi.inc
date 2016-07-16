<?php

/**
 *
 * @author José Correia
 *
 */
class BI
{
	public $conn;
	
	private function getGender($id)
	{
		$query = $this->conn->prepare("select id from tb_genders where sigla='$id'");
		$query->execute();
		$row = $query->fetch();
		return $row[0];
	}
	
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
	
	public function getCustomersEmail($id,$gender,$type)
	{
		switch ($gender)
		{
			case "A" : 	$genderFilter = "";
			break;
			default  :	$genderFilter = " and id_gender=".$this->getGender($gender);
			break;
		}
		
		$query = $this->conn->prepare("select count(num_cliente) from tb_customers where confiden_email=2 and area_negocios_$type=$id $genderFilter");
		$query->execute();
		$row = $query->fetch();
		return $row[0];
	}

	public function getCustomersSMS($id,$gender,$type)
	{
		switch ($gender)
		{
			case "A" : 	$genderFilter = "";
			break;
			default  :	$genderFilter = " and id_gender=".$this->getGender($gender);
			break;
		}
	
		$query = $this->conn->prepare("select count(num_cliente) from tb_customers where confiden_sms=2 and area_negocios_$type=$id $genderFilter");
		$query->execute();
		$row = $query->fetch();
		return $row[0];
	}
	
	public function getCustomersMMS($id,$gender,$type)
	{
		switch ($gender)
		{
			case "A" : 	$genderFilter = "";
			break;
			default  :	$genderFilter = " and id_gender=".$this->getGender($gender);
			break;
		}
	
		$query = $this->conn->prepare("select count(num_cliente) from tb_customers where confiden_mms=2 and area_negocios_$type=$id $genderFilter");
		$query->execute();
		$row = $query->fetch();
		return $row[0];
	}

	public function getCustomersOffline($id,$gender,$type)
	{
		switch ($gender)
		{
			case "A" : 	$genderFilter = "";
			break;
			default  :	$genderFilter = " and id_gender=".$this->getGender($gender);
			break;
		}
	
		$query = $this->conn->prepare("select count(num_cliente) from tb_customers where confiden_offline=2 and area_negocios_$type=$id $genderFilter");
		$query->execute();
		$row = $query->fetch();
		return $row[0];
	}
	
	public function getBAData()
	{
		$query = $this->conn->prepare("select id, name from tb_business_areas order by name");
		$query->execute();
		$resultado = "<tbody>";
		while ($row = $query->fetch())
		{
			$resultado .= "<tr>";
			$resultado .= "<td>".$row["name"]."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getBACustomers($row["id"],"A",1)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getBACustomers($row["id"],"F",1)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getBACustomers($row["id"],"M",1)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getBACustomers($row["id"],"A",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getBACustomers($row["id"],"F",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getBACustomers($row["id"],"M",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getCustomersEmail($row["id"],"A",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getCustomersEmail($row["id"],"F",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getCustomersEmail($row["id"],"M",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getCustomersSMS($row["id"],"A",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getCustomersSMS($row["id"],"F",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getCustomersSMS($row["id"],"M",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getCustomersMMS($row["id"],"A",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getCustomersMMS($row["id"],"F",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getCustomersMMS($row["id"],"M",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getCustomersOffline($row["id"],"A",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getCustomersOffline($row["id"],"F",2)."</td>";
			$resultado .= "<td style='border-left: solid 1px black;'>".$this->getCustomersOffline($row["id"],"M",2)."</td>";			
			$resultado .= "</tr>";
		}
		$resultado .= "</tbody>";
		return $resultado;
	}
	
	public function getBACustomers($id,$gender,$type)
	{
		switch ($gender)
		{
			case "A" : 	$genderFilter = "";
						break;
			default  :	$genderFilter = " and id_gender=".$this->getGender($gender);
						break;
		}
		
		$query = $this->conn->prepare("select count(num_cliente) from tb_customers where area_negocios_$type=$id $genderFilter");
		$query->execute();
		$row = $query->fetch();
		return $row[0];
	}
}