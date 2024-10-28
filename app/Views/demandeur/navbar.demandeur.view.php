<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Ma-demande</title>
    <style>
        .main-content {
            margin-top: 20px;
        }
    </style>
</head>

<body>
<table>
    <?php
    session_start();
    // Récupérer la connexion à la base de données
    require dirname(__DIR__) . '../..//Models/databaseConnexion.php';

    // Utilisez cette ligne pour récupérer l'ID de l'utilisateur connecté
    $userId = $_SESSION['demandeur_id'] ?? null; 

    if ($userId) {
        // Préparer la requête pour récupérer le demandeur avec l'ID spécifique
        $req = $pdo->prepare('SELECT * FROM demandeur WHERE id = ?');
        $req->execute([$userId]); // Passez l'ID de l'utilisateur ici

        $donnees = $req->fetchAll(PDO::FETCH_ASSOC); // Récupérer toutes les données

        if (count($donnees) == 0) {
            echo 'Aucun demandeur trouvé avec cet ID.';
        } else {
            foreach ($donnees as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
                echo "</tr>";
            }
        }
    } else {
        echo 'Aucun utilisateur connecté.';
    }
    ?>
</table>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <img class="d-block mx-auto" src="../../../public/images/logoCnpsBon.jpg" alt="" width="200" height="57">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="navbar.demandeur.view.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="navbar.demandeur.view.php?file=statutDemande.views.demandeur.php"><i class="fas fa-file-alt"></i> Statut Demande</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="navbar.demandeur.view.php?file=envoyerDemande.views.demandeur.php" tabindex="-1" aria-disabled="true"><i class="fas fa-paper-plane"></i> Envoyer Ma Demande</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="navbar.demandeur.view.php?file=laisserCommentaire.demandeur.views.php" tabindex="-1" aria-disabled="true"><i class="fas fa-comments"></i> Laisser un avis</a>
                    </li>
                </ul>
                <form action="../../Controler/login.cntrl.php" method="post" class="form-inline my-2 my-lg-0 justify-content-end" style="display: flex; align-items: center;">
                    <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" style="width: 100px;">
                    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>

                    <button type="submit" value="Déconnexion" name="Déconnexion" class="btn btn-primary">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>
    </nav>

    <div class="container main-content">
        <?php
        $file = isset($_GET['file']) ? $_GET['file'] : NULL;
        if ($file) {
            include $file;
        }
        ?>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>