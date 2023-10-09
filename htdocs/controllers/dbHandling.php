<?php

/**
 *
 */
class DatabaseHandler
{
  protected const _SALT = "MqYgw08CS1";
  protected const _ALGO = PASSWORD_BCRYPT;
  private static $db_con;

  //Create instance of mysqli connection
  function __construct()
  {
    //localise SERVER CONSTS, attempt db connection
    require_once(__DIR__ . "../../config/config.php");
    self::$db_con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    //connection error, throw error
    if (self::$db_con->connect_error){
      exit("There was en error connecting to the database");
      $this->handleError(self::$db_con->connect_error);
    }
  }

  //inputting account sanitation into dababase
  public function inputSanitisation($username,
                                $password,
                                $email,
                                $firstname,
                                $lastname,
                                $dob = "",
                                $gender = ""
                              )
  {

  }

  public function commitAccount($username,
                                $password,
                                $email,
                                $firstname,
                                $lastname,
                                $dob = "",
                                $gender = ""
                              )
  {
    //generate passoword and user ID
    $hashedPass = $this::_hashPassword($password);
    $uuid = substr($username, 0, 4) . random_int(10,9999); //ffs Rohan please implement a better uuid generator later
    $permID = substr($username, 0, 3) . random_int(10, 9999);

    //insert query into db
    $sql_query = "INSERT INTO useraccount (UserID, Email, FamilyName, FirstName, Password_Hash, BusinessID, UserName)
    values ('{$uuid}', '{$email}', '{$lastname}', '{$firstname}', '{$hashedPass}', 0, '{$username}');"
    .
    "
    INSERT INTO userpermission (UserPermID, RoleID, UserID)
    VALUES ('{$permID}', 'BUYER', '{$uuid}');
    ";

    //$sql = mysqli_query(self::$db_con, $sql_query);
    $sql = self::$db_con->multi_query($sql_query);
    //db response
    if ($sql === TRUE) {
        echo "New record created successfully";
        return true;
      } else {
        echo "Error: " . $sql . "<br>" . self::$db_con->error;
      }

      //give user default BUYER permissions role

  }


  //hashPassword using salt and bcrypt
  protected function _hashPassword($postPass)
  {
    $saltedPass = $this::_SALT . $postPass;
    $algo = $this::_ALGO;
    $hashedPass = password_hash($saltedPass, $algo);

    //unless successful hash, throw error
    if ($hashedPass) {
      return $hashedPass;
    } else {
      throw new Exception("Error Processing Request", 1);
    }
  }

  //check users salted and hashed password
  public function CheckHash($username, $UserPass)
  {
    //apply salt to password
    $saltedPass = $this::_SALT . $UserPass;
    /* sanitise username and password??? */

    //check db for user, and return result
    if ($stmt = self::$db_con->prepare('SELECT UserID, Password_Hash FROM UserAccount WHERE UserName = ?'))
    {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0){
      $stmt->bind_result($id,$password);
      $stmt->fetch();
    }

    //return match validity
    if (password_verify($saltedPass, $password)){
      return true;
    } else {
      return false;
    }
  }
}


public function commitPost($Post_obj){
  //you can do better than that rohan
  $PostId = "post" . random_int(100,999);
  $sql_query = "INSERT INTO Post VALUES('{$PostId}',
  '{$Post_obj->PostTitle}','{$Post_obj->username}', '{$Post_obj->PostDescription}','{$Post_obj->UserID}');";


  $sql = mysqli_query(self::$db_con, $sql_query);

  $sql_query_2 = "INSERT INTO Image VALUES(DEFAULT,'../public/images/posts/{$Post_obj->imageURL}',NULL ,'{$PostId}');";
  $sql = mysqli_query(self::$db_con, $sql_query_2);

  //db response
  if ($sql === TRUE) {
      echo "New record created successfully";
      return true;
    } else {

      echo "Error: " . $sql . "<br>" . self::$db_con->error . "<br>" . $sql_query . "<br>";
    }

}

public function getUserID($username){

  if($stmt = self::$db_con->prepare('SELECT UserID FROM UserAccount WHERE UserName = ?'))
  {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0){
      $stmt->bind_result($id);
      $stmt->fetch();
      return $id;
    }
  }
}

public function getPosts()
{
  //get all posts from post ordering by date
  $sql_query = "SELECT * FROM Post INNER JOIN Image ON Post.PostID = Image.PostID ORDER BY Post.PostID DESC;";
  $sql_res = self::$db_con->query($sql_query);
  //$sql_res = mysqli_query(self::$db_con, $sql_query);
  //$row = $sql_res -> fetch_array(MYSQLI_NUM);
  $rows = [];
  while ($row = $sql_res->fetch_row()){
    $rows[] = $row;
  }
  return $rows;
  /* would like feature: order by users favourite hashtags in cookies */
  /*foreach ($row as $key => $value) {
    // code...
    echo $key ."<br><br>";
    echo $value;
  }
  return $row;*/
}

public function getFilter()
{
  //get all posts from post ordering by date
  $sql_query = "SELECT * FROM Post INNER JOIN Image ON Post.PostID = Image.PostID ORDER BY Post.PostID ASC;";
  $sql_res = self::$db_con->query($sql_query);
  //$sql_res = mysqli_query(self::$db_con, $sql_query);
  //$row = $sql_res -> fetch_array(MYSQLI_NUM);
  $rows = [];
  while ($row = $sql_res->fetch_row()){
    $rows[] = $row;
  }
  return $rows;
  /* would like feature: order by users favourite hashtags in cookies */
  /*foreach ($row as $key => $value) {
    // code...
    echo $key ."<br><br>";
    echo $value;
  }
  return $row;*/
}

public function getUser($id){
  $sql_query = "SELECT * FROM useraccount WHERE UserID = '{$id}';";
  //$sql_res = self::$db_con->query($sql_query);
  $sql_res = $this->indirectQuery($sql_query);
  return $sql_res;

}

public function multiquery($sql){
  $res = self::$db_con->multi_query($sql);
  return $res;
}

//
public function indirectQuery($sql){
  $res = $this->directQuery($sql);
  return $res;
}

protected function directQuery($query){
  $sql_res = self::$db_con->query($query);
  return $sql_res;
}

  //log error to admin, and redirect to 404 page.
  protected function handleError($error_msg){
    if($error_msg){
      header("location: ../routes/error404Page.php");
      $this->__destruct();
    }
  }

  //Close db connection on instance deletion
  function __destruct(){
    $this::$db_con->close();
  }
}


 ?>
