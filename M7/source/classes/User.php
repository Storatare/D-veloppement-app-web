<?php
include_once 'service.php'; // Inclure la classe Service pour la gestion CSRF

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($nom, $prenom, $adresse, $email, $password, $confirmPassword) {
        $service = new Service();
        $service; #verifyCsrfToken(); // Vérification du jeton CSRF

        // Validation des données du formulaire
        $errors = $this->validateRegistrationForm($nom, $prenom, $adresse, $email, $password, $confirmPassword);

        if (!empty($errors)) {
            return $errors; // Retourner les erreurs s'il y en a
        }

        // Vérifier si l'email existe déjà
        $existingUser = $this->getUserByEmail($email);
        if ($existingUser) {
            return array('error' => 'email_exists');
        }

        // Enregistrer l'utilisateur dans la base de données
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = 2; // Par défaut, utilisateur normal
        $this->db->registerUser($nom, $prenom, $adresse, $email, $hashedPassword, $role);

        return true; // Enregistrement réussi
    }

    public function login($email, $password) {
        $service = new Service();
        $service; #verifyCsrfToken(); // Vérification du jeton CSRF

        // Récupérer les informations de l'utilisateur
        $user = $this->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // Connexion réussie, stocker l'ID de l'utilisateur en session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];

            return true; // Connexion réussie
        } else {
            return array('error' => 'wrong_email_password'); // Échec de connexion
        }
    }

    public function updateUserInfo($id, $nom, $prenom, $adresse, $email, $password, $confirmPassword) {
        $service = new Service();
        $service; #verifyCsrfToken(); // Vérification du jeton CSRF

        // Validation des données du formulaire
        $errors = $this->validateRegistrationForm($nom, $prenom, $adresse, $email, $password, $confirmPassword);

        if (!empty($errors)) {
            return $errors; // Retourner les erreurs s'il y en a
        }

        // Vérifier si l'email existe déjà
        $existingUser = $this->getUserByEmail($email);
        if ($existingUser && $existingUser['id'] !== $id) {
            return array('error' => 'email_exists');
        }

        // Mettre à jour les informations de l'utilisateur dans la base de données
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->db->updateUserInfo($id, $nom, $prenom, $adresse, $email, $hashedPassword);

        // Mettre à jour l'email de la session si nécessaire
        if ($_SESSION['email'] !== $email) {
            $_SESSION['email'] = $email;
        }

        return true; // Mise à jour réussie
    }

    public function closeAccount($id) {
        $service = new Service();
        $service; #verifyCsrfToken(); // Vérification du jeton CSRF

        // Supprimer le compte de l'utilisateur
        $this->db->closeAccount($id);

        // Détruire la session
        session_destroy();

        // Rediriger vers la page d'accueil
        header("Location: index.php");
        exit();
    }

    private function validateRegistrationForm($nom, $prenom, $adresse, $email, $password, $confirmPassword) {
        $errors = array();

        // Validation du nom et prénom
        if (!preg_match("/^[a-zA-Z\sàáâãäåèéêëìíîïòóôõöùúûüýÿç']+$/", $nom)) {
            $errors['nom'] = "Le nom n'est pas valide.";
        }

        if (!preg_match("/^[a-zA-Z\sàáâãäåèéêëìíîïòóôõöùúûüýÿç']+$/", $prenom)) {
            $errors['prenom'] = "Le prénom n'est pas valide.";
        }

        // Validation de l'adresse
        if (!preg_match("/^[a-zA-Z0-9\sàáâãäåèéêëìíîïòóôõöùúûüýÿç'-.,]+$/", $adresse)) {
            $errors['adresse'] = "L'adresse n'est pas valide.";
        }

        // Validation de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "L'adresse email n'est pas valide.";
        }

        // Validation du mot de passe
        if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
            $errors['password'] = "Le mot de passe doit avoir au moins 8 caractères et contenir au moins une lettre majuscule et un chiffre.";
        }

        // Validation de la confirmation du mot de passe
        if ($password !== $confirmPassword) {
            $errors['confirmPassword'] = "Les mots de passe ne correspondent pas.";
        }

        return $errors;
    }

    private function getUserByEmail($email) {
        return $this->db->getUserByEmail($email);
    }
}
?>
