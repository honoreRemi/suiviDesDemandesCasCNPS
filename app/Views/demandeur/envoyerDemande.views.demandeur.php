<!DOCTYPE html>
<html>

<head>
    <title>Rédiger une demande</title>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>
<style>
    body {
        background-color: #f2f2f2;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
    }

    h1 {
        margin-top: 0;
    }

    form {
        display: inline-block;
        text-align: left;
    }

    label {
        display: block;
        font-weight: bold;
        margin-top: 10px;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    textarea {
        height: 150px;
    }

    input[type="submit"] {
        display: block;
        width: auto;
        margin: 0 auto;
        padding: 10px 20px;
        background-color: #4285F4;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .logout {
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>

<body>

    <div class="container">
        <!-- <img class="d-block ml-auto mb-4" src="../../../public/images/logoCnpsBon.jpg" alt="" width="200" height="57"> -->
        <h1>Rédiger une demande</h1>

        <form action="../../Controler/demandeur/envoyerDemande.cntrl.demandeur.php" method="post" enctype="multipart/form-data">
            <!-- <div class="logout"><input type="submit" value="Déconnexion" class="btn btn-primary"></div> -->

            <label for="titre" class="mb-3">Objet :</label>
            <input type="text" name="titre" id="titre" required>

            <label for="description">Description :</label>
            <textarea name="description" id="description" rows="5" cols="80" required></textarea>

            <label for="file1">Insérez votre certificat de scolarité ici (sur format jpg, jpeg, png, gif) :</label>
            <input type="file" name="image" id="file1" accept="image/*" required>

            <label for="file2">Insérez votre curriculum vitae (CV) ici (sur format pdf) :</label>
            <input type="file" name="cv" id="file2" accept="application/pdf" required>

            <label for="motivation">Vos motivations :</label>
            <textarea name="motivation" id="motivation" rows="5" cols="80" required></textarea>

            <input type="submit" class="btn btn-primary w-100 mt-2 py-2" value="Soumettre ma demande" name="envoyer">
        </form>
    </div>

    <script>
        //CKEDITOR.replace('description');
        // Update file names
        const fileInputs = document.querySelectorAll('.file-input');
        fileInputs.forEach((input) => {
            input.addEventListener('change', (e) => {
                const fileName = e.target.value.split('\\').pop();
                const fileLabel = e.target.parentNode.querySelector('.file-name');
                fileLabel.textContent = fileName;
            });
        });
    </script>
</body>

</html>