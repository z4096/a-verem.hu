<?php class WelcomeModule extends Module {		
  
  public function render(&$parameters) { ?>    
    <article id="welcome">
      <section class="content-box">
        Üdvözlet!<br/>
        <br/>
        A-Verem.hu egy minimalista felületű, tartalom orientált oldal árkád/retró/homebrew alkotások/fejlesztések számára.<br/>
        Mindent, ami ezzel kapcsolatos, bedobhatsz ide, nem számít, ha rendhagyó, szürreális vagy idétlen. :)<br/>
        <br/>
        <a href="/the-stack/1" class="the-stack">Tovább a verembe</a>
      </section>
      <section class="content-box-bottom"></section>
    </article>  
    <script src="/scripts/wrapper-height.js"></script>
    <?php $_SESSION["previousUrl"] = "/welcome";   
  }
} ?>