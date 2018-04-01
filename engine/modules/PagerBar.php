<?php class PagerBar {
  
  public function render($pages, $page) { ?>
  <div class="pager-bar">
    <a href="/the-stack/1" class="arrow border">&lt&lt</a>
    <a href="/the-stack/<?php echo $page > 1 ? $page - 1 : "1"; ?>" class="arrow">&lt</a>
    <div class="page"><?php echo $page . " / " . $pages; ?></div>
    <a href="/the-stack/<?php echo $page < $pages ? $page + 1 : $pages; ?>" class="arrow border">&gt</a>
    <a href="/the-stack/<?php echo $pages; ?>" class="arrow">&gt&gt</a>
  </div>
  <?php }
} ?>