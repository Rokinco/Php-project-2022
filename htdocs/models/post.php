<?php
/* Class Definition: Posts*/

class Post
{

  /* Fields */
  public $PostTitle;
  public $PostDescription;
  protected $_imageURL;
  public $imageURL;
  public $Hashtags;
  public $Subcription;

  //meta props
  private $_USERID;
  public $UserID;
  public $username;
  public $postdate;


  /* Methods */
  function __construct($UserID, $PostTitle, $username, $PostDescription, $imageURL, $Subscription, $Hashtags) {
    //$this->Subscription = new Subcription();
    $this->PostTitle = $PostTitle;
    $this->PostDescription = $PostDescription;
    $this->username = $username;
    $this->imageURL = $imageURL;
    $this->Subscription = $Subscription;
    $this->Hashtags = $Hashtags;

    $this->_USERID = $UserID;
    $this->UserID = $this->_USERID;
    $this->postdate = date("Y-m-d H:i:s");
    //$this::validate_post();
    //$this::createPost();
  }

  private function _createPost()
  {
    //set fields from post
    $this->PostTitle = $_POST["PostTitle"];
    $this->PostDescription = $_POST["PostDescription"];


  }

  private function _loadFromDB()
  {

  }

  function update_post()
  {

  }

  function delete_post()
  {
    //$this::__destruct();

  }

  function validate_post()
  {

  }

  function commit_DB()
  {

  }


  function getPost(){
    return array(
      $this.PostTitle,
      $this.PostDescription,
      $this.imageURL,
      $this.Subcription
    );
  }
}


class Subscription extends Post
{

  //throw new Exception("unimplemented error", 1);
}
/*
$NewPost = new Post(
  $PostTitle = "Fresh veg",
  $PostDescription = "This is a description for some fresh veg",
  $imageURL = "/public/images/vege-pic.png",
  $Subscription = null,
  $Hashtags = "#cool",
  $UserID = null //$_SESSION["UserID"];

);*/

//echo $NewPost->PostTitle;

 ?>
 <!--
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form method="post" action="../controllers/CreatePost.php">
      <label for="PostTitle">Title</label>
      <input type="text" name="PostTitle" value="">
      <label for="PostDescription">Description</label>
      <input type="text" name="PostDescription" value="">
      <label for="subscription">Subscription</label>
      <input type="number" name="subscription" value="">
      <label for="hashtags">Hashtags</label>
      <input type="text" name="hashtags" value="">
      <button type="submit" name="button">Submit</button>
  </form>
  </body>
</html>
-->
