<?php


require_once './classes/Database.php'; 
require_once './controllers/PersonneController.php'; 
require_once './models/PersonneModel.php'; 
require_once './classes/Personne.php';

// Connexion à la base de données
$database = new Database();
$pdo = $database->connect();

$error = null;

// Traitement du formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        
        $controller = new PersonneController($pdo);

        // Collecter les données du formulaire
        $data = [
            'civilite' => $_POST['civilite'],
            'prenom' => $_POST['prenom'],
            'nom' => $_POST['nom'],
            'login' => $_POST['login'],
            'email' => $_POST['email'],
            'telephone' => $_POST['telephone'],
            'mot_de_passe' => $_POST['mot_de_passe'],
        ];

        // Appeler la méthode de création de compte
        $controller->creerCompte($data);

        // Rediriger après la création de compte réussie
        header('Location: home.php');
        exit;

    } catch (Exception $e) {
        $error = "Erreur : " . $e->getMessage();
    }
}



