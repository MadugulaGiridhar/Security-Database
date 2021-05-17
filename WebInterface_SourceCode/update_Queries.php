<?php
// session_start();

$ser='acadmysqldb001p.uta.edu';
$user = 'gxm0833';
$passw = "User@123";
$dbname = 'gxm0833';

// initializing variables 
$selectPrivilage = $updatePrivilage = $createPrivilage = $deletePrivilage = $userid = $rolename = "";

$userid = $username = $number = $rolename ="";
$errors = array(); 

// connect to the database
$db = mysqli_connect($ser, $user, $passw , $dbname);


if (isset($_POST['userTableClick'])) {
    // $errors = array(); 
  $userid = $_POST['userid'];
  
  
  $rolename = $_POST['rolename'];

  if (empty($userid)) { array_push($errors, "Id is required"); }
  
  if (empty($rolename)) { array_push($errors, "rolename is required"); }

  $user_role_check = "SELECT * FROM USER_ROLES WHERE ROLE_NAME='$rolename'";
  $result = mysqli_query($db, $user_role_check);
  $user = mysqli_fetch_assoc($result);

  if($user == null)
  {
    array_push($errors, "Role does not exist, Please select valid role");
  }

  $user_id_check = "SELECT * FROM USER_ACCOUNTS WHERE USER_IDNO='$userid'";
  $result1 = mysqli_query($db, $user_id_check);
  $user1 = mysqli_fetch_assoc($result1);

  if($user1==null)
  {
    array_push($errors, "User id doesnot already exist");
  }



  if (count($errors) == 0) {
  
    
      $query = "INSERT INTO `user_accounts` (`USER_IDNO`, `NAME`, `PHONE`, `ROLE_NAME`) VALUES ( '$userid','$username', '$number', '$rolename');";
      $query = "UPDATE `user_accounts` SET `Role_Name`='$rolename' WHERE User_IDNO='$userid';";
      
    //   mysqli_query($db, $query);
    $result = $db->query($query) or die($db->error);
    
    
      if($result)
      {
        header('location: execute.php');
      }
  }

}

else if (isset($_POST['roleTableClick'])) {
    $errors = array(); 
    
    $selectPrivilage = $_POST['selectPrivilage'];
    $updatePrivilage = $_POST['updatePrivilage'];
    $createPrivilage = $_POST['createPrivilage'];
    $deletePrivilage = $_POST['deletePrivilage'];
    
    $rolename1 = $_POST['rolename1'];
  
    
   
    
    if (empty($rolename1)) { array_push($errors, "rolename is required"); }
  
    $user_role_check = "SELECT * FROM USER_ROLES WHERE ROLE_NAME='$rolename1'";
    $result = mysqli_query($db, $user_role_check);
    $user = mysqli_fetch_assoc($result);
  
    if($user == null)
    {
      array_push($errors, "Role does not exist, Please select valid role");
    }
  

  
    if (count($errors) == 0) {
        $query = "UPDATE `privileges` SET `SELECT_PRIVILEGES`= '$selectPrivilage' ,`UPDATE_PRIVILEGES`='$updatePrivilage',`CREATE_PRIVILEGES`='$createPrivilage',`DELETE_PRIVILEGES`='$deletePrivilage' WHERE Role_Name = '$rolename1'";
      //   mysqli_query($db, $query);
        $result = $db->query($query) or die($db->error);
        if($result)
        {
          header('location: execute.php');
        }
    
    }
  }









?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="aboutus.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body >

<div class="header">
  
  <div class="topnav">
    <a href="useraccount.php" target="_blank">User_account</a>
    <a href="userrole.php" target="_blank">User_role</a>
    <a href="privilages.php" target="_blank">privilages</a>
    <a href="tables.php" target="_blank">tables</a>
    <a href="Update_Queries.php" target="_blank">Update_Queries</a>
    <a href="display.php" target="_blank">Display</a>

  </div>



  <div class="rpmaindiv">

  <!-- USER_ACCOUNT to a ROLE -->

    <form name="myForm" action="" method="POST">
      <div class="rpcontainer">
        <div>
        <?php include('errors.php'); ?></div>
              <h2>USER_ACCOUNT to a ROLE</h2>
              <label for="fname">User id:</label><br>
              <input class="rpinput-field" type="text" placeholder="User id " name="userid" value="<?php echo $userid; ?>" ><br>
              
              
              <label for="number">Enter RoleName to update :</label><br>
              <input class="rpinput-field" type="text" placeholder="Role" name="rolename" value="<?php echo $rolename; ?>"><br>

        <button name="userTableClick" type="submit" >Execute</button><br>
      </div>
    </form>



    <!-- ACCOUNT_PRIVILEGE to a ROLE -->

    <form name="myForm" action="" method="POST">
      <div class="rpcontainer">
        
        <div>
        <?php include('errors.php'); ?></div>  
        <h2>ACCOUNT_PRIVILEGE to a ROLE</h2>            
              <label for="role">Select Privileges:</label><br>
              <div class="custom-select">
                  <select name="selectPrivilage" class="rpinput-field" >
                    <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
                </div>
                <label for="role">Update Privileges:</label><br>
              <div class="custom-select">
                  <select name="updatePrivilage" class="rpinput-field" >
                    <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
                </div>
                <label for="role">Create Privileges:</label><br>
              <div class="custom-select">
                  <select name="createPrivilage" class="rpinput-field" >
                    <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
                </div>
                <label for="role">Delete Privileges:</label><br>
              <div class="custom-select">
                  <select name="deletePrivilage" class="rpinput-field" >
                    <option value="1">Yes</option>
                  <option value="0">No</option>
                  </select>
                </div>

                <label for="number">Role:</label><br>
              <input class="rpinput-field" type="text" placeholder="Role" name="rolename1" value="<?php echo $rolename; ?>"><br>
              <button name="roleTableClick" type="submit" >Execute</button><br>
      </div>
    </form>



  </div>
  
  </body>
  </html>
