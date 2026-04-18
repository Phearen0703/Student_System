<?php
include_once dirname(__FILE__, 3) . "/config.php";
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: ../index.php");
    exit();
}
$sql = "DELETE FROM departments WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
if (mysqli_stmt_execute($stmt)) {
    header("Location: ../index.php?msg=Department deleted successfully");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}


?>