<?php
include "../../config.php";
if(isset($_POST['submit'])){
    // Generate a lecturer code
    $query = "SELECT id FROM lecturers ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $last_id = $row['id'];
        $new_id = $last_id + 1;
    } else {
        $new_id = 1; // Start from 1 if no records exist
    }
    $lecturer_code = "LC" . str_pad($new_id, 4, '0', STR_PAD_LEFT);

    // Collect form data
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $department_id = $_POST['department'];

    // Handle file upload
    $image_name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    
    if(!getimagesize($temp_name)){
        $new_to_save = null; // No image uploaded
    } else {
        $upload_dir = "../../Assets/img/photos/";
        $new_to_save = uniqid() . "_" . basename($image_name);
        $upload_path = $upload_dir . $new_to_save;
        move_uploaded_file($temp_name, $upload_path);
    }
  

    $sql = "INSERT INTO lecturers (dep_id, lecturer_code, name, gender, dob, gmail, phone, img) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "isssssss", $department_id, $lecturer_code, $name, $gender, $dob, $email, $phone, $new_to_save);
        if(mysqli_stmt_execute($stmt)){
            header("Location: ../index.php?msg=Lecturer created successfully");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }else{
        echo "Error: " . mysqli_error($conn);
    }


}
?>