<?php
    require 'database.php';
    $db = Database::connect();
    $statement = $db->query('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category
                            FROM items LEFT JOIN categories ON items.category = categories.id
                            ORDER BY items.id DESC');
    $items = $statement->fetchAll();
    Database::disconnect();

    // Sélection et affichage du template PHTML.
    $template = 'index';
    include 'layout.phtml';
?>