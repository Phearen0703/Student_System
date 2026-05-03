<?php
include_once dirname(__FILE__, 3) . "/config.php";
if(isset($_POST['submit'])){
    $student_id = $_POST['student'];
    $class_id = $_POST['classes'];
    $status = $_POST['status'];

    $sql = "INSERT INTO enrollments (student_id, class_id, status) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iii", $student_id, $class_id, $status);
    if(mysqli_stmt_execute($stmt)){
        header("Location: ../index.php?msg=Enrollment added successfully");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../create.php");
    exit();
}


?>