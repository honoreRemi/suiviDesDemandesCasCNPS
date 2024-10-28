<?php session_start(); ?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MASSACK HONORE REMI">
    <meta name="author" content="MASSACK HONORE REMI">
    <meta name="generator" content="Hugo 0.115.4">
    <title>envoyer ma demande</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">
    <link rel="stylesheet" href="../../public/asset/app.css">


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


    <div class="container">
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="alert alert-danger text-center text-muted" role="alert">
                <?php echo $_SESSION['message']; ?>
            </div>
        <?php endif ?>
        <main>
            <div class="py-5 text-center mt-3 mb-1">
                <img class="d-block mx-auto mb-4" src="../../../public/images/logoCnpsBon.jpg" alt="" width="200" height="57">
                <h2>Submit my information</h2>
                <p class="lead">renseignez toutes vos informations correctes dans les champs qui vous sont soumis pour nous faciliter la tache à mieux traiter et suivre vos differentes demandes.</p>
            </div>

            <div class="row g-5 justify-content-center">
                <div class="col-md-7 col-lg-8">
                    <form class="needs-validation" method="post" novalidate action="../../Controler/demandeur/register.cntrl.demandeur.php">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="enter your name" value="" required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">prenom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="enter your surname" value="" required>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="username" class="form-label">votre établissement</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="établissement" name="établissement" placeholder="votre etablissemnet " required>
                                    <div class="invalid-feedback">
                                        Your school name is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="username" class="form-label">votre filière</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="filière" name="filière" placeholder="votre filière" required>
                                    <div class="invalid-feedback">
                                        Your spinneret is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="role" class="form-label">type de stage voulu</label>
                                <div class="w-100 mb-3">
                                    <select class="form-select" name="typeStage" id="typeStage">
                                        <option value="Academique">Academique</option>
                                        <option value="Professionel">Professionel</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Veuillez sélectionner un rôle.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email <span class="text-body-secondary">(Optional)</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="username" class="form-label">votre numero de telephone</label>
                                <div class="input-group has-validation">
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="votre numero de telephone " required>
                                    <div class="invalid-feedback">
                                        Your phone number is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="username" class="form-label">entrez la periode de votre stage(date debut)</label>
                                <div class="input-group has-validation">
                                    <input type="date" class="form-control" id="dateDebut" name="dateDebut" placeholder="entrez la periode de votre stage" required>
                                    <div class="invalid-feedback">
                                        Your internship period start is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="username" class="form-label">entrez la periode de votre stage(date fin)</label>
                                <div class="input-group has-validation">
                                    <input type="date" class="form-control" id="dateFin" name="dateFin" placeholder="entrez la periode de votre stage" required>
                                    <div class="invalid-feedback">
                                        Your end internship period is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="username" class="form-label">entrez la durée de votre stage</label>
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="durée" name="durée" placeholder="entrez la durée de votre stage" required>
                                    <div class="invalid-feedback">
                                        Your duration is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="username" class="form-label">entrez votre mot de passe</label>
                                <div class="input-group has-validation">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="entrez votre mot de passe" required <?php echo isset($_GET['error']) ? 'is-invalide' : ''; ?>>
                                    <?php if (isset($_GET['error'])) : ?>
                                        <div class="invalid-feedback">
                                            Your password is required.
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="username" class="form-label">confirmez votre mot de passe</label>
                                <div class="input-group has-validation">
                                    <input type="password" class="form-control" id="conf_password" name="conf_password" placeholder="confirmez votre mot de passe" required>
                                    <div class="invalid-feedback">
                                        Your password repeet is required.
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button class="w-100 mt-3 btn btn-primary btn-lg" name="create_request" type="submit">Me faire enregistrer</button>
                </div>

                </form>
            </div>
    </div>
    </main>
    <p class="text-center text-muted mt-3">All ready have an account ? <a href="../../../index.php">Login here</a></p>
        <p class="mb-1 mt-3 mb-3 text-center text-small">&copy; 2023–2024 Honore REMI MASSACK</p>

    </div>
    <?php require_once 'register.view.demandeur.php'; ?>
</body>

</html>