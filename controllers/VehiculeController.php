<?php
require_once __DIR__ . '/../models/VehiculeModel.php';
require_once __DIR__ . '/../classes/Vehicule.php';

class VehiculeController
{
    private $vehiculeModel;

    public function __construct()
    {
        $this->vehiculeModel = new VehiculeModel();
    }

    public function afficherVehicules()
    {
        return $this->vehiculeModel->listerVehicules();
    }

    public function supprimerVehicule($id)
    {
        $this->vehiculeModel->supprimerVehicule($id);
    }

    public function modifierVehicule($data)
    {
        return $this->vehiculeModel->updateVehicule($data);
    }


    public function ajouterVehicule($data)
    {
        // Vérifier si le matricule existe déjà
        if ($this->vehiculeModel->estMatriculeExistant($data['matricule'])) {
            throw new Exception("Le matricule existe déjà, veuillez en choisir un autre.");
        }

        // Vérifie si un fichier a été envoyé et assigne la valeur à $photo
        $photo = null;
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $photo = $_FILES['photo']['name']; // Nom du fichier
            move_uploaded_file($_FILES['photo']['tmp_name'], 'public/img/vehicules/' . $photo); // Déplace le fichier téléchargé
        }

        // Récupérer le statut de disponibilité depuis le formulaire
        $statutDispo = isset($data['statut_dispo']) ? $data['statut_dispo'] : 1;

        // Crée un nouvel objet Vehicule
        $vehicule = new Vehicule(
            $data['marque'],
            $data['modele'],
            $data['matricule'],
            $data['prix_journalier'],
            $data['type_vehicule'],
            $statutDispo,
            $photo
        );

        // Ajoute le véhicule via le modèle
        $this->vehiculeModel->ajouterVehicule($vehicule);
    }





}
