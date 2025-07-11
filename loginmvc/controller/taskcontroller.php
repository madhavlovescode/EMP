<?php
require_once __DIR__ . "/../model/usermodel.php";
require_once __DIR__ . "/../config/db.php";

//require_once "../model/usermodel.php";
//require_once "../config/db.php";


class createcontroller{
	public function createtask(){
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$eid=$_POST['emp_ids'];
			$title=$_POST['title'];
			$description = $_POST['description'];
			$status = $_POST['status'];
			

			if (empty($eid) || empty($title) || empty($description) || empty($status)) {
                echo "All fields are required!";
                return;
            }
            
			$model=new usermodel ($GLOBALS['conn']);
			 if ($model->createtask($eid, $title, $description,$status)) {
                echo "task created Successful.";
                header("Location:tlviewtask.php");
            } else {
                echo "Error during task creation";
            }

		}
	}
}
?>

