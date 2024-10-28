
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperation des mots de passe</title>
    <link rel="stylesheet" href="../public/asset/app.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
            <img class="d-block mx-auto mt-5" src="../public/images/CNPSlogo.jpeg" alt="" width="200" height="57">
                <h1 class="text-center text-muted mt-5">Update password</h1>
                <p class="text-center text-muted mb-5">We going to update your password.</p>

                <?php if(isset($_SESSION['login_err'])): ?>
                    <div class="alert alert-danger" role="alert">
                    veillez renseigner correctement les champs
                    </div>
                <?php endif ?>
                
                <form action="Controler/updatePassword.cntrl.php" method="POST">

                 <!-- <div class="alert alert-danger text-center" role="alert">
                    A simple danger alert—check it out!
                 </div> -->
                 <label for="email">Email</label>
                 <?php $email = isset($_POST['email']) ? $_POST['email'] : ''; // Récupérer la valeur de l'e-mail depuis le formulaire
                 $emailIsValid = filter_var($email, FILTER_VALIDATE_EMAIL); ?>
                 <input type="email" name="email" id="email" placeholder="emailexample@gmail.com" class="form-control mb-3 <?php echo $emailIsValid ? 'is-valid' : 'is-invalid'; ?>" required autocomplete="email" autofocus>
   
                 <div class="d-grid gap-2"> 
                   <button class="btn btn-primary" name="submit_email" type="submit">Sign in</button>
                 </div>

                    <p class="mt-5 mb-3 text-body-secondary">&copy; 2022–2023  MASSACK HONORE REMI</p>
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