<?php

require_once './controller/LoginController.php';
require_once './controller/RegisterController.php';
require_once './controller/TaskController.php';

$controller = new LoginController();
$controller->login();

require_once 'view/footer.php';
