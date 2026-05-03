<?php
include"../../config.php";

if($_GET['id']){
    $id = $_GET['id'];
    $sql = "DELETE FROM classes WHERE id=$id";
    if(mysqli_query($conn, $sql)){
        header("Location: ../index.php?msg=Classes deleted successfully");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../index.php");
    exit();
}

?>