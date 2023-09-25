<?php
// Connexion à la base de données
require 'connexion.php';
// Inclure le fichier "connexion.php" qui contient probablement le code de connexion à la base de données.

// Récupération de l'identifiant du salarié depuis les paramètres de l'URL
if (isset($_GET['idd'])) {
    $idd = $_GET['idd'];
    // Vérifier si le paramètre 'idd' est défini dans l'URL et récupérer sa valeur.
    
    $req = $bd->prepare('SELECT * FROM salaire WHERE idsalaire = :idd');
    // Préparer une requête SQL pour sélectionner toutes les colonnes de la table "salaire" où "idsalaire" correspond à la valeur fournie.
    
    $req->bindParam(':idd', $idd);
    // Lier le paramètre ':idd' à la variable $idd dans la requête SQL.
    
    $req->execute();
    // Exécuter la requête SQL préparée.
}
?>

<!-- La partie HTML commence ici -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Informations méta et liens CSS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Détails du Salarié</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Liens vers les fichiers de styles -->
   
    <!-- Le lien vers la feuille de styles pour l'impression -->
     <!-- <link rel="stylesheet" href="impression.css" media="print">  -->
     <style>
        body {
            background-color: #F5F5F5;
            height: 100vh;
        }
        .signature{
            position: absolute;
            /* right: 0; */
            left:0;
            bottom: 5%;
            color: black;
            text-decoration: underline;
            font-size: 20px;
        }
     </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <!-- Titre pour les détails de l'employé -->
                        <h1 class="h3 mb-4 text-gray-800">Détails du Salarié</h1>

                        <?php
                        while ($ligne = $req->fetch()) {

                            $reqEmploye = $bd->prepare('SELECT * FROM employe WHERE ide = ?');
                            $reqEmploye->execute([$ligne['ide']]);
                            $employe = $reqEmploye->fetch();
                            
                            // Boucle pour itérer sur les résultats de la requête SQL

                            // Affichage des détails sur le salaire
                            echo '<div class="col-md-6">';
                            echo '<p><strong>Modalité :</strong> ' . $ligne['modalitedupaie'] . '</p>';
                            echo '<p><strong>Montant :</strong> ' . $ligne['montant'] . '</p>';
                            echo '<p><strong>Date :</strong> ' . $ligne['date'] . '</p>';
                            echo '<p><strong>Employé :</strong> ' . $ligne['ide'] . '</p>';
                           
                            // Requête pour obtenir les détails de l'employé
                           
                            if ($employe) {
                                // Affichage des détails de l'employé
                                echo '<div class="col-md-6">';
                                echo '<p><strong>Nom de l\'employé :</strong> ' . $employe['nom'] . '</p>';
                                echo '<p><strong>Prénom de l\'employé :</strong> ' . $employe['prenom'] . '</p>';
                                echo '<p><strong>Adresse de l\'employé :</strong> ' . $employe['adresse'] . '</p>';
                                echo '<p><strong>Contact de l\'employé :</strong> ' . $employe['contact'] . '</p>';
                                echo '<p><strong>Email de l\'employé :</strong> ' . $employe['email'] . '</p>';
                                echo '<p><strong>Poste de l\'employé :</strong> ' . $employe['poste'] . '</p>';
                                echo '</div>';
                            } else {
                                echo '<p>Employé non trouvé.</p>';
                            }
                            echo '</div>'
                           ;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Boutons d'impression et de navigation -->
    <a href="salaire_list.php" id="link" class="btn btn-secondary">Retour à la liste des salariés</a>
    <button class="btn btn-primary" id="btn-I" onclick="imprimerDetails()">Imprimer Détails</button>
    <!-- Fonction JavaScript pour l'impression -->
    <div class="footer">
            <p>Date: <?php echo date('Y-m-d'); ?></p>
            <p class="signature"><strong>Signature</strong></p>
        </div>
    </div>
</body>
</html>
    <script>
        function imprimerDetails() {
            // Masquer les éléments indésirables pendant l'impression
            document.getElementById('btn-I').style.display = 'none';
            document.getElementById('link').style.display = 'none';
            // Imprimer la section des détails
            window.print();
            // Réafficher les éléments masqués après l'impression
            document.getElementById('btn-I').style.display = 'block';
            document.getElementById('link').style.display = 'block';
        }
    </script>
    
   
</body>
</html>
