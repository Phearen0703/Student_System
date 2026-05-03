<?php
$title = "Grade List";
$page = "Grades";
include_once dirname(__FILE__, 2) . "/Layouts/header.php";


$query = "SELECT grades.id, grades.mid_term, grades.final, students.name AS student_name, classes.class_name, (grades.mid_term + grades.final) AS total, CASE WHEN (grades.mid_term + grades.final) >= 50 THEN 'Pass' ELSE 'Fail' END AS Result 
FROM grades
INNER JOIN enrollments ON grades.enrollment_id = enrollments.id
INNER JOIN students ON enrollments.student_id = students.id
INNER JOIN classes ON enrollments.class_id = classes.id";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $grades = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $grades = [];
}

?>
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-3"><strong>Grade</strong> List</h1>
            <a href="create.php" class="btn btn-success">
                Add New Grade
            </a>
        </div>

        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>N.o</th>
                        <th>Student</th>
                        <th>Class</th>
                        <th>Tid-Term</th>
                        <th>Final</th>
                        <th>Total</th>
                        <th>Grade</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach($grades as $row){
                    echo "<tr>";
                    echo "<td>" . ++$i . "</td>";
                    echo "<td>" . $row['student_name'] . "</td>";
                    echo "<td>" . $row['class_name'] . "</td>";
                    echo "<td>" . $row['mid_term'] . "</td>";
                    echo "<td>" . $row['final'] . "</td>";
                    echo "<td>" . $row['total'] . "</td>";
                    echo "<td>" . $row['Result'] . "</td>";
                    echo "<td>
                            <a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>
                            <a href='" . $url . "Grades/actions/delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>
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