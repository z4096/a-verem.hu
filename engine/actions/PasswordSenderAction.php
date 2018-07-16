<?php class PasswordSenderAction extends Action {

  public function process($parameters) {
    switch ($_POST["action"]) {
      case "cancel":
        $_SESSION["returnUrl"] = $_SESSION["previousUrl"];
      break;
      case "confirm":
        $this->processPasswordSender();
      break;
    }
  }

  private function processPasswordSender() {
    $_SESSION["POST"] = $_POST;
    if (strlen($_POST["e-mail"]) < 64 && filter_var($_POST["e-mail"], FILTER_VALIDATE_EMAIL)) {
      $passwordSenderData = new PasswordSenderData();
      $userId = $passwordSenderData->getUserId($_POST["e-mail"]);
      if ($userId) {
        $keyspace = "123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ";
        for ($password = "", $index = 8; $index--; ) $password .= $keyspace[random_int(0, strlen($keyspace))];
        $passwordSenderData->setTemporaryPassword($userId, $hash = password_hash($password, PASSWORD_DEFAULT));
        mail($_POST["e-mail"], "A-verem.hu ideiglenes jelszó",
          "\r\nBejelentkezés után egy órán belül változtasd meg ezt a jelszót!\r\n\r\nIdeiglenes jelszavad: " . $password . "\r\n\r\nHa nem te kérted a jelszót, hagyd figyelmen kívül ezt az e-mailt.\r\nEz egy automatikusan generált üzenet, ne válaszólj rá!",
          "From: a-verem.hu <noreply@a-verem.hu>\r\nContent-Type: text/plain; charset=UTF-8");
        setcookie("user_data", "", time() - 3600, "/");
        $_SESSION["returnUrl"] = "/login";
        unset($_SESSION["POST"]);
      } else {
        $_SESSION["error"] = "Az e-mail cím nincs regisztrálva!";
        $_SESSION["error-field"] = "e-mail";
        $_SESSION["returnUrl"] = "/password-sender";
      }
    } else {
      $_SESSION["error"] = "Érvénytelen e-mail cím!";
      $_SESSION["error-field"] = "e-mail";
      $_SESSION["returnUrl"] = "/password-sender";
    }
  }
} ?>
