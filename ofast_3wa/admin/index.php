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
        <h1 class="text-logo">O'Fast</h1>       
    </div>
    <div class="container admin">
        <div class="row">
            <h2>Liste des produits</h2>
            <a href="insert.php"class="waves-effect waves-light btn">Ajouter</a>
            <table class="striped responsive-table">
                <thead>
                    <tr>
                        <th>Noms</th>
                        <th>Détails</th>
                        <th>Prix</th>
                        <th>Catégories</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require 'database.php';
                        $db = Database::connect();
                        $statement = $db->query('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category
                                                FROM items LEFT JOIN categories ON items.category = categories.id
                                                ORDER BY items.id DESC');
                        while($item = $statement->fetch())
                        {
                            echo '<tr>';
                            echo '<td>'. $item['name'] .'</td>';
                            echo'<td>'. $item['description'] .'</td>';
                            echo'<td>' . number_format((float) $item['price'],2,'.','') .' €'.'</td>';
                            echo'<td>'. $item['category'].'</td>';
                            echo'<td class="button_td">';
                                echo '<a class="waves-effect waves-light btn-small buttView" href="view.php?id='. $item['id'] . '" >Voir</a>';
                                echo '<a class="waves-effect waves-light btn-small buttMod" href="update.php?id='. $item['id'] . '">Modifier</a>';
                                echo '<a class="waves-effect waves-light btn-small buttSup" href="delete.php?id='. $item['id'] . '">Supprimer</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        Database::disconnect();
                    ?>
                </tbody>
            </table>
        </div>  
    </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/materialize.min.js"></script>
    <script src="../js/app.js"></script>
</body>
</html>