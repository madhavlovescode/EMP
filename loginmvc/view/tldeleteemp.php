<?php

require_once '../model/UserModel.php';
require_once '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $model = new UserModel($conn);
    $model->deleteUser($id);
}

header('Location: tlviewemp.php');
exit();
