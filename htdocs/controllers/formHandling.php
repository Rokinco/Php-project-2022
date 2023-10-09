<?php
/* Class definition: FormHandler */


class FormHandler
{
  static function accountCreation(/*$password*/)
  {

    //double check required fields are filled
    if (!isset($_POST["username"], $_POST["firstname"], $_POST["lastname"],$_POST["password"])){
      header("location: ../routes/signup.php");
      echo "Please fill in all of the fields";
    }

    //check username in DB
    include_once("dbHandling.php");
    $DB = new DatabaseHandler();

    //check email in db


    //Sanitise user input
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];

    //commit to databse
    $res = $DB->commitAccount($username, $password, $email, $firstname, $lastname, $dob, $gender);

    if ($res === true) {
    header("location: ../routes/login.php");
   }
  }

  function login()
  {
    if (isset($_POST["username"], $_POST["password"])){
      require_once("authController.php");
      $auth_instance = new AuthController();
      $auth_instance->handleLogin($_POST["username"], $_POST["password"]);
    }
  }

  function postCreation()
  {
    //validate from postcontroller and return post obj
    require_once("postController.php");
    $post_instance = new PostController();
    $post_res = $post_instance->handlePost();

    //move image to dir
    if (isset($_FILES['Image'])) {
      $imgname = $_FILES["Image"]["name"];
      $type = $_FILES["Image"]["type"];
      $tmpimage = $_FILES["Image"]["tmp_name"];
      $uploadPath = "../public/images/posts/" . $imgname;

      move_uploaded_file($tmpimage, $uploadPath);
    }
    //commit post to database
    require_once("dbHandling.php");
    $DB = new DatabaseHandler();
    $res = $DB->commitPost($post_res);

    //update view
    //I dont know how else to force re-render
    if ($res === true ){
      header("location: ../routes/home.php");
    }

  }

  function businessCreation()
  {
    require_once("../models/auth.php");
    $auth = new Authenticator();

    require_once("../models/business.php");
    $inst = new Business();
    $logoName = preg_replace('/\s+/', '_', $_FILES["compLogo"]["name"]);
    $res = $inst->createBusiness($_POST["compName"], $_POST["compDes"], $logoName, $_SESSION["id"]);

    if(isset($_FILES["compLogo"])){
      $tmpimage = $_FILES["compLogo"]["tmp_name"];
      $uploadPath = "../public/images/logos/" . $logoName;

      move_uploaded_file($tmpimage, $uploadPath);
    }


    $auth->newSession($_SESSION["username"], $_SESSION["id"]);
    header("location: ../routes/company.php");

  }

  function updateBusiness() {
    require_once("../models/auth.php");
    $auth = new Authenticator();

    require_once("../models/business.php");
    $inst = new Business();
    $inst->updateBusiness($_POST["compName"], $_POST["compDes"], $_POST["compLogo"], $_SESSION["id"]);
    $auth->newSession($_SESSION["username"], $_SESSION["id"]);
    header("location: ../routes/company.php");
  }

  function addEmployee() {
    require_once("../models/auth.php");
    $auth = new Authenticator();

    require_once("../models/business.php");
    $inst = new Business();
    $inst->addNewEmployee($_POST["NewUser"], $_POST["roleOption"]);
    $auth->newSession($_SESSION["username"], $_SESSION["id"]);
    header("location: ../routes/company.php");
  }

  function updateProfile(){
    require_once("../models/auth.php");
    $auth = new Authenticator();

    require_once("../models/user.php");
    User::updateUser($_SESSION['id'], $_POST["username"], $_POST["firstName"], $_POST["lastName"], $_POST["email"]);
    $auth->newSession($_SESSION["username"], $_SESSION["id"]);
    header("location: ../routes/profile.php");

  }

}

/* Script */
if(isset($_POST["button"])){
  $FormHandle = new FormHandler();


  if($_POST["button"] == "compCreate"){
    $FormHandle->businessCreation();
  }

  if($_POST["button"] == "update-company"){
    $FormHandle->updateBusiness();
  }

  if($_POST["button"] == "add-employee"){
    $FormHandle->addEmployee();
  }
  if($_POST["button"] == "update-profile"){
    $FormHandle->updateProfile();
  }

  if($_POST["button"] == "post-create"){
    $FormHandle->postCreation();
  }
}

 ?>
