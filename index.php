<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</head>

<body>


    <div class="container mt-5">
        <div class="row">
            <!-- Formulaire de création de compte -->
            <div class="col-md-6">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Créer un Compte</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="creerCompte.php">
                            <div class="mb-3">
                                <label for="civilite" class="form-label">Civilité :</label>
                                <select class="form-control" name="civilite" required>
                                    <option value="Mr">Mr</option>
                                    <option value="Mme">Mme</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom :</label>
                                <input type="text" class="form-control" name="prenom" placeholder="Votre prénom"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom :</label>
                                <input type="text" class="form-control" name="nom" placeholder="Votre nom" required>
                            </div>
                            <div class="mb-3">
                                <label for="login" class="form-label">Login :</label>
                                <input type="text" class="form-control" name="login" placeholder="Choisissez un login"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email :</label>
                                <input type="email" class="form-control" name="email" placeholder="Votre adresse email"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="telephone" class="form-label">Téléphone :</label>
                                <input type="tel" class="form-control" name="telephone"
                                    placeholder="Votre numéro de téléphone" required>
                            </div>
                            <div class="mb-3">
                                <label for="mot_de_passe" class="form-label">Mot de Passe :</label>
                                <input type="password" class="form-control" name="mot_de_passe"
                                    placeholder="Choisissez un mot de passe" 
                                    pattern="(?=.*[A-Z])(?=.*[a-z]).{12,}" 
                                    title="Le mot de passe doit comporter au moins 12 caractères, dont une majuscule." 
                                    required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Créer le Compte</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Formulaire de connexion -->

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h4>Connexion</h4>
                    </div>
                    <div class="card-body">
                         <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="login" class="form-label">Login :</label>
                        <input type="text" class="form-control" name="login" placeholder="Votre login" required>
                    </div>
                    <div class="mb-3">
                        <label for="mot_de_passe" class="form-label">Mot de Passe :</label>
                        <input type="password" class="form-control" name="mot_de_passe" placeholder="Votre mot de passe" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="connexion" class="btn btn-success">Se Connecter</button>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>