<?php

require_once('../connect/autoload.php');
require_once('../connect/connect.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="../process/processImage.php" method="POST" enctype="multipart/form-data">
        <label for="file">Ajouter une image pour une destination</label>
        <input type="file" name="file">
        <label for="destination_id">Sélectionnez la destination</label>
        <select name="destination_id" id="destination_id">
            <?php
            $sql = 'SELECT * FROM destination';
            $query = $db->prepare($sql);
            $query->execute();
            $destinations = $query->fetchAll();
            foreach ($destinations as $destination) {
                echo '<option value="' . $destination['id'] . '">' . $destination['location'] . '</option>';
            }
            ?>
        </select>
        <button type="submit">Ajouter</button>
    </form>


</body>

</html>