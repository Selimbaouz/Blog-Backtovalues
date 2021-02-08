<?php
    require '../data/database.php';

?>
<!DOCTYPE html>
<html>
    <head>
            <meta charset="UTF-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
            
            
            <link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@200;400&display=swap" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="../style.css">
            <script src="../script.js"></script>


            <title>Backtovalues</title>
    </head>
    <body>
        <header class="bg--img text-white text-center pb-2">
        <img src="../images/profil.png" class="rounded-circle pt-3" width='160px' alt="Logo Backtovalues">
        <br>
        <img src="../images/btv.jpg" class="img-fluid rounded" width='250px' alt="Logo Backtovalues">
        </header>

        <div class="m--page mx-auto mb-5 h-auto pb-5">
        
            <div class="container">
                <hr class="mt-5 border--trans">
                <h3 class="mt-4 ml-3">Administration Connexion </h3>
                <hr class="mb-5"> 

                <div class="row w-100 mx-auto">
                    <form class="form mt-5 mx-auto" role="form" action="home.php" method="post" enctype="multipart/form-data">
                        <div class="form-group mx-auto">
                            <label for="milesName">Nom:</label>
                            <input type="text" class="form-control" id="milesName" name="milesName">
                            </input>
                            <br>
                            <label for="milesPass">Mot de passe:</label>
                            <input type="password" class="form-control" id="milesPass" name="milesPass">
                            </input>
                            <br>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> Envoyer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>

        <footer class="bg--img p-3">
            <div class="container">
                2021 © Backtovalues
            </div>
        </footer>
    </body>
</html>