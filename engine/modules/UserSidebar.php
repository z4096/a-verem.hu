<?php class UserSidebar {		
  
  public function render(&$parameters) { ?>             
    <aside>
      <a href="/email-setting" class="option <?php if ($parameters[1] == "email-setting") echo "selected"; ?>">
        E-mail cím
      </a>
      <a href="/password-setting" class="option <?php if ($parameters[1] == "password-setting") echo "selected"; ?>">
        Jelszó
      </a>
      <a href="/action/logout" class="option">Kijelentkezés</a>
      <a href="<?php echo $_SESSION['previousUrl']; ?>" class="option">Vissza</a>
    </aside>
  <?php }
} ?>