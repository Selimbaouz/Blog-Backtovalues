<?php
    session_start ();

    require '../data/database.php';
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
            <link rel="stylesheet" type="text/css" href="../style.css">
            <script src="../script.js"></script>


            <title>Backtovalues</title>
    </head>
    <body>
    <?php
    
        
        $pass = checkInput($_POST['milesPass']);
        $statement = $db->query('SELECT * FROM admin');
        $result = $statement->fetch();

        $bddPass = $result['passBase'];
        
        if($pass == '') {
            $pass = '';
        } 

        if ($pass == $bddPass)
        {
            $_SESSION['adminName'] = $_POST['milesName'];
            $_SESSION['adminPass'] = $_POST['milesPass'];
        ?>
        <header class="bg--img text-white text-center pb-2">
        <img src="../images/profil.png" class="rounded-circle pt-3" width='160px' alt="Logo Backtovalues">
        <br>
        <img src="../images/btv.jpg" class="img-fluid rounded" width='250px' alt="Logo Backtovalues">
        </header>

        <div class="m--page mx-auto mb-5 h-auto pb-5">

        <?php
            $statement = $db->query('SELECT items.id, items.image, items.title, items.intro, items.article, categories.name AS category
                                                    FROM items LEFT JOIN categories ON items.category = categories.id
                                                    ORDER BY items.id DESC');?>
            
                <div class="container">
                    <hr class="mt-5 border--trans">
                    <h3 class="mt-4 ml-3">Admin</h3>
                    <hr class="mb-5"> 
                    <a href="insert.php" class="btn btn-success btn-md mb-5 ml-3"><i class="bi bi-plus-square-fill"></i> Ajouter un article</a></h1>

                    <div class="row w-100 mx-auto">
                    
                    <?php
                        while($item = $statement->fetch())
                        {?>
                            <div class="col-md-6 col-lg-4 mt-3">
                                    <div class="card h-100"  style="width: 100%;">
                                        <img src="../images/<?= $item['image']; ?>" class="img-fluid rounded ">
                                        <div class="card-body">
                                            <h4 class="card-title text-center"><?= $item['title']; ?></h4>
                                            <hr>
                                            <span class="badge btn--color"><?= $item['category']; ?></span><br><br>
                                                <a href="view.php?id=<?= $item['id']; ?>" class="btn btn-outline-dark" ><i class="bi bi-eye-fill"></i></a>
                                                <a href="update.php?id=<?= $item['id']; ?>" class="btn btn-success" role="button"><i class="bi bi-pencil-fill"></i></a>
                                                <a href="delete.php?id=<?= $item['id']; ?>" class="btn btn-danger" role="button"><i class="bi bi-x-circle-fill"></i></a>    
                                        </div>
                                    </div>
                                 </div>
                          <?php  }; ?>
                            </div>
                    <?php
                    Database::disconnect();?>

                </div>
        </div>
        <?php } else {
            header('Location: index.php');
            session_destroy();
        } ?>
        
        <footer class="bg--img p-3">
            <div class="container">
            2021 © Backtovalues
            </div>
        </footer>
    </body>
</html>
