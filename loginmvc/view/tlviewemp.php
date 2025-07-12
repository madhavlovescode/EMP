<?php

require_once 'header.php';

echo $_SESSION['user'];

require_once '../config/db.php';
require_once '../model/UserModel.php';

$model = new UserModel($conn);
$result = $model->getAllUser();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Leader View Employee</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container">
        <h1>View Employee</h1>

        <form>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Job Role</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['job_role'] ?></td>
                            <td><a href="tleditemp.php?id=<?= $row['id'] ?>">Edit</a></td>
                            <td><a href="admdeleteemp.php?id=<?= $row['id'] ?>">Delete</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </form>

        <a href="pldashboard.php">Back to Dashboard</a>
    </div>

</body>
</html>

<?php

require_once 'footer.php';
?>