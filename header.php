<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand">Agence de Location</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./home.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./listeVehicules.php">Modification Véhicules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./listePersonne.php">Modification Utilisateur</a>
                    </li>

                    <li class="nav-item">
                        <form action="logout.php" method="POST" style="display: inline;">
                            <button type="submit" name="deconnexion" class="btn btn-link nav-link" style="text-decoration: none;">Déconnexion</button>
                        </form>
                    </li>
 
                </ul>
            </div>
        </div>
    </nav>
</header>
