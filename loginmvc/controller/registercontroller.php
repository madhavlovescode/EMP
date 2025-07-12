<?php

require_once './model/UserModel.php';
require_once './config/db.php';

class RegisterController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            $model = new UserModel($GLOBALS['conn']);

            if ($model->registerUser($name, $username, $password)) {
                echo "Registration Successful. <a href='index.php'>Login Now</a>";
            } else {
                echo 'Error during registration';
            }
        } else {
            include './view/register.php';
        }
    }
}
