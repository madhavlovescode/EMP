<?php
class usermodel{

	private $conn;

	public function __construct($conn){
		$this->conn=$conn;



	}
	public function checkLogin($username, $password){
        $sql = "SELECT * FROM employee WHERE email='$username' AND password='$password'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();

    }
    public function registerUser($name,$username, $password){
    $sql = "INSERT INTO employee (name,email, password) VALUES ('$name','$username', '$password')";
    return $this->conn->query($sql);


    }
//get all user
    public function getalluser(){
        $sql = "select * from employee";
        $result=$this->conn->query($sql);
        return $result;

    }
//create task
    public function createtask($emp_id,$title,$description,$status){
       $sql="INSERT INTO task (emp_id,title,description,status) VALUES ('$emp_id','$title', '$description','$status')";
        return $this->conn->query($sql);
    }
//get all task
    public function getalltask(){
        $sql = "select * from task";
        $result=$this->conn->query($sql);
        return $result;

    }

    public function gettaskbyid($id){
    $sql = "SELECT * FROM task WHERE task_id='$id'";
    $result = $this->conn->query($sql);
    return $result->fetch_assoc();
}

public function updatetask($id, $emp_id, $title, $description, $status){
    $sql = "UPDATE task SET emp_id='$emp_id', title='$title', description='$description', status='$status' WHERE task_id='$id'";
    return $this->conn->query($sql);
}



    //delete task
public function deletetask($id){
    $sql = "DELETE FROM task WHERE task_id='$id'";
    return $this->conn->query($sql);
}



    //update page code
    public function getuserbyid($id){
    $sql = "SELECT * FROM employee WHERE id='$id'";
    $result = $this->conn->query($sql);
    return $result->fetch_assoc();
}

public function updateuser($id, $name, $email, $job){
    $sql = "UPDATE employee SET name='$name', email='$email', job_role ='$job'WHERE id='$id'";
    return $this->conn->query($sql);
}
//delete page code
public function deleteuser($id){
    $sql = "DELETE FROM employee WHERE id='$id'";
    return $this->conn->query($sql);
}

//update task status
public function updatetaskstatus($task_id, $emp_id, $title, $description, $status) {
    $sql = "UPDATE task SET emp_id='$emp_id', title='$title', description='$description', status='$status' WHERE task_id='$task_id'";
    return $this->conn->query($sql);
}

//getdata for profile page
public function getdata($name){
    $sql = "SELECT * FROM employee WHERE name='$name'";
    $result = $this->conn->query($sql);
    return $result->fetch_assoc();
}
//update profile page


public function updateprofile($id, $name, $email, $password, $jobrole, $imagepath){
    $sql = "UPDATE employee SET name='$name', email='$email', password='$password', job_role='$jobrole', imagepath='$imagepath' WHERE id='$id'";
    $result = $this->conn->query($sql);

    if (!$result) {
        echo "Update failed: " . $this->conn->error;
    } else {
        echo "Update success";
    }

    return $result;
}

//get employee for task assign
public function getallemp() {
    $sql = "SELECT id, name FROM employee WHERE job_role = 'emp'";
    $result = $this->conn->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}


}
?>