<?php 
require_once __DIR__ . '/../models/PersonneModel.php';
require_once __DIR__ . '/../classes/Personne.php';

class PersonneController {
    private $personneModel;

    public function __construct($pdo) {
        $this->personneModel = new PersonneModel($pdo);
    }

    public function creerCompte($data) {

        // Créer une instance de Personne
        $personne = new Personne(
            $data['civilite'],
            $data['prenom'],
            $data['nom'],
            $data['login'],
            $data['email'],
            $data['telephone'],
            $data['mot_de_passe']
        );

        // Ajouter la personne via le modèle
        $this->personneModel->ajouterPersonne($personne);
    }

    public function seConnecter($login, $motDePasse) {
        // Récupérer l'utilisateur par login via le modèle
        $personne = $this->personneModel->getPersonneParLogin($login);
    
        if ($personne && password_verify($motDePasse, $personne->getMdp())) {
            // Initialiser la session ou mettre en place un indicateur de connexion
            session_start();
            $_SESSION['utilisateur'] = $personne->getLogin();
            return true;
        }
        return false;
    }

 }

