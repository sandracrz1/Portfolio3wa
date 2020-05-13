<?php
    require 'database.php';

    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }
   
    $db = Database::connect();
    $statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category
                             FROM items LEFT JOIN categories ON items.category = categories.id
                             WHERE items.id = ?');
   

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
                <h2>Voir un produit</h2>
                <form>
                    <div class="form_product">
                        <label>Nom:</label><?php echo ' '. $item ['name']; ?>
                    </div>
                    <div class="form_product">
                        <label>Détails:</label><?php echo ' '. $item ['description']; ?>
                    </div>
                    <div class="form_product">
                        <label>Prix:</label><?php echo ' '. number_format((float) $item['price'],2,'.','') .' €'; ?>
                    </div>
                    <div class="form_product">
                        <label>Catégorie:</label><?php echo ' '. $item ['category']; ?>
                    </div>
                    <div class="form_product">
                        <label>Photo:</label><?php echo ' '. $item ['image']; ?>
                    </div>
                </form>
                <br>
                <div>
                    <a href="index.php"class="waves-effect waves-light btn">Retour</a>
                </div>
                <br>
            </div>
            <div class ="col s12 m6 l6">
                <img src="<?php echo '../image/'. $item ['image']; ?>" alt="menuClassic">
                <div><?php echo number_format((float) $item['price'],2,'.',''). ' €' ; ?></div>
                <div class="caption">
                    <h2><?php echo $item ['name']; ?></h2>
                    <p><?php echo $item ['description']; ?></p>
                    <br>
                    <a href="#" class="waves-effect waves-light btn">Commander</a>
                </div>
            </div>
        </div>  
    <script src="../js/jquery.js"></script>
    <script src="../js/materialize.min.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>