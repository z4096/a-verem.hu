function setArticleHeight() {
  var wrapperHeight = document.querySelector("#body-container").clientHeight - 90;
  var sidebarHeight = document.querySelector("aside").clientHeight;
  var article = document.querySelector("article"); 
  if (sidebarHeight > article.clientHeight && sidebarHeight > wrapperHeight) article.style.height = sidebarHeight + "px";
  else if (wrapperHeight > article.clientHeight && wrapperHeight > sidebarHeight) article.style.height = wrapperHeight + "px";
}

window.onresize = function() {window.location.reload();};
window.onload = function() {setArticleHeight();};
