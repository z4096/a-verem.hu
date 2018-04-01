<?php abstract class Module {
  
  abstract public function render(&$parameters);
  
  protected function notFound() {    
    header("location: /not-found");
    exit();
  }
} ?>