<?php class EmailSettingData extends Database {

  public function isEmailRegistered($email) {
    $this->statement = $this->pdo->prepare("SELECT id FROM users WHERE email = :email");
    $this->statement->bindParam(':email', $email);
    $this->statement->execute();
    return $this->statement->rowCount();
  }

  public function getEmail($userId) {
    $this->statement = $this->pdo->prepare("SELECT email FROM users WHERE id = :user_id");
    $this->statement->bindParam(':user_id', intval($userId), PDO::PARAM_INT);
    $this->statement->execute();
    return $this->statement->rowCount() ? parent::fetchRows()[0]["email"] : false;
  }

  public function setEmail($userId, $email) {
    $this->statement = $this->pdo->prepare("UPDATE users SET email = :email WHERE id = :user_id");
    $this->statement->bindParam(':user_id', intval($userId), PDO::PARAM_INT);
    $this->statement->bindParam(':email', $email);
    $this->statement->execute();
  }
} ?>
