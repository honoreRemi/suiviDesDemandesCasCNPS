<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="MASSACK Honore Remi, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.115.4">
  <title>Demandes archivées</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-fixed/">
</head>

<body>

  <!-- <img class="mb-4" src="../../../public/images/logoCnpsBon.jpg" alt="" width="200" height="57"> -->
  <main class="container">
    <div class="bg-info p-1 rounded">
      <h2>Liste des demandes archivées</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Non</th>
              <th scope="col">Prénom</th>
              <th scope="col">Objet</th>
              <th scope="col">Description</th>
              <th scope="col">Cetificat_de_scolarité</th>
              <th scope="col">C V</th>
              <th scope="col">Motivation</th>
              <th scope="col">Dates</th>
              <th scope="col">Statut</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
              require dirname(__DIR__) . '../../Models/databaseConnexion.php';

              $req = $pdo->prepare('SELECT * FROM demande JOIN demandeur ON demande.id_demandeur = demandeur.id');
              $donnees = $req->fetchAll(PDO::FETCH_ASSOC);
              $req->execute();
              foreach ($donnees as $row) {
                echo $row['nom'];
              }
              if ($req->RowCount() == 0) {
                $_SESSION['message'] = 'Une erreur est survenue !';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
              } else {
                while ($donnees = $req->fetch()) {
              ?>
            <tr>
              <td><?= $donnees['nom'] ?></td>
              <td><?= $donnees['prenom'] ?></td>
              <td><?= $donnees['titre'] ?></td>
              <td><?= $donnees['description'] ?></td>
              <td><?= $donnees['image'] ?></td>
              <td><?= $donnees['cv'] ?></td>
              <td><?= $donnees['motivation'] ?></td>
              <td><?= $donnees['dateDebut'] ?></td>
              <td>
                <?php if ($donnees['confirm'] === null) : ?>
                  <button class="btn btn-primary" name="EnAttente">En_Attente</button>
                <?php elseif ($donnees['confirm'] == 1) : ?>
                  <button class="btn btn-success" name="Accepter">Acceptée</button>
                <?php else : ?>
                  <button class="btn btn-danger" name="Refuser">Refusée</button>
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
  </main>
  </div>
  </div>
  </div>
  </main>
</body>

</html>