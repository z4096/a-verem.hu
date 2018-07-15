<?php class AccountDeleteData extends Database {

  public function getEmail($userId) {
    try {
      $this->statement = $this->pdo->prepare("SELECT email FROM users WHERE id = :user_id");
      $this->statement->bindParam(':user_id', intval($userId), PDO::PARAM_INT);
      $this->statement->execute();
      return $this->statement->rowCount() ? parent::fetchRows()[0]["email"] : false;
    } catch (PDOException $exception) {echo $exception->getMessage();}
  }

  public function deleteEmail($userId) {
    try {
      $this->statement = $this->pdo->prepare("UPDATE users SET email = 'deleted' WHERE id = :user_id");
      $this->statement->bindParam(':user_id', intval($userId), PDO::PARAM_INT);
      $this->statement->execute();
    } catch (PDOException $exception) {echo $exception->getMessage();}
  }
} ?>
