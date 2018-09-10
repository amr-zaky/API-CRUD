<?php 


//Database connection

class Database 
{
	private $host='localhost';
	private $dbname='apiphp';
	private $username='root';
	private $password='';
	public $conn;

	public function getconnection()
	{
		$this->conn=NULL;
		try
		{
			$this->conn=new PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->username,$this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}

		catch(PDOExeption $e) 
		{
			echo 'Connetion error '.$e->getMessage();
		}

		return $this->conn;
	}

}


















