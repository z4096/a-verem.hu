<?php class TheStackModule extends Module {

  public function render($parameters) {
    if (!isset($parameters[2]) || !ctype_digit($parameters[2]) || $parameters[2] == 0) $this->notFound();
    $theStackData = new TheStackData();
    $topicRow = $theStackData->getPosts($parameters[2]);
    if ($parameters[2] != 1 && !$topicRow) $this->notFound();
    $rowCount = $theStackData->getCount();
    $pages = ($rowCount == 0 ? 1 : intdiv(($rowCount - 1), 10) + 1); ?>
    <article id="topics-article">
      <div class="pager-bar-top">
        <?php ($pagerBar = new PagerBar())->render($pages, $parameters[2]); ?>
      </div>
      <?php if (isset($_SESSION["user-id"])): ?>
        <a href="/new-post" class="new-post">Új hozzászólás</a>
      <?php endif; ?>
      <?php for ($index = 0; $index != count($topicRow); $index++):
        $date = explode(" ", $topicRow[$index]["time"]);
        $date[1] = substr($date[1], 0, -3);
        if ($date[0] === date("Y-m-d")) $date[0] = "ma";
        elseif ($date[0] === date("Y-m-d", time() - 86400)) $date[0] = "tegnap";
        else $date[1] = ""; ?>
        <section class="content-box">
          <div class="post-header">
            <div class="left-side">
              <span class="title"><?php echo $topicRow[$index]["id"] ?>. </span>
              <span class="user"><?php echo $topicRow[$index]["name"] ?> </span>
              <span class="title"><br/><?php echo $date[0] . " " . $date[1] ?></span>
              <?php if ($topicRow[$index]["reply_id"]): ?>
                <br/><span class="reply"> (<?php echo $topicRow[$index]["reply_id"] ?>. hozzászólásra válasz)</span>
              <?php endif; ?>
            </div>
            <?php if (isset($_SESSION["user-id"])):
              if ($topicRow[$index]["user_id"] != $_SESSION["user-id"]): ?>
                <div class="center"></div>
                <a href=<?php echo "/reply-post/" . $topicRow[$index]["id"] ?> class="right-side">válasz erre</a>
              <?php elseif (strtotime($topicRow[$index]["time"]) > strtotime($topicRow[$index]["time_limit"])): ?>
                <div class="center"></div>
                <a href=<?php echo "/edit-post/" . $topicRow[$index]["id"] ?> class="right-side">szerkesztés</a>
              <?php endif;
            endif; ?>
          </div>
          <div class="post"><?php echo $this->parsePost($topicRow[$index]["post"]); ?></div>
          <?php if ($topicRow[$index]["edit_time"] != "0000-00-00 00:00:00"):
            $date = explode(" ", $topicRow[$index]["edit_time"]);
            $date[1] = substr($date[1], 0, -3);
            if ($date[0] === date("Y-m-d")) $date[0] = "ma";
            elseif ($date[0] === date("Y-m-d", time() - 86400)) $date[0] = "tegnap";
            else $date[1] = "";?>
            <div class="post-edited">szerkesztve: <?php echo $date[0] . " " . $date[1] ?></div>
          <?php endif; ?>
        </section>
      <?php endfor; ?>
      <div class="content-box-bottom"></div>
      <div class="pager-bar-bottom">
        <?php if ($pages != $parameters[2]) $pagerBar->render($pages, $parameters[2]); ?>
      </div>
    </article>
    <?php $_SESSION["previousUrl"] = "/the-stack/" . $parameters[2];
  }

  private function parsePost($post) {
    $post = nl2br(htmlspecialchars($post));
    $post = str_replace("[B]", "<b>", $post, $opening);
    $post = str_replace("[/B]", "</b>", $post, $ending);
    while ($opening > $ending++) $post .= "</b>";
    $post = str_replace("[I]", "<i>", $post, $opening);
    $post = str_replace("[/I]", "</i>", $post, $ending);
    while ($opening > $ending++) $post .= "</i>";
    for ($post = str_replace("[/LINK]", "</a>", $post, $ending), $opening = 0; $this->parseLink($post, $opening); );
    while ($opening > $ending++) $post .= "</a>";
    while ($this->parseImage($post));
    while ($this->parseYoutube($post));
    return $post;
  }

  private function parseLink(&$post, &$opening) {
    if (($start = strpos($post, "[LINK=")) === false) return false;
    if (($end = strpos($post, "]", $start)) === false) {
      $post .= "]";
      $end = strpos($post, "]", $start);
    }
    $end++;
    $post = substr_replace($post,
      "<a href='" . substr($post, $start + 6, $end - $start - 7) . "' class='link'>", $start, $end - $start);
    $opening++;
    return true;
  }

  private function parseImage(&$post) {
    if (($start = strpos($post, "[IMAGE]")) === false) return false;
    if (($end = strpos($post, "[/IMAGE]")) === false) {
      $post .= "[/IMAGE]";
      $end = strpos($post, "[/IMAGE]");
    }
    $end += 8;
    $post = substr_replace($post,
      "<img src='" . substr($post, $start + 7, $end - $start - 15) . "' class='image'>", $start, $end - $start);
    return true;
  }

  private function parseYoutube(&$post) {
    if (($start = strpos($post, "[YOUTUBE]")) === false) return false;
    if (($end = strpos($post, "[/YOUTUBE]")) === false) {
      $post .= "[/YOUTUBE]";
      $end = strpos($post, "[/YOUTUBE]");
    }
    $end += 10;
    if (($codePosition = strpos($post, "youtu.be/", $start + 9)) !== false && $codePosition < $end) $codePosition += 9;
    else if (($codePosition = strpos($post, "v=", $start + 9)) !== false && $codePosition < $end) $codePosition += 2;
    else {
      $post = substr_replace($post, "", $start, $end - $start);
      return true;
    }
    $post = substr_replace($post, "<div class='youtube-container'><iframe src='https://www.youtube.com/embed/" .
      substr($post, $codePosition, 11) .
      "' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen class='video'></iframe></div>",
      $start, $end - $start);
    return true;
  }
} ?>
