<?php
$title = "Classes List";
$page = "Classes";
include_once dirname(__FILE__, 2) . "/Layouts/header.php";


$query = "SELECT classes.id, classes.class_name, classes.schedule, classes.room, courses.course_name AS course_name, lecturers.name AS lecturer_name
FROM classes
LEFT JOIN lecturers ON classes.lecturer_id = lecturers.id
LEFT JOIN courses ON classes.course_id = courses.id;";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $classes = mysqli_fetch_fields($result);
} else {
    $classes = [];
}

?>
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-3"><strong>Classes</strong> List</h1>
            <a href="create.php" class="btn btn-success">
                Add New Classes
            </a>
        </div>

        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Lecturer</th>
                        <th>Course</th>
                        <th>Classes Name</th>
                        <th>Schedule</th>
                        <th>Room</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" . ++$i . "</td>";
                    echo "<td>" . $row['lecturer_name'] . "</td>";
                    echo "<td>" . $row['course_name'] . "</td>";
                    echo "<td>" . $row['class_name'] . "</td>";
                    echo "<td>" . $row['schedule'] . "</td>";
                    echo "<td>" . $row['room'] . "</td>";
                    echo "<td>
                            <a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>
                            <a href='" . $url . "Classes/actions/delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>
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