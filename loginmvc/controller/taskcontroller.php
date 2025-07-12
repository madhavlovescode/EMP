<?php

require_once __DIR__ . '/../model/UserModel.php';
require_once __DIR__ . '/../config/db.php';

class CreateController
{
    public function createTask()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eid = $_POST['empid'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];

            if (empty($eid) || empty($title) || empty($description) || empty($status)) {
                echo 'All fields are required!';
                return;
            }

            $model = new UserModel($GLOBALS['conn']);

            if ($model->createTask($eid, $title, $description, $status)) {
                echo 'Task created successfully.';
                header('Location: tlviewtask.php');
            } else {
                echo 'Error during task creation';
            }
        }
    }
}
