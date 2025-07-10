<?php
include "header.php";
require_once "../model/usermodel.php";
require_once "../config/db.php";

$model = new usermodel($conn);
$task=null;
if (isset($_GET['id'])) {
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $task = $model->gettaskbyid($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = $_POST['task_id'];
    $emp_id = $_POST['emp_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status=$_POST['status'];
    $model->updatetask($task_id, $emp_id, $title, $description,$status);
    echo $emp_id;
    header("Location: tlviewtask.php");
    exit();
}
?>
<<!DOCTYPE html>
<html>
<head>
    
    <title></title>
</head>
<body>
<form action="" method="POST">
    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">
    emp_id: <input type="text" name="emp_id" value="<?php echo $task['emp_id']; ?>"><br>
    title: <input type="text" name="title" value="<?php echo $task['title']; ?>"><br>
    description: <input type="text" name="description" value="<?php echo $task['description']; ?>"><br>
    status:<br>
    <input type="radio" name="status" value="pending" <?= ($task['status'] == 'pending') ? 'checked' : '' ?>> pending<br>
    <input type="radio" name="status" value="in-progress" <?= ($task['status'] == 'in-progress') ? 'checked' : '' ?>> in-progress<br>
     <input type="radio" name="status" value="completed" <?= ($task['status'] == 'in-progress') ? 'checked' : '' ?>> completed<br>
    <input type="submit" name="submit" value="Update">
</form>
</body>
</html>
<?php
include "footer.php";

?>

