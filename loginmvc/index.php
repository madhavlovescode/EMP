<?php
	
require_once "./controller/logincontroller.php";
require_once "./controller/registercontroller.php";
require_once "./controller/taskcontroller.php";

$controller = new LoginController();
$controller->login();

include"view/footer.php";
?>