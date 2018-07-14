<?php abstract class Database {
  protected $pdo;
  protected $statement;

  public function __construct() {
    try {
      $this->pdo = new PDO("mysql:host=localhost;dbname=a_verem_hu;charset=utf8",
        "root", "abc123", array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (PDOException $exception) {echo $exception->getMessage();}
  }

  protected function fetchRows() {
	   try {return $this->statement->fetchAll(PDO::FETCH_ASSOC);}
	   catch (PDOException $exception) {echo $exception->getMessage();}
  }
} ?>
