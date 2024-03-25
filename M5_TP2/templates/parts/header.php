<?php
 // Démarrer la session (si elle n'est pas déjà active)
     if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./templates/assets/css/style.css">
    <script src="./templates/assets/js/main.js"></script>
    <title>Gestion d'utilisateur</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <div class="logo">
                    <img src="templates\assets\img\logo.png" alt="Logo">
                </div>
                <li>PORTFOLIO</li>
                <li><a class = "underline-link" href="index.php">Accueil</a></li>
                <?php
                    // Si l'utilisateur n'est pas connecté, afficher les liens d'inscription et de connexion
                    if (!isset($_SESSION['user_id'])) {
                        echo '<li><a class = "underline-link" href="index.php?action=register">Inscription</a></li>';
                        echo '<li><a class = "underline-link" href="index.php?action=login">Connexion</a></li>';
                    } else {
                        // Si l'utilisateur est connecté, afficher les liens du tableau de bord et de déconnexion
                        echo '<li><a class = "underline-link" href="index.php?action=dashboard">Tableau de bord</a></li>';
                        echo '<li><a class = "underline-link" href="index.php?action=update">Modifier mes informations</a></li>';
                        echo '<li><a class = "underline-link" href="index.php?action=logout">Déconnexion</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </header>
<?php