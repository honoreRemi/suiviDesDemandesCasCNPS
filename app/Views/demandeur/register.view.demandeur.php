<script>
  // Sélectionner l'élément de l'input
  const nomInput = document.getElementById('nom');
  const prenomInput = document.getElementById('prenom');
  const établissementInput = document.getElementById('établissement');
  const filièreInput = document.getElementById('filière');
  const typeStageInput = document.getElementById('typeStage');
  const emailInput = document.getElementById('email');
  const phoneInput = document.getElementById('phone');
  const dateDebutInput = document.getElementById('dateDebut');
  const dateFinInput = document.getElementById('dateFin');
  const duréeInput = document.getElementById('durée');
  const passwordInput = document.getElementById('password');
  const conf_passwordInput = document.getElementById('conf_password');

  
    // Écouter l'événement de changement de valeur
    nomInput.addEventListener('input', function() {
    const value = nomInput.value.trim(); // Récupérer la valeur et supprimer les espaces en début et fin

    // Définir l'expression régulière pour la validation
    const regex = /^[A-Za-z][A-Za-z0-9\s\p{P}]*$/;

    // Vérifier si la valeur de l'input est valide en utilisant l'expression régulière
    if (regex.test(value)) {
      nomInput.classList.add('is-valid');
      nomInput.classList.remove('is-invalid');
    } else {
      nomInput.classList.add('is-invalid');
      nomInput.classList.remove('is-valid');
    }
  });

  
    // Écouter l'événement de changement de valeur
    prenomInput.addEventListener('input', function() {
    const value = prenomInput.value.trim(); // Récupérer la valeur et supprimer les espaces en début et fin

    // Définir l'expression régulière pour la validation
    const regex = /^[A-Za-z][A-Za-z0-9\s\p{P}]*$/;

    // Vérifier si la valeur de l'input est valide en utilisant l'expression régulière
    if (regex.test(value)) {
      prenomInput.classList.add('is-valid');
      prenomInput.classList.remove('is-invalid');
    } else {
      prenomInput.classList.add('is-invalid');
      prenomInput.classList.remove('is-valid');
    }
  });

  
    // Écouter l'événement de changement de valeur
    établissementInput.addEventListener('input', function() {
    const value = établissementInput.value.trim(); // Récupérer la valeur et supprimer les espaces en début et fin

    // Définir l'expression régulière pour la validation
    const regex = /^[A-Za-z][A-Za-z0-9\s\p{P}]*$/;

    // Vérifier si la valeur de l'input est valide en utilisant l'expression régulière
    if (regex.test(value)) {
      établissementInput.classList.add('is-valid');
      établissementInput.classList.remove('is-invalid');
    } else {
      établissementInput.classList.add('is-invalid');
      établissementInput.classList.remove('is-valid');
    }
  });

  
    // Écouter l'événement de changement de valeur
    filièreInput.addEventListener('input', function() {
    const value = filièreInput.value.trim(); // Récupérer la valeur et supprimer les espaces en début et fin

    // Définir l'expression régulière pour la validation
    const regex = /^[A-Za-z][A-Za-z0-9\s\p{P}]*$/;

    // Vérifier si la valeur de l'input est valide en utilisant l'expression régulière
    if (regex.test(value)) {
      filièreInput.classList.add('is-valid');
      filièreInput.classList.remove('is-invalid');
    } else {
      filièreInput.classList.add('is-invalid');
      filièreInput.classList.remove('is-valid');
    }
  });

  
    // Écouter l'événement de changement de valeur
    typeStageInput.addEventListener('input', function() {
    const value = typeStageInput.value.trim(); // Récupérer la valeur et supprimer les espaces en début et fin

    // Définir l'expression régulière pour la validation
    const regex = /^[A-Za-z][A-Za-z0-9\s\p{P}]*$/;

    // Vérifier si la valeur de l'input est valide en utilisant l'expression régulière
    if (regex.test(value)) {
      typeStageInput.classList.add('is-valid');
      typeStageInput.classList.remove('is-invalid');
    } else {
      typeStageInput.classList.add('is-invalid');
      typeStageInput.classList.remove('is-valid');
    }
  });

 
  
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

  
    // Écouter l'événement de changement de valeur
    phoneInput.addEventListener('input', function() {
    const value = phoneInput.value.trim(); // Récupérer la valeur et supprimer les espaces en début et fin

    // Définir l'expression régulière pour la validation
    const regex = /^(\+237)?[2368]\d{7,8}$/;

    // Vérifier si la valeur de l'input est valide en utilisant l'expression régulière
    if (regex.test(value)) {
      phoneInput.classList.add('is-valid');
      phoneInput.classList.remove('is-invalid');
    } else {
      phoneInput.classList.add('is-invalid');
      phoneInput.classList.remove('is-valid');
    }
  });
  
  
  // Écouter l'événement de changement de valeur
  dateDebutInput.addEventListener('input', function() {
    // Vérifier si la valeur de l'input est valide
    if (dateDebutInput.validity.valid) {
      // Si la valeur est valide, ajouter la classe CSS 'is-valid'
      dateDebutInput.classList.add('is-valid');
      // Supprimer la classe CSS 'is-invalid' si elle existe
      dateDebutInput.classList.remove('is-invalid');
    } else {
      // Si la valeur n'est pas valide, ajouter la classe CSS 'is-invalid'
      dateDebutInput.classList.add('is-invalid');
      // Supprimer la classe CSS 'is-valid' si elle existe
      dateDebutInput.classList.remove('is-valid');
    }
});

  
  // Écouter l'événement de changement de valeur
  dateFinInput.addEventListener('input', function() {
    // Vérifier si la valeur de l'input est valide
    if (dateFinInput.validity.valid) {
      // Si la valeur est valide, ajouter la classe CSS 'is-valid'
      dateFinInput.classList.add('is-valid');
      // Supprimer la classe CSS 'is-invalid' si elle existe
      dateFinInput.classList.remove('is-invalid');
    } else {
      // Si la valeur n'est pas valide, ajouter la classe CSS 'is-invalid'
      dateFinInput.classList.add('is-invalid');
      // Supprimer la classe CSS 'is-valid' si elle existe
      dateFinInput.classList.remove('is-valid');
    }
});

  
    // Écouter l'événement de changement de valeur
    duréeInput.addEventListener('input', function() {
    const value = duréeInput.value.trim(); // Récupérer la valeur et supprimer les espaces en début et fin

    // Définir l'expression régulière pour la validation
    const regex = /^[A-Za-z0-9\s\p{P}]*$/;

    // Vérifier si la valeur de l'input est valide en utilisant l'expression régulière
    if (regex.test(value)) {
      duréeInput.classList.add('is-valid');
      duréeInput.classList.remove('is-invalid');
    } else {
      duréeInput.classList.add('is-invalid');
      duréeInput.classList.remove('is-valid');
    }
  });

// Écouter l'événement de changement de valeur pour les deux champs
passwordInput.addEventListener('input', validatePassword);
conf_passwordInput.addEventListener('input', validatePassword);

function validatePassword() {
  const passwordValue = passwordInput.value;
  const confPasswordValue = conf_passwordInput.value;

  if (passwordValue === conf_passwordValue) {
    // Les mots de passe correspondent, ajouter la classe CSS 'is-valid' aux deux champs
    passwordInput.classList.add('is-valid');
    passwordInput.classList.remove('is-invalid');
    conf_passwordInput.classList.add('is-valid');
    conf_passwordInput.classList.remove('is-invalid');
  } else {
    // Les mots de passe ne correspondent pas, ajouter la classe CSS 'is-invalid' aux deux champs
    passwordInput.classList.add('is-invalid');
    passwordInput.classList.remove('is-valid');
    conf_passwordInput.classList.add('is-invalid');
    conf_passwordInput.classList.remove('is-valid');
  }
}
</script>

<style>
  .is-valid {
    border-color: green !important;
  }
  
  .is-invalid {
    border-color: red !important;
  }
</style>