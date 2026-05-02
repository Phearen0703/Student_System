<?php
include"../../config.php";

if(isset($_POST['submit'])){
    $classes_name = $_POST['name'];
    $schedule = $_POST['schedule'];
    $room = $_POST['room'];
    $lecturer_id = $_POST['lecturer'];
    $course_id = $_POST['course'];
    $id = $_POST['id'];

    $sql = "UPDATE classes SET class_name='$classes_name', schedule='$schedule', room='$room', lecturer_id='$lecturer_id', course_id='$course_id' WHERE id=$id";
    if(mysqli_query($conn, $sql)){
        header("Location: ../index.php?msg=Classes updated successfully");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../index.php");
    exit();
}




?>