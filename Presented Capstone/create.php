<!DOCTYPE html>
<html>
<head>
  <title>User Registration</title>
  <style>
    body{
      background-position:center;
      background-image:url(./Images/SiteBackground.png);
      background-attachment: fixed;
      background-size:cover;
    }
    form {
      border: 3px solid #f1f1f1;
      text-align: center;
      width:45%;
      margin:auto;
      padding:5px;
    }
    input[type=text], input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    button {
      background-color: #5848e6;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }
    button:hover {
      opacity: 0.8;
    }
    .container{
        display:inline-block;
        color:white;
        width:100%;
        text-align:center;
    }
    .header{
        text-align:center;
        color:white;
        margin-top:15vh;
    }
    img{
        display:inline-block;
        float:left;
        height:12vh;
    }
    .toprow{
      position: absolute;
      background:black;
      top: 0; right: 0; left: 0;
      height:12vh;
      margin-bottom:1vh;
    }
  </style>
</head>
<body>
<div class="toprow">
    <img src="LogoTp.png">
</div>
<div class="header">
  <h2>User Registration</h2>
</div>
<div class="container">
  <form action="" method="post">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="pwd"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="pwd" required>

      <label for="pwdConfirm"><b>Re-Enter Password</b></label>
      <input type="password" placeholder="Re-Enter Password" name="pwdConfirm" required>

      <button type="submit" name="submit">Register</button>
  </form>
<?php
    session_start();
    include 'db.php';
    // Process the form data
    if(isset($_SESSION['confirmation'])){
        echo "<b>Passwords do not match!</b>";
    }
    if (isset($_POST['submit'])) {
        $uname = $_POST["uname"];
        $pwd = $_POST["pwd"];
        $pwdConfirm = $_POST['pwdConfirm'];

        if($pwd != $pwdConfirm){
          $_SESSION['confirmation'] = 1;
        }else{
          session_destroy();
          // Hash the password
          $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

          // Insert the user into the database
          $sql = "INSERT INTO Users (Username, Password) VALUES ('$uname', '$hashed_password')";

          if ($conn->query($sql) === TRUE) {
              echo "New record created successfully";
              header("Location: Login.php");
              exit();
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
    }

    // Close the connection
    $conn->close();
?>
</div>
</body>
</html>
