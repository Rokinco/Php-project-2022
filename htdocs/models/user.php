<?php
/* Class Definition: Users */

class User
{
  /* Fields */
  private $_UserID;
  public $username;
  public $_firstName;
  public $_lastName;
  public $email;
  public $accountDescription;

  /* meta props */
  private $_accountCreationDate;
  private $_userPermissions;
  private $_business;

  /* Methods */
  function __construct($id)
  {
    require_once("../controllers/dbHandling.php");
    $db_instance = new DatabaseHandler();
    $user_res = $db_instance->getUser($id);
  //$user_info = mysqli_fetch_all($user_res, MYSQLI_ASSOC);
    $user_info = $user_res->fetch_assoc();
    /* Account creation form */
    $this->_UserID = $id;
    $this->username = $user_info["UserName"];
    $this->_firstName = $user_info["FirstName"];
    $this->_lastName = $user_info["FamilyName"];
    $this->email = $user_info["Email"];
    /* default properties */
    $this->_accountCreationDate = date("Y-m-d H-m-s");

    /* subclass init */
    //$this->_business = new Business();
    //$this->_userPermissions = new UserPermissions($this->_UserID);

  }
  function createUser($passHash)
  {
    /* check database for username and email in it*/
    /*require_once("../controllers/dbHandling.php");
    $db_instance = new DatabaseHandler();
    $this->generateUserID($username);
    $db_instance->commitAccount($passHash);*/
  }

  static function updateUser($id, $username, $firstname, $lastname, $email)
  {
    require_once("../controllers/dbHandling.php");
    $db_instance = new DatabaseHandler();

    $sql = "UPDATE useraccount
    SET Username = '{$username}',
    FirstName = '{$firstname}',
    FamilyName = '{$lastname}',
    Email = '{$email}'
    WHERE UserID = '{$id}';
    ";

    $db_instance->indirectQuery($sql);

  }

  function deleteUser()
  {

  }
  private function createUserCookies()
  {

  }

  public function getUserCookies()
  {

  }

  protected function generateUserID($tmp_username)
  {
    /*$sql_query = "SELECT * FROM useraccount WHERE UserID = '{$id}';";
    //$sql_res = self::$db_con->query($sql_query);
    $sql_res = $this->indirectQuery($sql_query);
    return $sql_res;*/
  }

  function get_date(){
    return $this->_accountCreationDate;
  }



}

/* script testing */
/*$instance = new User("Rokinco", "Rohan", "Kinraid", "Rokinco@gmail.com");
echo $instance->username;
echo $instance->get_date();*/



 ?>
