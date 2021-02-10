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

        <?php 
            $statement = $db->prepare('SELECT * FROM items WHERE id = ?');
            $statement->execute(array(checkInput($_GET['id'])));
            $item = $statement->fetch();
            $categorylink = $item['category'];
            ?>
            
            <nav class="navbar bg--nav navbar-expand-lg sticky-top justify-content-center navbar-light border--botblack">
            <button class="navbar-toggler btn--color" data-toggle="collapse" data-target="#collapse_target">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center text-center" id="collapse_target">            
                <a class="nav-link" href="index.php">Accueil</a>

                <?php
                    if($categorylink == '2') {?>
                <a class="nav-link active" href="manipulation.php">Manipulation</a>
                <a class="nav-link" href="psychologie.php">Psychologie</a>
                <?php } 
                    if($categorylink == '3') {?>
                    <a class="nav-link" href="manipulation.php">Manipulation</a>
                    <a class="nav-link active" href="psychologie.php">Psychologie</a>
                <?php } ?>

            </div>
        </nav>
                
        
        <div class="container">
            <p class="text-center mt-5">Bienvenue sur le site de Backtovalues.fr, <br>un site qui a vocation de vous apprendre à prendre les bonnes décisions pour une vie plus heuseuse. </p>
        </div>

                <div class="container">
                    <hr class="mt-5 border--trans">

                    <?php 
                    $statement = $db->prepare('SELECT * FROM items WHERE id = ?');
                    $statement->execute(array(checkInput($_GET['id'])));
                    $item = $statement->fetch();
                    $categorylink = $item['category'];
                    $choiceLink = ($categorylink == '2') ? 'manipulation.php' :  'psychologie.php';
                    ?>

                    <h3 class="mt-4 ml-3"><?= $item['title']; ?></h3>
                    <hr class="mb-5">
                
                    <div class="row mx-auto">
                    
                        <div class="col-md-6 col-lg-8"> 
                            <div class="card" style="width: 100%;">
                                <img src="images/<?= $item['image'];?>" class="img-fluid rounded ">
                                <div class="card-body">
                                <p class="card-text"><?= $item['article']?></p>
                                <a href="<?= checkInput($choiceLink);?>" class="btn btn--color">Revenir</a><br>
                                </div>
                            </div>
                        </div>

                        <?php Database::disconnect(); ?>

                        <div class="col-md-6 col-lg-1"></div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card" style="width: 100%;">
                                <img src="images/profil.png" class="mx-auto w-75 img-fluid rounded mt-3">
                                <hr>
                                <div class="card-body">
                                <h5 class="card-title">Suivez-nous sur instagram <br><br><i class="bi bi-instagram">Backtovalues</i></h5>
                                <a href="https://www.instagram.com/backtovalues/" class="btn btn-success">Abonnez-vous</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            
                <div class="container">
                    <hr class="mt-5 border--trans">
                    <h3 class="mt-4 ml-3">Commentaires</h3>
                    <hr class="mb-5">   

                    <?php
                         $statement = $db->prepare('SELECT * FROM comment WHERE item = ?');
                         $statement->execute(array(checkInput($_GET['id'])));
                         foreach($statement as $item){
                    ?>

                    <div class="row mx-auto">
                    
                        <div class="col-md-6 col-lg-8"> 
                        
                            <div class="card mt-3">
                                <div class="card-header">
                                    <?= $item['autor']; ?>
                                </div>
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                    <p><?= $item['comment']; ?></p>
                                    <footer class="blockquote-footer"><?= $item['date_comment']; ?></footer>
                                    </blockquote>
                                </div>
                            </div> 

                        </div>

                    </div>

                    <?php }
                    ?>
                    
                    <div class="row mx-auto">
                
                        <div class="col-md-6 col-lg-8"> 

                                <form class="card mt-5 mb-5" role="form" action="data/insert_comment.php?id=<?= $item['id']; ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group mx-auto w-75 mt-3">
                                        <label for="autor">Nom</label>
                                        <input type="text" class="form-control" id="autor" name="autor" aria-describedby="autor">
                                    </div>
                                    <div class="form-group mx-auto w-75">
                                        <label for="comment">Commentaire</label>
                                        <textarea class="form-control" id="comment" name="comment" row="5"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn--color mb-5 mx-auto w-75">Envoyer</button>
                                </form>
                        </div>
                    </div>
            </div>

        <footer class="bg--img p-3 mt-5">
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