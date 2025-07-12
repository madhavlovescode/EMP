<?php

require_once '../model/UserModel.php';
require_once '../config/db.php';
require_once 'header.php';

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

    if (empty($status)) {
        echo 'Status is required.';
    } else {
        $model->updateTaskStatus($taskId, $empId, $title, $description, $status);
        header('Location: empviewtask.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Details</title>
</head>
<body>
    <h2>Current Task Details</h2>

    <?php if ($task) : ?>
        <form method="POST">
            <table>
                <tr>
                    <th>Task ID</th>
                    <td><input type="text" name="task_id" value="<?= $task['task_id'] ?>" readonly></td>
                </tr>
                <tr>
                    <th>Employee ID</th>
                    <td><input type="text" name="emp_id" value="<?= $task['emp_id'] ?>" readonly></td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td><input type="text" name="title" value="<?= $task['title'] ?>" readonly></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><textarea name="description" readonly><?= $task['description'] ?></textarea></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <input type="radio" name="status" value="pending" <?= ($task['status'] === 'pending') ? 'checked' : '' ?>> Pending<br>
                        <input type="radio" name="status" value="in-progress" <?= ($task['status'] === 'in-progress') ? 'checked' : '' ?>> In-Progress<br>
                        <input type="radio" name="status" value="completed" <?= ($task['status'] === 'completed') ? 'checked' : '' ?>> Completed<br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Update"></td>
                </tr>
            </table>
        </form>
    <?php else : ?>
        <p>Task not found!</p>
    <?php endif; ?>
</body>
</html>

<?php

require_once 'footer.php';
