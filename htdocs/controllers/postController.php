<?php
include "../models/post.php";

/**
 *
 */
class PostController
{

  function handlePost()
  {
    session_start();

    if(empty($_POST["PostTitle"]) || empty($_POST["PostDescription"])){
      //replace this with return error
      exit("Please include a title or description");


    } else {
      require_once("../models/post.php");
      $NewPost = new Post(
        $_SESSION["id"],
        $_SESSION["username"],
        $_POST["PostTitle"],
        $_POST["PostDescription"],
        $_FILES["Image"]["name"],
        null,
        //$_POST["subscription"],
        null
        //$_POST["Hashtags"]
      );

      return $NewPost;
  }
}

  function handleDelete()
  {

  }

  function getPosts()
  {

  }

  function getPost()
  {

  }
}


 ?>
