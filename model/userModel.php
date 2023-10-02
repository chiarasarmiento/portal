<?php
 session_start(); 
class User {
    private $conn;

    // to connect to the database
    function __construct() {
        $host = "localhost";  
        $username = "root";  
        $password = "";  
        $database = "user_accounts";  

        $this->conn = new mysqli($host, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // to add users
    function createUser($first_name,$last_name,$email,$password) {
        $sql = "INSERT INTO users (user_firstName, user_lastName, user_email, user_password) VALUES (?, ?, ?, ?)";
        $result = $this->conn->prepare($sql);
        $result->bind_param("ssss", $first_name,$last_name,$email,$password);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // to get users
    function getUser($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // to update users
    function updateUser($id, $name, $email) {
        $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $email, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // to delete users
    function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // to get all users
    function getAllUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
        $users = array();
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    // to check is email exists
    function ifEmailExists($email) {
        $sql = "SELECT COUNT(*) as count FROM users WHERE user_email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0; // If count > 0, the email exists
        } else {
            return false;
        }
    }


    // to check is user exists
    function ifUserExists($email, $password) {
        $passwordMD5 = md5($password);
        $sql = "SELECT * FROM users WHERE user_email = ? and user_password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $email, $passwordMD5);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    // to update password of user
    function updateUserPassword($email, $new_password) {
        // Hash the new password
        $hashed_password = md5($new_password);
    
        // Perform the database update
        $sql = "UPDATE users SET user_password = ? WHERE user_email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $hashed_password, $email);
    
        if ($stmt->execute()) {
            return true;  
        } else {
            return false;  
        }
    }

    function __destruct() {
        $this->conn->close();
    }
}
?>