<!--<head>
  <link rel="stylesheet" href="../css/header.css">
</head>-->
<header>
    <nav>
        <div id="logo">
            <a href="../../routes/home.php">
                <h1 id="logo-h1">Agora</h1>
            </a>
            <img src="../public/images/Logo.svg" alt="AgoraLogo">
        </div>
        <div id="nav-items">
            <div id="search">
                <input type="text" name="search-input" placeholder="Search">
            </div>

            <a href="../../routes/profile.php">
                <span class="material-symbols-outlined nav_profile">
                    account_circle
                </span>
            </a>

            <div id="hamburger">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </div>
    </nav>
    <div id="subnav">
        <ul>
            <li><a href="../../routes/home.php">Home</a></li>
            <li><a href="../../routes/company.php">Company</a></li>
            <li><a href="../../routes/profile.php">Profile</a></li>
            <li><a href="../../routes/subscriptions.php">Subscriptions</a></li>
            <?php
            if (!isset($_SESSION["loggedin"])){
              echo  '<li><a href="../../routes/login.php">login</a></li>';
            } else {
            echo '<li><a href="../../views/logout.php">Logout</a>';
          }
            ?>
        </ul>
    </div>
</header>
