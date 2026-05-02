<?php
$title = "Create Course";
$page = "Courses";
include_once dirname(__FILE__, 2) . "/Layouts/header.php";


$sql = "SELECT * FROM departments";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
    $departments = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $departments = [];
}
?>

<main class="content">
    <div class="container-fluid p-0">

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6"> 
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Create Course</h5>
                        <a href="index.php" class="btn btn-sm btn-danger">
                            <i class="align-middle" data-feather="arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="actions/upload.php" method="POST" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Course Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Course Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Credit</label>
                                <input type="number" class="form-control" id="credit" name="credit" required>
                            </div>

                                <div class="mb-3">
                                    <label for="departement" class="form-label">Department</label>
                                    <select class="form-select" id="department" name="department" required>
                                        <option value="" selected disabled>Select Depatment</option>
                                        <?php
                                        foreach($departments as $department){
                                            echo "<option value='" . $department['id'] . "'>" . $department['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>                           
                            <hr>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">Reset</button>
                                <button type="submit" name="submit" class="btn btn-primary px-4">Save Course</button>
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