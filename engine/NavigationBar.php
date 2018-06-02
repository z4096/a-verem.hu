<?php class NavigationBar {
  
  public function render() { ?> 
    <ul>  
      <li><a href="/" id="logo-link"><img src="/images/logo.png" alt="a-verem.hu logo" id="logo-image"/></a>
      </li> 
      
      <li>
        <div class="dropdown">             
          <span id="menu-span" class="dropdown-menu">
            <i class="material-icons icon dropdown-menu">&#xE853;</i>
            <?php echo isset($_SESSION["user-id"]) ? $_SESSION["user"] : "Menü"; ?>
          </span>
          <div id="menu-div" class="dropdown-content dropdown-menu">
            <?php if (isset($_SESSION["user-id"])): ?>
            <a href="/action/logout">Kijelentkezés</a>
            <a href="/email-setting">E-mail cím beállítasa</a>
            <a href="/password-setting">Jelszó beállítasa</a>
            <a href="/account-delete">Felhasználó törlése</a>
            <?php else: ?>
            <a href="/login">Bejelentkezés</a>
            <a href="/registration">Regisztráció</a>
            <a href="/password-sender">Elfelejtett jelszó</a>
            <?php endif; ?>
          </div>
        </div>  
      </li>
      
      <!--<li>
        <a href="<?php echo isset($_SESSION["user-id"]) ? "/email-setting" : "/login"; ?>">
        <i class="material-icons icon">&#xE853;</i>
        <?php echo isset($_SESSION["user-id"]) ? $_SESSION["user"] : "Menü"; ?>
        </a>  
      </li>-->
    </ul>
    <script src="/scripts/navigation-bar.js"></script>
  <?php }
} ?>
