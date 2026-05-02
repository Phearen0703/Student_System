<?php
include_once dirname(__FILE__, 3) . "/config.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    // Get the lecturer record to find the image file
    $query = "SELECT img FROM lecturers WHERE id = ?";
    if($stmt = mysqli_prepare($conn, $query)){
        mysqli_stmt_bind_param($stmt, "i", $id);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) > 0){
                $lecturer = mysqli_fetch_assoc($result);
                $image_to_delete = $lecturer['img'];
            } else {
                echo "Lecturer not found.";
                exit();
            }
        } else {
            echo "Error: " . mysqli_error($conn);
            exit();
        }
        mysqli_stmt_close($stmt);
} else {
        echo "Error: " . mysqli_error($conn);
        exit();
    }


    // Delete the lecturer record
    $delete_query = "DELETE FROM lecturers WHERE id = ?";
    if($delete_stmt = mysqli_prepare($conn, $delete_query)){
        mysqli_stmt_bind_param($delete_stmt, "i", $id);
        if(mysqli_stmt_execute($delete_stmt)){
            // If there was an image, delete it from the server
            if(!empty($image_to_delete)){
                $image_path = dirname(__FILE__, 3)."/Assets/img/photos/" . $image_to_delete;
                if(file_exists($image_path)){
                    unlink($image_path);
                }
            }
            header("Location: ../index.php?msg=Lecturer deleted successfully");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($delete_stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

}

?>