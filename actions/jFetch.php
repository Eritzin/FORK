<?php  

class DB
{
	private $con;
	private $host = "localhost";
	private $dbname = "fullstackproject";
	private $user = "root";
	private $password = "";


	public function __construct()
	{
		$dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;

		try
		{
			$this->con = new PDO($dsn, $this->user, $this->password);
			$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
		}
	}

	public function viewData()
	{
		$query = "SELECT * FROM alumni";
		$stmt = $this->con->prepare($query);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}

	public function searchData($firstname)
	{
		$query = "SELECT * FROM alumni WHERE firstname LIKE :firstname";
		$stmt = $this->con->prepare($query);
		$stmt->execute(["firstname" => "%". $firstname ."%"]);
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}

}



?>