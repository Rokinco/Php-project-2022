<?php
/**
 *
 */
class Business
{
  /* Fields */
  private $businessID;
  public $businessName;
  public $businessDescription;
  public $businessLogo;


  public $EMPLOYEES = array();
  public $ROLES = array();

  /* Methods */
  function __construct()
  {
    //check if company exists
    $res = $this->checkCompanyExists();
    $this->businessID = $res["BusinessID"];
    if ($this->businessID != 0)
    {
      //set obj fields
      $bus_res = $this->loadBusiness();
      $this->businessName = $bus_res["BusinessName"];
      $this->businessDescription = $bus_res["BusinessDescription"];
      $this->businessLogo = $bus_res["CompanyLogo"];
      //fetch users and permissions from db
      $emp_res = $this->getEmployees();
      $this->EMPLOYEES = $emp_res;
      $role_res = $this->getRoles();
      $this->ROLES = $role_res;
    } else
    {
      //return no company default
      echo "no company";
    }


  }

  function checkCompanyExists()
  {
    require_once("../controllers/dbHandling.php");
    $db_instance = new DatabaseHandler();

    $cur_user = $_SESSION['id'];
    $db_query = "SELECT BusinessID FROM useraccount WHERE UserID = '{$cur_user}';";

    $db_res = $db_instance->indirectQuery($db_query);
    $db_res = mysqli_fetch_array($db_res, MYSQLI_ASSOC);

    return $db_res;
  }


  function createBusiness($companyName, $businessDescription, $logoUrl, $usrID)
  {
    //get params
    $cur_user = $usrID;
    $companyID = substr($companyName, 0,3 ) . random_int(100,999);
    //$logoUrl = "../public/images/logos/" . $logoUrl;
    $adminID = "ADMIN" . random_int(100,999);
    $buyerID = "BUYER" . random_int(100,999);
    $sellerID = "SELLER" . random_int(100,999);
    //insert new business into db,
    require_once("../controllers/dbHandling.php");
    $db_instance = new DatabaseHandler();


    //create new business, update user table, update roles, set user to admin
    $bus_sql = "
    INSERT INTO business (BusinessID, BusinessName, BusinessDescription, CompanyLogo) VALUES
    ('{$companyID}', '{$companyName}', '{$businessDescription}', '{$logoUrl}');
    "
    .
    "
    UPDATE useraccount SET BusinessID = '{$companyID}' WHERE UserID = '{$cur_user}' ;
    "
    .
    "
    INSERT INTO rolepermission (BusinessID, CanDelete, CanUpdate, CanView, RoleID, RoleName)
    VALUES ('{$companyID}', 1, 1, 1, '{$adminID}', 'Admin');
    "
    .
    "
    INSERT INTO rolepermission (BusinessID, CanDelete, CanUpdate, CanView, RoleID, RoleName)
    VALUES ('{$companyID}', 0, 0, 1, '{$buyerID}', 'Buyer');
    "
    .
    "
    INSERT INTO rolepermission (BusinessID, CanDelete, CanUpdate, CanView, RoleID, RoleName)
    VALUES ('{$companyID}', 1, 1, 1, '{$sellerID}', 'Seller');
    "
    .
    "
    UPDATE userpermission SET RoleID = '{$adminID}' WHERE UserID = '{$cur_user}';
    "
    ;

    $db_instance->multiquery($bus_sql);
    //but buyer and seller and admin as default permissions

  }

  function loadBusiness(){
    require_once("../controllers/dbHandling.php");
    $db_instance = new DatabaseHandler();

    $cur_user = $_SESSION['id'];
    //$db_query = "SELECT BusinessName, BusinessDescription, CompanyLogo FROM business WHERE BusinessID = '{$this->businessID}';";
    $db_query = "SELECT * FROM business WHERE BusinessID = '{$this->businessID}';";

    $db_res = $db_instance->indirectQuery($db_query);
    $db_res = mysqli_fetch_array($db_res, MYSQLI_ASSOC);

    return $db_res;
  }

  function updateBusiness($newName, $newDes, $newLogo, $id)
  {
    require_once("../controllers/dbHandling.php");
    $db_instance = new DatabaseHandler();

    $this->businessName = $newName;
    $this->businessDescription = $newDes;
    $this->comapnyLogo = $newLogo;
    $BID = $this->businessID;
    $sql = "UPDATE business
    SET BusinessName = '{$this->businessName}', BusinessDescription = '{$this->businessDescription}', CompanyLogo ='{$this->companyLogo}'
    WHERE BusinessID = '{$this->businessID}';";

    $db_instance->indirectQuery($sql);
  }

  function getEmployees()
  {
    require_once("../controllers/dbHandling.php");
    $db_instance = new DatabaseHandler();

    $sql = "SELECT useraccount.UserName, rolepermission.RoleName, rolepermission.CanView, rolepermission.CanUpdate, rolepermission.CanDelete
    FROM business
    INNER JOIN rolepermission ON rolepermission.BusinessID = business.businessID
    INNER JOIN userpermission ON userpermission.RoleID = rolepermission.RoleID
    INNER JOIN useraccount ON useraccount.UserID = userpermission.UserID
    WHERE business.BusinessID = '{$this->businessID}'
    ORDER BY rolepermission.RoleName ASC;";

    $db_res = $db_instance->indirectQuery($sql);
    $db_res = mysqli_fetch_all($db_res, MYSQLI_ASSOC);
    //mysqli_num_rows($db_res);

    return $db_res;
  }

  function getRoles()
  {
    require_once("../controllers/dbHandling.php");
    $db_instance = new DatabaseHandler();

    $sql = "SELECT rolepermission.RoleID, rolepermission.RoleName, rolepermission.CanView, rolepermission.CanUpdate, rolepermission.CanDelete
    FROM business
    INNER JOIN rolepermission ON rolepermission.BusinessID = business.businessID
    WHERE rolepermission.BusinessID = '{$this->businessID}'
    ORDER BY rolepermission.RoleName ASC;";

    $db_res = $db_instance->indirectQuery($sql);
    $db_res = mysqli_fetch_all($db_res, MYSQLI_ASSOC);
    //mysqli_num_rows($db_res);

    return $db_res;
  }

  function addNewEmployee($newuser, $roleID)
  {
    require_once("../controllers/dbHandling.php");
    $db_instance = new DatabaseHandler();

    $sql = "UPDATE useraccount SET BusinessID = '{$this->businessID}' WHERE UserName = '{$newuser}';";
    $db_res = $db_instance->indirectQuery($sql);
    if(!$db_res){
      exit("Userdoes not exist");
    } else {
      $perm_sql = "UPDATE userpermission SET RoleID = '{$roleID}'
      WHERE UserID = ( SELECT UserID FROM useraccount WHERE UserName = '{$newuser}' ); ";
      $db_instance->indirectQuery($perm_sql);
    }
  }

  function removeEmployee($username)
  {
    echo "hi";
  }


}



?>
