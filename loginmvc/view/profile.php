<?php

require_once '../model/UserModel.php';
require_once '../config/db.php';
require_once 'header.php';

$model = new UserModel($conn);

$data = [
    'id' => '',
    'name' => '',
    'email' => '',
    'password' => '',
    'job_role' => '',
    'imagepath' => ''
];

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $fetched = $model->getData($id);

    if ($fetched) {
        $data = $fetched;
    }
}

$oldPass = $data['password'];
$oldEmail = $data['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $jobRole = $_POST['job_role'];

    $imagePath = '';

    if (!empty($_FILES['image']['name'])) {
        $targetDir = '../image/';
        $imagePath = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $imagePath;
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath);
    } else {
        $imagePath = $data['imagepath'];
    }

    $model->updateProfile($id, $name, $email, $password, $jobRole, $imagePath);

    if (empty($password) || $password !== $oldPass || $email !== $oldEmail) {
        session_unset();
        session_destroy();
        header('Location: ../index.php');
        exit();
    }

    if ($jobRole === 'emp') {
        header('Location: empdashboard.php');
    } else {
        header('Location: pldashboard.php');
    }

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Page</title>
</head>
<body>
    <h1>Profile Page</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>ID:</td>
                <td><input type="text" name="id" value="<?= $data['id']; ?>" readonly></td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" value="<?= $data['name']; ?>"></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" value="<?= $data['email']; ?>"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="text" name="password" value="<?= $data['password']; ?>"></td>
            </tr>
            <tr>
                <td>Job Role:</td>
                <td><input type="text" name="job_role" value="<?= $data['job_role']; ?>" readonly></td>
            </tr>
            <tr>
                <td>Upload Image:</td>
                <td><input type="file" name="image"></td>
            </tr>

            <?php if (!empty($data['imagepath'])) : ?>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <img src="../image/<?= $data['imagepath']; ?>" width="150" height="150" alt="Profile Image">
                    </td>
                </tr>
            <?php endif; ?>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="update" value="Update">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php require_once 'footer.php'; ?>
