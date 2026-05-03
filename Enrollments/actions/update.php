<?php
include_once dirname(__FILE__, 3) . "/config.php";
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $student_id = $_POST['student'];
    $class_id = $_POST['classes'];
    $status = $_POST['status'];

    $sql = "UPDATE enrollments SET student_id = ?, class_id = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiii", $student_id, $class_id, $status, $id);
    if(mysqli_stmt_execute($stmt)){
        header("Location: ../index.php?msg=Enrollment updated successfully");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../index.php");
    exit();
}



?>