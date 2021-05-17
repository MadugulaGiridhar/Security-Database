<?php 
$username = "gxm0833"; 
$password = "User@123"; 
$database = "gxm0833"; 
$mysqli = new mysqli("acadmysqldb001p.uta.edu", $username, $password, $database); 

if (isset($_POST['userRoleClick'])) {


    // $query = "SELECT Role_Name, Description FROM user_roles";
    $query = "SELECT * from user_roles";


echo '<table border="1" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">Role_Name</font> </td> 
          <td> <font face="Arial">Description</font> </td> 
          
      </tr>';

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["Role_Name"];
        $field2name = $row["Description"];
       

        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  
              </tr>';
    }
    $result->free();
}

}

else if (isset($_POST['useraccountClick'])) {


    // $query = "SELECT Role_Name, Description FROM user_roles";
    $query = "SELECT * from USER_ACCOUNTS";


echo '<table border="1" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">User_IDNO</font> </td> 
          <td> <font face="Arial">Name</font> </td> 
          <td> <font face="Arial">Phone</font> </td> 
          <td> <font face="Arial">Role_Name</font> </td>                     
      </tr>';

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["User_IDNO"];
        $field2name = $row["Name"];
        $field3name = $row["Phone"];
        $field4name = $row["Role_Name"];
       

        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
                  <td>'.$field4name.'</td> 
                  
              </tr>';
    }
    $result->free();
}

}

else if (isset($_POST['privilegeClick'])) {


    // $query = "SELECT Role_Name, Description FROM user_roles";
    $query = "SELECT * from PRIVILEGES";


echo '<table border="1" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">Select_Privileges</font> </td> 
          <td> <font face="Arial">Update_Privileges</font> </td> 
          <td> <font face="Arial">Create_Privileges</font> </td> 
          <td> <font face="Arial">Delete_Privileges</font> </td>                     
          <td> <font face="Arial">User_IDNO</font> </td>                     
          <td> <font face="Arial">Role_Name</font> </td>                     
      </tr>';

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {

        $field1name = $row["SELECT_PRIVILEGES"];
        $field2name = $row["UPDATE_PRIVILEGES"];
        $field3name = $row["CREATE_PRIVILEGES"];
        $field4name = $row["DELETE_PRIVILEGES"];
        $field5name = $row["User_IDNO"];
        $field6name = $row["Role_Name"];
       

        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
                  <td>'.$field4name.'</td> 
                  <td>'.$field5name.'</td> 
                  <td>'.$field6name.'</td> 
                  
              </tr>';
    }
    $result->free();
}

}
 

else if (isset($_POST['tablesClick'])) {


    // $query = "SELECT Role_Name, Description FROM user_roles";
    $query = "SELECT * from TABLES";


echo '<table border="1" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">TableName</font> </td>                               
          <td> <font face="Arial">User_IDNO</font> </td>                     
          <td> <font face="Arial">Role_Name</font> </td>                     
      </tr>';

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {

        $field1name = $row["TableName"];       
        $field2name = $row["User_IDNO"];
        $field3name = $row["Role_Name"];
       

        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
                  
                  
              </tr>';
    }
    $result->free();
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
    <form name="myForm" action="" method="POST">
      <div class="rpcontainer">
       
        <button name="userRoleClick" type="submit" >USER_ROLES TABLE</button><br>
        <button name="useraccountClick" type="submit" >USER_ACCOUNTS TABLE</button><br>
        <button name="privilegeClick" type="submit" >PRIVILEGE TABLE</button><br>
        <button name="tablesClick" type="submit" >TABLES TABLE</button><br>
      </div>
    </form>
  </div>
  
  </body>
  </html>
