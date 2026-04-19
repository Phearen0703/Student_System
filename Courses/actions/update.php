
<?php
include_once dirname(__FILE__, 3) . "/config.php";

if(isset($_POST['submit'])){
    $id = (int)$_POST['id'];
    $name = (string)$_POST['name'];
    $department = (int)$_POST['department'];
    $credit = (int)$_POST['credit'];

    $sql = "UPDATE courses SET course_name = ?, department_id = ?, credit = ? WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){

        mysqli_stmt_bind_param($stmt, "siii", $name, $department, $credit, $id);
        
        if(mysqli_stmt_execute($stmt)){
            header("Location: ../index.php?msg=Course updated successfully");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}
?>