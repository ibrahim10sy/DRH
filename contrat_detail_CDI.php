<?php
require 'connexion.php';

if (isset($_GET['iddCDI'])) {
    $iddCDI = $_GET['iddCDI'];
    
    $req = $bd->prepare('SELECT * FROM contrat WHERE idc = :iddCDI');
    $req->bindParam(':iddCDI', $iddCDI);
    $req->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Détails du Salarié</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F5F5F5;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .details-column {
            width: 48%;
        }
        .footer {
            /* text-align: right;
            margin-top: 20px; */
            position: absolute;
            right: 5%;
            bottom: 10%;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Détails du contrat</h1>
        </div>

        <?php
        while ($ligne = $req->fetch()) {
            $reqEmploye = $bd->prepare('SELECT * FROM employe WHERE ide = ?');
            $reqEmploye->execute([$ligne['ide']]);
            $employe = $reqEmploye->fetch();

            echo '<div class="details">';
            echo '<div class="details-column">';
            echo '<p><strong>Type de contrat :</strong> ' . $ligne['type'] . '</p>';
            echo '<p><strong>Date debut du contrat :</strong> ' . $ligne['debut'] . '</p>';
            echo '</div>';
            
            if ($employe) {
                echo '<div class="details-column">';
                echo '<p><strong>Nom de l\'employé :</strong> ' . $employe['nom'] . '</p>';
                echo '<p><strong>Prénom de l\'employé :</strong> ' . $employe['prenom'] . '</p>';
                echo '<p><strong>Poste de l\'employé :</strong> ' . $employe['poste'] . '</p>';
                echo '</div>';
            } else {
                echo '<p>Employé non trouvé.</p>';
            }
            echo '</div>';
        }
        ?>

        <div class="footer">
            <p>Date: <?php echo date('Y-m-d'); ?></p>
            <p class="signature"><strong>Signature</strong></p>
        </div>
        
        <div class="button-container">
            <a class="btn btn-secondary" href="contrat_list.php" id="link">Retour à la liste des contrats</a>
            <button class="btn btn-primary" id="btn-I" onclick="imprimerDetails()">Imprimer Détails</button>
        </div>
    </div>
    
    <script>
        function imprimerDetails() {
            document.getElementById('btn-I').style.display = 'none';
            document.getElementById('link').style.display = 'none';
            window.print();
            document.getElementById('btn-I').style.display = 'block';
            document.getElementById('link').style.display = 'block';
        }
    </script>
</body>
</html>
