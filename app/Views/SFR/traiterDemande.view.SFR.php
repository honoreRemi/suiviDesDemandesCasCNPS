<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../../public/asset/st.css">
    <!-- <link rel="stylesheet" href="../../../public/asset/app.css"> -->
    <title>Decision</title>

</head>

<body>

    <body bgcolor="white"></body>
    <b>
        <CENTER>
            <font size="100px">Lettre de decision
    </b></font>
    </div>
    </CENTER>
    <div class="princip">


        <p class="pixel">
            <B>Caisse Nationale De Prevoyance Sociale</B><br>_______________<br>
            <B>Direction des Ressources Humaines</B><br> _______________<br>
            <B>Service De La Formation Et Du Recyclage</B><br>_______________<br>
            <B>BP 441 YAOUNDE</B><br>
        </p>

        <p class="class1"><strong>
                <font class="class1" size="4PX">DECISION</font>
            </strong></p>
        <p class="c2">N°<input class="a" type="tel" name="decision">/24/CNPS/DG/DRH/SFR</p>
        <p class="c0">DU<input class="a" type="date" name="dateJ"></p><br><br>
        <p class="cr">Portant admission en stage non remunéré de certains étudiants.</p>

        <p class="remi"><b>REPUBLIQUE DU CAMEROUN</b><br>
            <i>PAIX-TRAVAIL-PATRIE</i><br>

            <b>REPUBLIC OF CAMEROON</b><br>
            <i>PEACE WORK FATHERLAND</i>
        </p>

        <p class="c1"><strong>
                <font class="c1" size="2PX">

                    <h3>Vu Le decret n°2018/354 du 07 juin 2018 portant réorganisation et fonctionnement de la Caisse Nationale de prévoyance sociale;</h3><br>
                    <h3>Vu Le décret n°2008/129 du 07 juin 2008 portant nomination du Directeur Général de la Caisse Nationale de prévoyance sociale;</h3><br>
                    <h3>Vu La note de service n°087/03/BG/DRH/CNPS du 22 mai 2003 portant réorganisation des stages academiques à la <br> Caisse Nationale de prévoyance sociale</h3><br>
                    <h3>Vu La décision n°1628/19/DG/CNPS du 16 décembre 2019 accrodant délégation de signature à Monsieur NANA Bello et Monsieur <br> NGANG HOME Kenneth Brice Juvénal respectiv
                        ement Directeur et Directeur adjoint des ressources humaines</h3><br>
                    <h3>Vu La note de service n°20/18/DG/DRH/SFR/SFR/CNPS du 23 février 2018 relative au renforcement de l'encadrement et <br> le suivi des stagiaires academiques et professionnel à la CNPS<br>
                        <h3>Vu les demandes des interessés.</h3><br>

                        <h1 class="cr1">DECIDE</h1><br>
                        <h3><u>Article 1</u> les étudiants dont les noms suivent sont admis à effectuer un stage non remunéré à la caisse nationale de <br> prevoyance social confiormement au tableau si dessous</h3>

                        <table style="width:100%; border-collapse: collapse;">
                            <tr>
                                <?php
                                // Récupérer la connexion à la base de données
                                require dirname(__DIR__) . '../../Models/databaseConnexion.php';

                                // Récupérer toutes les demandes confirmées
                                $reqDemande = $pdo->prepare('SELECT * FROM demande WHERE confirm = 1');
                                $reqDemande->execute();
                                $demandes = $reqDemande->fetchAll(PDO::FETCH_ASSOC);

                                // Récupérer tous les demandeurs
                                $reqDemandeur = $pdo->prepare('SELECT * FROM demandeur');
                                $reqDemandeur->execute();
                                $demandeurs = $reqDemandeur->fetchAll(PDO::FETCH_ASSOC);

                                // Affichage des résultats
                                if (count($demandeurs) == 0) {
                                    echo 'Aucun utilisateur retrouvé dans la base de données.';
                                } else {
                                    echo '<table>';
                                    echo '<tr>
                                            <th style="padding: 10px;">N°</th>
                                            <th style="padding: 10px;">Nom</th>
                                            <th style="padding: 10px;">Filière</th>
                                            <th style="padding: 10px;">Type de Stage</th>
                                            <th style="padding: 10px;">Structure D\'accueil</th>
                                            <th style="padding: 10px;">Date de Début</th>
                                            <th style="padding: 10px;">Date de Fin</th>
                                        </tr>';

                                    foreach ($demandes as $demande) {
                                        // Vérifier si le demandeur a une demande confirmée
                                        foreach ($demandeurs as $demandeur) {
                                            if ($demande['id'] == $demandeur['id']) { // Assurez-vous que cet ID correspond
                                                // Afficher les informations du demandeur et de la demande
                                                echo '<tr>';
                                                echo '<td style="padding: 10px;">' . $demandeur['id'] . '</td>';
                                                echo '<td style="padding: 10px;">' . $demandeur['nom'] . '</td>';
                                                echo '<td style="padding: 10px;">' . $demandeur['filière'] . '</td>';
                                                echo '<td style="padding: 10px;">' . $demandeur['typeStage'] . '</td>'; // Récupérez le type de stage depuis la demande
                                                echo '<td style="padding: 10px;">DSI</td>'; // Remplacez par vos données
                                                echo '<td style="padding: 10px;">' . $demandeur['dateDebut'] . '</td>'; // Récupérez la date de début depuis la demande
                                                echo '<td style="padding: 10px;">' . $demandeur['dateFin'] . '</td>'; // Récupérez la date de fin depuis la demande
                                                echo '</tr>';
                                            }
                                        }
                                    }
                                    echo '</table>';
                                }
                                ?>
                        </table>
                </font>
            </strong></p>
        <h3 class="cr2"><u>Article 2</u> A cet effet, il est demandé aux responsables et agents des structures concernées de leurs reserver <br> un bon acceuil</h3>

    </div>


</body>

</html>