<?php class PostData extends Database {

  public function isPostExists($postId, $userId) {
    $this->statement = $this->pdo->prepare("SELECT id FROM posts WHERE id = :post_id AND user_id = :user_id");
    $this->statement->bindParam(':post_id', intval($postId), PDO::PARAM_INT);
    $this->statement->bindParam(':user_id', intval($userId), PDO::PARAM_INT);
    $this->statement->execute();
    return $this->statement->rowCount();
  }

  public function getPost($postId) {
    $this->statement = $this->pdo->prepare("SELECT posts.id, posts.reply_id, posts.post, posts.time, users.name
      FROM posts LEFT JOIN users ON users.id = posts.user_id WHERE posts.id = :post_id");
    $this->statement->bindParam(':post_id', intval($postId), PDO::PARAM_INT);
    $this->statement->execute();
    return $this->statement->rowCount() ? parent::fetchRows()[0] : false;
  }

  public function addPost($userId, $replyId, $post) {
    $this->statement = $this->pdo->prepare("INSERT INTO posts (user_id, reply_id, post, time)
      VALUES (:user_id, :reply_id, :post, NOW())");
    $this->statement->bindParam(':user_id', intval($userId), PDO::PARAM_INT);
    $this->statement->bindParam(':reply_id', intval($replyId), PDO::PARAM_INT);
    $this->statement->bindParam(':post', $post);
    $this->statement->execute();
  }

  public function setPost($postId, $post) {
    $this->statement = $this->pdo->prepare("UPDATE posts SET post = :post, edit_time = NOW() WHERE id = :post_id");
    $this->statement->bindParam(':post_id', intval($postId), PDO::PARAM_INT);
    $this->statement->bindParam(':post', $post);
    $this->statement->execute();
  }
} ?>
