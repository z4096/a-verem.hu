<?php class EmailSettingData extends Database {

  public function getUserId($email) {
    $this->pdo->query("DELETE FROM temporary_password WHERE password_time < DATE_SUB(NOW(), INTERVAL 1 HOUR)");
    $this->statement = $this->pdo->prepare("SELECT id FROM users WHERE email = :email");
    $this->statement->bindParam(':email', $email);
    $this->statement->execute();
    return $this->statement->rowCount() ? parent::fetchRows()[0]["id"] : false;
  }

  public function setTemporaryPassword($userId, $hash) {
    $this->statement = $this->pdo->prepare("REPLACE INTO temporary_password
      SET user_id = :user_id, password_hash = :hash, password_time = NOW()");
    $this->statement->bindParam(':user_id', intval($userId), PDO::PARAM_INT);
    $this->statement->bindParam(':hash', $hash);
    $this->statement->execute();
  }
} ?>
