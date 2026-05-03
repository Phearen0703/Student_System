<?php
include_once dirname(__FILE__, 3) . "/config.php";
if($_GET['id']){
    $id = $_GET['id'];
    $sql = "DELETE FROM grades WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if(mysqli_stmt_execute($stmt)){
        header("Location: ../index.php?msg=Grade deleted successfully");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../index.php?msg=Invalid Grade ID");
    exit();
}


?>