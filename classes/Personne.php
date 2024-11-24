<?php

// Classe Personne
class Personne {
    private $civilite;
    private $prenom;
    private $nom;
    private $login;
    private $email;
    private $telephone;
    private $mdp;
    private $role;
    
    public function __construct($civilite, $prenom, $nom, $login, $email, $telephone, $mdp, $role = 'Client') {
        $this->civilite = $civilite;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->login = $login;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->mdp = $mdp;
        $this->role = $role;
    }

    // Getters
    public function getCivilite() {
        return $this->civilite;
    }
    public function getPrenom() {
        return $this->prenom;
    }
    public function getNom() {
        return $this->nom;
    }
    public function getLogin() {
        return $this->login;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getTelephone() {
        return $this->telephone;
    }
    public function getMdp() {
        return $this->mdp;
    }
    public function getRole() {
        return $this->role;
    }
}