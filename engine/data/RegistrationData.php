<?php class RegistrationData extends Database {

  public function isNameRegistered($name) {
    try {
      $this->statement = $this->pdo->prepare("SELECT name FROM users WHERE name = :name");
      $this->statement->bindParam(':name', $name);
      $this->statement->execute();
      return $this->statement->rowCount();
    } catch (PDOException $exception) {echo $exception->getMessage();}
  }

  public function isEmailRegistered($email) {
    try {
      $this->statement = $this->pdo->prepare("SELECT email FROM users WHERE email = :email");
      $this->statement->bindParam(':email', $email);
      $this->statement->execute();
      return $this->statement->rowCount();
    } catch (PDOException $exception) {echo $exception->getMessage();}
  }

  public function getUserId($email) {
    try {
      $this->statement = $this->pdo->prepare("SELECT id FROM users WHERE email = :email");
      $this->statement->bindParam(':email', $email);
      $this->statement->execute();
      return $this->statement->rowCount() ? parent::fetchRows()[0]["id"] : false;
    } catch (PDOException $exception) {echo $exception->getMessage();}
  }

  public function addUser($name, $email, $hash) {
    try {
      $this->statement = $this->pdo->prepare("INSERT INTO users (name, email, password_hash) VALUES (:name, :email, :hash)");
      $this->statement->bindParam(':name', $name);
      $this->statement->bindParam(':email', $email);
      $this->statement->bindParam(':hash', $hash);
      $this->statement->execute();
    } catch (PDOException $exception) {echo $exception->getMessage();}
  }
} ?>
