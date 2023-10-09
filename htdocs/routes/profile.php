<?php
include("../models/business.php");
session_start();

if(!isset($_SESSION["loggedin"])){
  header("location: ../routes/signup.php");
}

include("../views/profileView.php");
$bus_instance =  unserialize($_SESSION["business"]);
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Agora</title>
      <link href="../public/css/profile.css" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
  </head>

  <body>
    <!-- fetch header component -->
    <?php require("../public/components/header.php"); ?>
    <style><?php include('../public/css/header.css');?></style>

  <main>
    <div id="profile-nav">
      <div class="nav-banner">
        <img src="../public/images/Profile-Icon-1.svg" alt="profile-icon">
        <h1><?php echo $_SESSION["username"]; ?></h1>


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
        <h1>Profile</h1>
      </div>
      <div id="cards">
        <div class="myprofile card">
          <h1 class="card-title">Profile</h1>
          <div class="table">
          <?php
          foreach($profile_res as $profile_item){
            echo"
            <div class='row'>
            <p class ='row-start'>{$profile_item["UserName"]}</p>
            <div class='row-end'>
              <a href='../views/updateProfile.php'>Edit</a>
              <a href='#'>Delete</a>
            </div>
            </div>";
            echo"
            <div class='row'>
            <p class ='row-start'>{$profile_item["FirstName"]}</p>
            <div class='row-end'>
              <a href='../views/updateProfile.php'>Edit</a>
              <a href='#'>Delete</a>
              </div>
            </div>";
            echo"
            <div class='row'>
            <p class='row-start'>{$profile_item["FamilyName"]}</p>
            <div class='row-end'>
              <a href='../views/updateProfile.php'>Edit</a>
              <a href='#'>Delete</a>
              </div>
            </div>";
            echo"
            <div class='row'>
            <p class ='row-start'>{$profile_item["Email"]}</p>
            <div class='row-end'>
              <a href='../views/updateProfile.php'>Edit</a>
              <a href='#'>Delete</a>
            </div>
            </div>";
          }
            ?>
          </div>
        </div>

        <div class="mycompany card">
          <h1 class="card-title">My Company</h1>
          <div class="table">
          <?php foreach($company_res as $company_item){
            echo"
            <div class='row'>
            <p class ='row-start'>{$company_item["BusinessName"]}</p>
            <div class='row-end'>
              <a href='../views/updateCompany.php'>Edit</a>
              <a href='#'>Delete</a>
            </div>
            </div>";
            echo"
            <div class='row'>
            <p class ='row-start'>{$company_item["BusinessDescription"]}</p>
            <div class='row-end'>
              <a href='../views/updateCompany.php'>Edit</a>
              <a href='#'>Delete</a>
              </div>
            </div>";
          }
            ?>
          </div>
          <!--<div class="table">
          <h2 class="card-title">My Role</h2>
          <div class='row'>
          <p class ='row-start'>
            <?php
            //var_dump($bus_instance->ROLES);
            foreach($bus_instance->ROLES as $role){
              if ($role["UserID"] == $_SESSION["id"]){
                echo $role["RoleName"];
              }
            }
            ?>
          </p>
          <div class='row-end'>
            <a href='#'>Edit</a>
            <a href='#'>Delete</a>
            </div>
          </div>
        </div>-->
        </div>
        <div class="billing card">
          <h1>Billing</h1>
          <div class="table">
          <div class='row'>
          <p class ='row-start'>4835 5421 6424 9043</p>
          <div class='row-end'>
            <a href='#'>Edit</a>
            <a href='#'>Delete</a>
          </div>
          </div>
          <div class='row'>
          <p class ='row-start'>E Jenkins</p>
          <div class='row-end'>
            <a href='#'>Edit</a>
            <a href='#'>Delete</a>
            </div>
          </div>
          <div class='row'>
          <p class ='row-start'>03/25</p>
          <div class='row-end'>
            <a href='#'>Edit</a>
            <a href='#'>Delete</a>
            </div>
          </div>
          <div class='row'>
          <p class ='row-start'>738</p>
          <div class='row-end'>
            <a href='#'>Edit</a>
            <a href='#'>Delete</a>
            </div>
          </div>
        </div>
        </div>

        <div class="security card">
          <h1>Security</h1>
          <div class="table">
          <div class='row'>
          <p class ='row-start'>First dog: jeff</p>
          <div class='row-end'>
            <a href='#'>Edit</a>
            <a href='#'>Delete</a>
          </div>
          </div>
          <div class='row'>
          <p class ='row-start'>First School: cawley high</p>
          <div class='row-end'>
            <a href='#'>Edit</a>
            <a href='#'>Delete</a>
            </div>
          </div>
        </div>
        </div>
    </div>
    </div>

  </main>
  <script>
      var subnav = document.getElementById("subnav");
      var hamburger = document.getElementById("hamburger");

      hamburger.addEventListener("click", ()=>{
          subnav.classList.toggle("active");
      });
  </script>
  </body>
</html>
