<?php
// session_start();

$ser='acadmysqldb001p.uta.edu';
$user = 'gxm0833';
$passw = "User@123";
$dbname = 'gxm0833';

// initializing variables for register
$rolename = $roledescription  ="";
$errors = array(); 

// connect to the database
$db = mysqli_connect($ser, $user, $passw , $dbname);



if (isset($_POST['rolePageClick'])) {


$rolename = $_POST['rolename'];
$roledescription = $_POST['roledescription'];

$user_check_query = "SELECT * FROM USER_ROLES WHERE ROLE_NAME='$rolename'";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) { // if user exists
    array_push($errors, "user role already exists");
}else{

 
  if (empty($rolename)) { array_push($errors, "Role name is required"); }
  if (empty($roledescription)) { array_push($errors, "Role description is required"); }

  if (count($errors) == 0) {


  	$query = "INSERT INTO `USER_ROLES` (`ROLE_NAME`, `DESCRIPTION`) VALUES ( '$rolename','$roledescription');";
    //   mysqli_query($db, $query);
      $result1 = $db->query($query) or die($db->error);
      if($result1)
      {
        header('location: execute.php');
      }
  
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
    <form name="myForm" action="userrole.php" method="POST">
      <div class="rpcontainer">
        <div>
        <?php include('errors.php'); ?></div>
              <h2>User_role</h2>
              <label for="number">Role name:</label><br>
              <input class="rpinput-field" type="text" placeholder="Role" name="rolename" value="<?php echo $rolename; ?>"><br>
              <label for="number">Description:</label><br>
              <input class="rpinput-field" type="text" placeholder="Role Description" name="roledescription" value="<?php echo $roledescription; ?>"><br>
              
        <button name="rolePageClick" type="submit" >Execute</button><br>
      </div>
    </form>
  </div>
  
  </body>
  </html>
