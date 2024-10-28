<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MASSACK HONORE REMI">
    <meta name="author" content="MASSACK HONORE REMI">
    <meta name="generator" content="Hugo 0.115.4">
    <title>Modifier utilisateurs</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <meta name="theme-color" content="#712cf9">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }
    </style>

</head>

<body class="bg-body-tertiary">

    <?php
    
    //recuperer la connexion a labase de donnee
    require dirname(__DIR__) . '../../Models/databaseConnexion.php';

    $userId = $_GET['id']; // Récupérez l'ID de l'utilisateur à partir de l'URL
    $req = $pdo->prepare('SELECT * FROM utilisateur WHERE id = :userId');
    $req->bindParam(':userId', $userId, PDO::PARAM_INT);
    $req->execute();
    $donnees = $req->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="alert alert-danger text-center text-muted" role="alert">
                <?php echo $_SESSION['message']; ?>
            </div>
        <?php endif ?>
        <main>
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" src="../../../public/images/CNPSlogo.jpeg" alt="" width="200" height="57">
                <h2>Checkout form</h2>
                <p class="lead text-center text-muted mb-3">Créer tous les utilisateurs de la structure.</p>
            </div>

            <div class="row g-5 justify-content-center">
                <div class="col-md-7 col-lg-8">
                    <form class="needs-validation" method="post" novalidate action="../../Controler/admin/modifierUser.admin.ctrl.php">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="enter your name" value="<?php echo $donnees['nom'] ?? ''; ?>" required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">prenom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="enter your surname" value="<?php echo $donnees['prenom'] ?? ''; ?>" required>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email <span class="text-body-secondary">(Optional)</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $donnees['email'] ?? ''; ?>" placeholder=" you@example.com">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="phone" class="form-label">votre numero de telephone</label>
                                <div class="input-group has-validation">
                                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $donnees['phone'] ?? ''; ?>" placeholder="votre numero de telephone " required>
                                    <div class="invalid-feedback">
                                        Your phone is required.
                                    </div>
                                </div>
                            </div>


                            <div class="col-6">
                                <label for="dateCreation" class="form-label">date de creation</label>
                                <div class="input-group has-validation">
                                    <input type="date" class="form-control" id="dateCreation" name="dateCreation" value="<?php echo $donnees['dateCreation'] ?? ''; ?>" placeholder=" votre numero de telephone " required>
                                    <div class=" invalid-feedback">
                                        Your dateCreation is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="password" class="form-label">entrez votre mot de passe</label>
                                <div class="input-group has-validation">
                                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $donnees['password'] ?? ''; ?>" placeholder=" entrez votre mot de passe" required>
                                    <div class="invalid-feedback">
                                        Your password is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="conf_password" class="form-label">confirmez votre mot de passe</label>
                                <div class="input-group has-validation">
                                    <input type="password" class="form-control" id="conf_password" name="conf_password" value="" placeholder=" confirmez votre mot de passe" required>
                                    <div class="invalid-feedback">
                                        Your conf_password is required.
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="role" class="form-label">Choisir un rôle</label>
                                <div class="w-100 mb-3">
                                    <select class="form-select" name="nom_role" id="nom_role">
                                        <option value="Administrateur">Administrateur</option>
                                        <option value="DG">DG</option>
                                        <option value="DRH">DRH</option>
                                        <option value="DSI">DSI</option>
                                        <option value="SFR">SFR</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Veuillez sélectionner un rôle.
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button class="w-100 mt-3 btn btn-primary btn-lg" name="Creer" type="submit">Modifier</button>
                </div>

                </form>
            </div>
    </div>
    </main>
    <footer class="my-5 pt-5 text-body-secondary text-center text-small">
        <p class="mb-1">&copy; 2022–2023 MASSACK HONORE REMI</p>

    </footer>
    </div>
    <?php require_once 'createuser.php'; ?>
</body>

</html>