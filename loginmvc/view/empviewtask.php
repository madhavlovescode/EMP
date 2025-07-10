<?php
include "header.php";
require_once "../config/db.php";
require_once "../model/usermodel.php";
$model=new usermodel($conn);
$result=$model->getalltask();
?>
	
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title>TASK VIEW </title>
</head>
<body>
<h1>ASSIGNED TASKS</h1>
<div class="container">
<form>
<table class="table">
    <tr>
        <th>Task ID</th>
        <th>Emp ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>action</th>
        
    </tr>
    <?php
    while($row = $result->fetch_assoc()) {
    ?>
    <tr>
        <td><?php echo $row['task_id']; ?></td>
        <td><?php echo $row['emp_id']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['status']; ?></td>
         
        <td><a href="empedittask.php?id=<?php echo $row['task_id'] ?>">edit</a></td></td>
    </tr>
    <?php
    }
    ?>
</table>

</form>
<a href="empdashboard.php">back to dashboard</a>
</div>
</body>
</html>

<?php

include "footer.php";
?>