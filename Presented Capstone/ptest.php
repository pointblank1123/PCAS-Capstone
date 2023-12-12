<?php
// Check if the form is submitted
session_start();
if(session_id() !== null){
    session_destroy();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the username and password from the form
    $uname = $_POST['uname'];
    $pwd = $_POST['psw'];
    echo $uname;
    echo $pwd;

    include 'db.php';

    // Prepare the SQL statement to retrieve the user's information
    $stmt = $conn->prepare("SELECT * FROM Users WHERE Username = ?");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    //$sql = "SELECT Username, Password FROM Users WHERE Username = '".$uname."'";
    //echo $sql;
    //$result = $conn->query($sql);
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        //if($pwd == $user['Password']){
        if (password_verify($pwd, $user['Password'])) {
            // Password is correct, do something (e.g., set session and redirect to dashboard)
            if(isset($_SESSION)){
                session_destroy();
            }
            session_start();
            $_SESSION['username'] = $uname;
            $_SESSION['uid'] = $user['UID'];
            header("Location: Dashboard.php");
            exit();
        } else {
            // Password is incorrect
            session_start();
            $_SESSION['invalid'] = 1;
            header("Location: Login.php");
        }
    } else {
        // User does not exist
        session_start();
        $_SESSION['noUser'] = 1;
        header("Location: Login.php");
    }

    // Close the connection
    $stmt->close();
    $conn->close();
}
?>
