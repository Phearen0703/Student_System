<?php
include"../../config.php";
if(isset($_POST['submit'])){
    $couse_name = $_POST['name'];
    $credit = $_POST['credit'];
    $department_id = $_POST['department'];
    $cours_code = "C" . rand(100, 999);

    $sql = "INSERT INTO courses (course_name, department_id, course_code, credit) VALUES ('$couse_name', '$department_id', '$cours_code', '$credit')";
    if(mysqli_query($conn, $sql)){
        header("Location: ../index.php?msg=Course created successfully");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../index.php");
    exit();
}




?>