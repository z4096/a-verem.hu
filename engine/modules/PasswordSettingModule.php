<?php class PasswordSettingModule extends Module {		
  
  public function render(&$parameters) { ?>    
    <div class="sidebar-page">
      <div id="aside-row">
        <?php (new UserSidebar())->render($parameters); ?>
      </div>
      <article id="login-article">
        <section class="content-box">
          <?php if (isset($_SESSION["error"])): ?>
            <div class="error"><?php echo $_SESSION["error"]; ?></div>
          <?php endif; ?>
          <form method="post" action="/action/password-setting">            
            <div>
              <input type="password" name="password" placeholder="Új jelszó (minimum 8, maximum 63 karakter)"
                class="input <?php if (isset($_SESSION["error-field"]) && $_SESSION["error-field"] === "password")
                  echo "input-error" ?>">
            </div>
            <div>
              <input type="password" name="password-again" placeholder="Új jelszó megerősítése"
                class="input <?php if (isset($_SESSION["error-field"]) && $_SESSION["error-field"] === "password")
                  echo "input-error" ?>">
            </div>            
            <div>          
              <button type="submit" name="action" value="confirm" class="button confirm-button">Mentés</button>                  
              <button type="submit" name="action" value="cancel" class="button cancel-button">Mégsem</button>
            </div>
          </form>   
        </section>
        <div class="content-box-bottom"></div>
      </article>
    </div>
    <?php unset($_SESSION["error"]);
    unset($_SESSION["error-field"]);
    unset($_SESSION["POST"]);
  }
} ?>
