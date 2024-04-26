<?php
require_once 'load_env.php';
class UserManager {
    private $conn;

    public function __construct() {
        $servername = getenv('DB_HOST') ?: $_ENV['DB_HOST'];
        $username = getenv('DB_USER') ?: $_ENV['DB_USER'];
        $password = getenv('DB_PASS') ?: $_ENV['DB_PASS'];
        $dbname = getenv('DB_NAME') ?: $_ENV['DB_NAME'];

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addUser($userId, $name) {
        $sql = "INSERT INTO users (user_id, name) VALUES ('$userId', '$name')";
        if ($this->conn->query($sql) === TRUE) {
            return "User added successfully";
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function deleteUser($userId) {
        $sql = "DELETE FROM users WHERE user_id='$userId'";
        if ($this->conn->query($sql) === TRUE) {
            return "User deleted successfully";
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function getUserInfo($userId) {
        $sql = "SELECT * FROM users WHERE user_id='$userId'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return "User not found";
        }
    }

    public function __destruct() {
        $this->conn->close();
    }
}

?>
