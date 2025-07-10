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
    <div class="container">
<h1>TEAM LEADER TASK VIEW</h1>

<form>
<table class="table">
    <tr>
        <th>Task ID</th>
        <th>emp ID</th>
        <th>title</th>
        <th>description</th>
        <th>status</th>
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
        <td><a href="tledittask.php?id=<?php echo $row['task_id'] ?>">edit</a></td>
        <td><a href="tldeletetask.php?id=<?php echo $row['task_id'] ?>">delete</a></td>
    </tr>
    <?php
    }
    ?>
</table>

</form>
<a href="pldashboard.php">back to dashboard</a>
</body>
</div>
</html>

<?php
include "footer.php";
?>