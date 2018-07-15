<?php class AccountDeleteModule extends Module {

  public function render($parameters) {
    if (!isset($_SESSION["user-id"])) $this->notFound();
    if (!isset($_SESSION["POST"])) {
      $accountDeleteData = new AccountDeleteData();
      $email = $accountDeleteData->getEmail($_SESSION["user-id"]);
      if (!$email) $this->notFound();
    } ?>
    <div class="sidebar-page">
      <article id="login-article">
        <section class="content-box">
          <div>Biztosan törölni akarod az alábbi fiókot? (A korábbi hozzászólásaid megmaradnak.)</div>
          <form method="post" action="/action/account-delete">
            <div class="settings">
              <div class="row">
                <div class="left-side">Felhasználónév:</div>
                <div class="right-side name"><?php echo $_SESSION["user"]; ?></div>
              </div>
              <div class="row">
                <div class="left-side">E-mail cím:</div>
                <div class="right-side"><?php echo $email ?></div>
              </div>
              <br/>
            </div>
            <div>
              <button type="submit" name="action" value="confirm" class="button confirm-button">Törlés</button>
              <button type="submit" name="action" value="cancel" class="button cancel-button">Mégsem</button>
            </div>
          </form>
        </section>
        <div class="content-box-bottom"></div>
      </article>
    </div>
    <?php }
} ?>
