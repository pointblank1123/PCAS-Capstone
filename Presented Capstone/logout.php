<DOCTYPE html>
<html lang=en>
<head>
<meta http-equiv="Refresh" content="1; url=Login.php" />
</head>
<body>
<?php
    session_start();
    if (isset($_SESSION['username'])) {
        session_destroy();
    }
?>
</body>
</html>
