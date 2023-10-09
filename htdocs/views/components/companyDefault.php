<?php


?>
<div id="profile-nav">
  <div class="nav-banner">
    <img src="../public/images/Profile-Icon-1.svg" alt="profile-icon">
    <h1><?php echo $bus_instance->businessName; ?></h1>


  </div>
  <ul>
    <li><a href="#">Profile Details</a></li>
    <li><a href="#">Company Details</a></li>
    <li><a href="#">About me</a></li>
    <li><a href="#">Billing info</a></li>
    <li><a href="#">Privacy</a></li>
    <li><a href="#">Security</a></li>
  </ul>
</div>
<div id="main-content">
  <div class="banner">
    <h1>Company</h1>
  </div>
  <div id="cards">

    <div class="security card">
      <h1>Ooops No company</h1>
      <div class="table">
      <p>It appears you havent signed up with a Company.<br> Please ask your administration to add you as an employee, or if you are not currently with a company create your own company <a href="../views/createCompany.php">here</a></p>
      </div>
    </div>
    </div>
</div>
</div>
