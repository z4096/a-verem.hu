<?php function notFound() {
  header("location: /not-found");
  exit();
}

spl_autoload_register(function($class) {
  $file = "../engine/" . $class . ".php";
  if (file_exists($file)) require $file;
  $file = "../engine/modules/" . $class . ".php";
  if (file_exists($file)) require $file;
  $file = "../engine/actions/" . $class . ".php";
  if (file_exists($file)) require $file;
});
(new Session())->run();
$parameters = explode("/", $_SERVER["REQUEST_URI"]);
if (!isset($parameters[1]) || $parameters[1] == "") {
  header("location: " . (isset($_SESSION["user-id"]) ? "/the-stack/1" : "/welcome"));
  exit();
} elseif (isset($parameters[1])) {
  if ($parameters[1] == "action") {
    if (isset($parameters[2]) && $parameters[2] != "") {
      $actionClass = "";
      foreach (explode("-", $parameters[2]) as $tag) $actionClass .= ucfirst($tag);
      $actionClass .= "Action";
      if (class_exists($actionClass)) {
        (new $actionClass())->process($parameters);
        header("location: " . $_SESSION["returnUrl"]);
        exit();
      } else notFound();
    } else notFound();
  } else {
    if ($parameters[1] != "") {
      $moduleClass = "";
      foreach (explode("-", $parameters[1]) as $tag) $moduleClass .= ucfirst($tag);
    } else notFound();
    $moduleClass .= "Module"; 
    if (!class_exists($moduleClass)) notFound();
  }
} else notFound(); ?>
  
<!doctype html>
<html lang="hu">  
  <head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title>A-Verem.hu</title>
	<meta http-equiv="Cache-Control" content="max-age=3600"/>
	<meta name="expires" content="NEVER"/>
	<meta name="revisit-after" content="7 day"/>
	<meta name="Generator" content="Brackets"/>
	<meta name="Author" content=""/>
	<meta name="Keywords" content=""/>
	<meta name="Description" content=""/>
    <link rel="icon" href="/images/favicon.ico"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Taviraj|Titillium+Web|Material+Icons"/>
    <link rel="stylesheet" media="screen and (min-width: 1001px)" href="/big-screen.css"/>
    <link rel="stylesheet" media="screen and (max-width: 1000px)" href="/small-screen.css"/>
  </head>
  <body>
    <div id="body-container">      
      <nav>
        <?php (new NavigationBar())->render(); ?>
      </nav>
      <main>     
        <?php (new $moduleClass())->render($parameters); ?>
      </main>
    </div>
    <div id="footer-container">
      <footer>
        ©Copyright 2050 by nobody. All rights reversed.
      </footer>    
    </div>    
  </body>
</html>
