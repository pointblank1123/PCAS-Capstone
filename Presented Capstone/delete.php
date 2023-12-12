<?php
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        session_start();
        $id = $_POST['delete'];
        $uid = $_SESSION['uid'];

        $sql = "DELETE FROM passwords WHERE ID = ". $id. " AND UID = ".$uid;

        if($conn->query($sql) === True){
            echo "record deleted";
            header("Location: Dashboard.php");
        } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
?>

