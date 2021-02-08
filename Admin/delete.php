<?php
    session_start ();
    require '../data/database.php';

    if (!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }
    if(!empty($_POST))
    {
        $id = checkInput($_POST['id']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM items WHERE id = ? ");
        $statement->execute(array($id));
        Database::disconnect();
        header("Location: index.php");
    }

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
            <h1 class="pt-3"><strong>Supprimer un item  </strong></h1>
                    <hr>
                <div class="row">
                    <br>
                    <form class="form" role="form" action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <p class="alert alert-warning">Êtes-vous sûr de vouloir supprimer ?</p>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-warning">Oui</button>
                            <a class="btn btn-default" href="home.php">Non</a>
                        </div>
                    </form>
                </div>

            </div>
            <?php 
    } else {
        header('Location: index.php');
    }?>
    </body>
</html>