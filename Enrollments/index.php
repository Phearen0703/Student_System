<?php
$title = "Enrollments List";
$page = "Enrollments";
include_once dirname(__FILE__, 2) . "/Layouts/header.php";


$query = "SELECT 
    enrollments.id,
    enrollments.enroll_date,
    enrollments.status,
    students.name AS stu_name,
    classes.class_name,
    courses.id AS course_id,
    courses.course_name
FROM enrollments
INNER JOIN students 
    ON enrollments.student_id = students.id
INNER JOIN classes 
    ON enrollments.class_id = classes.id
INNER JOIN courses 
    ON classes.course_id = courses.id;";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $enrollment = mysqli_fetch_fields($result);
} else {
    $enrollment = [];
}

?>
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-3"><strong>Enrollment</strong> List</h1>
            <a href="create.php" class="btn btn-success">
                Add New Enrollment
            </a>
        </div>

        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>N.o</th>
                        <th>Student</th>
                        <th>Class</th>
                        <th>Course</th>
                        <th>Enrollment Date</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" . ++$i . "</td>";
                    echo "<td>" . $row['stu_name'] . "</td>";
                    echo "<td>" . $row['class_name'] . "</td>";
                    echo "<td>" . $row['course_name'] . "</td>";
                    echo "<td>" . $row['enroll_date'] . "</td>";
                    echo "<td>" . 
                    ($row['status'] == 1 
                        ? "<span style='color:green;'>Active</span>" 
                        : "<span style='color:red;'>Inactive</span>") 
                    . "</td>";
                    echo "<td>
                            <a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>
                            <a href='" . $url . "Enrollments/actions/delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>
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