<?php
/* Necessary inforamation */

//     <form action="../controllers/formHandling.php" method="post">
session_start();
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <title>Sign Up</title>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="../public/css/login.css" rel="stylesheet">
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
   </head>
   <body>
     <?php require("../public/components/header.php"); ?>
     <style><?php include('../public/css/header.css');?></style>
     <main>
     <div id="signup-box">
     <form action="../views/accountCreation.php" method="post">
       <label for="username" required>username</label>
       <input type="text" name="username" value="" required>
       <label for="email" required> email </label>
       <input type="email" name="email" value="">
       <label for="firstname">First Name</label>
       <input type="text" name="firstname" value="" required>
       <label for="lastname">Last Name</label>
       <input type="text" name="lastname" value="" required>
       <label for="password">Password</label>
       <input type="password" name="password" value="" required >
       <!--pattern="[A-Za-z\d !@#$%^*()]"-->

       <label for="dob">Date of Birth</label>
       <input type="date" name="dob" value="">
       <label for="gender">Gender</label>
       <select class="" name="gender">
         <option value=male"">Male</option>
         <option value="female">Female</option>
       </select>

       <button type="submit" name="button">submit</button>
   </form>
 </div>
</main>
   </body>
 </html>
