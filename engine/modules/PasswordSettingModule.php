<?php class PasswordSettingModule extends Module {

  public function render(&$parameters) {
    if (!isset($_SESSION["user-id"])) $this->notFound(); ?>
    <div class="sidebar-page">
      <article id="login-article">
        <section class="content-box">
          <?php if (isset($_SESSION["error"])): ?>
            <div class="error"><?php echo $_SESSION["error"]; ?></div>
          <?php endif; ?>
          <form method="post" action="/action/password-setting">
            <div>
              <input type="password" name="password" maxlength="63" placeholder="Új jelszó (minimum 8, maximum 63 karakter)"
                class="input <?php if (isset($_SESSION["error-field"]) && $_SESSION["error-field"] === "password")
                  echo "input-error" ?>">
            </div>
            <div>
              <input type="password" name="password-again" maxlength="63" placeholder="Új jelszó megerősítése"
                class="input <?php if (isset($_SESSION["error-field"]) && $_SESSION["error-field"] === "password")
                  echo "input-error" ?>">
            </div>
            <div>
              <input type="checkbox" id="allow-cookie" name="allow-cookie"/>
              <span id="allow-cookie-span">Süti engedélyezése a bejelentkezve maradáshoz</span>
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
