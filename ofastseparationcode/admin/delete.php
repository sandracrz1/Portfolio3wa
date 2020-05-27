<?php
    require 'database.php';

    if(!empty($_GET['id']))
    {
        $id =  checkInput($_GET['id']);
    }

    if(!empty($_POST['id']))
    {
        $id =  checkInput($_POST['id']);
        $db =  Database::connect();
        $statement = $db->prepare("DELETE FROM items WHERE id = ?");
        $statement->execute(array($id));
        Database::disconnect();
        header("location: index.php");
    }

    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // Sélection et affichage du template PHTML.
    $template = 'delete';
    include 'layout.phtml';
?>