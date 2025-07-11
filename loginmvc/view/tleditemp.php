<?php
require_once "../model/usermodel.php";
require_once "../config/db.php";
include'header.php';
$model = new usermodel($conn);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $model->getuserbyid($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $job = $_POST['job_role'];
    $model->updateuser($id, $name, $email, $job);
    header("Location: tlviewemp.php");
    exit();
}
?>
<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>
<form method="POST">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">
    Name: <input type="text" name="name" value="<?= $user['name'] ?>"><br>
    Email: <input type="text" name="email" value="<?= $user['email'] ?>"><br>
    job-role: <input type="text" name="job_role" value="<?= $user['job_role'] ?>"readonly><br>
    <input type="submit" value="Update">
</form>
</body>
</html>
<?php
include"footer.php";
?>

