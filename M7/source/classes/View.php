<?php
class View {
    public static function render($template, $data = array()) {
        // Logique pour afficher une vue HTML avec des données
        extract($data);
        include_once 'templates/' . $template . '.php';
    }
}
?>