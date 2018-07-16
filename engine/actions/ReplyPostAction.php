<?php class ReplyPostAction extends Action {

  public function process($parameters) {
    switch ($_POST["action"]) {
      case "cancel":
        $_SESSION["returnUrl"] = $_SESSION["previousUrl"];
      break;
      case "confirm":
        $this->processEditPost($parameters);
      break;
    }
  }

  private function processEditPost($parameters) {
    $_SESSION["POST"] = $_POST;
    if (isset($parameters[3]) && ctype_digit($parameters[3]) && $parameters[3] != 0) {
      $postData = new PostData();
      if ($postData->isPostExists($parameters[3], $_SESSION["user-id"])) {
        if (mb_strlen($_POST["new-post-input"])) {
          $postData->addPost($_SESSION["user-id"], $parameters[3], $_POST["new-post-input"]);
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
