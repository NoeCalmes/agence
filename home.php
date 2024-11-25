<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
     <?php
    include './header.php';

    session_start();
    if (isset($_SESSION['login'])) {
        echo "Vous êtes connecté en tant que : " . $_SESSION['login'];
    } else {
        echo "Aucune session utilisateur active.";
    }
    if (isset($_SESSION['message'])) {
        echo "<script>alert('" . htmlspecialchars($_SESSION['message']) . "');</script>";
        // Supprimer le message de la session pour éviter de l'afficher à chaque rafraîchissement de la page
        unset($_SESSION['message']);
    }
    ?> 
    
    <div class="container mt-5">
        <h1>Bienvenue sur la page d'accueil</h1>

     <h1 class="text-center mt-5">Bienvenue dans l'agence</h1>
    <img src="public/img/bienvenu.jpg" alt="" class="mx-auto d-block">
    
</body>
</html>