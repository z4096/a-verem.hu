<?php class TheStackData extends Database {

  public function getPosts($page) {
    $this->statement = $this->pdo->prepare("SELECT posts.id, posts.user_id, posts.reply_id, posts.post, posts.time,
      posts.edit_time, users.name, DATE_SUB(NOW(), INTERVAL 15 MINUTE) AS time_limit FROM posts LEFT JOIN users
      ON users.id = posts.user_id ORDER BY posts.time DESC LIMIT :page, 10");
    $this->statement->bindParam(':page', intval(($page - 1) * 10), PDO::PARAM_INT);
    $this->statement->execute();
    return $this->statement->rowCount() ? parent::fetchRows() : false;
  }

  public function getCount() {
    $this->statement = $this->pdo->query("SELECT COUNT(id) AS 'rows' FROM posts");
    return parent::fetchRows()[0]["rows"];
  }

} ?>
