<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="MASSACK Honore Remi, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.115.4">
  <title>Avis des demandeurs</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-fixed/">
</head>

<body>

  <!-- <img class="mb-4" src="../../../public/images/logoCnpsBon.jpg" alt="" width="200" height="57"> -->
  <main class="container">
    <div class="bg-info p-1 rounded">
      <h2>Avis des demandeurs</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Non</th>
              <th scope="col">Prénom</th>
              <th scope="col">Avis</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
              require dirname(__DIR__) . '../../Models/databaseConnexion.php';

              $req = $pdo->prepare('SELECT * FROM avisdemandeur JOIN demandeur ON avisdemandeur.id_demandeur = demandeur.id');
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
              <td><?= $donnees['libelé'] ?></td>
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