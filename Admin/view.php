<?php
    session_start ();
    require '../data/database.php';

    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }

    $db = Database::connect();
    $statement = $db->prepare("SELECT items.id, items.image, items.title, items.intro, items.article, categories.name AS category
                                                    FROM items LEFT JOIN categories ON items.category = categories.id
                                                    WHERE items.id = ?");

    $statement->execute(array($id));
    $item = $statement->fetch();

    Database::disconnect();

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
        <link rel="stylesheet" type="text/css" href="../style.css">
        <script src="../script.js"></script>


        <title>Backtovalues</title>
    </head>
    <body>
    <?php

        if (!empty($_SESSION['adminPass'])) 
        {
            ?>

    <header class="bg--img text-white text-center pb-2">
        <img src="../images/profil.png" class="rounded-circle pt-3" width='160px' alt="Logo Backtovalues">
        <br>
        <img src="../images/btv.jpg" class="img-fluid rounded" width='250px' alt="Logo Backtovalues">
        </header>

        <div class="m--page mx-auto mb-5 h-auto pb-5">

            <div class="container mt-5">
            <div class="row ">
                <div class="col-sm-6 mx-auto">
                    <br>
                    <form>
                        <div class="form-group">
                            <label>Titre :</label><h3><?= ' ' . $item['title']; ?></h3>
                        </div>
                        <div class="form-group">
                            <label>Introduction :</label><?= ' ' . $item['intro']; ?>
                        </div>
                        <div class="form-group">
                            <label>Article :</label><?= ' ' . $item['article']; ?>
                        </div>
                        <div class="form-group">
                            <label>Catégorie :</label><?= ' ' . $item['category']; ?>
                        </div>
                        <div class="form-group">
                            <img src="<?= '../images/' . $item['image']; ?>" class="img-fluid rounded" alt="menu classic">
                            <br>
                            <label>Image :</label><?= ' ' . $item['image']; ?>
                        </div>
                    </form>
                    <br>
                    <div class="form-actions">
                        <a class="btn btn-primary" href="home.php"><i class="bi bi-arrow-left-square-fill"></i> Retour</a>
                    </div>
                </div>
                
            </div>
</div>  
    </div>
    
    <?php 
    } else {
        header('Location: index.php');
    }?>

    </body>
</html>

