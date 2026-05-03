<?php
$title = "Create Enrollments";
$page = "Enrollments";
include_once dirname(__FILE__, 2) . "/Layouts/header.php";


$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);
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
                        <h5 class="card-title mb-0">Create Enrollments</h5>
                        <a href="index.php" class="btn btn-sm btn-danger">
                            <i class="align-middle" data-feather="arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="actions/upload.php" method="POST" enctype="multipart/form-data">
                            
                                <div class="mb-3">
                                    <label for="student" class="form-label">Student</label>
                                    <select class="form-select" id="student" name="student" required>
                                        <option value="" selected disabled>Select Student</option>
                                        <?php
                                        foreach($students as $student){
                                            echo "<option value='" . $student['id'] . "'>" . $student['name'] . "</option>";
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
                                            echo "<option value='" . $class['id'] . "'>" . $class['class_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>                           
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="" selected disabled>Select Status</option>
                                        <option style="color:green" value="1">Active</option>
                                        <option style="color:red" value="0">Inactive</option>
                                    </select>
                                </div>                           
                            <hr>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">Reset</button>
                                <button type="submit" name="submit" class="btn btn-primary px-4">Save Enrollments</button>
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