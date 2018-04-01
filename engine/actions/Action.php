<?php abstract class Action {		  
  
  abstract public function process(&$parameters); 

  protected function notFound() {$_SESSION["returnUrl"] = "/not-found";}

} ?>