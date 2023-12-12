<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>My Passwords</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
      table {
          width: 100%;
          border-collapse: collapse;
      }

      table, th, td {
          border: 1px solid white;
          background-color:rgb(88 72 230 / 30%);
          padding:10px;
      }
      th{
        background-color:rgb(224 47 16 / 70%);
      }
      td{
        padding:3px;
        text-align:center;
      }
      body{
        background-position:center;
        background-image:url(./Images/SiteBackground.png);
        background-attachment: fixed;
        background-size:cover;
      }
      .dropdown {
          display: block;
          float:right;
        }

        .dropbtn{
          font-size:20px;
          background-color:rgb(88 72 230 / 70%);
          color:white;
          border:none;
          width:7vw;
          height:10vh;
        }
        .dropbtn:hover{
          background-color: #3625D4;
        }
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f9f9f9;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          right: 0;
        }

        .dropdown:hover .dropdown-content {
          display: block;
        }

        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }

        .dropdown-content a:hover {
          background-color: #f1f1f1;
        }

        .toprow{
          position: absolute;
          background:black;
          top: 0; right: 0; left: 0;
          height:10vh;
          margin-bottom:1vh;
          z-index:9999;
        }
        .vaulttable{
          margin:auto;
          margin-top:12vh;
          margin-left:5vw;
          width: 80%;
          color:white;
          float:left;
        }
        img{
          display:inline-block;
          float:left;
          height:10vh;
        }
        .img{
          display:block;
        }
        .sidebar{
          display:inline-block;
          width:12vw;
          float:right;
          color:white;
          background-color:rgb(88 72 230 / 50%);
          height:100vh;
          position:absolute;
          top:0; right:0;
        }
        .generator{
          margin-top:12vh;
          margin-left:5px;
        }
        .genForm{
          margin-left:5px;
          width:90%;
          padding:3px;
        }
        .genOut{
          margin-left:5px;
          width:80%;
        }
    </style>
    <script>
      function showHidePwd(){
        document.getElementById("")
      }
      function copytoclipboard(){
          var copy = document.getElementById("output");

          copy.select();
          copy.setSelectionRange(0, 99999);

          navigator.clipboard.writeText(copy.value);
      }
    </script>
</head>
<body>
<div class="toprow">
  <div class="img">
    <img src="/Images/LogoTp.png">

  </div>
  <?php
    session_start();
    if (isset($_SESSION['username'])) {
      $uid = $_SESSION['uid'];
      echo "<div class='dropdown'><button class='dropbtn'><i class='fas fa-user-circle'></i>  ".$_SESSION['username']."</button>";
    }else{
      header("Location: Login.php");
    }
  ?>
    <div class="dropdown-content">
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>
<br>
<table class="vaulttable">
  <tr><th>Website</th><th>Username</th><th>Password</th><th>Compromised</th><th>Delete</th></tr>
<?php
  include 'db.php';

  //$query = "SELECT * FROM passwords WHERE UID = ".$uid;
  //$result = $conn->query($query);
  $stmt = $conn->prepare("SELECT * FROM passwords WHERE UID = ?");
  $stmt->bind_param("i", $uid);

  // Set parameters and execute
  $stmt->execute();

  // Get the result
  $result = $stmt->get_result();


  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if ($row["Compromised"] == 1){
        echo "<tr><td>" . $row["Website"]. "</td><td>" . $row["Username"]. "</td><td>". $row["Password"]. "</td><td>Compromised</td><td><form action='delete.php' method='POST'><input type='hidden' name='delete' value=".$row['ID']."><button type='submit'><i class='fa-solid fa-trash-can'></i></button></form></td></tr>";
      }  elseif ($row["Compromised"]=="0"){
        echo "<tr><td>" . $row["Website"]. "</td><td>" . $row["Username"]. "</td><td>". $row["Password"]. "</td><td>Safe</td><td><form action='delete.php' method='POST'><input type='hidden' name='delete' value=".$row['ID']."><button type='submit'><i class='fa-solid fa-trash-can'></i></button></form></td></tr>";
      } else{
        echo "<tr><td>" . $row["Website"]. "</td><td>" . $row["Username"]. "</td><td>". $row["Password"]. "</td><td>Not Tested</td><td><form action='delete.php' method='POST'><input type='hidden' name='delete' value=".$row['ID']."><button type='submit'><i class='fa-solid fa-trash-can'></i></button></form></td></tr>";
      }
    }
  } else {
    echo "0 results";
  }
  $conn->close();
?>
  <tr>
    <form action='process.php' method='POST'>
        <td><label for='Website'>Website: </label>
        <input type='text' name='Website'></td>

        <td><label for='Username'>Username: </label>
        <input type='text' name='Username'></td>

        <td><label for='Password'>Password: </label>
        <input type='password' name='Password'></td>

        <td><button type="submit">Submit</button></td>
    </form>
  </tr>
</table>
<div class="sidebar">
  <h4 class="generator">Password Generator</h4>
  <form action="" method='POST'  class="genForm">
    <input name="generator" type="hidden" value="true">
    <label for="length">Length: </label><span id="rangeValue">16</span>
    <input type="range" name="length" min="8" max="30" oninput="rangeValue.innerText = this.value" value="16"><br>

    <label for="upper">Uppercase (A-Z): </label>
    <input type="checkbox" name="upper" checked><br>

    <label for="nums">Numbers (0-9): </label>
    <input type="checkbox" name="nums" checked><br>

    <label for="special">Special Chars: </label>
    <input type="checkbox" name="special" checked><br><br>

    <button type="submit">Generate</button>
  </form>
  <br>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['generator'])){
      $length = $_POST['length'];
      $upper = $_POST['upper'];
      $nums = $_POST['nums'];
      $special = $_POST['special'];

      $script = "/var/www/html/Python/Generator.py ". $length ." " . $upper. " ". $nums. " ". $special;
      $command = escapeshellcmd('/usr/bin/python3 '.$script);
      $string = shell_exec($command);

      echo "<input class='genOut' type='text' value=".$string." id='output' readonly><button onclick='copytoclipboard()'><i class='fa-solid fa-clipboard'></i></button>";
    }
  }
?>
</div>

</body>
</html>
