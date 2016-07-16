<?php

/**
 * 
 * @author José Correia
 *
 */
class BusinessAreas
{
	public $conn;
	public $name;
	public $address1;
	public $address2;
	public $place;
	public $zipcode;
	public $zipplace;
	public $telephone;
	public $telefax;
	public $cellphone;
	public $email;
	
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
	 * @name listBusinessAreas
	 * 
	 * gets a list of all business areas order by name
	 */
	public function listBusinessAreas()
	{
		$query = $this->conn->prepare("select * from tb_business_areas order by name");
		$query->execute();
		$resultado = "<tbody>";
		while ($row = $query->fetch())
		{
			$resultado .= "<tr>";
			$resultado .= "<td>".$row["id"]."</td>";
			$resultado .= "<td>".$row["name"]."</td>";
			$resultado .= "<td>".$row["place"]."</td>";
			$resultado .= "<td>".$row["zip_place"]."</td>";
			$resultado .= "<td><img src='/images/icons/data_view.png' onclick='carrega(\"../../mod_business_center/models/showBA.php?id=".$row["id"]."\",\"jumbotron\");'/></td>";
			$resultado .= "</tr>";
		}
		$resultado .= "</tbody>";
		return $resultado;
	}
	
	/**
	 * @name getBusinessArea
	 * @param integer $id
	 * @return boolean
	 * 
	 * gets the details of the business area with the code $id
	 */
	public function getBusinessArea($id)
	{
		$query = $this->conn->prepare("select * from tb_business_areas where id=$id");
		$query->execute();
		$row = $query->fetch();
		$this->name = utf8_encode($row["name"]);
		$this->address1 = utf8_encode($row["address_1"]);
		$this->address2 = utf8_encode($row["address_2"]);
		$this->place = utf8_encode($row["place"]);
		$this->zipcode = utf8_encode($row["zip_code"]);
		$this->zipplace = utf8_encode($row["zip_place"]);
		$this->telephone = $row["phonenumber"];
		$this->cellphone = $row["cellnumber"];
		$this->telefax = $row["faxnumber"];
		$this->email = utf8_encode($row["email"]);
		return true;
	}
}