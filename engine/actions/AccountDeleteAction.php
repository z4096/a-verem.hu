<?php class AccountDeleteAction extends Action {

  public function process(&$parameters) {
    switch ($_POST["action"]) {
      case "cancel":
        $_SESSION["returnUrl"] = $_SESSION["previousUrl"];
      break;
      case "confirm":
        $this->processAccountDelete();
      break;
    }
  }

  private function processAccountDelete() {
    $accountDeleteData = new AccountDeleteData();
    $accountDeleteData->deleteEmail($_SESSION["user-id"]);
    session_destroy();
    setcookie("PHPSESSID", "", time() - 3600, "/");
    setcookie("cookiebar", "", time() - 3600, "/");
    setcookie("user_data", "", time() - 3600, "/");
    header("location: /welcome");
  }
} ?>
