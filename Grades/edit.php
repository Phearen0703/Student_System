<?php
$title = "Edit Grades";
$page = "Grades";
include_once dirname(__FILE__, 2) . "/Layouts/header.php";


$sql = "SELECT students.name AS student_name, classes.class_name AS class_name, enrollments.id FROM enrollments
INNER JOIN 	students ON enrollments.student_id = students.id
INNER JOIN classes ON enrollments.class_id = classes.id WHERE enrollments.status > 0";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
    $enrollments = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $enrollments = [];
}
$getGrade = "SELECT * FROM grades WHERE id = " . $_GET['id'];
$result = mysqli_query($conn, $getGrade);
if(mysqli_num_rows($result) > 0){
    $grade = mysqli_fetch_assoc($result);
} else {
    header("Location: index.php?msg=Grade not found");
    exit();
}

?>

<main class="content">
    <div class="container-fluid p-0">

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6"> 
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Edit Grades</h5>
                        <a href="index.php" class="btn btn-sm btn-danger">
                            <i class="align-middle" data-feather="arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="actions/update.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $grade['id'] ?>">
                                <div class="mb-3">
                                    <label for="enrollment" class="form-label">Student</label>
                                    <select class="form-select" id="enrollment" name="enrollment" required>
                                        <option value="" selected disabled>Select Student</option>
                                        <?php
                                        foreach($enrollments as $enrollment){
                                            $selected = ($enrollment['id'] == $grade['enrollment_id']) ? 'selected' : '';
                                            echo "<option value='" . $enrollment['id'] . "' " . $selected . ">" . $enrollment['student_name']. ' - '.$enrollment['class_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="mid-term" class="form-label">Mid-Term</label>
                                    <input type="number" class="form-control" id="mid-term" name="mid_term" value="<?php echo $grade['mid_term'] ?>" required>
                                </div>                           
                                <div class="mb-3">
                                    <label for="final" class="form-label">Final</label>
                                    <input type="number" class="form-control" id="final" name="final" value="<?php echo $grade['final'] ?>" required>
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