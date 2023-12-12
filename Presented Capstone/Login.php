<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    body{
      background-position:center;
      background-image:url(./Images/SiteBackground.png);
      background-attachment: fixed;
      background-size:cover;
    }
    form {
      border: 3px solid #f1f1f1;
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
        margin:auto;
        text-align: center;
    }
    .header{
        text-align:center;
        margin-top:15vh;
        color:white
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
    <img src="/Images/LogoTp.png">
</div>
<br>
<div>
<div class="header">
    <h2>Login</h2>
</div>
  <div class="container">
    <form action="ptest.php" method="post">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
        <button type="submit">Login</button>
    </form>
    <?php
      session_start();
      if (isset($_SESSION['invalid'])){
        echo '<i>Invalid Password</i>';
      }
      if (isset($_SESSION['noUser'])){
        echo '<i>User not found</i>';
      }
    ?>
    <br>
    <span>Don't have an account: </span><a href="create.php">Create an Account</a>
  </div>
</div>
</body>
</html>
