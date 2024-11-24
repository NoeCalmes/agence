<?php
require_once './controllers/VehiculeController.php';

$controller = new VehiculeController();

// Gestion de la recherche
$filtre = $_GET['filtre'] ?? '';
$vehicules = $controller->afficherVehicules();

if ($filtre) {
    $vehicules = array_filter($vehicules, function ($vehicule) use ($filtre) {
        return stripos($vehicule['marque'], $filtre) !== false ||
            stripos($vehicule['modele'], $filtre) !== false ||
            stripos($vehicule['type_vehicule'], $filtre) !== false;
    });
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    try {
        $controller->ajouterVehicule($_POST);
        header('Location: listeVehicules.php?message=vehicule_ajoute');
        exit;
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
if (isset($_GET['message']) && $_GET['message'] === 'vehicule_ajoute') {
    echo '<div class="alert alert-success">Véhicule ajouté avec succès.</div>';
}

// Suppression d'un véhicule
if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $controller->supprimerVehicule($id);
    header('Location: listeVehicules.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Véhicules</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="container mt-5">

    <?php
    include './header.html'; ?>

    <h1 class="mt-5 mb-4">Liste des Véhicules Disponibles</h1>

    <!-- Formulaire de recherche -->
    <form method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-10">
                <input type="text" name="filtre" class="form-control"
                    placeholder="Rechercher par marque, modèle ou type" value="<?= htmlspecialchars($filtre) ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Rechercher</button>
            </div>
        </div>
    </form>

    <!-- Tableau des véhicules -->
    <table class="table table-bordered table-striped mb-4">
        <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Immatriculation</th>
                <th>Type</th>
                <th>Prix par jour (€)</th>
                <th>Disponibilité</th>
                <th>Supprimer</th>
                <th>Modifier</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($vehicules)): ?>
                <?php foreach ($vehicules as $vehicule): ?>
                    <tr>
                        <td>
                            <?php if ($vehicule['photo']): ?>
                                <img src="./public/img/vehicules/<?= htmlspecialchars($vehicule['photo']) ?>"
                                    alt="Image du véhicule" style="width: 100px; height: auto;">
                            <?php else: ?>
                                <span>Aucune image</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($vehicule['marque']) ?></td>
                        <td><?= htmlspecialchars($vehicule['modele']) ?></td>
                        <td><?= htmlspecialchars($vehicule['matricule']) ?></td>
                        <td><?= htmlspecialchars($vehicule['type_vehicule']) ?></td>
                        <td><?= number_format($vehicule['prix_journalier'], 0, ',', ' ') ?></td>

                        <td>
                            <?= $vehicule['statut_dispo'] ? '<span class="text-success">Disponible</span>' : '<span class="text-danger">Indisponible</span>' ?>
                        </td>
                        <td>
                            <a href="?action=supprimer&id=<?= $vehicule['id_vehicule'] ?>" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modifierVehiculeModal<?= $vehicule['id_vehicule'] ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </td>
                    </tr>

                  <!-- Modal de modification -->
<div class="modal fade" id="modifierVehiculeModal<?= $vehicule['id_vehicule'] ?>" tabindex="-1"
    aria-labelledby="modifierVehiculeLabel<?= $vehicule['id_vehicule'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifierVehiculeLabel<?= $vehicule['id_vehicule'] ?>">Modifier le Véhicule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="modifierVehicule.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_vehicule" value="<?= htmlspecialchars($vehicule['id_vehicule']) ?>">
                    <div class="mb-3">
                        <label for="marque" class="form-label">Marque</label>
                        <input type="text" class="form-control" name="marque" value="<?= htmlspecialchars($vehicule['marque']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="modele" class="form-label">Modèle</label>
                        <input type="text" class="form-control" name="modele" value="<?= htmlspecialchars($vehicule['modele']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="matricule" class="form-label">Immatriculation</label>
                        <input type="text" class="form-control" name="matricule" value="<?= htmlspecialchars($vehicule['matricule']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="type_vehicule" class="form-label">Type de Véhicule</label>
                        <input type="text" class="form-control" name="type_vehicule" value="<?= htmlspecialchars($vehicule['type_vehicule']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="prix_journalier" class="form-label">Prix par jour (€)</label>
                        <input type="number" step="0.01" class="form-control" name="prix_journalier" value="<?= htmlspecialchars($vehicule['prix_journalier']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="statut_dispo" class="form-label">Disponibilité</label>
                        <select class="form-control" name="statut_dispo" required>
                            <option value="1" <?= $vehicule['statut_dispo'] == 1 ? 'selected' : '' ?>>Disponible</option>
                            <option value="0" <?= $vehicule['statut_dispo'] == 0 ? 'selected' : '' ?>>Indisponible</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo">
                        <input type="hidden" name="photo_actuelle" value="<?= htmlspecialchars($vehicule['photo']) ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" name="modifier" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div

                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" class="text-center">Aucun véhicule ne correspond à votre recherche.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <hr>
    <!-- Formulaire d'ajout d'un véhicule -->
    <h2 class="mt-2 mb-4">Ajouter un Nouveau Véhicule</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="marque" class="form-control" placeholder="Marque" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="modele" class="form-control" placeholder="Modèle" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <input type="text" name="matricule" class="form-control" placeholder="Immatriculation" required>
            </div>
            <div class="col-md-6">
                <input type="number" name="prix_journalier" class="form-control" placeholder="Prix par jour (€)"
                    step="1" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <input type="text" name="type_vehicule" class="form-control" placeholder="Type de véhicule" required>
            </div>
            <div class="col-md-6">
                <input type="file" name="photo" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label for="statut_dispo" class="form-label">Disponibilité</label>
                <select name="statut_dispo" class="form-control">
                    <option value="1">Disponible</option>
                    <option value="0">Indisponible</option>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" name="ajouter" class="btn btn-success w-100">Ajouter le Véhicule</button>
            </div>
        </div>
    </form>


</body>

</html>