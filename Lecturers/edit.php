<?php
include_once dirname(__FILE__, 2) . "/Layouts/header.php";
$title = "Edit Lecturer";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM lecturers WHERE id = ?";
    if($stmt = mysqli_prepare($conn, $query)){
        mysqli_stmt_bind_param($stmt, "i", $id);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) > 0){
                $lecturers = mysqli_fetch_assoc($result);
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

    $getDepartmentsSql = "SELECT * FROM departments";
    $result = mysqli_query($conn, $getDepartmentsSql);
    if (mysqli_num_rows($result) > 0) {
        $departments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $departments = [];
    }
    
}
?>

<main class="content">
    <div class="container-fluid p-0">

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6"> 
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Edit Lecturers</h5>
                        <a href="index.php" class="btn btn-sm btn-danger">
                            <i class="align-middle" data-feather="arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="actions/update.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $lecturers['id'] ?>">
                            <input type="hidden" name="old_image" value="<?php echo $lecturers['img'] ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $lecturers['name'] ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select " id="gender" name="gender" required>
                                        <option value="" disabled <?php echo !$lecturers['gender'] ? 'selected' : '' ?>>Select gender</option>
                                        <option value="Male" <?php echo $lecturers['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                        <option value="Female" <?php echo $lecturers['gender'] == 'Female' ? 'selected' : '' ?>>  Female</option>
                                        <option value="Other" <?php echo $lecturers['gender'] == 'Other' ? 'selected' : '' ?>> Other</option>
                                    </select>   
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $lecturers['dob'] ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="departement" class="form-label">Department</label>
                                    <select class="form-select" id="department" name="department" required>
                                        <option value="" selected disabled>Select Depatment</option>
                                        <?php
                                        foreach($departments as $department){
                                            $selected = $department['id'] == $lecturers['dep_id'] ? "selected" : "";
                                            echo "<option value='" . $department['id'] . "' $selected>" . $department['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $lecturers['phone'] ?>" placeholder="012-345-678" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $lecturers['gmail'] ?>" required>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Profile Image</label>
                                <div class="mb-2">
                                    <img src="<?php echo ($lecturers['img'] ? $url . "Assets/img/photos/" . $lecturers['img'] : $url . "Assets/img/photos/default.png") ?>" 
                                         alt="Profile" width="80" class="rounded border shadow-sm">
                                </div>
                                <input type="file" class="form-control" name="image" accept="image/*">
                                <small class="text-muted">Upload new to change or leave empty to keep current.</small>
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