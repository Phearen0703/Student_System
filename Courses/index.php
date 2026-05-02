<?php
$title = "Course List";
$page = "Courses";
include_once dirname(__FILE__, 2) . "/Layouts/header.php";


$query = "SELECT courses.course_name, courses.course_code, courses.credit, courses.id, departments.name AS department
FROM courses
INNER JOIN departments ON courses.department_id = departments.id";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $courses = mysqli_fetch_fields($result);
} else {
    $courses = [];
}

?>
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-3"><strong>Course</strong> List</h1>
            <a href="create.php" class="btn btn-success">
                Add New Course
            </a>
        </div>

        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Department</th>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Credit</th>
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
                    echo "<td>" . $row['course_code'] . "</td>";
                    echo "<td>" . $row['course_name'] . "</td>";
                    echo "<td>" . $row['credit'] . "</td>";
                    echo "<td>
                            <a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>
                            <a href='" . $url . "Courses/actions/delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>
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