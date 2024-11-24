<?php
require_once './classes/Database.php';
require_once './controllers/PersonneController.php';

$database = new Database();
$pdo = $database->connect();
$controller = new PersonneController($pdo);

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connexion'])) {
    $login = $_POST['login'];
    $motDePasse = $_POST['mot_de_passe'];

    try {
        if ($controller->seConnecter($login, $motDePasse)) {
            // Rediriger vers la page d'accueil après une connexion réussie
            header('Location: home.php');
            exit;
        } else {
            $error = "Login ou mot de passe incorrect.";
        }
    } catch (Exception $e) {
        $error = "Erreur : " . $e->getMessage();
    }
}
