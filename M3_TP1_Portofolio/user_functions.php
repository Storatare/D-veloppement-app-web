<?php
require_once("config.php");

function getProjects() {
    global $conn;
    
    $sql = "SELECT * FROM projects";
    $result = $conn->query($sql);
    
    $projects = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
    }
    
    return $projects;
}

// Fonctions CRUD pour les projets selon les besoins
?>
