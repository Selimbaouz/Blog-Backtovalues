<?php
    require 'data/database.php';
    $db = Database::connect();

    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
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
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="script.js"></script>


        <title>Backtovalues</title>
    </head>

    <body>
    <header class="bg--img text-white text-center pb-2">
        <img src="images/profil.png" class="rounded-circle pt-3" width='160px' alt="Logo Backtovalues">
        <br>
        <img src="images/btv.jpg" class="img-fluid rounded" width='250px' alt="Logo Backtovalues">
        </header>
        
        <nav class="navbar bg--nav navbar-expand-lg sticky-top justify-content-center navbar-light border--botblack">

            <button class="navbar-toggler btn--color" data-toggle="collapse" data-target="#collapse_target">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center text-center" id="collapse_target">
                        <a class="nav-link active" href="index.php">Accueil</a>
                        <a class="nav-link" href="manipulation.php">Manipulation</a>
                        <a class="nav-link" href="psychologie.php">Psychologie</a>
            </div>
        </nav>
        
        <div class="container">
            <p class="text-center mt-5">Bienvenue sur le site de Backtovalues.fr, <br>un site qui a vocation de vous apprendre à prendre les bonnes décisions pour une vie plus heuseuse. </p>
        </div>
        
          

            <div class="m--page mx-auto mb-5 h-auto pb-5">

            
            <div class="container">


                <hr class="mt-5 border--trans">
                <h3 class="mt-4 ml-3">Psychologie</h3>
                <hr class="mb-5"> 
            
                <div class="row w-100 mx-auto m-5">

                <?php $statement = $db->query('SELECT * FROM items WHERE category = 3 ORDER BY id DESC');
                foreach($statement as $item) {
                ?>

                    <div class="col-md-6 col-lg-4 mt-3">
                        <div class="card h-100" style="width: 100%;">
                            <img src="images/<?= $item['image']; ?>" class="img-fluid rounded">
                            <div class="card-body">
                            <h4 class="card-title text-center"><?= $item['title']; ?></h4><hr>
                            <p class="card-text"><?= $item['intro']; ?></p><br>
                            <a href="item.php?id=<?= checkInput($item['id']); ?>" class="btn btn--color">Lire la suite  -></a><br>
                            </div>
                        </div>
                    </div>
                    
                <?php } ?>

                </div>
                

            </div>

        </div>

        <footer class="bg--img p-3">
            <div class="container mx-auto text-center">
                Backtovalues
                <div class="copyright mx-auto text-center">
                    <small>Copyright © 2021. Tous droits réservés.</small> <br>
            </div>
                    <a href="mention.html" class="mention">
                        <small>Mentions légales</small>
                    </a>
            </div>
        </footer>
             
    </body>
</html>