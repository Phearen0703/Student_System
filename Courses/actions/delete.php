<?php
include_once dirname(__FILE__, 3) . "/config.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $delete_query = "DELETE FROM courses WHERE id = ?";
    if($delete_stmt = mysqli_prepare($conn, $delete_query)){
        mysqli_stmt_bind_param($delete_stmt, "i", $id);
        if(mysqli_stmt_execute($delete_stmt)){
            header("Location: ../index.php?msg=Course deleted successfully");
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
