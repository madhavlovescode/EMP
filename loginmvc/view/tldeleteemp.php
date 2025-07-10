<?php
require_once "../model/usermodel.php";
require_once "../config/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $model = new usermodel($conn);
    $model->deleteuser($id);
}
header("Location: tlviewemp.php");
exit();
