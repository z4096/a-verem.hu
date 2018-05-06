<?php class NavigationBar {
  
  public function render() { ?> 
    <ul>  
      <li><a href="/" id="logo-link"><img src="/images/logo.png" alt="a-verem.hu logo" id="logo-image"/></a>
      </li> 
      <li>
        <a href="<?php echo isset($_SESSION["user-id"]) ? "/email-setting" : "/login"; ?>">
        <i class="material-icons icon">&#xE853;</i>
        <?php echo isset($_SESSION["user-id"]) ? $_SESSION["user"] : "Belépés"; ?>
        </a>  
      </li>
    </ul>
  <?php }
} ?>
