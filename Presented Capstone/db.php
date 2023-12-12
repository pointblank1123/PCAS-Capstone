<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
    $server = 'localhost';
    $database = 'Passwords';
    $username = 'admin';
    $password = 'PCASSql';
//$driver = '{ODBC Driver 18 for SQL Server}';

    // Create connection
    $conn = new mysqli($server, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    echo "<script>console.log('Connected successfully')</script>";
?>

</body>
</html>
