<?php
require_once "../model/usermodel.php";
require_once "../config/db.php";
include "header.php";
$model = new usermodel($conn);
$task = null;

// Fetch task details based on ID (only if GET request contains an ID)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $task = $model->gettaskbyid($id);
}


// Handle form submission (POST request)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = $_POST['task_id'];
    $emp_id = $_POST['emp_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Check if all required fields are set (basic validation)
    if (empty($status)) {
        echo "Status is required.";
    } else {
        // Update task status in the database
        $model->updatetaskstatus($task_id, $emp_id, $title, $description, $status);
        header("Location: empviewtask.php");
        exit();
    }
}
?>
<html>
<head>
    <title>Task Details</title>
</head>
<body>
<h2>Current Task Details</h2>
<?php if ($task): ?>
    <form action="" method="POST">
        <table>
    <tr>
        <th>Task ID</th>
        <td><input type="text" name="task_id" value="<?php echo $task['task_id']; ?>" readonly></td>
    </tr>
    <tr>
        <th>Employee ID</th>
        <td><input type="text" name="emp_id" value="<?php echo $task['emp_id']; ?>" readonly></td>
    </tr>
    <tr>
        <th>Title</th>
        <td><input type="text" name="title" value="<?php echo $task['title']; ?>"  readonly></td>
    </tr>
    <tr>
        <th>Description</th>
        <td><textarea name="description" readonly><?php echo $task['description']; ?></textarea>
</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            <input type="radio" name="status" value="pending" <?= ($task['status'] == 'pending') ? 'checked' : '' ?>> pending<br>
            <input type="radio" name="status" value="in-progress" <?= ($task['status'] == 'in-progress') ? 'checked' : '' ?>> in-progress<br>
            <input type="radio" name="status" value="completed" <?= ($task['status'] == 'completed') ? 'checked' : '' ?>> completed<br>
        </td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="submit" value="Update"></td>
    </tr>
</table>

    </form>
<?php else: ?>
    <p>Task not found!</p>
<?php endif; ?>
</body>
</html>
<?php
include "footer.php";
?>
