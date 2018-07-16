<?php abstract class Module {

  abstract public function render($parameters);

  protected function clear() {
    unset($_SESSION["error"]);
    unset($_SESSION["error-field"]);
    unset($_SESSION["POST"]);
  }

  protected function notFound() {
    header("location: /not-found");
    exit();
  }
} ?>
