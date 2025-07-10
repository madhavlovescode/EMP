<?php
include "header.php";
require_once("../controller/taskcontroller.php");
require_once("../model/usermodel.php");
require_once("../config/db.php");
$model = new usermodel($conn);
$employees = $model->getallemp();

$controller = new createcontroller();
$controller->createtask();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<form action="" method="POST">
<h1>CREATE TASK</h1>
title : <input type="text" name="title">
description:<input type="text" name="description">
<h3>Assign to Employees:</h3>
		<?php foreach ($employees as $emp): ?>
			<input type="checkbox" name="emp_ids" value="<?= $emp['id'] ?>">
			<?= $emp['name'] ?><br>
		<?php endforeach; ?>
		<label>Status:</label><br>
<input type="radio" name="status" value="pending"> Pending<br>
<input type="radio" name="status" value="inprogress"> In Progress<br>
<input type="radio" name="status" value="complete"> Complete<br>
<input type="submit" name="submit">
</form>
<a href="pldashboard.php">back to dashboard</a>
</body>
</html>
<?php
include "footer.php";
?>