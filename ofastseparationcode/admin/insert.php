<?php
    require 'database.php';

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
        $isUploadSucess = false;

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
            $image_error        = "Remplir le champs";
            $isSucess           = false;
        }
        else 
        {
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

        if($isSucess && $isUploadSucess)
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO items (name,description,price,category,image) values(?,?,?,?,?)");
            $statement->execute(array($name,$description,$price,$category,$image));
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

    // Connection base de données et affichage input field
    $db = Database::connect();
    $rows = $db->query('SELECT * FROM categories');
    Database::disconnect();

    // Sélection et affichage du template PHTML.
    $template = 'insert';
    include 'layout.phtml';
?>
