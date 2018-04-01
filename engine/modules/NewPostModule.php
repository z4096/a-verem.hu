<?php class NewPostModule extends Module {		
  
  public function render(&$parameters) { ?>
    <article id="topics-article"> 
      <section class="content-box">
        <?php if (isset($_SESSION["error"])): ?>
          <div class="error"><?php echo $_SESSION["error"]; ?></div>
        <?php endif; ?>      
        <form method="post" action="/action/new-post">
          <?php (new PostBody())->render(); ?>        
        </form>
      </section>
      <div class="section-bottom"></div>
    </article>  
    <script src="/scripts/wrapper-height.js"></script>
    <?php unset($_SESSION["error"]);          
    unset($_SESSION["error-field"]);
    unset($_SESSION["POST"]);
  }
} ?>