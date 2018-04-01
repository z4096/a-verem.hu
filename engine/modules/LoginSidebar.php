<?php class LoginSidebar {		
  
  public function render(&$parameters) { ?>             
    <aside>
      <a href="/login" class="option <?php if ($parameters[1] == "login") echo "selected"; ?>">
        Bejelentkezés
      </a>
      <a href="/password-sender" class="option <?php if ($parameters[1] == "password-sender") echo "selected"; ?>">
        Elfelejtett jelszó
      </a>
      <a href="/registration" class="option <?php if ($parameters[1] == "registration") echo "selected"; ?>">
        Regisztráció
      </a>
      <a href="<?php echo $_SESSION['previousUrl']; ?>" class="option">Vissza</a>
    </aside>
  <?php }
} ?>