<?php
include_once dirname(__FILE__, 2) . "/Layouts/header.php";
$title = "Create Lecturer"; 

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
                        <h5 class="card-title mb-0">Create Lecturer</h5>
                        <a href="index.php" class="btn btn-sm btn-danger">
                            <i class="align-middle" data-feather="arrow-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="actions/upload.php" method="POST" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="" selected disabled>Select gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="012-345-678" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="2" required></textarea>
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


                            <div class="mb-3">
                                <label for="image" class="form-label">Profile Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <small class="text-muted">Accepted formats: JPG, PNG, GIF</small>
                            </div>
                            
                            <hr>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-outline-secondary me-md-2">Reset</button>
                                <button type="submit" name="submit" class="btn btn-primary px-4">Save Lecturer</button>
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