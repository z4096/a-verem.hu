<?php class LoginModule extends Module {		
  
  public function render(&$parameters) { ?>
    <div class="sidebar-page">
      <div id="aside-row">
        <?php (new LoginSidebar())->render($parameters); ?>
      </div>
      <article id="login-article">
        <section class="content-box">
          <?php if (isset($_SESSION["error"])): ?>
            <div class="error"><?php echo $_SESSION["error"]; ?></div>
          <?php endif; ?>
          <form method="post" action="/action/login">
            <div>
              <input type="email" name="e-mail" maxlength="63" placeholder="E-mail cím" 
                value="<?php if (isset($_SESSION["POST"]["e-mail"])) echo $_SESSION["POST"]["e-mail"]; ?>"
                class="input <?php if (isset($_SESSION["error-field"]) && $_SESSION["error-field"] === "e-mail")
                  echo "input-error"; ?>"/>
            </div>
            <div>
              <input type="password" name="password" maxlength="63" placeholder="Jelszó"
                class="input <?php if (isset($_SESSION["error-field"]) && $_SESSION["error-field"] === "password")
                  echo "input-error"; ?>"/>
            </div>
            <div>          
              <button type="submit" name="action" value="confirm" class="button confirm-button">Bejelentkezem</button>                  
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
