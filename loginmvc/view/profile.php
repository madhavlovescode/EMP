<?php
require_once "../model/usermodel.php";
require_once "../config/db.php";
include "header.php";
$model = new usermodel($conn);
$data = ['name' => '', 'email' => '', 'password' => '', 'job_role' => '', 'image_path' => '']; // Ensure 'image_path' is initialized.

if (isset($_SESSION['user'])) {
    $name = $_SESSION['user'];
    $fetched = $model->getdata($name);
    if ($fetched) {
        $data = $fetched;
    }
}

// fetch details
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $fetched = $model->getdata($id);
    if ($fetched) {
        $data = $fetched;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];  // required for update
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $job_role = $_POST['job_role'];

    $imagePath = ''; // Default value

    // Logic for image
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../image/";
        $imagePath = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $imagePath;

        move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath);
    } else {
        // If image not uploaded, keep existing one
        $imagePath = $data['image_path'];
    }

    // Ensure updateprofile method takes 6 parameters: id, name, email, password, job_role, and image_path
    $model->updateprofile($id, $name, $email, $password, $job_role, $imagePath); // Corrected function call
    header("Location: empdashboard.php");
    exit();
}
?>
<html>
<head>
    
    <title>Profile Page</title>
</head>
<body>
<h1>PROFILE PAGE</h1>
<form action="" method="POST" enctype="multipart/form-data"> <!-- Added enctype for image upload -->
    <table>
        <tr>
            <td>ID:</td>
            <td><input type="text" name="id" value="<?php echo $data['id']; ?>" readonly></td> <!-- Read-only -->
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
            <td><input type="text" name="job_role" value="<?php echo $data['job_role']; ?>"></td>
        </tr>
        <tr>
            <td>Upload Image:</td>
            <td><input type="file" name="image"></td>
        </tr>
        <?php if (!empty($data['image_path'])): ?>
        <tr>
            <td>Current Image:</td>
            <td><img src="../image/<?php echo $data['image_path']; ?>" width="100"></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="update" value="Update">
            </td>
            <?php if (!empty($data['imagepath'])): ?>
<tr>
    <td>Current Image:</td>
    <td><img src="../image/<?php echo $data['imagepath']; ?>" width="150" height="150"></td>
</tr>
<?php endif; ?>

        </tr>
    </table>
</form>

</body>
</html>
<?php
include "footer.php";
?>
