<?php class Database {
  public $pdo;
  private $result;

  public function __construct() {
    try {
      $this->pdo = new PDO("mysql:host=localhost;dbname=a_verem_hu;charset=utf8",
        "root", "abc123", array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (PDOException $exception) {echo $exception->getMessage();}
  }

  public function countRows() {return $this->result->rowCount();}

  public function fetchRows() {
	   try {return $this->result->fetchAll(PDO::FETCH_ASSOC);}
	   catch (PDOException $exception) {echo $exception->getMessage();}
  }

  public function doQuery($query) {
    try {$this->result = $this->pdo->query($query);}
	  catch (PDOException $exception) {echo $exception->getMessage();}
  }
} ?>
