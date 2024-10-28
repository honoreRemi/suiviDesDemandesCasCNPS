<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Massack honore remi, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.115.4">
    <title>Liste des demandes refusées</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-fixed/">
</head>

<body>
    <form class="d-flex" action="../../Controler/utilisateur/DG/confirmer.DG.user.ctrl.php" method="post">
        <!-- <img class="mb-4" src="../../../public/images/CNPSlogo.jpeg" alt="" width="200" height="57"> -->
    </form>

    <main class="container">
        <div class="bg-info p-1 rounded">
            <h2>Liste des demandes refusées</h2>
            <div class="table-responsive small">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">Description</th>
                            <th scope="col">School_certificat</th>
                            <th scope="col">C V</th>
                            <th scope="col">Motivation</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Decision</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Récupérer la connexion à la base de données
                        require dirname(__DIR__) . '../../Models/databaseConnexion.php';

                        $req = $pdo->prepare('SELECT * FROM demande WHERE confirm = -1');
                        $req->execute();
                        $donnees = $req->fetchAll(PDO::FETCH_ASSOC);

                        if (count($donnees) == 0) {
                            echo '<tr><td colspan="8">Aucune demande trouvée dans la base de données</td></tr>';
                        } else {
                            foreach ($donnees as $row) {
                        ?>
                                <tr>
                                    <td><?= $row['titre'] ?></td>
                                    <td><?= $row['description'] ?></td>
                                    <td><?= $row['image'] ?></td>
                                    <td><?= $row['cv'] ?></td>
                                    <td><?= $row['motivation'] ?></td>
                                    <td>
                                        <?php if ($row['confirm'] === null) : ?>
                                            <button class="btn btn-primary" name="EnAttente">En_Attente</button>
                                        <?php elseif ($row['confirm'] == 1) : ?>
                                            <button class="btn btn-success" name="Accepter">Acceptée</button>
                                        <?php else : ?>
                                            <button class="btn btn-danger" name="Refuser">Refusée</button>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if (isset($row['confirm']) && $row['confirm'] == 1) : ?>
                                            <a href="../SFR/traiterDemande.view.SFR.php?id=<?= $row['id'] ?>" class="d-inline-block"><button type="button" class="btn btn-outline-primary">Decision</button></a>
                                        <?php else : ?>
                                            <a href="#?id=<?= $row['id'] ?>" class="d-inline-block"><button type="button" class="btn btn-outline-primary">Decision</button></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>