<?php
require_once "../model/usermodel.php";
require_once "../config/db.php";
include "header.php";

$model = new usermodel($conn);
$data = ['id' => '', 'name' => '', 'email' => '', 'password' => '', 'job_role' => '', 'imagepath' => ''];

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $fetched = $model->getdata($id);
    if ($fetched) {
        $data = $fetched;
    }
}

$old_pass = $data['password'];
$old_email = $data['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $job_role = $_POST['job_role'];

    $imagePath = '';

    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../image/";
        $imagePath = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $imagePath;

        move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath);
    } else {
        $imagePath = $data['imagepath'];
    }

    $model->updateprofile($id, $name, $email, $password, $job_role, $imagePath);

    if ($password == "" || $password != $old_pass || $email != $old_email) {
        session_unset();
        session_destroy();
        header("Location: ../index.php");
        exit();
    } elseif ($job_role == 'emp') {
        header("Location: empdashboard.php");
        exit();
    } else {
        header("Location: pldashboard.php");
        exit();
    }
}
?>

<html>
<head>
    <title>Profile Page</title>
</head>
<body>
<h1>PROFILE PAGE</h1>
<form action="" method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <td>ID:</td>
            <td><input type="text" name="id" value="<?php echo $data['id']; ?>" readonly></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="name" value="<?php echo $data['name']; ?>"></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="text" name="email" value="<?php echo $data['email']; ?>"></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="text" name="password" value="<?php echo $data['password']; ?>"></td>
        </tr>
        <tr>
            <td>Job Role:</td>
            <td><input type="text" name="job_role" value="<?php echo $data['job_role']; ?>" readonly></td>
        </tr>
        <tr>
            <td>Upload Image:</td>
            <td><input type="file" name="image"></td>
        </tr>
        <?php if (!empty($data['imagepath'])): ?>
        <tr>
            <td>Current Image:</td>
            <td><img src="../image/<?php echo $data['imagepath']; ?>" width="150" height="150"></td>
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

<?php include "footer.php"; ?>
