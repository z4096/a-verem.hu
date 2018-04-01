<?php class NewPostAction extends Action {		  
  
  public function process(&$parameters) {   
    switch ($_POST["action"]) {
      case "cancel":
        $_SESSION["returnUrl"] = $_SESSION["previousUrl"];
      break;
      case "confirm":
        $this->processNewPost();
      break;
    }
  }
    
  private function processNewPost() {
    $_SESSION["POST"] = &$_POST;  
    if (mb_strlen($_POST["new-post-input"])) {
      $database = new Database();
      $database->doQuery("INSERT INTO posts (user_id, post, time) VALUES (" .
        $_SESSION["user-id"] . ", " . $database->pdo->quote($_POST["new-post-input"]) . ", NOW())");
        $_SESSION["parameters"] = "/the-stack/1";
        unset($_SESSION["POST"]);
    } else {
      $_SESSION["error"] = "Érvénytelen hozzászólás!";
      $_SESSION["error-field"] = "new-post-input";
      $_SESSION["returnUrl"] = "/new-post";
    }
  }
} ?>