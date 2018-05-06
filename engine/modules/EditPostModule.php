<?php class EditPostModule extends Module {		
  
  public function render(&$parameters) { 
    if (!isset($parameters[2]) || !ctype_digit($parameters[2]) || $parameters[2] == 0) $this->notFound();     
    $database = new Database();
    $database->doQuery("SELECT posts.id, posts.reply_id, posts.post, posts.time, users.name
      FROM posts LEFT JOIN users ON users.id = posts.user_id WHERE posts.id = " . $parameters[2]);
    if (!$database->countRows()) $this->notFound();
    $postRow = $database->fetchRows();  
    $date = explode(" ", $postRow[0]["time"]);
    $date[1] = substr($date[1], 0, -3);
    if ($date[0] === date("Y-m-d")) $date[0] = "ma";
    elseif ($date[0] === date("Y-m-d", time() - 86400)) $date[0] = "tegnap";
    else $date[1] = "";    
    if (!isset($_SESSION["POST"])) {
      $_SESSION["POST"] = array();
      $_SESSION["POST"]["new-post-input"] = $postRow[0]["post"];
    } ?>
    <article id="topics-article"> 
      <section class="content-box">
        <?php if (isset($_SESSION["error"])): ?>
          <div class="error"><?php echo $_SESSION["error"]; ?></div>
        <?php endif; ?>
        <!--<div class="top-bottom"></div>      -->
        <div class="post-header">
          <div class="left-side">
            <span class="title"><?php echo $postRow[0]["id"] ?>. </span>
            <span class="user"><?php echo $postRow[0]["name"] ?> </span>
            <span class="title">: <?php echo $date[0] . " " . $date[1] ?></span>
            <?php if ($postRow[0]["reply_id"]): ?>
              <span class="reply">(<?php echo $postRow[0]["reply_id"] ?> hozzászólásra válasz)</span>
            <?php endif; ?>
          </div>
          <div class="center"></div>
          <span class="right-comment">szerkesztés</span>        
        </div>      
        <form method="post" action="/action/edit-post/<?php echo $parameters[2]; ?>">
          <?php PostBody::render(); ?>        
        </form>
        <div class="top-bottom"></div>
      </section>
      <div class="content-box-bottom"></div>
    </article>
    <?php unset($_SESSION["error"]);          
    unset($_SESSION["error-field"]);
    unset($_SESSION["POST"]);
  }
} ?>
