<?php class EditPostModule extends Module {

  public function render($parameters) {
    if (!isset($_SESSION["user-id"]) || !isset($parameters[2])
      || !ctype_digit($parameters[2]) || $parameters[2] == 0) $this->notFound();
    $postData = new PostData();
    $postRow = $postData->getPost($parameters[2]);
    if (!$postRow) $this->notFound();
    $date = explode(" ", $postRow["time"]);
    $date[1] = substr($date[1], 0, -3);
    if ($date[0] === date("Y-m-d")) $date[0] = "ma";
    elseif ($date[0] === date("Y-m-d", time() - 86400)) $date[0] = "tegnap";
    else $date[1] = "";
    if (!isset($_SESSION["POST"])) {
      $_SESSION["POST"] = array();
      $_SESSION["POST"]["new-post-input"] = $postRow["post"];
    } ?>
    <article id="topics-article">
      <section class="content-box">
        <?php if (isset($_SESSION["error"])): ?>
          <div class="error"><?php echo $_SESSION["error"]; ?></div>
        <?php endif; ?>
        <div class="post-header">
          <div class="left-side">
            <span class="title"><?php echo $postRow["id"] ?>. </span>
            <span class="user"><?php echo $postRow["name"] ?> </span>
            <br/><span class="title"><?php echo $date[0] . " " . $date[1] ?></span>
            <?php if ($postRow["reply_id"]): ?>
              <br/><span class="reply">(<?php echo $postRow["reply_id"] ?>. hozzászólásra válasz)</span>
            <?php endif; ?>
          </div>
          <div class="center"></div>
          <span class="right-comment">szerkesztés</span>
        </div>
        <form method="post" action="/action/edit-post/<?php echo $parameters[2]; ?>">
          <?php PostBody::render(); ?>
        </form>
      </section>
      <div class="content-box-bottom"></div>
    </article>
    <?php unset($_SESSION["error"]);
    unset($_SESSION["error-field"]);
    unset($_SESSION["POST"]);
  }
} ?>
