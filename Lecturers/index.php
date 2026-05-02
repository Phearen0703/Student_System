<?php
$title = "Lecturers List";
$page = "Lecturers";
include_once dirname(__FILE__, 2) . "/Layouts/header.php";


$query = "SELECT lecturers.*, departments.name AS department FROM lecturers
INNER JOIN departments ON lecturers.dep_id = departments.id ORDER BY id DESC";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $lecturers = mysqli_fetch_fields($result);
} else {
    $lecturers = [];
}

?>
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-3"><strong>Lecturers</strong> List</h1>
            <a href="create.php" class="btn btn-success">
                Add New Lecturer
            </a>
        </div>

        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Department</th>
                        <th>Image</th>
                        <th>Lecturer Code</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" . ++$i . "</td>";
                    echo "<td>" . $row['department'] . "</td>";
                    echo "<td><img src='" . ($row['img'] ? $url . "Assets/img/photos/" . $row['img'] : $url . "Assets/img/photos/default.png") . "' alt='Profile Image' width='50'></td>";
                    echo "<td>" . $row['lecturer_code'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . date("d/m/Y", strtotime($row['dob'])) .   "</td>";
                    echo "<td>" . $row['gmail'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>
                            <a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>
                            <a href='" . $url . "Lecturers/actions/delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>
                          </td>";
                    echo "</tr>";
                }

                ?>
                </tbody>
            </table>
        </div>
    </div>
</main>


<?php
include_once dirname(__FILE__, 2) . "/Layouts/footer.php";
?>