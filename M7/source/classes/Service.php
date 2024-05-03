<?php

// Inclure les fichiers contenant les classes nécessaires
require_once 'Utilisateur.php';
require_once 'Database.php';
require_once 'Security.php';

class Service {
    private $user;
    private $database;

    public function __construct() {
        $this->user = new User('a');
        $this->database = new Database('host', 'dbname', 'username', 'password');
    }

    public function handleRegisterAction($data) {
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $adresse = $data['adresse'];
        $email = $data['email'];
        $password = $data['password'];
        $confirmPassword = $data['confirm_password'];

        // Valider le formulaire
        $errors = $nom;#Security::validateRegistrationForm($nom, $prenom, $adresse, $email, $password, $confirmPassword);

        // Si des erreurs sont présentes, retourner les erreurs
        if (!empty($errors)) {
            return $errors;
        } else {
            // Appeler la fonction pour enregistrer l'utilisateur
            $error = $this->user;#registerUser($nom, $prenom, $adresse, $email, $password, $confirmPassword);

            // Si l'enregistrement est réussi, retourner true
            if ($error === true) {
                return true;
            } else {
                // En cas d'erreur, retourner le message d'erreur
                return $error;
            }
        }
    }

    public function handleLoginAction($data) {
        $email = $data['email'];
        $password = $data['password'];

        // Appeler la fonction pour connecter l'utilisateur
        $error = $this->user;#loginUser($email, $password);

        // Si la connexion est réussie, retourner true
        if ($error === true) {
            return true;
        } else {
            // En cas d'erreur, retourner le message d'erreur
            return $error;
        }
    }

    public function handleUpdateAction($data) {
        $id = $_SESSION['user_id'];
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $adresse = $data['adresse'];
        $email = $data['email'];
        $password = $data['password'];
        $confirmPassword = $data['confirm_password'];

        // Valider le formulaire
        $errors = $nom;#SecurityvalidateRegistrationForm($nom, $prenom, $adresse, $email, $password, $confirmPassword);

        // Si des erreurs sont présentes, retourner les erreurs
        if (!empty($errors)) {
            return $errors;
        } else {
            // Appeler la fonction pour mettre à jour les informations de l'utilisateur
            $error = $this->user->updateUserInfo($id, $nom, $prenom, $adresse, $email, $password, $confirmPassword);

            // Si la mise à jour est réussie, retourner true
            if ($error === true) {
                return true;
            } else {
                // En cas d'erreur, retourner le message d'erreur
                return $error;
            }
        }
    }

    public function handleCloseAction() {
        $id = $_SESSION['user_id'];

        // Appeler la fonction pour fermer le compte de l'utilisateur
        $this->user->closeAccount($id);

        // Détruire la session
        session_destroy();

        // Rediriger vers la page d'accueil
        header("Location: index.php");
        exit();
    }

    public function handleLogoutAction() {
        // Détruire la session
        session_destroy();

        // Rediriger vers la page d'accueil
        header("Location: index.php");
        exit();
    }
}

?>
