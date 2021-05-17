<?php
// session_start();

$ser='acadmysqldb001p.uta.edu';
$user = 'gxm0833';
$passw = "User@123";
$dbname = 'gxm0833';

// initializing variables for register
$userid = $username = $number = $rolename ="";
$errors = array(); 

// connect to the database
$db = mysqli_connect($ser, $user, $passw , $dbname);


if (isset($_POST['registerclick'])) {
  $userid = $_POST['userid'];
  $username = $_POST['username'];
  $number = $_POST['number'];
  $rolename = $_POST['rolename'];

  if (empty($userid)) { array_push($errors, "Id is required"); }
  if (empty($username)) { array_push($errors, "username is required"); }
  if (empty($number)) { array_push($errors, "Phonenumber is required"); }
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

  if($user1)
  {
    array_push($errors, "User id already exist");
  }



  if (count($errors) == 0) {
  
    
  	$query = "INSERT INTO `user_accounts` (`USER_IDNO`, `NAME`, `PHONE`, `ROLE_NAME`) VALUES ( '$userid','$username', '$number', '$rolename');";
    //   mysqli_query($db, $query);
    $result = $db->query($query) or die($db->error);
    $queryPrivilege = "INSERT INTO `privileges` (`SELECT_PRIVILEGES`, `UPDATE_PRIVILEGES`, `CREATE_PRIVILEGES`, `DELETE_PRIVILEGES`, `User_IDNO`, `Role_Name`) VALUES ('0', '0', '0', '0', '$userid', '$rolename');";
    $result1 = $db->query($queryPrivilege) or die($db->error);
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
    <form name="myForm" action="useraccount.php" method="POST">
      <div class="rpcontainer">
        <div>
        <?php include('errors.php'); ?></div>
              <h2>User_TABLE</h2>
              <label for="fname">User id:</label><br>
              <input class="rpinput-field" type="text" placeholder="User id " name="userid" value="<?php echo $userid; ?>" ><br>
              <label for="lname">User name:</label><br>
              <input class="rpinput-field" type="text" placeholder="User Name " name="username" value="<?php echo $username; ?>"><br>
              <label for="number">Telephone number:</label><br>
              <input class="rpinput-field" type="text" placeholder="+1 (xxx) xxx xxxx" name="number" value="<?php echo $number; ?>"><br>
              <label for="number">Role:</label><br>
              <input class="rpinput-field" type="text" placeholder="Role" name="rolename" value="<?php echo $rolename; ?>"><br>

        <button name="registerclick" type="submit" >Execute</button><br>
      </div>
    </form>
  </div>
  
  </body>
  </html>
