<?php class AccountDeleteData extends Database {

  public function getEmail($userId) {
    $this->statement = $this->pdo->prepare("SELECT email FROM users WHERE id = :user_id");
    $this->statement->bindParam(':user_id', intval($userId), PDO::PARAM_INT);
    $this->statement->execute();
    return $this->statement->rowCount() ? parent::fetchRows()[0]["email"] : false;
  }

  public function deleteEmail($userId) {
    $this->statement = $this->pdo->prepare("UPDATE users SET email = 'deleted' WHERE id = :user_id");
    $this->statement->bindParam(':user_id', intval($userId), PDO::PARAM_INT);
    $this->statement->execute();
  }
} ?>
