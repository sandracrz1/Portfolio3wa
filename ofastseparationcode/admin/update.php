<?php
    require 'database.php';

    if(!empty($_GET['id']))
    {
        $id = checkInput(($_GET['id']));
    }

    $name_error = $description_error = $price_error = $category_error = $image_error = $name =
    $description = $price = $category = $image = "";

    if(!empty($_POST))
    {
        $name           = checkInput($_POST['name']);
        $description    = checkInput($_POST['description']);
        $price          = checkInput($_POST['price']);
        $category       = checkInput($_POST['category']);
        $image          = checkInput($_FILES['image']['name']);
        $imagePath      = '../image/' . basename($image);
        $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $isSucess       = true;

        if(empty($name))
        {
            $name_error         = "Remplir le champs";
            $isSucess           = false;
        }
        if(empty($description))
        {
            $description_error  = "Remplir le champs";
            $isSucess           = false;
        }
        if(empty($price))
        {
            $price_error        = "Remplir le champs";
            $isSucess           = false;
        }
        if(empty($category))
        {
            $category_error     = "Remplir le champs";
            $isSucess           = false;
        }
        if(empty($image))
        {
            $isImageUpdated     = false;
            $isSucess           = false;
        }
        else 
        {
            $isImageUpdated = true;
            $isUploadSucess = true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif")
            {
                $image_error = "Seuls sont autorisés les fichiers: .jpg, .png, .jpeg, .gif";
                $isUploadSucess = false;
            }
            if(file_exists($imagePath))
            {
                $image_error = "Fichier déjà existant";
                $isUploadSucess = false;
            }
            if($_FILES["image"]["size"] > 500000)
            {
                $image_error = "Le fichier ne doit pas être supérieur à 500KB";
                $isUploadSucess = false;
            }
            if($isUploadSucess)
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"],$imagePath))
                {
                    $image_error = " Erreur dans l'upload";
                    $isUploadSucess = false;
                }
            }

        }

        if(($isSucess && $isImageUpdated && $isUploadSucess) || ($isSucess && !$isImageUpdated))
        {
            $db = Database::connect();
            if($isImageUpdated)
            {
                $statement = $db->prepare("UPDATE  items set name = ?, description = ?, price = ?, category = ?,image = ? WHERE id = ?");
                $statement->execute(array($name,$description,$price,$category,$image,$id));
            }
           else
           {
                $statement = $db->prepare("UPDATE  items set name = ?, description = ?, price = ?, category = ? WHERE id = ?");
                $statement->execute(array($name,$description,$price,$category,$id));
           }
            Database::disconnect();
            header("Location:index.php");
        }

        else if($isImageUpdated && !$isUploadSucess)
        {
            $db = Database::connect();
            $statement = $db->prepare("SELECT image FROM  items  WHERE id = ?");
            $statement->execute(array($id));
            $item = $statement->fetch();
            $image = $item['image'];
            Database::disconnect();
        }

    }

    else 
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM items WHERE id= ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $name           = $item['name'];
        $description    = $item['description'];
        $price          = $item['price'];
        $category       = $item['category'];
        $image          = $item['image'];
       
        Database::disconnect();
    }

    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Connection base de données et affichage input field
    $db = Database::connect();
    $rows = $db->query('SELECT * FROM categories');
    Database::disconnect();
    
    // Sélection et affichage du template PHTML.
    $template = 'update';
    include 'layout.phtml';
?>
