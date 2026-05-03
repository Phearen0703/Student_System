<?php
include_once dirname(__FILE__, 3) . "/config.php";
if(isset($_POST['submit'])){
    $enrollment_id = $_POST['enrollment'];
    $mid_term = $_POST['mid_term'];
    $final = $_POST['final'];

    $sql = "INSERT INTO grades (enrollment_id, mid_term, final) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iii", $enrollment_id, $mid_term, $final);
    if(mysqli_stmt_execute($stmt)){
        header("Location: ../index.php?msg=Grades added successfully");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../create.php");
    exit();
}




?>