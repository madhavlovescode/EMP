<?php
include"header.php";
require_once "../config/db.php";
require_once "../model/usermodel.php";
$model=new usermodel($conn);
$result=$model->getalluser();

?>
	
<!DOCTYPE html>
<html>
<head>
     <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ADMIN VIEW EMPLOYEE</title>
</head>
<body>
    <div class="container">
<h1>VIEW EMPLOYEE</h1>

<form>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Job Role</th>
        <th>action</th>
        
    </tr>
    <?php
    while($row = $result->fetch_assoc()) {
    ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['job_role']; ?></td>
        <td><a href="admeditemp.php?id=<?php echo $row['id'] ?>">edit</a></td>
        <td><a href="admdeleteemp.php?id=<?php echo $row['id'] ?>">delete</a></td>
    </tr>
    <?php
    }
    ?>
</table>

</form>
</div>
<a href="admdashboard.php">back to dashboard</a>
</body>
</html>

<?php
include"footer.php";
?>