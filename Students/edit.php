<?php
$title = "Edit Student";
$page = "Students";
include_once dirname(__FILE__, 2) . "/Layouts/header.php";


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM students WHERE id = ?";
    if($stmt = mysqli_prepare($conn, $query)){
        mysqli_stmt_bind_param($stmt, "i", $id);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result) > 0){
                $student = mysqli_fetch_assoc($result);
            } else {
                echo "Student not found.";
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
    
}
?>

<main class="content">
    <div class="container-fluid p-0">

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6"> 
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Edit Students</h5>
                        <a href="index.php" class="btn btn-sm btn-danger">
                            <i class="align-middle" data-feather="arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="actions/update.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $student['id'] ?>">
                            <input type="hidden" name="old_image" value="<?php echo $student['image'] ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $student['name'] ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select " id="gender" name="gender" required>
                                        <option value="" disabled <?php echo !$student['gender'] ? 'selected' : '' ?>>Select gender</option>
                                        <option value="Male" <?php echo $student['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                        <option value="Female" <?php echo $student['gender'] == 'Female' ? 'selected' : '' ?>>  Female</option>
                                        <option value="Other" <?php echo $student['gender'] == 'Other' ? 'selected' : '' ?>> Other</option>
                                    </select>   
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $student['dob'] ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $student['email'] ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $student['phone'] ?>" placeholder="012-345-678" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="2" required><?php echo $student['address'] ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Profile Image</label>
                                <div class="mb-2">
                                    <img src="<?php echo ($student['image'] ? $url . "Assets/img/photos/" . $student['image'] : $url . "Assets/img/photos/default.png") ?>" 
                                         alt="Profile" width="80" class="rounded border shadow-sm">
                                </div>
                                <input type="file" class="form-control" name="image" accept="image/*">
                                <small class="text-muted">Upload new to change or leave empty to keep current.</small>
                            </div>
                            
                            <hr>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">Reset</button>
                                <button type="submit" name="submit" class="btn btn-primary px-4">Update Student</button>
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