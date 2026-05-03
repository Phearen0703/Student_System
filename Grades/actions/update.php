<?php
include_once dirname(__FILE__, 3) . "/config.php";
if(isset($_POST['submit'])) {
    $enrollment_id = $_POST['enrollment'];
    $mid_term = $_POST['mid_term'];
    $final = $_POST['final'];
    $id = $_POST['id'];

    $sql = "UPDATE grades SET enrollment_id = ?, mid_term = ?, final = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiii", $enrollment_id, $mid_term, $final, $id);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../index.php?msg=Grades updated successfully");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../create.php");
    exit();
}


?>