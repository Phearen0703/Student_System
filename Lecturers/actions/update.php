<?php
include_once dirname(__FILE__, 3) . "/config.php";
if(isset($_POST['submit'])){
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $old_image = $_POST['old_image'];
    $department_id = $_POST['department'];
 

    // Handle file upload
    $image_name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    if(!empty($image_name) && getimagesize($temp_name)){
        $upload_dir = "../../Assets/img/photos/";
        $new_to_save = uniqid() . "_" . basename($image_name);
        $upload_path = $upload_dir . $new_to_save;
        if(move_uploaded_file($temp_name, $upload_path)){
            // Delete old image if exists
            if(!empty($old_image) && file_exists($upload_dir . $old_image)){
                unlink($upload_dir . $old_image);
            }
        } else {
            echo "Error uploading image.";
            exit();
        }
    }else{
        $new_to_save = $old_image; // Keep old image if no new image uploaded
    }


    $sql = "UPDATE lecturers SET dep_id = ?, name = ?, gender = ?, dob = ?, gmail = ?, phone = ?,  img = ? WHERE id = ?";
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "issssssi", $department_id, $name, $gender, $dob, $email, $phone, $new_to_save, $id);
        if(mysqli_stmt_execute($stmt)){
            header("Location: ../index.php?msg=Lecturers updated successfully");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }

}
