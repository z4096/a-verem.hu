<?php class CookieDeleteAction extends Action {

  public function process($parameters) {
    session_destroy();
    setcookie("PHPSESSID", "", time() - 3600, "/");
    setcookie("cookiebar", "", time() - 3600, "/");
    setcookie("user_data", "", time() - 3600, "/");
    header("location: /welcome");
    exit;
  }
} ?>
