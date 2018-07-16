<?php class PasswordSenderModule extends Module {

  public function render($parameters) { ?>
    <div class="sidebar-page">
      <article id="login-article">
        <section class="content-box">
          <?php if (isset($_SESSION["error"])): ?>
            <div class="error"><?php echo $_SESSION["error"]; ?></div>
          <?php endif; ?>
          <div class="message">Bejelentkezés után egy órán belül változtasd meg az elküldött jelszót!</div>
          <form method="post" action="/action/password-sender">
            <div>
              <input type="email" name="e-mail" placeholder="E-mail cím"
                value="<?php if (isset($_SESSION["POST"]["e-mail"])) echo $_SESSION["POST"]["e-mail"]; ?>"
                class="input <?php if (isset($_SESSION["error-field"]) && $_SESSION["error-field"] === "e-mail")
                  echo "input-error"; ?>">
            </div>
            <div>
              <button type="submit" name="action" value="confirm" class="button confirm-button">Jelszó küldése</button>
              <button type="submit" name="action" value="cancel" class="button cancel-button">Mégsem</button>
            </div>
          </form>
        </section>
        <div class="content-box-bottom"></div>
      </article>
    </div>
    <?php parent::clear();
  }
} ?>
