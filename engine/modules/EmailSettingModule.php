<?php class EmailSettingModule extends Module {

  public function render($parameters) {
    if (!isset($_SESSION["user-id"])) $this->notFound();
    if (!isset($_SESSION["POST"])) {
      $_SESSION["POST"] = array();
      $emailSettingData = new EmailSettingData();
      $_SESSION["POST"]["e-mail"] = $emailSettingData->getEmail($_SESSION["user-id"]);
      if (!$_SESSION["POST"]["e-mail"]) $this->notFound();
    } ?>
    <div class="sidebar-page">
      <article id="login-article">
        <section class="content-box">
          <?php if (isset($_SESSION["error"])): ?>
            <div class="error"><?php echo $_SESSION["error"]; ?></div>
          <?php endif; ?>
          <form method="post" action="/action/email-setting">
            <div class="settings">
              <div class="row">
                <div class="left-side">Felhasználónév:</div>
                <div class="right-side name"><?php echo $_SESSION["user"]; ?></div>
              </div>
              <div class="row">
                <div class="left-side">E-mail cím:</div>
                <input type="email" name="e-mail" maxlength="63" placeholder="(maximum 63 karakter)"
                  value="<?php if (isset($_SESSION["POST"]["e-mail"])) echo $_SESSION["POST"]["e-mail"] ?>"
                  class="right-side input <?php if (isset($_SESSION["error-field"]) && $_SESSION["error-field"] === "e-mail")
                    echo "input-error" ?>">
              </div>
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
