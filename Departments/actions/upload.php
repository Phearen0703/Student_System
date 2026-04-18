<?php
include "../../config.php";
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO departments (name, description) VALUES ('$name', '$description')";
    if (mysqli_query($conn, $sql)) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


?>