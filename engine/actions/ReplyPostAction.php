<?php class ReplyPostAction extends Action {		  
  
  public function process(&$parameters) {   
    switch ($_POST["action"]) {
      case "cancel":
        $_SESSION["returnUrl"] = $_SESSION["previousUrl"];
      break;
      case "confirm":
        $this->processEditPost($parameters);
      break;
    }
  }
    
  private function processEditPost(&$parameters) {
    $_SESSION["POST"] = &$_POST;  
    if (isset($parameters[3]) && ctype_digit($parameters[3]) && $parameters[3] != 0) {
      $database = new Database();
      $database->doQuery("SELECT id FROM posts WHERE id = " . $parameters[3] . " AND user_id != " . $_SESSION["user-id"]);
      if ($database->countRows()) {
        if (mb_strlen($_POST["new-post-input"])) {                      
          $database->doQuery("INSERT INTO posts (user_id, reply_id, post, time) VALUES (" . $_SESSION["user-id"] . 
            ", " . $parameters[3] . ", " . $database->pdo->quote($_POST["new-post-input"]) . ", NOW())");
          $_SESSION["parameters"] = "/the-stack/1";
          unset($_SESSION["POST"]);
        } else {
          $_SESSION["error"] = "Érvénytelen hozzászólás!";
          $_SESSION["error-field"] = "new-post-input";  
          $_SESSION["returnUrl"] = "/reply-post/" . $parameters[3];
        } 
      } else $this->interrupt(); 
    } else $this->interrupt(); 
  }

  private function interrupt() {    
    unset($_SESSION["POST"]);
    $this->notFound(); 
  }
} ?>