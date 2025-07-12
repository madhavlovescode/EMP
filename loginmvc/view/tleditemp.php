<?php

require_once '../model/UserModel.php';
require_once '../config/db.php';
require_once 'header.php';

$model = new UserModel($conn);
$user = [];

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
    header('Location: tlviewemp.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
</head>
<body>
    <h2>Edit Employee</h2>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= $user['name'] ?>"><br><br>

        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="<?= $user['email'] ?>"><br><br>

        <label for="job_role">Job Role:</label>
        <input type="text" name="job_role" id="job_role" value="<?= $user['job_role'] ?>" readonly><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>

<?php

require_once 'footer.php';
?>