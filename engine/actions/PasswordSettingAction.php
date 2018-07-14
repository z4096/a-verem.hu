<?php class PasswordSettingAction extends Action {

  public function process(&$parameters) {
    switch ($_POST["action"]) {
      case "cancel":
        $_SESSION["returnUrl"] = $_SESSION["previousUrl"];
      break;
      case "confirm":
        $this->processPasswordSetting();
      break;
    }
  }

  private function processPasswordSetting() {
    $_SESSION["POST"] = &$_POST;
    if(strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 63 || !ctype_alnum($_POST["password"])) {
      $_SESSION["error"] = "Érvénytelen jelszó!";
      $_SESSION["error-field"] = "password";
      $_SESSION["returnUrl"] = "/password-setting";
      return;
    } elseif ($_POST["password"] != $_POST["password-again"]) {
      $_SESSION["error"] = "A jelszó megerősítése sikertelen!";
      $_SESSION["error-field"] = "password";
      $_SESSION["returnUrl"] = "/password-setting";
      return;
    }
    $passwordSettingData = new PasswordSettingData();
    $passwordSettingData->setPasswordHash($_SESSION["user-id"], $hash = password_hash($_POST["password"], PASSWORD_DEFAULT));
    setcookie("user_data", "", time() - 3600, "/");
    if (isset($_POST["allow-cookie"])) setcookie("user_data", json_encode(array("user" => $_POST["name"],
        "password_hash" => password_hash($hash, PASSWORD_DEFAULT))), time() + 604800, "/");
    $_SESSION["returnUrl"] = $_SESSION["previousUrl"];
    unset($_SESSION["POST"]);
  }
} ?>
