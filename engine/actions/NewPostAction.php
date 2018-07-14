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
      $newPostData = new NewPostData();
      $newPostData->addPost($_SESSION["user-id"], $_POST["new-post-input"]);
      $_SESSION["returnUrl"] = "/the-stack/1";
      unset($_SESSION["POST"]);
    } else {
      $_SESSION["error"] = "Érvénytelen hozzászólás!";
      $_SESSION["error-field"] = "new-post-input";
      $_SESSION["returnUrl"] = "/new-post";
    }
  }
} ?>
