function setArticleHeight() {
  var wrapperHeight = document.querySelector("#body-container").clientHeight - 90;
  var article = document.querySelector("article");
  if (wrapperHeight > article.clientHeight) article.style.height = wrapperHeight + "px";
}

window.onresize = function() {window.location.reload();};
window.onload = function() {setArticleHeight();};
