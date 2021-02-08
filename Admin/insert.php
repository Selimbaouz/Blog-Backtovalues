<?php
    session_start ();
    require '../data/database.php';

    $titleError = $introError = $articleError = $categoryError = $imageError = $title = $intro = $article = $category = $image = "";

    if(!empty($_POST))
    {
        $title = checkInput($_POST['title']);
        $intro = checkInput($_POST['intro']);
        $article = checkInput($_POST['article']);
        $category = checkInput($_POST['category']);
        $image = checkInput($_POST['image']);
        //$image = checkInput($_FILES['image']['name']);
        //$imagePath = '../images/' . basename($image);
        //$imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $isSuccess = true;
        $isUploadSuccess = false;

        if(empty($title))
        {
            $titleError = "Ce champ ne peut pas être vide";
            $isSuccess = "false";
        }
        if(empty($intro))
        {
            $introError = "Ce champ ne peut pas être vide";
            $isSuccess = "false";
        }
        if(empty($article))
        {
            $articleError = "Ce champ ne peut pas être vide";
            $isSuccess = "false";
        }
        if(empty($category))
        {
            $categoryError = "Ce champ ne peut pas être vide";
            $isSuccess = "false";
        }
        if(empty($image))
        {
            $imageError = "Ce champ ne peut pas être vide";
            $isSuccess = "false";
        }
        
        if($isSuccess)
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO items (image, title, intro, article, category) VALUES (?,?,?,?,?)");
            $statement->execute(array($image,$title,$intro,$article,$category));
            Database::disconnect();
            header("Location:index.php");
        }
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
        <h3  class="pt-3 text-center">Ajouter un nouvel article</h3>
        <hr>
            <div class="row">
                <form class="form mt-5 mx-auto" role="form" action="insert.php" method="post" enctype="multipart/form-data">
                    <div class="form-group mt-5">
                        <label for="title">titre:</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Titre" value="<?php echo $title; ?>">
                        <span class="help-inline"><?php echo $titleError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="intro">Introduction:</label>
                        <textarea class="form-control" id="intro" name="intro" placeholder="Introduction" value="<?php echo $intro; ?>" rows="3"></textarea>
                        <span class="help-inline"><?php echo $introError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="article">Article:</label>
                        <textarea class="form-control" id="article" name="article" placeholder="Article" value="<?php echo $article; ?>" rows="20"></textarea>
                        <span class="help-inline"><?php echo $articleError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="category">Catégorie:</label>
                        <select class="form-control" id="category" name="category">
                        <?php
                            $db = Database::connect();
                            foreach ($db->query('SELECT * FROM categories') as $row)
                            {
                                echo '<option value="' . $row['id'] . '">' . $row['name'] . '<option>';
                            }
                            Database::disconnect();
                        ?>
                        </select>
                        <span class="help-inline"><?php echo $categoryError; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="image">Indiquer le nom de l'image avec l'extension (p2.jpg):</label>
                        <br>
                        <input type="text" id="image" name="image">
                        <span class="help-inline"><?php echo $imageError; ?></span>
                    </div>
                <br>
                <div class="form-actions">
                    <a class="btn btn-primary" href="home.php"><i class="bi bi-arrow-left-square-fill"></i> Retour</a>
                    <button type="submit" class="btn btn-success"><i class="bi bi-pencil-fill"></i> Ajouter</button>
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