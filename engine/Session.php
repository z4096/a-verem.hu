<?php class Session {	

  public function run() {
    session_start(); 
    if (!isset($_SESSION["user-id"]) && isset($_COOKIE["user_data"])) {         
      $database = new Database();
      $userData = json_decode($_COOKIE["user_data"], true);      
      $database->doQuery("SELECT id, password_hash FROM users WHERE name='" . $userData["user"] . "'");
      if ($database->countRows()) {
        $dataRows = $database->fetchRows();
        if (password_verify($dataRows[0]["password_hash"], $userData["password_hash"])) {
          $_SESSION["user-id"] = $dataRows[0]["id"];
          $_SESSION["user"] = $userData["user"];
          setcookie("user_data", json_encode($userData), time() + 604800);
        } else $this->logout();
      } else $this->logout();
    }
  }
  
  private function logout() {
    session_destroy();    
    setcookie("user_data", "", time() - 3600, "/");    
    session_start();
  }
} ?>