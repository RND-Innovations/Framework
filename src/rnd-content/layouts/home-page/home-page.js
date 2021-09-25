var slideIndex = 1;
showDivs(slideIndex);
carousel();

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("slide-images");
  var dots = document.getElementsByClassName("dotted");
    
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
    
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" rnd-white", "");
  }
    
  x[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " rnd-white";
        
}

function carousel() {
  var i;
  var x = document.getElementsByClassName("slide-images");
  var dots = document.getElementsByClassName("dotted");    
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; 
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" rnd-white", "");
  }    
  slideIndex++;
  if (slideIndex > x.length) {slideIndex = 1} 
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " rnd-white";    
  setTimeout(carousel, 2000); // Change image every 2 seconds
}


// fetch styles from another CSS file after load,
if(document.createStyleSheet) {
  document.createStyleSheet('{{css-import-url}}');
}
else {
  var styles = "@import url('{{css-import-url}}');";
  var newSS=document.createElement('link');
  newSS.rel='stylesheet';
  newSS.href='data:text/css,'+escape(styles);
  document.getElementsByTagName("head")[0].appendChild(newSS);
}