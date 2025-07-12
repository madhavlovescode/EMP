<?php

require_once 'header.php';
require_once '../model/UserModel.php';
require_once '../config/db.php';

$model = new UserModel($conn);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $model->getUserById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $job = $_POST['job_role'];

    $model->updateUser($id, $name, $email, $job);
    header('Location: adminviewemp.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        
        Name: <input type="text" name="name" value="<?= $user['name'] ?>"><br>
        Email: <input type="text" name="email" value="<?= $user['email'] ?>"><br>

        Job Role:<br>
        <input type="radio" name="job_role" value="emp" <?= ($user['job_role'] === 'emp') ? 'checked' : '' ?>> Employee<br>
        <input type="radio" name="job_role" value="tl" <?= ($user['job_role'] === 'tl') ? 'checked' : '' ?>> Team Leader<br>

        <input type="submit" value="Update">
    </form>
</body>
</html>

<?php require_once 'footer.php'; ?>
