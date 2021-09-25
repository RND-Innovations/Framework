<h1>Panels & Boxes</h1>
<p>Panels & Boxes will help you to organize your content in a better way. Following panels, boxes and cards are available in RND Framework by default.</p>



<hr>
<div class="rnd-container">
  <h2>Displaying Panels</h2>
  <p>Panels are the same as containers except for an added top and bottom margin.</p>

  <div class="rnd-panel rnd-red">
    <p>I am a panel.</p>
  </div>
  <div class="rnd-panel rnd-green">
    <p>I am a panel.</p>
  </div>

  <div class="rnd-container rnd-red">
    <p>I am a container.</p>
  </div>
    
  <div class="rnd-container rnd-green">
    <p>I am a container.</p>
  </div>
    
<hr>    
<h2>Display Alerts</h2>
<p>The <mark>rnd-panel</mark> class can be used to display alerts:</p>

<div class="rnd-panel rnd-pink">
  <h3>Danger!</h3>
  <p>Red often indicates a dangerous or negative situation.</p>
</div>

<div class="rnd-panel rnd-orange">
  <h3>Danger!</h3>
  <p>Red often indicates a dangerous or negative situation.</p>
</div>

<div class="rnd-panel rnd-blue-grey">
  <h3>Danger!</h3>
  <p>Red often indicates a dangerous or negative situation.</p>
</div>

<div class="rnd-panel rnd-deep-orange">
  <h3>Danger!</h3>
  <p>Red often indicates a dangerous or negative situation.</p>
</div>

<div class="rnd-panel rnd-black">
  <h3>Danger!</h3>
  <p>Red often indicates a dangerous or negative situation.</p>
</div>
    
</div>

<hr>

<div class="rnd-container">
  <h2>Cards</h2>
  <p>Create paper-like cards with the rnd-card classes:</p>

  <div class="rnd-panel rnd-card"><p>rnd-card</p></div>
  <div class="rnd-panel rnd-card-2"><p>rnd-card-2</p></div>
  <div class="rnd-panel rnd-card-4"><p>rnd-card-4</p></div>
    
  <div class="rnd-panel rnd-card rnd-green"><p>rnd-card</p></div>
  <div class="rnd-panel rnd-card-2 rnd-green"><p>rnd-card-2</p></div>
  <div class="rnd-panel rnd-card-4 rnd-green"><p>rnd-card-4</p></div>
    
</div>

<hr>

<div class="rnd-container">
  <h2>Card Content</h2>
  <p>Add containers inside the card to create different sections:</p>

  <div class="rnd-card-4" style="width:50%;">
    <header class="rnd-container rnd-blue">
      <h1>Header</h1>
    </header>

    <div class="rnd-container">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>

    <footer class="rnd-container rnd-blue">
      <h5>Footer</h5>
    </footer>
  </div>
    
    
<br>
    
  <div class="rnd-card-4 rnd-dark-grey" style="width:50%">

    <div class="rnd-container rnd-center">
      <h3>Friend Request</h3>
      <img src="<?php echo MEDIA_URL;?>/gallery/customer-care.jpg" alt="Avatar" style="width:80%">
      <h5>Sha Doe</h5>

      <div class="rnd-section">
        <button class="rnd-button rnd-green">Accept</button>
        <button class="rnd-button rnd-red">Decline</button>
      </div>
    </div>

  </div>
    
    
<br>
    
    
  <div class="rnd-card-4" style="width:70%">
    <header class="rnd-container rnd-light-grey">
      <h3>Sha Doe</h3>
    </header>
    <div class="rnd-container">
      <p>1 new friend request</p>
      <hr>
      <img src="<?php echo MEDIA_URL;?>/gallery/customer-care.jpg" alt="Avatar" class="rnd-left rnd-circle rnd-margin-right" style="width:60px">
      <p>CEO at Lotus Company of Marketing and Advertising. Seeking a new job and new opportunities.</p><br>
    </div>
    <button class="rnd-button rnd-block rnd-dark-grey">+ Connect</button>
  </div>    
    
</div>

<hr>
