<?php session_start(); ?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="Massack honore remi, and Bootstrap contributors">
<meta name="generator" content="Hugo 0.115.4">
<title>statut des demandes</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

<link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-fixed/">

</head>

<body>

    <form class="d-flex" action="../../Controler/utilisateur/DG/confirmer.DG.user.ctrl.php" method="post">
      <img class="mb-4" src="../../../public/images/CNPSlogo.jpeg" alt="" width="200  " height="57">
    </form>
    

  <main class="container">
    <div class="bg-primary p-1 rounded">
      <h2>Liste de toutes les demandes</h2>
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
            <tr>

              <?php
              //recuperer la connexion a labase de donnee
              require dirname(__DIR__) . '../../Models/databaseConnexion.php';

              $req = $pdo->prepare('SELECT * FROM demande');
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
              <td><?= $donnees['titre'] ?></td>
              <td><?= $donnees['description'] ?></td>
              <td><?= $donnees['image'] ?></td>
              <td><?= $donnees['cv'] ?></td>
              <td><?= $donnees['motivation'] ?></td>
              <td>
                <?php if ($donnees['confirm'] === null) : ?>
                  <button class="btn btn-primary" name="EnAttente">En_Attente</button>
                <?php elseif ($donnees['confirm'] == 1) : ?>
                  <button class="btn btn-success" name="Accepter">Accepter</button>
                <?php else : ?>
                  <button class="btn btn-danger" name="Refuser">Refuser</button>
                <?php endif; ?>
              </td>
              <!-- <td class="btn btn-success rounded-pill px-1" name="Accepter">Accepter</td>
              <td class="btn btn-warning rounded-pill px-1" name="Encours">Encours</td>
              <td class="btn btn-danger rounded-pill px-1" name="Refuser">Refuser</td> -->

              <td>
                <a href="../DSI/decision.view.dsi.php?id=<?= $donnees['id'] ?>" class="d-inline-block"><button type="button" class="btn btn-outline-primary">Decision</button></a>
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