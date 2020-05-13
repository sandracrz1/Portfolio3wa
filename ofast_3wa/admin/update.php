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
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Fastfood</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="HTML, CSS, XML, JavaScript">
    <meta name="author" content="Sandra Cruz">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300Roboto:300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1 class="logo">O'Fast</h1>       
</div>
    <div class="container admin">
        <div class="row">
            <div class="col s12 m6 l6">
                <h2>Modifier un item</h2>
                <br>
                <form class="form" role="form" action="<?php echo 'update.php?id='.$id; ?>" method="post" enctype="multipart/form-data">
                    <div class="form_product">
                        <label for="name">Nom:</label>
                        <input type="text" id="name" name="name"  value="<?php echo $name; ?>">
                        <p class="comments"><?php echo $name_error; ?></p>
                    </div>
                    <div class="form_product">
                        <label for="description">Détails:</label>
                        <input type="text" id="description" name="description"  value="<?php echo $description; ?>">
                        <p class="comments"><?php echo $description_error; ?></p>
                    </div>
                    <div class="form_product">
                        <label for="price">Prix (€):</label>
                        <input type="number" step ="0.01" id="price" name="price"  value="<?php echo $price; ?>">
                        <p class="comments"><?php echo $price_error; ?></p>
                    </div>
                    <div class="form_product">
                        <label for="category">Catégorie:</label>
                       <div class='input-field'>
                            <select id="category" name="category">
                                <option value="" disabled selected>Choose your option</option>
                                <?php 
                                    $db = Database::connect();
                                    foreach($db->query('SELECT * FROM categories') as $row)
                                    {
                                        if($row['id'] == $category)
                                        echo '<option selected = "selected" value ="' . $row['id'] . '">' . $row['name'] . '</option>';
                                        else 
                                        echo '<option = "selected" value ="' . $row['id'] . '">' . $row['name'] . '</option>';
                                    }
                                    Database::disconnect();
                                ?>
                            </select>
                        </div>
                        <p class="comments"><?php echo $category_error; ?></p>
                    </div>
                    <br>
                    <div class="form_product">
                        <label>Image:</label>
                        <p><?php echo $image;?></p>
                        <br>
                        <label for="image">Sélectionner une photo:</label>
                        <br>
                        <input type="file" id="image" name="image">
                        <p class="comments"><?php echo $image_error; ?></p>
                    </div>
                    <br>
                    <div class="form_action">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Modifier</button>
                        <a href="index.php"class="waves-effect waves-light btn">Retour</a>
                    </div>
                </form>
            </div>
            <div class ="col s12 m6 l6 updateShow">
                <img src="<?php echo '../image/'. $image; ?>" alt="menuClassic">
                <br>
                <div><?php echo number_format((float) $price,2,'.',''). ' €' ; ?></div>
                <br>
                <div class="caption">
                    <h2><?php echo $name; ?></h2>
                    <br>
                    <p><?php echo $description; ?></p>
                    <br>
                    <a href="#" class="waves-effect waves-light btn">Commander</a>
                </div>
            </div>
        </div>
    </div> 
    <script src="../js/jquery.js"></script> 
    <script src="../js/materialize.min.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>