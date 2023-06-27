<html>
<head>
  <style>
    body{
      background-image: url("sucessbg.jpg");
      background-repeat: no-repeat;
      background-size: cover;
    }
    body{
      text-align: center;
    
      font-size:50px;
      font-family:Franklin Gothic Medium;
      font-weight:bold;
      text-transform:uppercase;
      padding:20%;
      border: soild 15px #e74c3c;
    }
    
  </style>
</head>
<?php

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email  = $_POST['email'];
$uname = $_POST['uname'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];




if (!empty($fname) || !empty($lname) || !empty($email) || !empty($uname) || !empty($pass) || !empty($cpass) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "chatbot";



// Create connection
$conn = new mysqli ($host, $dbname, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From register2 Where email = ? Limit 1";
  $INSERT = "INSERT Into register2 (fname , lname ,email , uname, pass, cpass )values(?,?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssss", $fname,$lname,$email,$uname,$pass,$cpass);
      $stmt->execute();
      echo "Accounts Registered Successfully!"."<a href='htmlpage.html'>Click Here To Login</a>";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>