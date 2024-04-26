<?php
require_once 'load_env.php';
#TODO: add check for security
function createDatabaseTables()
{
    $servername = getenv('DB_HOST') ?: $_ENV['DB_HOST'];
    $username = getenv('DB_USER') ?: $_ENV['DB_USER'];
    $password = getenv('DB_PASS') ?: $_ENV['DB_PASS'];
    $dbname = getenv('DB_NAME') ?: $_ENV['DB_NAME'];
    $conn = new mysqli($servername, $username, $password);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully<br>";
    } else {
        echo "Error creating database: " . $conn->error . "<br>";
        $conn->close();
        return;
    }

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        name VARCHAR(255) NOT NULL
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Table 'users' created successfully<br>";
        $demoData = [
            ['user_id' => 1, 'name' => 'Ivan'],
            ['user_id' => 2, 'name' => 'Petr'],
            ['user_id' => 3, 'name' => 'German']
        ];
        foreach ($demoData as $data) {
            $userId = $data['user_id'];
            $name = $data['name'];
            $sql = "INSERT INTO users (user_id, name) VALUES ('$userId', '$name')";
            if ($conn->query($sql) !== TRUE) {
                echo "Error inserting demo data: " . $conn->error . "<br>";
            }
        }
    } else {
        echo "Error creating table 'users': " . $conn->error . "<br>";
    }

    $sql = "CREATE TABLE IF NOT EXISTS groups (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Table 'groups' created successfully<br>";
    } else {
        echo "Error creating table 'groups': " . $conn->error . "<br>";
    }

    $sql = "CREATE TABLE IF NOT EXISTS user_group (
        user_id INT,
        group_id INT,
        FOREIGN KEY (user_id) REFERENCES users(id),
        FOREIGN KEY (group_id) REFERENCES groups(id),
        PRIMARY KEY (user_id, group_id)
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Table 'user_group' created successfully<br>";
    } else {
        echo "Error creating table 'user_group': " . $conn->error . "<br>";
    }

    $sql = "CREATE TABLE IF NOT EXISTS permissions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Table 'permissions' created successfully<br>";
    } else {
        echo "Error creating table 'permissions': " . $conn->error . "<br>";
    }

    $sql = "CREATE TABLE IF NOT EXISTS group_permission (
        group_id INT,
        permission_id INT,
        FOREIGN KEY (group_id) REFERENCES groups(id),
        FOREIGN KEY (permission_id) REFERENCES permissions(id),
        PRIMARY KEY (group_id, permission_id)
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Table 'group_permission' created successfully<br>";
    } else {
        echo "Error creating table 'group_permission': " . $conn->error . "<br>";
    }

    $conn->close();
}

createDatabaseTables();
