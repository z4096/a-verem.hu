<?php class RegistrationModule extends Module {

  public function render($parameters) { ?>
    <div class="sidebar-page">
      <article id="login-article">
        <section class="content-box">
          <?php if (isset($_SESSION["error"])): ?>
            <div class="error"><?php echo $_SESSION["error"]; ?></div>
          <?php endif; ?>
          <form method="post" action="/action/registration">
            <div>
              <input type="text" name="name" maxlength="12" placeholder="Felhasználónév (maximum 12 karakter)"
                value="<?php if (isset($_SESSION["POST"]["name"])) echo $_SESSION["POST"]["name"]; ?>"
                class="input <?php if (isset($_SESSION["error-field"]) && $_SESSION["error-field"] === "name")
                  echo "input-error"; ?>">
            </div>
            <div>
              <input type="email" name="e-mail" maxlength="63" placeholder="E-mail cím (maximum 63 karakter)"
                value="<?php if (isset($_SESSION["POST"]["e-mail"])) echo $_SESSION["POST"]["e-mail"]; ?>"
                class="input <?php if (isset($_SESSION["error-field"]) && $_SESSION["error-field"] === "e-mail")
                  echo "input-error"; ?>">
            </div>
            <div>
              <input type="password" name="password" maxlength="63" placeholder="Jelszó (minimum 8, maximum 63 karakter)"
                class="input <?php if (isset($_SESSION["error-field"]) && $_SESSION["error-field"] === "password")
                  echo "input-error"; ?>">
            </div>
            <div>
              <input type="password" name="password-again" maxlength="63" placeholder="Jelszó megerősítése"
                class="input <?php if (isset($_SESSION["error-field"]) && $_SESSION["error-field"] === "password")
                  echo "input-error"; ?>">
            </div>
            <div>
              <input type="checkbox" id="allow-storage" name="allow-storage"/>
              <span id="allow-storage-span" <?php if (isset($_SESSION["error-field"])
                  && $_SESSION["error-field"] === "allow-storage") echo " class=input-error"; ?>>
                Hozzájárulok a megadott adatok tárolásához</span>
            </div>
            <div>
              <input type="checkbox" id="allow-cookie" name="allow-cookie"/>
              <span id="allow-cookie-span">Süti engedélyezése a bejelentkezve maradáshoz</span>
            </div>
            <div>
              <button type="submit" name="action" value="confirm" class="button confirm-button">Regisztrálok</button>
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
