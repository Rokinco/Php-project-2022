<?php

session_start();

if(!isset($_SESSION['loggedin'])){
  header('Location: signup.php');
}

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agora</title>
    <link href="../public/css/home.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
</head>

<body>
  <!--fetch header component -->
  <?php require("../public/components/header.php"); ?>
  <style><?php include('../public/css/header.css');?></style>

    <main>
        <aside class="grid-col-1">
          <form class="" action="../controllers/formHandling.php" method="post">


            <h2>Filter</h2>
            <select name="filter-type" id="filter-type">
                <option class="filter_type" value="buyer">Buyer</option>
                <option class="filter_type" value="seller">Seller</option>
            </select>

            <div class="filter_location">
                <div class="filter_location-heading">
                    <span class="material-symbols-outlined">
                        pin_drop
                    </span>
                    <h4>Location</h4>
                </div>
                <div class="filter_location-search">

                </div>
            </div>

            <div class="filter_category">
                <div class="filter_subheading">
                    <span class="material-symbols-outlined">
                        category
                    </span>
                    <h4>Category</h4>
                </div>
                <div id="checkboxes">
                    <div class="checkbox">
                        <input class="checkbox_box" type="checkbox" name="option1">
                        <label for="option1">Produce</label>
                    </div>
                    <div class="checkbox">
                        <input class="checkbox_box" type="checkbox" name="option2">
                        <label for="option2">Industrial</label>
                    </div>
                    <div class="checkbox">
                        <input class="checkbox_box" type="checkbox" name="option3">
                        <label for="option3">Services</label>
                    </div>
                </div>
            </div>



            <div id="price-range">
                <div class="price-range_filter">
                    <span class="material-symbols-outlined">
                        filter_alt
                    </span>
                    <label for="price-range">Price</label>
                </div>
                <div id="pr-inputs">
                    <input type="number" placeholder="Any">
                    <input type="number" placeholder="Any">
                </div>
            </div>
            <button type="button" name="button" value="filter">Filter</button>
          </form>
        </aside>
        <div class="seperator"></div>

        <div id="centre" class="grid-col-2">
            <div id="subheader">
                <label class="subheader__title" for="hashtags">
                    <span class="material-symbols-outlined">
                        trending_up
                    </span>
                    <h3>Trending</h3>
                </label>
                <div id="hashtags">
                    <button class="hashtag">#Produce</button>
                    <button class="hashtag">#Dairy</button>
                    <button class="hashtag">#Floristry</button>
                    <button class="hashtag">#WholeGoods</button>
                </div>


            </div>
            <div id="create-post">
              <form action="../controllers/formHandling.php" method="post" enctype="multipart/form-data">
                <h3>Create Post</h3>
                <label for="PostTitle">Post Title</label>
                <input type="text" name="PostTitle" value="">
                <label for="PostDescription">Description</label>
                <input type="text" name="PostDescription" value="">
                <h4>attach image</h4>
                <input type="file" name="Image" value="" accept="image/*">
                <button type="submit" name="button" value="post-create">Post</button>

            </form>
            </div>
            <div id="feed">
              <?php include("../views/searchPosts.php");?>


            </div>
        </div>

        <div class="seperator"></div>

        <div id="right-aside" class="grid-col-3">
            <div id="discount" class="aside-box">
                <h3>New to Agora?</h3>
                <p>Subscribe to Agora premium and get 14 days free</p>
            </div>
            <!-- <div id="rando-box" class="aside-box"></div> -->
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
