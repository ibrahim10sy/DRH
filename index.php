<?php
//Demarrage de la session
    session_start();
    require 'connexion.php';
    if(isset($_POST['connexion'])){
        if(isset($_POST['login'],$_POST['password'])){
            $req=$bd->query('SELECT * from utilisateur where login="'.
            $_POST['login'].'" and password="'.$_POST['password'].'"');
            if ($ligne=$req->fetch () ) 
          
            {
                $_SESSION['nom']=$ligne['nom'];
                header('Location:accueil.php');
                
            }else{
               
                header('Location:index.php');
                echo 'Identifiant ou Mot de Passe Incorrect';
            }
        }
       
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="template/css/sb-admin-2.min.css" rel="stylesheet">

</head>

  <body class="container">
    <div>
      <div class="row">
        <div class="col-8">
          <section class="login_content">
            <form action="index.php" method="post">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" name="login" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
              </div>
              <div>
                <button name="connexion" class="btn btn-default submit">Connexion</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
               

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> DRH</h1>
                  <p>©2023 Tous droits reservés.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
