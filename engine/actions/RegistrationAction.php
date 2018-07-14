<?php class RegistrationAction extends Action {

  public function process(&$parameters) {
    switch ($_POST["action"]) {
      case "cancel":
        $_SESSION["returnUrl"] = $_SESSION["previousUrl"];
      break;
      case "confirm":
        $this->processRegistration();
      break;
    }
  }

  private function processRegistration() {
    $_SESSION["POST"] = &$_POST;
    if (!isset($_POST["allow-storage"])) {
      $_SESSION["error"] = "Nem járultál hozzá a megadott adatok tárolásához!";
      $_SESSION["error-field"] = "allow-storage";
      $_SESSION["returnUrl"] = "/registration";
      return;
    }
    if (mb_strlen($_POST["name"]) && mb_strlen($_POST["name"]) < 13) {
      $nameLetters = "abcdefghijklmnopqrstuvwxyzáéíóöőüűABCDEFGHUJKLMNOPQRSTUVWXYZÁÉÍÓÖŐÜŰ";
      for ($index = mb_strlen($_POST["name"]); $index--; ) {
        if (mb_strpos($nameLetters, mb_substr($_POST["name"], $index, 1)) !== false) break;
      }
      if ($index == -1) {
        $_SESSION["error"] = "Érvénytelen felhasználónév!";
        $_SESSION["error-field"] = "name";
        $_SESSION["returnUrl"] = "/registration";
        return;
      }
      $nameLetters .= "-_. ";
      for ($index = mb_strlen($_POST["name"]); $index--; ) {
        if (mb_strpos($nameLetters, mb_substr($_POST["name"], $index, 1)) === false) {
          $_SESSION["error"] = "Érvénytelen felhasználónév!";
          $_SESSION["error-field"] = "name";
          $_SESSION["returnUrl"] = "/registration";
          return;
        }
      }
    } else {
      $_SESSION["error"] = "Érvénytelen felhasználónév!";
      $_SESSION["error-field"] = "name";
      $_SESSION["returnUrl"] = "/registration";
      return;
    }
    $registrationData = new RegistrationData();
    if ($registrationData->isNameRegistered($_POST["name"])) {
      $_SESSION["error"] = "Ezen a néven már létezik felhasználó!";
      $_SESSION["error-field"] = "name";
      $_SESSION["returnUrl"] = "/registration";
      return;
    }
    if (strlen($_POST["e-mail"]) > 63 || !filter_var($_POST["e-mail"], FILTER_VALIDATE_EMAIL)) {
      $_SESSION["error"] = "Érvénytelen e-mail cím!";
      $_SESSION["error-field"] = "e-mail";
      $_SESSION["returnUrl"] = "/registration";
      return;
    }
    else {
      if ($registrationData->isEmailRegistered($_POST["e-mail"])) {
        $_SESSION["error"] = "Az e-mail cím már regisztrálva lett!";
        $_SESSION["error-field"] = "e-mail";
        $_SESSION["returnUrl"] = "/registration";
        return;
      }
    }
    if(strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 63 || !ctype_alnum($_POST["password"])) {
      $_SESSION["error"] = "Érvénytelen jelszó!";
      $_SESSION["error-field"] = "password";
      $_SESSION["returnUrl"] = "/registration";
      return;
    } elseif ($_POST["password"] != $_POST["password-again"]) {
      $_SESSION["error"] = "A jelszó megerősítése sikertelen!";
      $_SESSION["error-field"] = "password";
      $_SESSION["returnUrl"] = "/registration";
      return;
    }
    $registrationData->addUser($_POST["name"], $_POST["e-mail"], $hash = password_hash($_POST["password"], PASSWORD_DEFAULT));
    $_SESSION["user-id"] = $registrationData->getUserId($_POST["e-mail"]);
    $_SESSION["user"] = $_POST["name"];
    if (isset($_POST["allow-cookie"])) setcookie("user_data", json_encode(array("user" => $_POST["name"],
        "password_hash" => password_hash($hash, PASSWORD_DEFAULT))), time() + 604800, "/");
    $_SESSION["returnUrl"] = $_SESSION["previousUrl"];
    unset($_SESSION["POST"]);
  }
} ?>
