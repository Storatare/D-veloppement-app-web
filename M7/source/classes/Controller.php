<?php

class Controller {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function handleRequest() {
        try {
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                switch ($action) {
                    case 'register':
                        $this->handleRegisterAction();
                        break;
                    case 'login':
                        $this->handleLoginAction();
                        break;
                    case 'dashboard':
                        $this->handleDashboardAction();
                        break;
                    case 'update':
                        $this->handleUpdateAction();
                        break;
                    case 'close':
                        $this->handleCloseAction();
                        break;
                    case 'logout':
                        $this->handleLogoutAction();
                        break;
                    default:
                        $this->includeTemplate('home');
                        break;
                }
            } else {
                $this->includeTemplate('home');
            }
        } catch (Exception $e) {
            $this->includeTemplate('error', ['error_message' => $e->getMessage()]);
        }
    }

    private function handleRegisterAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrfToken();
            $nom = $this->sanitizeInput($_POST['nom']);
            $prenom = $this->sanitizeInput($_POST['prenom']);
            $adresse = $this->sanitizeInput($_POST['adresse']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            $errors = $this->validateRegistrationForm($nom, $prenom, $adresse, $email, $password, $confirmPassword);

            if (!empty($errors)) {
                $data['errors'] = $errors;
                $this->includeTemplate('register', $data);
            } else {
                $error = $this->db->registerUser($nom, $prenom, $adresse, $email, $password, $confirmPassword);

                if ($error === true) {
                    header("Location: index.php?action=login");
                    exit();
                } else {
                    $data['error'] = $error;
                    $this->includeTemplate('register', $data);
                }
            }
        } else {
            $this->includeTemplate('register');
        }
    }

    private function handleLoginAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->verifyCsrfToken();
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            $error = $this->db->loginUser($email, $password);

            if ($error === true) {
                header("Location: index.php?action=dashboard");
                exit();
            } else {
                $data['error'] = $error;
                $this->includeTemplate('login', $data);
            }
        } else {
            $this->includeTemplate('login');
        }
    }

    private function handleDashboardAction() {
        if (!$this->isLoggedIn()) {
            header("Location: index.php?action=login");
            exit();
        }

        $userId = $_SESSION['user_id'];
        $user = $this->db->getUserById($userId);

        $data['user'] = $user;
        $this->includeTemplate('dashboard', $data);
    }

    private function handleUpdateAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->isLoggedIn()) {
                header("Location: index.php?action=login");
                exit();
            }

            $this->verifyCsrfToken();

            $userId = $_SESSION['user_id'];

            $nom = $this->sanitizeInput($_POST['nom']);
            $prenom = $this->sanitizeInput($_POST['prenom']);
            $adresse = $this->sanitizeInput($_POST['adresse']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            $errors = $this->validateRegistrationForm($nom, $prenom, $adresse, $email, $password, $confirmPassword);

            if (!empty($errors)) {
                $data['errors'] = $errors;
                $this->includeTemplate('update', $data);
                return;
            }

            try {
                $this->db->updateUserInfo($userId, $nom, $prenom, $adresse, $email, $password, $confirmPassword);
                header("Location: index.php?action=dashboard");
                exit();
            } catch (Exception $e) {
                $this->showError("Erreur lors de la mise à jour des informations de l'utilisateur : " . $e->getMessage());
            }
        } else {
            $this->includeTemplate('update');
        }
    }

    private function handleCloseAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->isLoggedIn()) {
                header("Location: index.php?action=login");
                exit();
            }

            $this->verifyCsrfToken();

            $userId = $_SESSION['user_id'];

            try {
                $this->db->closeAccount($userId);
                session_destroy();
                header("Location: index.php");
                exit();
            } catch (Exception $e) {
                $this->showError("Erreur lors de la fermeture du compte de l'utilisateur : " . $e->getMessage());
            }
        } else {
            header("Location: index.php");
            exit();
        }
    }

    private function handleLogoutAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_destroy();
            header("Location: index.php");
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    }

    private function includeTemplate($template, $data = []) {
        extract($data);
        include_once "templates/$template.php";
    }

    private function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    private function verifyCsrfToken() {
        // Vérifier si le jeton CSRF est présent dans la requête POST
        if (!isset($_POST['csrf_token'])) {
            throw new Exception("Erreur CSRF : jeton CSRF manquant dans la requête.");
        }
    
        // Récupérer le jeton CSRF envoyé par le formulaire
        $clientToken = $_POST['csrf_token'];
    
        // Récupérer le jeton CSRF stocké dans la session
        $serverToken = isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : null;
    
        // Comparer les jetons CSRF
        if ($clientToken !== $serverToken) {
            throw new Exception("Erreur CSRF : jeton CSRF invalide.");
        }
    }
    

    private function showError($message) {
        // Afficher le message d'erreur
        echo "<p>Erreur : $message</p>";
    }
    

    private function sanitizeInput($input) {
        // Nettoyer les données d'entrée
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
    

    private function validateRegistrationForm($nom, $prenom, $adresse, $email, $password, $confirmPassword) {
        $errors = [];
    
        // Vérifier si les champs obligatoires sont vides
        if (empty($nom)) {
            $errors['nom'] = "Le nom est requis.";
        }
        if (empty($prenom)) {
            $errors['prenom'] = "Le prénom est requis.";
        }
        if (empty($adresse)) {
            $errors['adresse'] = "L'adresse est requise.";
        }
        if (empty($email)) {
            $errors['email'] = "L'email est requis.";
        }
        if (empty($password)) {
            $errors['password'] = "Le mot de passe est requis.";
        }
        if (empty($confirmPassword)) {
            $errors['confirmPassword'] = "La confirmation du mot de passe est requise.";
        }
    
        // Vérifier si les mots de passe correspondent
        if ($password !== $confirmPassword) {
            $errors['confirmPassword'] = "Les mots de passe ne correspondent pas.";
        }
    
        // Vous pouvez ajouter d'autres validations ici selon vos besoins
    
        return $errors;
    }
    
}

?>
