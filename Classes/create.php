<?php
$title = "Create Classes";
$page = "Classes";
include_once dirname(__FILE__, 2) . "/Layouts/header.php";


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
                        <h5 class="card-title mb-0">Create Classes</h5>
                        <a href="index.php" class="btn btn-sm btn-danger">
                            <i class="align-middle" data-feather="arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="actions/upload.php" method="POST" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Classes Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Classes Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="schedule" class="form-label">Schedule</label>
                                <input type="text" class="form-control" id="schedule" name="schedule" placeholder="Enter Schedule" required>
                            </div>
                            <div class="mb-3">
                                <label for="room" class="form-label">Room</label>
                                <input type="text" class="form-control" id="room" name="room" placeholder="Enter Room" required>
                            </div>

                                <div class="mb-3">
                                    <label for="lecturer" class="form-label">Lecturer</label>
                                    <select class="form-select" id="lecturer" name="lecturer" required>
                                        <option value="" selected disabled>Select Lecturer</option>
                                        <?php
                                        foreach($lecturers as $lecturer){
                                            echo "<option value='" . $lecturer['id'] . "'>" . $lecturer['name'] . "</option>";
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
                                            echo "<option value='" . $course['id'] . "'>" . $course['course_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>                           
                            <hr>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">Reset</button>
                                <button type="submit" name="submit" class="btn btn-primary px-4">Save Classes</button>
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