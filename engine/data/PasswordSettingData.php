<?php class EmailSettingData extends Database {

  public function setPasswordHash($userId, $hash) {
    $this->statement = $this->pdo->prepare("UPDATE users SET password_hash = :hash WHERE id = :user_id");
    $this->statement->bindParam(':user_id', intval($userId), PDO::PARAM_INT);
    $this->statement->bindParam(':hash', $hash);
    $this->statement->execute();
  }
} ?>
