<?php class LoginData extends Database {

  public function getUserData($email) {
    $this->statement = $this->pdo->prepare("SELECT id, name, password_hash FROM users WHERE email = :email");
    $this->statement->bindParam(':email', $email);
    $this->statement->execute();
    return $this->statement->rowCount() ? parent::fetchRows()[0] : false;
  }

  public function getTemporaryPassword($userId) {
    $this->statement = $this->pdo->prepare("SELECT password_hash FROM temporary_password
      WHERE user_id = :user_id AND password_time > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
    $this->statement->bindParam(':user_id', intval($userId), PDO::PARAM_INT);
    $this->statement->execute();
    return $this->statement->rowCount() ? parent::fetchRows()[0]["password_hash"] : false;
  }
} ?>
