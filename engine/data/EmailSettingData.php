<?php class EmailSettingData extends Database {

  public function isEmailRegistered($email) {
    try {
      $this->statement = $this->pdo->prepare("SELECT id FROM users WHERE email = :email");
      $this->statement->bindParam(':email', $email);
      $this->statement->execute();
      return $this->statement->rowCount();
    } catch (PDOException $exception) {echo $exception->getMessage();}
  }

  public function getEmail($userId) {
    try {
      $this->statement = $this->pdo->prepare("SELECT email FROM users WHERE id = :user_id");
      $this->statement->bindParam(':user_id', intval($userId), PDO::PARAM_INT);
      $this->statement->execute();
      return $this->statement->rowCount() ? parent::fetchRows()[0]["email"] : false;
    } catch (PDOException $exception) {echo $exception->getMessage();}
  }

  public function setEmail($userId, $email) {
    try {
      $this->statement = $this->pdo->prepare("UPDATE users SET email = :email WHERE id = :user_id");
      $this->statement->bindParam(':user_id', intval($userId), PDO::PARAM_INT);
      $this->statement->bindParam(':email', $email);
      $this->statement->execute();
    } catch (PDOException $exception) {echo $exception->getMessage();}
  }
} ?>
