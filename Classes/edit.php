<?php
$title = "Edit Classes";
$page = "Classes";
include_once dirname(__FILE__, 2) . "/Layouts/header.php";


$id = $_GET['id'] ?? null;
if(!$id){
    header("Location: index.php");
    exit();
}

$oldDataQuery = "SELECT * FROM classes WHERE id = $id";
$oldDataResult = mysqli_query($conn, $oldDataQuery);
if(mysqli_num_rows($oldDataResult) > 0){
    $oldData = mysqli_fetch_assoc($oldDataResult);
} else {
    header("Location: index.php?msg=Classes not found");
    exit();
}

$sql = "SELECT * FROM lecturers";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
    $lecturers = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $lecturers = [];
}

$getCourseSql = "SELECT * FROM courses";
$getCourseResult = mysqli_query($conn, $getCourseSql);
if(mysqli_num_rows($getCourseResult) > 0){
    $courses = mysqli_fetch_all($getCourseResult, MYSQLI_ASSOC);
} else {
    $courses = [];
}
?>

<main class="content">
    <div class="container-fluid p-0">

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6"> 
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Edit Classes</h5>
                        <a href="index.php" class="btn btn-sm btn-danger">
                            <i class="align-middle" data-feather="arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="actions/update.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $oldData['id'] ?>">
                             
                             <div class="mb-3">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Classes Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $oldData['class_name'] ?? '' ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="schedule" class="form-label">Schedule</label>
                                <input type="text" class="form-control" id="schedule" name="schedule" value="<?php echo $oldData['schedule'] ?? '' ?>" placeholder="Enter Schedule" required>
                            </div>
                            <div class="mb-3">
                                <label for="room" class="form-label">Room</label>
                                <input type="text" class="form-control" id="room" name="room" value="<?php echo $oldData['room'] ?>" required>
                            </div>

                                <div class="mb-3">
                                    <label for="lecturer" class="form-label">Lecturer</label>
                                    <select class="form-select" id="lecturer" name="lecturer" required>
                                        <option value="" selected disabled>Select Lecturer</option>
                                        <?php
                                        foreach($lecturers as $lecturer){
                                            $selected = $lecturer['id'] == $oldData['lecturer_id'] ? "selected" : "";
                                            echo "<option value='" . $lecturer['id'] . "' $selected>" . $lecturer['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>                           
                                <div class="mb-3">
                                    <label for="course" class="form-label">Course</label>
                                    <select class="form-select" id="course" name="course" required>
                                        <option value="" selected disabled>Select Course</option>
                                        <?php
                                        foreach($courses as $course){
                                            $selected = $course['id'] == $oldData['course_id'] ? "selected" : "";
                                            echo "<option value='" . $course['id'] . "' $selected>" . $course['course_name'] . "</option>";
                                        }
                                        ?>
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