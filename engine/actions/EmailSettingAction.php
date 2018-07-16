<?php class EmailSettingAction extends Action {

  public function process($parameters) {
    switch ($_POST["action"]) {
      case "cancel":
        $_SESSION["returnUrl"] = $_SESSION["previousUrl"];
      break;
      case "confirm":
        $this->processEmailSetting();
      break;
    }
  }

  private function processEmailSetting() {
    $_SESSION["POST"] = $_POST;
    if (strlen($_POST["e-mail"]) > 63 || !filter_var($_POST["e-mail"], FILTER_VALIDATE_EMAIL)) {
      $_SESSION["error"] = "Érvénytelen e-mail cím!";
      $_SESSION["error-field"] = "e-mail";
      $_SESSION["returnUrl"] = "/email-setting";
      return;
    }
    else {
      $emailSettingData = new EmailSettingData();
      if ($emailSettingData->isEmailRegistered($_POST["e-mail"])) {
        $_SESSION["error"] = "Az e-mail cím már regisztrálva lett!";
        $_SESSION["error-field"] = "e-mail";
        $_SESSION["returnUrl"] = "/email-setting";
        return;
      }
    }
    $emailSettingData->setEmail($_SESSION["user-id"], $_POST["e-mail"]);
    $_SESSION["returnUrl"] = $_SESSION["previousUrl"];
    unset($_SESSION["POST"]);
  }
} ?>
