<?php class LoginAction extends Action {

  public function process(&$parameters) {
    switch ($_POST["action"]) {
      case "cancel":
        $_SESSION["returnUrl"] = isset($_SESSION["previousUrl"]) ? $_SESSION["previousUrl"] : "/welcome";
      break;
      case "confirm":
        $this->processLogin();
      break;
    }
  }

  private function processLogin() {
    $_SESSION["POST"] = &$_POST;
    if (strlen($_POST["e-mail"]) < 64 && filter_var($_POST["e-mail"], FILTER_VALIDATE_EMAIL)) {
      $database = new Database();
      $database->doQuery("SELECT id, name, password_hash FROM users WHERE email = '" . $_POST["e-mail"] . "'");
      if ($database->countRows()) {
        if (strlen($_POST["password"]) > 7 && strlen($_POST["password"]) < 64) {
          $userRow = $database->fetchRows();
          if (password_verify($_POST["password"], $userRow[0]["password_hash"]))
            $this->finishLogin($userRow[0]["id"], $userRow[0]["name"], $userRow[0]["password_hash"]);
          else {
            $database->doQuery("SELECT password_hash FROM temporary_password WHERE user_id = " .
              $userRow[0]["id"] . " AND password_time > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
            if ($database->countRows()) {
              $dataRow = $database->fetchRows();
              if (password_verify($_POST["password"], $dataRow[0]["password_hash"]))
                $this->finishLogin($userRow[0]["id"], $userRow[0]["name"], $dataRow[0]["password_hash"]);
              else {
                $_SESSION["error"] = "Hibás jelszó!";
                $_SESSION["error-field"] = "password";
                $_SESSION["returnUrl"] = "/login";
              }
            } else {
              $_SESSION["error"] = "Hibás jelszó!";
              $_SESSION["error-field"] = "password";
              $_SESSION["returnUrl"] = "/login";
            }
          }
        } else {
          $_SESSION["error"] = "Érvénytelen jelszó!";
          $_SESSION["error-field"] = "password";
          $_SESSION["returnUrl"] = "/login";
        }
      } else {
        $_SESSION["error"] = "Az e-mail cím nincs regisztrálva!";
        $_SESSION["error-field"] = "e-mail";
        $_SESSION["returnUrl"] = "/login";
      }
    } else {
      $_SESSION["error"] = "Érvénytelen e-mail cím!";
      $_SESSION["error-field"] = "e-mail";
      $_SESSION["returnUrl"] = "/login";
    }
  }

  private function finishLogin($id, $name, $hash) {
    if (isset($_COOKIE["cookiebar"]) && $_COOKIE["cookiebar"] == "CookieAllowed") {
      $_SESSION["user-id"] = $id;
      $_SESSION["user"] = $name;
      if (isset($_POST["allow-cookie"])) setcookie("user_data", json_encode(array("user" => $name,
          "password_hash" => password_hash($hash, PASSWORD_DEFAULT))), time() + 604800, "/");
      $_SESSION["returnUrl"] = $_SESSION["previousUrl"];
    }
    else $_SESSION["returnUrl"] = "/welcome";
    unset($_SESSION["POST"]);
  }
} ?>
