<?php

    require 'database.php';
    $db = Database::connect();

    $id = $autor = $comment = $date_comment = $item = "";

        
        $autor = checkInput($_POST['autor']);
        $comment = checkInput($_POST['comment']);
        $date_comment =  date("Y-m-d H:i:s"); 
        
        $item = checkInput($_GET['id']);
        

        $statement = $db->prepare("INSERT INTO comment (autor, comment, date_comment, item) VALUES (?,?,?,?)");
        $statement->execute(array($autor,$comment,$date_comment,$item));
        echo '<br><br>';
        
     

    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    Database::disconnect();
    header('Location: ../item.php?id=' . $item);
?>