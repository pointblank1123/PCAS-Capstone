<DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?php
	session_start();
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	include 'db.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$website = $_POST["Website"];
		$username = $_POST["Username"];
		$password = $_POST["Password"];
		$uid = $_SESSION['uid'];
		// Hash the password before storing it in the database
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO passwords (UID, website, username, password) VALUES ('$uid','$website', '$username', '$password')";

		$conn->query($sql);
	}
	$script = "/var/www/html/Python/main.py";
	$command = escapeshellcmd('/usr/bin/python3 '.$script);
	$string = exec($command, $output);
	$conn->close();
	header("location: Dashboard.php")
?>
</body>
</html>
