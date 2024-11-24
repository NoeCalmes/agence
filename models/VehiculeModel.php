<?php
require_once __DIR__ . '/../classes/Database.php';

class VehiculeModel {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->connect();
    }


    public function supprimerVehicule($id) {
        $sql = "DELETE FROM vehicule WHERE id_vehicule = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
    
    public function listerVehicules() {
        $sql = "SELECT * FROM vehicule";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function estMatriculeExistant($matricule) {
        $sql = "SELECT COUNT(*) FROM vehicule WHERE matricule = :matricule";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['matricule' => $matricule]);
        return $stmt->fetchColumn() > 0;
    }

    public function ajouterVehicule(Vehicule $vehicule) {
        $sql = "INSERT INTO vehicule (marque, modele, matricule, prix_journalier, type_vehicule, statut_dispo, photo)
        VALUES (:marque, :modele, :matricule, :prix_journalier, :type_vehicule, :statut_dispo, :photo)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'marque' => $vehicule->getMarque(),
            'modele' => $vehicule->getModele(),
            'matricule' => $vehicule->getMatricule(),
            'prix_journalier' => $vehicule->getPrixJournalier(),
            'type_vehicule' => $vehicule->getTypeVehicule(),
            'statut_dispo' => $vehicule->getStatutDispo(),
            'photo' => $vehicule->getPhoto()
        ]);            
    }
    
    public function modifierVehicule(Vehicule $vehicule) {
        $sql = "UPDATE vehicule 
                SET marque = :marque, modele = :modele, matricule = :matricule, 
                    prix_journalier = :prix_journalier, type_vehicule = :type_vehicule, 
                    statut_dispo = :statut_dispo, photo = :photo 
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'marque' => $vehicule->getMarque(),
            'modele' => $vehicule->getModele(),
            'matricule' => $vehicule->getMatricule(),
            'prix_journalier' => $vehicule->getPrixJournalier(),
            'type_vehicule' => $vehicule->getTypeVehicule(),
            'statut_dispo' => $vehicule->getStatutDispo(),
            'photo' => $vehicule->getPhoto(),
            'id' => $vehicule->getId()
        ]);
    }

public function updateVehicule($data) {
    // Construire la requête SQL de base
    $sql = "UPDATE vehicule SET 
                marque = :marque,
                modele = :modele,
                matricule = :matricule,
                type_vehicule = :type_vehicule,
                prix_journalier = :prix_journalier,
                statut_dispo = :statut_dispo";

    // Ajouter la mise à jour de la photo seulement si elle est fournie
    if (!empty($data['photo'])) {
        $sql .= ", photo = :photo";
    }

    $sql .= " WHERE id_vehicule = :id_vehicule";

    // Préparer la requête
    $stmt = $this->pdo->prepare($sql);

    // Associer les valeurs
    $stmt->bindValue(':marque', $data['marque']);
    $stmt->bindValue(':modele', $data['modele']);
    $stmt->bindValue(':matricule', $data['matricule']);
    $stmt->bindValue(':type_vehicule', $data['type_vehicule']);
    $stmt->bindValue(':prix_journalier', $data['prix_journalier']);
    $stmt->bindValue(':statut_dispo', $data['statut_dispo']);
    $stmt->bindValue(':id_vehicule', $data['id_vehicule']);

    // Associer la valeur de la photo seulement si elle est présente
    if (!empty($data['photo'])) {
        $stmt->bindValue(':photo', $data['photo']);
    }

    // Exécuter la requête
    return $stmt->execute();
}


 

    
}
