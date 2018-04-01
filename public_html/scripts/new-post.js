function insertTags(type, url) {
  var textarea = document.getElementById("new-post-input");
  var start = textarea.selectionStart;
  var end = textarea.selectionEnd;
  var text = textarea.value;  
  switch (type) {
    case "bold":
      textarea.value = text.substring(0, start) + "[B]" + text.substring(start, end) + "[/B]" + text.substring(end, text.length);      
    break;
    case "italic":
      textarea.value = text.substring(0, start) + "[I]" + text.substring(start, end) + "[/I]" + text.substring(end, text.length);      
    break;
    case "link":
      textarea.value = text.substring(0, start) + "[LINK=" + url + "]" +
        text.substring(start, end) + "[/LINK]" + text.substring(end, text.length);      
    break;
    case "image":
      textarea.value = text.substring(0, start) + "[IMAGE]" + url + "[/IMAGE]" + text.substring(start, text.length);            
    break;
    case "video":      
      textarea.value = text.substring(0, start) + "[YOUTUBE]" + url + "[/YOUTUBE]" + text.substring(start, text.length);      
    break;
  }
  textarea.selectionStart = textarea.selectionEnd = start;
  textarea.focus();
}

document.getElementById("new-post-bold").onclick = function() {insertTags("bold", null);};
document.getElementById("new-post-italic").onclick = function() {insertTags("italic", null);};
document.getElementById("new-post-link").onclick = function() {
  var url = window.prompt("Add meg a link URL címét:", "");
  if (url != null && url != "") insertTags("link", url);
};
document.getElementById("new-post-image").onclick = function() {
  var url = window.prompt("Add meg a kép URL címét:", "");
  if (url != null && url != "") insertTags("image", url);
};
document.getElementById("new-post-youtube").onclick = function() {
  var url = window.prompt("Add meg a videó URL címét:", "");
  if (url != null && url != "") insertTags("video", url);
};