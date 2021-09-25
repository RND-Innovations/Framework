<h1>Animations in RND Framework</h1>
<p>In default, RND Framework uses the following Animations in pages.</p>

<hr>


<div class="rnd-container">
    
    <div class="rnd-col m6 l4 rnd-margin">
        <p>rnd-animate-top:</p>
        <img src="<?php echo MEDIA_URL;?>/gallery/rnd-black-logo-lg.png" class="rnd-round-small rnd-animate-top" alt="RND Images" style="width:90%">   
    </div>
    
  
    <div class="rnd-col m6 l4 rnd-margin">
        <p>rnd-animate-zoom:</p>
        <img src="<?php echo MEDIA_URL;?>/gallery/rnd-black-logo-lg.png" class="rnd-round-small rnd-animate-zoom" alt="RND Images" style="width:90%">   
    </div>
    
    <div class="rnd-col m6 l4 rnd-margin">
        <p>rnd-animate-left:</p>
        <img src="<?php echo MEDIA_URL;?>/gallery/rnd-black-logo-lg.png" class="rnd-round-small rnd-animate-left" alt="RND Images" style="width:90%">   
    </div>
    
    <div class="rnd-col m6 l4 rnd-margin">
        <p>rnd-animate-bottom:</p>
        <img src="<?php echo MEDIA_URL;?>/gallery/rnd-black-logo-lg.png" class="rnd-round-small rnd-animate-bottom" alt="RND Images" style="width:90%">   
    </div>    

    <div class="rnd-col m6 l4 rnd-margin">
        <p>rnd-spin:</p>
        <img src="<?php echo MEDIA_URL;?>/gallery/rnd-black-logo-lg.png" class="rnd-circle rnd-spin" alt="RND Images" style="width:90%">   
    </div>
    
    <div class="rnd-col m6 l4 rnd-margin">
        <p>rnd-animate-fading:</p>
        <img src="<?php echo MEDIA_URL;?>/gallery/rnd-black-logo-lg.png" class="rnd-circle rnd-animate-fading" alt="RND Images" style="width:90%">   
    </div>
    
</div>

<hr>


<div class="rnd-container">
  <h2>RND Animated Modal</h2>
  <p>Zoom in the modal with the rnd-animate-zoom class, or slide in the modal from a specific direction using the rnd-animate-top, rnd-animate-bottom, rnd-animate-left or rnd-animate-right class:</p>
  <button onclick="document.getElementById('id01').style.display='block'" class="rnd-button rnd-black">Open Animated Modal</button>

  <div id="id01" class="rnd-modal">
    <div class="rnd-modal-content rnd-animate-top rnd-card-4">
      <header class="rnd-container rnd-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="rnd-button rnd-display-topright">&times;</span>
        <h2>Modal Header</h2>
      </header>
      <div class="rnd-container">
        <p>Some text..</p>
        <p>Some text..</p>
      </div>
      <footer class="rnd-container rnd-teal">
        <p>Modal Footer</p>
      </footer>
    </div>
  </div>
</div>


<hr>

<div class="rnd-container">
<h2>Modal Tabs</h2>
<p>In this example we add tabbed content inside the modal.</p>

<button onclick="document.getElementById('id02').style.display='block'" class="rnd-button rnd-black">Open Tabbed Modal</button>

<div id="id02" class="rnd-modal">
 <div class="rnd-modal-content rnd-card-4 rnd-animate-zoom">
  <header class="rnd-container rnd-blue"> 
   <span onclick="document.getElementById('id02').style.display='none'" 
   class="rnd-button rnd-blue rnd-xlarge rnd-display-topright">&times;</span>
   <h2>Header</h2>
  </header>

  <div class="rnd-bar rnd-border-bottom">
   <button class="tablink rnd-bar-item rnd-button" onclick="openCity(event, 'London')">London</button>
   <button class="tablink rnd-bar-item rnd-button" onclick="openCity(event, 'Paris')">Paris</button>
   <button class="tablink rnd-bar-item rnd-button" onclick="openCity(event, 'Tokyo')">Tokyo</button>
  </div>

  <div id="London" class="rnd-container city">
   <h1>London</h1>
   <p>London is the most populous city in the United Kingdom, with a metropolitan area of over 9 million inhabitants.</p>
   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
  </div>

  <div id="Paris" class="rnd-container city">
   <h1>Paris</h1>
   <p>Paris is the capital of France.</p>
   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
  </div>

  <div id="Tokyo" class="rnd-container city">
   <h1>Tokyo</h1>
   <p>Tokyo is the capital of Japan.</p><br>
  </div>

  <div class="rnd-container rnd-light-grey rnd-padding">
   <button class="rnd-button rnd-right rnd-white rnd-border" 
   onclick="document.getElementById('id02').style.display='none'">Close</button>
  </div>
 </div>
</div>

</div>

<script>
document.getElementsByClassName("tablink")[0].click();

function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].classList.remove("rnd-light-grey");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.classList.add("rnd-light-grey");
}
</script>
 

<hr>



<div class="rnd-container">

<h2>RND Lightbox</h2>
<p>In this example we combine JavaScript from Slideshows and Modals to create a Lightbox (Modal Image Gallery):</p>
<div class="rnd-row-padding" style="margin:0 -16px">
  <div class="rnd-col s4">
    <img src="<?php echo MEDIA_URL;?>/gallery/nature.jpg" style="width:100%;cursor:pointer"
    onclick="openModal();currentDiv(1)" class="rnd-hover-shadow">
  </div>
  <div class="rnd-col s4">
    <img src="<?php echo MEDIA_URL;?>/gallery/snow.jpg" style="width:100%;cursor:pointer"
    onclick="openModal();currentDiv(2)" class="rnd-hover-shadow">
  </div>
  <div class="rnd-col s4">
    <img src="<?php echo MEDIA_URL;?>/gallery/hills.jpg" style="width:100%;cursor:pointer"
    onclick="openModal();currentDiv(3)" class="rnd-hover-shadow">
  </div>
</div>

<div id="myModal" class="rnd-modal rnd-black">
 <span class="rnd-text-white rnd-xxlarge rnd-hover-text-grey rnd-container rnd-display-topright" onclick="closeModal()" style="cursor:pointer">×</span>
 <div class="rnd-modal-content">

  <div class="rnd-content" style="max-width:1200px">
   <img class="mySlides" src="<?php echo MEDIA_URL;?>/gallery/nature.jpg" style="width:100%">
   <img class="mySlides" src="<?php echo MEDIA_URL;?>/gallery/snow.jpg" style="width:100%">
   <img class="mySlides" src="<?php echo MEDIA_URL;?>/gallery/hills.jpg" style="width:100%">
   <div class="rnd-row rnd-black rnd-center">
    <div class="rnd-display-container">
     <p id="caption"></p>
     <span class="rnd-display-left rnd-btn" onclick="plusDivs(-1)">❮</span>
     <span class="rnd-display-right rnd-btn" onclick="plusDivs(1)">❯</span>
    </div>
    <div class="rnd-col s4">
     <img class="demo rnd-opacity rnd-hover-opacity-off" src="<?php echo MEDIA_URL;?>/gallery/nature.jpg" style="width:100%" onclick="currentDiv(1)" alt="Nature and sunrise">
    </div>
    <div class="rnd-col s4">
     <img class="demo rnd-opacity rnd-hover-opacity-off" src="<?php echo MEDIA_URL;?>/gallery/snow.jpg" style="width:100%" onclick="currentDiv(2)" alt="French Alps">
    </div>
    <div class="rnd-col s4">
     <img class="demo rnd-opacity rnd-hover-opacity-off" src="<?php echo MEDIA_URL;?>/gallery/hills.jpg" style="width:100%" onclick="currentDiv(3)" alt="Mountains and fjords">
    </div>
   </div> <!-- End row -->
  </div> <!-- End rnd-content -->
  
 </div> <!-- End modal content -->
</div> <!-- End modal -->

</div>

<script>
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" rnd-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " rnd-opacity-off";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

<hr>