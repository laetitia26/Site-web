<?php
if(file_exists("../db_config.php"))
	require_once "../db_config.php";
else require_once "db_config.php";

class DB{

	private $host = HOSTNAME;
	private $username = USERNAME;
	private $password = PASSWORD;
	private $database = DB_NAME;
	private $db;

	public function __construct($host = null, $username = null, $password = null, $database = null){
		if($host != null){
			$this->host = $host;
			$this->username = $username;
			$this->password = $password;
			$this->database = $database;
		}

		try{
			$this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password, array(
					PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
					PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
				));
		}catch(PDOException $e){
			print $e->getMessage();
			die('<h1>Impossible de se connecter à la base de données</h1>');
		}


	}

	public function query($sql, $data = array()){
		$req =$this->db->prepare($sql);
		$req->execute($data);
		return $req->fetchAll(PDO::FETCH_OBJ);
	}

}


?>
