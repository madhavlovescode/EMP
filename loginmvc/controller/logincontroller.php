<?php

require_once './model/UserModel.php';
require_once './config/db.php';

session_start();

class LoginController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $adminId = 'admin';
            $adminPass = 'admin';

            if ($username === $adminId && $password === $adminPass) {
                $_SESSION['user'] = $username;
                header('Location: ./view/admdashboard.php');
                exit();
            }

            $model = new UserModel($GLOBALS['conn']);
            $userData = $model->checkLogin($username, $password);

            if ($userData) {
                $_SESSION['user'] = $username;
                $_SESSION['id'] = $userData['id'];

                $role = isset($userData['job_role']) ? trim($userData['job_role']) : '';

                if ($role === 'emp') {
                    header('Location: ./view/empdashboard.php');
                } elseif ($role === '') {
                    header('Location: ./view/pending.php');
                } elseif ($role === 'tl') {
                    header('Location: ./view/pldashboard.php');
                } else {
                    echo "Unknown role assigned: $role";
                }

                exit();
            } else {
                echo 'Invalid Credentials';
            }
        } else {
            include './view/loginview.php';
        }
    }
}
