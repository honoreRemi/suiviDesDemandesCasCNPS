<!doctype html>
<html lang="en" data-bs-theme="auto">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="Massack honore remi, and Bootstrap contributors">
<meta name="generator" content="Hugo 0.115.4">
<title>Liste des stagiaires</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

<link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-fixed/">

</head>

<body>
    <!-- <form class="d-flex" action="../../Controler/utilisateur/DG/confirmer.DG.user.ctrl.php" method="post">
      <img class="mb-4" src="../../../public/images/CNPSlogo.jpeg" alt="" width="200  " height="57">
    </form> -->

  <main class="container">
    <div class="bg-info p-1 rounded">
      <h2>Liste des stagiaires</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Nom</th>
              <th scope="col">Prenom</th>
              <th scope="col">Etablissement</th>
              <th scope="col">Filière</th>
              <th scope="col">Type_Stage</th>
              <th scope="col">Date_Debut</th>
              <th scope="col">Date_Fin</th>
              <th scope="col">Durée</th>
              <th scope="col">Decision</th>
            </tr>
          </thead>
          <tbody>
            <tr>

              <?php
              //recuperer la connexion a labase de donnee
              require dirname(__DIR__) . '../../Models/databaseConnexion.php';

              $req = $pdo->prepare('SELECT * FROM demandeur where filière = "GL"');
              $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
              $req->execute();
              foreach ($donnees as $row) {
                echo $row['nom'];
              }
              if ($req->RowCount() == 0) {
                echo '  aucun utilisateur retrouver dans la base de deonnée';
              } else {
                while ($donnees = $req->fetch()) {
              ?>
            <tr>
              <td><?= $donnees['nom'] ?></td>
              <td><?= $donnees['prenom'] ?></td>
              <td><?= $donnees['établissement'] ?></td>
              <td><?= $donnees['filière'] ?></td>
              <td><?= $donnees['typeStage'] ?></td>
              <td><?= $donnees['dateDebut'] ?></td>
              <td><?= $donnees['dateFin'] ?></td>
              <td><?= $donnees['durée'] ?></td>
              
              <!-- <td class="btn btn-success rounded-pill px-1" name="Accepter">Accepter</td>
              <td class="btn btn-warning rounded-pill px-1" name="Encours">Encours</td>
              <td class="btn btn-danger rounded-pill px-1" name="Refuser">Refuser</td> -->
              <td>
              <a href="decision.view.dsi.php?id=<?= $donnees['id'] ?>" class="d-inline-block"><button type="button" class="btn btn-outline-primary">Decision</button></a>
              </td>
            </tr>
        <?php
                }
              }
        ?>

          </tbody>
        </table>
      </div>
  </main>
  </div>
  </div>
  </div>
  </main>
</body>

</html>