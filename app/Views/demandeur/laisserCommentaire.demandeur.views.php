<!DOCTYPE html>
<html>

<head>
    <title>Laisser un avis</title>
    <style>
        .comment-container {
            width: 80%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .comment {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .comment-author {
            font-weight: bold;
        }

        .comment-date {
            color: #777;
            font-size: 14px;
        }

        .comment-content {
            line-height: 1.5;
        }

        .comment-form {
            margin-top: 20px;
        }

        .comment-form textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .comment-form button {
            display: block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="comment-container">
        <h2>Laisser un avis</h2>

        <div id="comments-section">
            <div class="comment">
                <div class="comment-header">
                    <span class="comment-author">Honore Remi</span>
                    <span class="comment-date">2023-08-09</span>
                </div>
                <div class="comment-content">
                    Ce site est très utile pour suivre les demandes de stage. Merci !
                </div>
            </div>
        </div>

        <form action="../../Controler/demandeur/demandeurAvis.cntrl.php" method="POST" class="comment-form">
            <textarea name="libelé" placeholder="Laissez votre commentaire ici..."></textarea>
            <button type="submit" name="envoyer">Envoyer</button>
        </form>
    </div>

    <script>
        const commentForm = document.querySelector('.comment-form');
        const commentTextarea = commentForm.querySelector('textarea');
        const commentsSection = document.getElementById('comments-section');

        // Ajout d'un nouvel avis à la page après soumission
        commentForm.addEventListener('submit', (event) => {
            event.preventDefault(); // Empêche la soumission par défaut

            const commentContent = commentTextarea.value.trim();
            if (commentContent) {
                // Créez un nouvel élément de commentaire
                const newComment = document.createElement('div');
                newComment.classList.add('comment');

                newComment.innerHTML = `
                    <div class="comment-header">
                        <span class="comment-author">Vous</span>
                        <span class="comment-date">${new Date().toISOString().slice(0, 10)}</span>
                    </div>
                    <div class="comment-content">${commentContent}</div>
                `;

                // Ajoutez le nouveau commentaire à la section des commentaires
                commentsSection.appendChild(newComment);
                commentTextarea.value = ''; // Réinitialiser le champ de texte

                // Soumettre le formulaire pour l'enregistrement
                commentForm.submit();
            }
        });
    </script>
</body>

</html>