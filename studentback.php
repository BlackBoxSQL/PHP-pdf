<?php
$student_id = $_POST['student_id'];
$student_name = $_POST['student_name'];
$student_fname = $_POST['student_fname'];
$student_mname = $_POST['student_mname'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$class = $_POST['class'];
$roll = $_POST['roll'];
$section = $_POST['section'];
$ctname = $_POST['ctname'];
$result = $_POST['result'];
if (!empty($student_id) || !empty($student_name) || !empty($student_fname) || !empty($student_mname) || !empty($gender) || !empty($address) || !empty($mobile) || !empty($email)|| !empty($class) ||
!empty($roll) ||
!empty($section) ||
!empty($ctname) ||
!empty($result)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "info";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email FROM information WHERE email = ? LIMIT 1";
     $INSERT = "INSERT INTO information (student_id,student_name,student_fname,student_mname,gender,address,mobile,email,class,roll,section,ctname,result) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
      $stmt->bind_param("sssssssssssss", $student_id, $student_name, $student_fname, $student_mname,$gender, $address, $mobile, $email, $class, $roll, $section, $ctname, $result);
      $stmt->execute();
      echo "New record inserted sucessfully";
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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PDF||Generator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <form action="studentinfo.html" method="POST">
      <button class="btn btn-danger" type="submit"><- Go back</button>
    </form>
  </div>
</body>
</html>
