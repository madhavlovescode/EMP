<?php

require_once 'header.php';
require_once '../controller/TaskController.php';
require_once '../model/UserModel.php';
require_once '../config/db.php';

$model = new UserModel($conn);
$employees = $model->getAllEmp();

$controller = new CreateController();
$controller->createTask();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
</head>
<body>
    <h1>Create Task</h1>

    <form method="POST" action="">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title"><br><br>

        <label for="description">Description:</label>
        <input type="text" name="description" id="description"><br><br>

        <h3>Assign to Employees:</h3>
        <?php foreach ($employees as $emp) : ?>
            <input type="checkbox" name="empid" value="<?= $emp['id'] ?>"> <?= $emp['name'] ?><br>
        <?php endforeach; ?>

        <h3>Status:</h3>
        <input type="radio" name="status" value="pending"> Pending<br>
        <input type="radio" name="status" value="inprogress"> In Progress<br>
        <input type="radio" name="status" value="complete"> Complete<br><br>

        <input type="submit" name="submit" value="Create Task">
    </form>

    <br>
    <a href="pldashboard.php">Back to Dashboard</a>
</body>
</html>

<?php

require_once 'footer.php';
?>