<?php class PostBody {		
  
  public function render() { ?>    
    <div>
      <textarea rows="16" name="new-post-input" id="new-post-input" placeholder="Hozzászólás"
        class="input <?php if (isset($_SESSION["error-field"]) && $_SESSION["error-field"] === "new-post-input")
          echo "input-error"; ?>"><?php if (isset($_SESSION["POST"]["new-post-input"])) 
          echo $_SESSION["POST"]["new-post-input"]; ?></textarea>
    </div>
    <div>
      <button type="button" id="new-post-bold" class="new-post-button">Vastag</button>                  
      <button type="button" id="new-post-italic" class="new-post-button">Dőlt</button>
      <button type="button" id="new-post-link" class="new-post-button">Link</button>                  
      <button type="button" id="new-post-image" class="new-post-button">Kép</button>
      <button type="button" id="new-post-youtube" class="new-post-button">YouTube</button> 
    </div>
    <div>
      <button type="submit" name="action" value="confirm" class="post-button confirm-button">Mehet</button>                  
      <button type="submit" name="action" value="cancel" class="post-button cancel-button">Mégsem</button>
    </div>
    <script src="/scripts/new-post.js"></script>    
  <?php }
} ?>