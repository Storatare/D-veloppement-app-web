<?php

class Error {
    public static function handleException($exception) {
        // Logique de gestion des exceptions
        $error_message = $exception->getMessage();
        require_once 'templates/error.php';
    }
}

?>