<?php

class UserModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function checkLogin($username, $password)
    {
        $sql = "SELECT * FROM employee WHERE email = '$username' AND password = '$password'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function registerUser($name, $username, $password)
    {
        $sql = "INSERT INTO employee (name, email, password) VALUES ('$name', '$username', '$password')";
        return $this->conn->query($sql);
    }

    public function getAllUser()
    {
        $sql = "SELECT * FROM employee";
        return $this->conn->query($sql);
    }

    public function createTask($empId, $title, $description, $status)
    {
        $sql = "INSERT INTO task (emp_id, title, description, status) VALUES ('$empId', '$title', '$description', '$status')";
        return $this->conn->query($sql);
    }

    public function getAllTask()
    {
        $sql = "SELECT * FROM task";
        return $this->conn->query($sql);
    }

    public function getTaskById($id)
    {
        $sql = "SELECT * FROM task WHERE task_id = '$id'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function updateTask($id, $empId, $title, $description, $status)
    {
        $sql = "UPDATE task SET emp_id = '$empId', title = '$title', description = '$description', status = '$status' WHERE task_id = '$id'";
        return $this->conn->query($sql);
    }

    public function deleteTask($id)
    {
        $sql = "DELETE FROM task WHERE task_id = '$id'";
        return $this->conn->query($sql);
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM employee WHERE id = '$id'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function updateUser($id, $name, $email, $job)
    {
        $sql = "UPDATE employee SET name = '$name', email = '$email', job_role = '$job' WHERE id = '$id'";
        return $this->conn->query($sql);
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM employee WHERE id = '$id'";
        return $this->conn->query($sql);
    }

    public function updateTaskStatus($taskId, $empId, $title, $description, $status)
    {
        $sql = "UPDATE task SET emp_id = '$empId', title = '$title', description = '$description', status = '$status' WHERE task_id = '$taskId'";
        return $this->conn->query($sql);
    }

    public function getData($id)
    {
        $sql = "SELECT * FROM employee WHERE id = '$id'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function updateProfile($id, $name, $email, $password, $jobRole, $imagePath)
    {
        $sql = "UPDATE employee SET name = '$name', email = '$email', password = '$password', job_role = '$jobRole', imagepath = '$imagePath' WHERE id = '$id'";
        $result = $this->conn->query($sql);

        if (!$result) {
            echo 'Update failed: ' . $this->conn->error;
        } else {
            echo 'Update success';
        }

        return $result;
    }

    public function getAllEmp()
    {
        $sql = "SELECT id, name FROM employee WHERE job_role = 'emp'";
        $result = $this->conn->query($sql);
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
}
