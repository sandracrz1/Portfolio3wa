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
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="container">
    <h1 class="logo">O'Fast</h1>       
</div>
    <div class="container admin">
        <div class="row">
            <div class="col s12 m6 l6">
                <h2>Supprimer un item</h2>
                <form class="form" role="form" action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <p class="suppItem">Etes vous sûr de vouloir supprimer l'item ?</p>
                    <br>
                    <div class="form_action">
                        <button class="btn waves-effect waves-light ouiDelete" type="submit" name="action">Oui</button>
                        <a href="index.php"class="waves-effect waves-light btn nonDelete">Non</a>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <script src="../js/jquery.js"></script> 
    <script src="../js/materialize.min.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>