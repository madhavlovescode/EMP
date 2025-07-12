<?php

require_once 'header.php';
require_once '../model/UserModel.php';
require_once '../config/db.php';

$model = new UserModel($conn);
$task = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $task = $model->getTaskById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = $_POST['task_id'];
    $empId = $_POST['emp_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $model->updateTask($taskId, $empId, $title, $description, $status);

    header('Location: tlviewtask.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
</head>
<body>
    <h2>Edit Task</h2>

    <?php if ($task) : ?>
        <form method="POST" action="">
            <input type="hidden" name="task_id" value="<?= $task['task_id'] ?>">

            <label for="emp_id">Employee ID:</label>
            <input type="text" name="emp_id" id="emp_id" value="<?= $task['emp_id'] ?>"><br><br>

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?= $task['title'] ?>"><br><br>

            <label for="description">Description:</label>
            <input type="text" name="description" id="description" value="<?= $task['description'] ?>"><br><br>

            <label>Status:</label><br>
            <input type="radio" name="status" value="pending" <?= ($task['status'] === 'pending') ? 'checked' : '' ?>> Pending<br>
            <input type="radio" name="status" value="in-progress" <?= ($task['status'] === 'in-progress') ? 'checked' : '' ?>> In Progress<br>
            <input type="radio" name="status" value="completed" <?= ($task['status'] === 'completed') ? 'checked' : '' ?>> Completed<br><br>

            <input type="submit" name="submit" value="Update">
        </form>
    <?php else : ?>
        <p>Task not found.</p>
    <?php endif; ?>
</body>
</html>

<?php

require_once 'footer.php';
?>