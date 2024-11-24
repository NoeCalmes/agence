<?php

require_once './controllers/VehiculeController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
    $controller = new VehiculeController();

    // Collecte des données du formulaire
 $data = [
    'id_vehicule' => $_POST['id_vehicule'],
    'marque' => $_POST['marque'],
    'modele' => $_POST['modele'],
    'matricule' => $_POST['matricule'],
    'type_vehicule' => $_POST['type_vehicule'],
    'prix_journalier' => $_POST['prix_journalier'],
    'statut_dispo' => $_POST['statut_dispo'],
    'photo' => isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK ? $_FILES['photo']['name'] : null,
];

$controller->modifierVehicule($data);

    // Redirection après la mise à jour
    header('Location: listeVehicules.php');
    exit;
}
?>
