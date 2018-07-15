<?php class NewPostData extends Database {

  public function addPost($userId, $post) {
    try {
      $this->statement = $this->pdo->prepare("INSERT INTO posts (user_id, post, time) VALUES (:user_id, :post, NOW())");
      $this->statement->bindParam(':user_id', intval($userId), PDO::PARAM_INT);
      $this->statement->bindParam(':post', $post);
      $this->statement->execute();
    } catch (PDOException $exception) {echo $exception->getMessage();}
  }
} ?>
