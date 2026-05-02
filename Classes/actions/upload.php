<?php
include"../../config.php";

if(isset($_POST['submit'])){
    $classes_name = $_POST['name'];
    $schedule = $_POST['schedule'];
    $room = $_POST['room'];
    $lecturer_id = $_POST['lecturer'];
    $course_id = $_POST['course'];

    $sql = "INSERT INTO classes (class_name, schedule, room, lecturer_id, course_id) VALUES ('$classes_name', '$schedule', '$room', '$lecturer_id', '$course_id')";
    if(mysqli_query($conn, $sql)){
        header("Location: ../index.php?msg=Classes created successfully");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: ../index.php");
    exit();
}



?>