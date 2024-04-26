<?php
require_once 'load_env.php';
class UserGroupManager
{
    private $conn;

    public function __construct()
    {
        $servername = getenv('DB_HOST') ?: $_ENV['DB_HOST'];
        $username = getenv('DB_USER') ?: $_ENV['DB_USER'];
        $password = getenv('DB_PASS') ?: $_ENV['DB_PASS'];
        $dbname = getenv('DB_NAME') ?: $_ENV['DB_NAME'];
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function addUserToGroup($userId, $groupId)
    {
        $sql = "INSERT INTO user_group (user_id, group_id) VALUES ('$userId', '$groupId')";
        if ($this->conn->query($sql) === TRUE) {
            return "User added to group successfully";
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function removeUserFromGroup($userId, $groupId)
    {
        $sql = "DELETE FROM user_group WHERE user_id='$userId' AND group_id='$groupId'";
        if ($this->conn->query($sql) === TRUE) {
            return "User removed from group successfully";
        } else {
            return "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function getUserGroupsAndPermissions($userId)
    {
        $sql = "SELECT groups.name AS group_name, GROUP_CONCAT(permissions.name) AS permissions 
                FROM user_group 
                INNER JOIN groups ON user_group.group_id = groups.id 
                LEFT JOIN group_permission ON user_group.group_id = group_permission.group_id 
                LEFT JOIN permissions ON group_permission.permission_id = permissions.id 
                WHERE user_group.user_id='$userId' 
                GROUP BY groups.name";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $response = array();
            while ($row = $result->fetch_assoc()) {
                $response[$row['group_name']] = $row['permissions'] ? explode(',', $row['permissions']) : [];
            }
            return $response;
        } else {
            return "No groups found for this user";
        }
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
