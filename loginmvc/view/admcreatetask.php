<?php
session_start();
require_once("../controller/taskcontroller.php");
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
e_id :<input type="text" name="eid">
title : <input type="text" name="title">
description:<input type="text" name="description">
<input type="submit" name="submit">
</form>
<a href="admdashboard.php">back to dashboard</a>
</body>
</html>