<?php

class Database {
    private $pdo;

    public function __construct($host, $dbname, $username, $password) {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function registerUser($nom, $prenom, $adresse, $email, $hashedPassword, $role) {
        $stmt = $this->pdo->prepare("INSERT INTO users (nom, prenom, adresse, email, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $adresse, $email, $hashedPassword, $role]);
    }

    public function updateUserInfo($id, $nom, $prenom, $adresse, $email, $hashedPassword) {
        $stmt = $this->pdo->prepare("UPDATE users SET nom = ?, prenom = ?, adresse = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$nom, $prenom, $adresse, $email, $hashedPassword, $id]);
    }

    public function closeAccount($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
