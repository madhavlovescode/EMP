<?php

require_once 'header.php';
require_once '../config/db.php';
require_once '../model/UserModel.php';

$model = new UserModel($conn);
$result = $model->getAllTask();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Leader - Task View</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h1>Team Leader Task View</h1>

    <form>
        <table class="table">
            <thead>
                <tr>
                    <th>Task ID</th>
                    <th>Employee ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row['task_id'] ?></td>
                        <td><?= $row['emp_id'] ?></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><?= $row['status'] ?></td>
                        <td><a href="tledittask.php?id=<?= $row['task_id'] ?>">Edit</a></td>
                        <td><a href="tldeletetask.php?id=<?= $row['task_id'] ?>">Delete</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </form>

    <a href="pldashboard.php">Back to Dashboard</a>
</div>

</body>
</html>

<?php

require_once 'footer.php';
?>