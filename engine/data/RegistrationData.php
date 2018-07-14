<?php class RegistrationData extends Database {

  public function isNameRegistered($name) {
    $this->statement = $this->pdo->prepare("SELECT name FROM users WHERE name = :name");
    $this->statement->bindParam(':name', $name);
    $this->statement->execute();
    return $this->statement->rowCount();
  }

  public function isEmailRegistered($email) {
    $this->statement = $this->pdo->prepare("SELECT email FROM users WHERE email = :email");
    $this->statement->bindParam(':email', $email);
    $this->statement->execute();
    return $this->statement->rowCount();
  }

  public function getUserId($email) {
    $this->statement = $this->pdo->prepare("SELECT id FROM users WHERE email = :email");
    $this->statement->bindParam(':email', $email);
    $this->statement->execute();
    return $this->statement->rowCount() ? parent::fetchRows()[0]["id"] : false;
  } 

  public function addUser($name, $email, $hash) {
    $this->statement = $this->pdo->prepare("INSERT INTO users (name, email, password_hash) VALUES (:name, :email, :hash)");
    $this->statement->bindParam(':name', $name);
    $this->statement->bindParam(':email', $email);
    $this->statement->bindParam(':hash', $hash);
    $this->statement->execute();
  }
} ?>
