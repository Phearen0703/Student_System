<?php
$title = "Edit Enrollments";
$page = "Enrollments";
include_once dirname(__FILE__, 2) . "/Layouts/header.php";
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit();
}
$sql = "SELECT * FROM enrollments WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) > 0) {
    $enrollment = mysqli_fetch_assoc($result);
} else {
    header("Location: index.php");
    exit();
}


$getStudents = "SELECT * FROM students";
$result = mysqli_query($conn, $getStudents);
if(mysqli_num_rows($result) > 0){
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $students = [];
}

$getClass = "SELECT * FROM classes";
$GetClassResult = mysqli_query($conn, $getClass);
if(mysqli_num_rows($GetClassResult) > 0){
    $classes = mysqli_fetch_all($GetClassResult, MYSQLI_ASSOC);
} else {
    $classes = [];
}
?>

<main class="content">
    <div class="container-fluid p-0">

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6"> 
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Edit Enrollments</h5>
                        <a href="index.php" class="btn btn-sm btn-danger">
                            <i class="align-middle" data-feather="arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="actions/update.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $enrollment['id']; ?>">

                                <div class="mb-3">
                                    <label for="student" class="form-label">Student</label>
                                    <select class="form-select" id="student" name="student" required>
                                        <option value="" selected disabled>Select Student</option>
                                        <?php
                                        foreach($students as $student){
                                                $selected = ($student['id'] == $enrollment['student_id']) ? "selected" : "";
                                            echo "<option value='" . $student['id'] . "' " . $selected . ">" . $student['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>                           
                                <div class="mb-3">
                                    <label for="classes" class="form-label">Classes</label>
                                    <select class="form-select" id="classes" name="classes" required>
                                        <option value="" selected disabled>Select Class</option>
                                        <?php
                                        foreach($classes as $class){
                                            $selected = ($class['id'] == $enrollment['class_id']) ? "selected" : "";
                                            echo "<option value='" . $class['id'] . "' " . $selected . ">" . $class['class_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>                           
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="" selected disabled>Select Status</option>
                                        <option style="color:green" value="1" <?php echo ($enrollment['status'] == 1) ? "selected" : ""; ?>>Active</option>
                                        <option style="color:red" value="0" <?php echo ($enrollment['status'] == 0) ? "selected" : ""; ?>>Inactive</option>
                                    </select>
                                </div>                           
                            <hr>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">Reset</button>
                                <button type="submit" name="submit" class="btn btn-primary px-4">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<?php
include_once dirname(__FILE__, 2) . "/Layouts/footer.php";
?>