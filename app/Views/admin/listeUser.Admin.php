<!doctype html>
<html lang="en" data-bs-theme="auto">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="MASSACK Honore Remi, Jacob Thornton, and Bootstrap contributors">
<meta name="generator" content="Hugo 0.115.4">
<title>Liste des utilisateurs</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

<link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-fixed/">

</head>

<body>
<?php
if (isset($_SESSION['message'])) {
    echo "<div>" . htmlspecialchars($_SESSION['message']) . "</div>";
    unset($_SESSION['message']); // Nettoyer le message après l'affichage
}
?>
  
      <!-- <img class="mb-4" src="../../../public/images/logoCnpsBon.jpg" alt="" width="200  " height="57"> -->
   
 

  <main class="container">
    <div class="bg-info p-1 rounded">
      <h2>Liste des utilisateurs</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Nom</th>
              <th scope="col">Prénom</th>
              <th scope="col">Email</th>
              <th scope="col">Numéro_de_telephone</th>
              <th scope="col">Date creation</th>
              <th scope="col">Supprimé</th>
              <th scope="col">Modifié</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
              //recuperer la connexion a labase de donnee
              require dirname(__DIR__) . '../../Models/databaseConnexion.php';

              $req1 = $pdo->prepare('SELECT u.*, r.* FROM utilisateur u JOIN role r ON u.id_role = r.id');
              $donnees = $req1->fetchAll(PDO::FETCH_ASSOC);
              $req1->execute();

              foreach ($donnees as $row) {
                echo $row['nom'];
              }
              if ($req1->RowCount() == 0) {
                $_SESSION['message'] = 'Une erreur est survenue !';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
              } else {
                while ($donnees = $req1->fetch()) {
              ?>


            <tr>
              <td><?= $donnees['nom'] ?></td>
              <td><?= $donnees['prenom'] ?></td>
              <td><?= $donnees['email'] ?></td>
              <td><?= $donnees['phone'] ?></td>
              <td><?= $donnees['dateCreation'] ?></td>
              <td>
                <a href="../../Controler/utilisateur/DG/refuser.DG.user.ctrl.php?id=<?= $donnees['id'] ?>" class="d-inline-block btn btn-danger">
                  <!-- <img src="../../../public/images/supprimer2.jpg" class="img-fluid" style="max-width: 30px;"> -->
                   Supprimer
                </a>
              </td>
              <td>
                <a href="modifierUser.views.admin.php?id=<?= $donnees['id'] ?>" class="d-inline-block">
                  <img src="../../../public/images/modifier.jpg" class="img-fluid" style="max-width: 30px;">
                </a>
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