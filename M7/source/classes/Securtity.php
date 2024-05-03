<?php
class Security {
    public static function sanitizeInput($input) {
        // Logique de désinfection des données d'entrée
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    public static function verifyCsrfToken($token) {
        // Logique de vérification du jeton CSRF
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $token) {
            throw new Exception("Erreur CSRF token. Les jetons ne correspondent pas.");
        }
    }

    public static function generateCsrfToken() {
        // Logique de génération du jeton CSRF
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}
?>
