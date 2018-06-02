function navToggleDiv(divId, spanId) {
  var dropdown = document.getElementById(divId);
  dropdown.style.display = dropdown.style.display === "block" ? "none" : "block"; 
  var span = document.getElementById(spanId);
  if (span.style.backgroundColor === "") {
    span.style.backgroundColor = "darkslategray";
    span.style.borderColor = "white";
  } else {
    span.style.backgroundColor = "";
    span.style.borderColor = "darkslategray";
  }
  /*userspan.style.backgroundColor = userspan.style.backgroundColor === "" ? "darkslategray" : "";
  userspan.style.border = "1px solid darkslategray";
  userspan.style.borderBottom = "0px";
  userspan.style.borderRadius = "3px 3px 0px 0px";*/
}

function navHideDiv(event, dropdownClass, divId, spanId) {
  if (!event.target.matches(dropdownClass)) {
    document.getElementById(divId).style.display = "none";
    
    var span = document.getElementById(spanId);  
    span.style.backgroundColor = "";
    span.style.borderColor = "darkslategray";
    
    /*document.getElementById(spanId).style.backgroundColor = "";*/
  }
}

window.onclick = function(event) {navHideDiv(event, ".dropdown-menu", "menu-div", "menu-span");};
document.onkeydown = function(event) {
  if (event.keyCode == 27) navHideDiv(event, ".dropdown-menu", "menu-div", "menu-span"); 
};
document.getElementById("menu-span").onclick = function() {navToggleDiv("menu-div", "menu-span");};
