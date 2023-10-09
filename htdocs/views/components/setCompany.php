<div id="profile-nav">
  <div class="nav-banner">
    <img src=
    <?php  if(file_exists("../public/images/logos/".$bus_instance->businessLogo))  {
    echo "../public/images/logos/{$bus_instance->businessLogo}";
  }
    else {  echo "../public/images/Profile-Icon-1.svg";
    }?>
     alt="profile-icon">
    <h1><?php echo $bus_instance->businessName;?></h1>


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
    <h1>Company</h1>
  </div>
  <div id="cards">
    <div class="mycompany card">
      <h1 class="card-title">Company Details</h1>
      <div class="table">

      <div class="row">
        <p>Company Name:</p>
        <p><?php echo $bus_instance->businessName;?></p>
      </div>
      <div class="row">
        <p>Company Description</p>
        <p><?php echo $bus_instance->businessDescription;?></p>
      </div>
    </div>
      <a href="../views/updateCompany.php">edit</a>
      <a href="../views/updateCompany.php">Upload Logo</a>

    </div>
    <?php if(file_exists("../public/images/logos/{$bus_instance->businessLogo}")) { echo "true"; } else { echo "false"; }
    echo "../public/images/logos/{$bus_instance->businessLogo}" ?>
    <div class="users card">
      <h1 class="card-title">Employees</h1>
      <table class="employees-tb">
        <thead>
        <tr>
          <th>Employee Name</th>
          <th>Role</th>
          <th>View</th>
          <th>Update</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $handleRemove = function($inst, $user){
          $bus_instance->removeEmployee($username);
        };

        foreach($bus_instance->EMPLOYEES as $employee){
          $username = $employee["UserName"];
          echo "
          <tr class='employee-tr'>
            <td>{$employee["UserName"]}</td>
            <td>{$employee["RoleName"]}</td>
            <td>{$employee["CanView"]}</td>
            <td>{$employee["CanUpdate"]}</td>
            <td>{$employee["CanDelete"]}</td>
            <td><a href='../../views/updateCompany.php'>Edit</a></td>
            <td><a>Remove</a></td>
          </tr>";
        }


          ?>
        </tbody>
      </table>
      <a href="../views/addEmployee.php">Add Employee</a>
    </div>

    <div class="permissions card">
      <h1>Roles</h1>
      <div class="table">
        <div class='row'>
        <p class ='row-start'>Role</p>
        <div class='row-end'>
          <p>View</p>
          <p>Update</p>
          <p>Delete</p>
          <a href='#'>Edit</a>
          <a href='#'>Delete</a>
        </div>
        </div>
      <?php
      //var_dump($bus_instance->ROLES);
      foreach($bus_instance->ROLES as $role) {
        echo "
        <div class='row'>
        <p class ='row-start'>{$role["RoleName"]}</p>
        <div class='row-end'>
          <p>{$role['CanView']} </p>
          <p>{$role['CanUpdate']} </p>
          <p>{$role['CanDelete']} </p>
          <a href='#'>Edit</a>
          <a href='#'>Delete</a>
        </div>
        </div>
        ";
      }

      ?>
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
