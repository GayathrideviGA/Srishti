<?php
$username = $_POST['username'];
$college = $_POST['college'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dept = $_POST['dept'];
$event = $_POST['event'];
if (!empty($username) || !empty($college) || !empty($email) ||
!empty($phone) || !empty($dept) || !empty($event)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "nsit";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register (username, college, email,phone,dept,event) values(?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssiss", $username, $college, $email, $phone, $dept, $event);
      $stmt->execute();
      echo "sucessfully registered";
     } else {
      echo "already register";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>