<?php class LogoutAction extends Action {		  
  
  public function process(&$parameters) {
    $previousUrl = $_SESSION["previousUrl"];
    session_destroy();    
    setcookie("user_data", "", time() - 3600, "/");    
    session_start();
    $_SESSION["returnUrl"] = $_SESSION["previousUrl"] = $previousUrl;
  }
} ?>