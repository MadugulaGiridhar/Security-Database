<?php
// session_start();

$ser='acadmysqldb001p.uta.edu';
$user = 'gxm0833';
$passw = "User@123";
$dbname = 'gxm0833';

// initializing variables for register
$userid = $tablename = $rolename ="";
$errors = array(); 

// connect to the database
$db = mysqli_connect($ser, $user, $passw , $dbname);

// REGISTER USER
if (isset($_POST['tableClick'])) {
  // receive all input values from the form
//   $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $tablename = $_POST['tablename'];
  $userid = $_POST['userid'];
  $rolename = $_POST['rolename'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
 
  if (empty($userid)) { array_push($errors, "Id is required"); }
  if (empty($tablename)) { array_push($errors, "tablename is required"); }
  if (empty($rolename)) { array_push($errors, "rolename is required"); }

  $table_check = "SELECT * FROM TABLES WHERE TABLENAME='$tablename'";
  $result3 = mysqli_query($db, $table_check);
  $user3 = mysqli_fetch_assoc($result3);

  if ($user3) { array_push($errors, "Table already exist"); }

  $user_role_check = "SELECT * FROM USER_ROLES WHERE ROLE_NAME='$rolename'";
  $result = mysqli_query($db, $user_role_check);
  $user = mysqli_fetch_assoc($result);

  $user_id_check = "SELECT * FROM USER_ACCOUNTS WHERE USER_IDNO='$userid'";
  $result1 = mysqli_query($db, $user_id_check);
  $user1 = mysqli_fetch_assoc($result1);

  $role_id_match = "SELECT * FROM USER_ACCOUNTS WHERE USER_IDNO='$userid' and ROLE_NAME = '$rolename'";
  $result2 = mysqli_query($db, $role_id_match);
  $user2 = mysqli_fetch_assoc($result2);

  if($user1 == null)
  {
    array_push($errors, "User id does not exist, Please select valid user id");
  }else if($user == null)
  {
    array_push($errors, "Role does not exist, Please select valid role");
  }else if($user2==false || $user2 == null)
  {
    array_push($errors, "User id does not match with role");
  }


  if (count($errors) == 0) {

  	$query = "INSERT INTO `TABLES` (`TableName`, `USER_IDNO`, `ROLE_NAME`) VALUES ( '$tablename','$userid', '$rolename');";
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
    <form name="myForm" action="tables.php" method="POST">
      <div class="rpcontainer">
        <div>
        <?php include('errors.php'); ?></div>
              <h2>User_TABLE</h2>
              <label for="lname">Table name:</label><br>
              <input class="rpinput-field" type="text" placeholder="Table name " name="tablename" value="<?php echo $tablename; ?>"><br>
              <label for="fname">User id:</label><br>
              <input class="rpinput-field" type="text" placeholder="User id " name="userid" value="<?php echo $userid; ?>" ><br>
              <label for="number">Role:</label><br>
              <input class="rpinput-field" type="text" placeholder="Role" name="rolename" value="<?php echo $rolename; ?>"><br>

        <button name="tableClick" type="submit" >Execute</button><br>
      </div>
    </form>
  </div>
  
  </body>
  </html>
