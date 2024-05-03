# Documentation du Projet

Ce projet est une application de gestion d'utilisateurs avec des fonctionnalités telles que l'enregistrement, la connexion, la mise à jour des informations utilisateur, la fermeture de compte et la déconnexion, implémentées en utilisant la programmation orientée objet (POO) en PHP avec l'architecture Modèle-Vue-Contrôleur (MVC).

## Architecture du Projet

Le projet est structuré selon l'architecture MVC, avec les composants suivants :

1. **Modèles** :
   - **Utilisateur (`User.php`)** : Cette classe représente un utilisateur et contient des méthodes pour l'enregistrement, la connexion, la mise à jour et la fermeture de compte.
   - **Base de Données (`Database.php`)** : Cette classe gère les opérations de base de données telles que l'insertion, la sélection et la mise à jour des données d'utilisateur.

2. **Vues** :
   - Les vues sont des fichiers PHP qui affichent l'interface utilisateur. Ils sont inclus dans les contrôleurs pour générer la réponse HTML.

3. **Contrôleurs** :
   - **Contrôleur Principal (`Controller.php`)** : Cette classe gère les requêtes HTTP et appelle les méthodes appropriées des modèles en fonction de l'action demandée.
   - **Service (`Service.php`)** : Cette classe agit comme une couche intermédiaire entre le contrôleur et la classe Utilisateur. Elle traite les données reçues du contrôleur, appelle les méthodes appropriées du modèle et renvoie les résultats au contrôleur.
   - **Sécurité (`Security.php`)** : Cette classe contient des méthodes pour la validation des formulaires, la génération de jetons CSRF et d'autres fonctions de sécurité.

## Utilisation du Projet

Pour utiliser ce projet, vous devez inclure les fichiers des classes dans votre application PHP et configurer votre serveur web pour qu'il pointe vers le fichier d'entrée du contrôleur principal. Voici comment utiliser chaque fonctionnalité :

1. **Enregistrement d'Utilisateur** :
   - Soumettez le formulaire d'inscription à l'URL appropriée.
   - Le contrôleur détectera l'action "register" et appellera la méthode correspondante du service.
   - Le service validera les données, enregistrera l'utilisateur et renverra les résultats au contrôleur.

2. **Connexion d'Utilisateur** :
   - Soumettez le formulaire de connexion à l'URL appropriée.
   - Le contrôleur détectera l'action "login" et appellera la méthode correspondante du service.
   - Le service vérifiera les informations d'identification et renverra les résultats au contrôleur.

3. **Mise à Jour des Informations Utilisateur** :
   - Soumettez le formulaire de mise à jour à l'URL appropriée.
   - Le contrôleur détectera l'action "update" et appellera la méthode correspondante du service.
   - Le service validera les données, mettra à jour l'utilisateur et renverra les résultats au contrôleur.

4. **Fermeture de Compte Utilisateur** :
   - Accédez à l'URL appropriée pour fermer le compte.
   - Le contrôleur détectera l'action "close" et appellera la méthode correspondante du service.
   - Le service fermera le compte et détruira la session de l'utilisateur.

5. **Déconnexion d'Utilisateur** :
   - Accédez à l'URL appropriée pour déconnecter l'utilisateur.
   - Le contrôleur détectera l'action "logout" et appellera la méthode correspondante du service.
   - Le service détruira la session de l'utilisateur.

## Développement et Contributions

Ce projet est ouvert aux contributions. Si vous souhaitez contribuer, veuillez créer une nouvelle branche, apporter vos modifications et soumettre une demande d'extraction. Assurez-vous de suivre les conventions de codage et d'ajouter des tests si nécessaire.
