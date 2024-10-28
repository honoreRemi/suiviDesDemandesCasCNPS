<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi des demandes</title>
    <link rel="stylesheet" href="public/asset/app.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <img class="d-block mx-auto mt-5" src="public/images/logoCnpsBon.jpg" alt="" width="200" height="57">
                <h1 class="text-center text-muted mt-3">Please sign in</h1>
                <p class="text-center text-muted mb-3">looking for my request.</p>

                <?php if (isset($_SESSION['message'])) : ?>
                    <div class="alert alert-danger text-center text-muted" role="alert">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                <?php endif ?> 

                <form action="app/Controler/login.cntrl.php" method="POST">

                    <!-- <div class="alert alert-danger text-center" role="alert">
                    A simple danger alert—check it out!
                 </div> -->
                    <label for="email">Email</label>
                    <?php $email = isset($_POST['email']) ? $_POST['email'] : ''; // Récupérer la valeur de l'e-mail depuis le formulaire
                    $emailIsValid = filter_var($email, FILTER_VALIDATE_EMAIL); ?>
                    <input type="email" name="email" id="email" placeholder="emailexample@gmail.com" class="form-control mb-3 <?php echo $emailIsValid ? 'is-valid' : 'is-invalid'; ?>" required autocomplete="email" autofocus>

                    <label for="password">password</label>
                    <input type="password" name="password" id="password" placeholder="enter your password here" class="form-control mb-3" required autocomplete="password" autofocus>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                        </div>

                        <div class="col-md-6 text-end">
                            <a href="app/updatePassword.html.php">Forgot password ?</a>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" name="login" type="submit">Sign in</button>
                    </div>

                    <p class="text-center text-muted mt-3">Not requester account ? <a href="app/Views/demandeur/Register.php">Create an account</a></p>
                    <p class="mt-3 mb-3 text-body-secondary">&copy; 2023–2024 MASSACK HONORE REMI</p>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Sélectionner l'élément de l'input
        const emailInput = document.getElementById('email');
        // Écouter l'événement de changement de valeur
        emailInput.addEventListener('input', function() {
            const value = emailInput.value.trim(); // Récupérer la valeur et supprimer les espaces en début et fin

            // Définir l'expression régulière pour la validation
            const regex = /^[A-Za-z][A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,6}$/;

            // Vérifier si la valeur de l'input est valide en utilisant l'expression régulière
            if (regex.test(value)) {
                emailInput.classList.add('is-valid');
                emailInput.classList.remove('is-invalid');
            } else {
                emailInput.classList.add('is-invalid');
                emailInput.classList.remove('is-valid');
            }
        });
    </script>

    <style>
        .is-valid {
            border-color: green !important;
        }

        .is-invalid {
            border-color: red !important;
        }
    </style>
    <script src="public/asset/lib/bootstrap/js/bootstrap.js"></script>
</body>

</html>