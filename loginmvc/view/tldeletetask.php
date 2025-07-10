<?php
require_once "../model/usermodel.php";
require_once "../config/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $model = new usermodel($conn);
    $model->deletetask($id);
}
header("Location: tlviewtask.php");
exit();
