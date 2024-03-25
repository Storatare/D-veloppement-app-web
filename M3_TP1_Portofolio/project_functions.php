<?php
require_once("config.php");

function createUser($username, $password) {
    global $conn;
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
    
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

function loginUser($username, $password) {
    global $conn;
    
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function logoutUser() {
    session_unset();
    session_destroy();
}

function deleteUser($username) {
    global $conn;
    
    $sql = "DELETE FROM users WHERE username='$username'";
    
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}
?>
