<?php 
class PersonneModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function ajouterPersonne(Personne $personne) {
        // Construire la requête SQL
        $sql = "INSERT INTO personne (civilite, prenom, nom, login, email, tel, mdp, role) 
                VALUES (:civilite, :prenom, :nom, :login, :email, :tel, :mdp, :role)";
        $stmt = $this->pdo->prepare($sql);
        
        // Hachage du mot de passe
        $hashedPassword = password_hash($personne->getMdp(), PASSWORD_BCRYPT);
        
        // Exécuter la requête
        return $stmt->execute([
            'civilite' => $personne->getCivilite(),
            'prenom' => $personne->getPrenom(),
            'nom' => $personne->getNom(),
            'login' => $personne->getLogin(),
            'email' => $personne->getEmail(),
            'tel' => $personne->getTelephone(),
            'mdp' => $hashedPassword,
            'role' => $personne->getRole()
        ]);
    }


    public function getPersonneParLogin($login) {
        $sql = "SELECT * FROM personne WHERE login = :login";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['login' => $login]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            // Créer une instance de Personne avec les données récupérées
            return new Personne(
                $result['civilite'],
                $result['prenom'],
                $result['nom'],
                $result['login'],
                $result['email'],
                $result['tel'],
                $result['mdp'],
                $result['role']
            );
        }
    
        return null;
    }
    
}