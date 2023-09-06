<?php

require_once('../connect/autoload.php');
require_once('../connect/connect.php');

if (isset($_FILES['file'])) {
    $tmpName = $_FILES['file']['tmp_name'];
    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];

    $tabExtension = explode('.', $name);
    $extension = strtolower(end($tabExtension));
    //Tableau des extensions que l'on accepte
    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
    //Taille max que l'on accepte
    $maxSize = 4000000;

    if (in_array($extension, $extensions) && $size <= $maxSize && $error == 0) {

        $uniqueName = uniqid('', true);
        //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
        $file = $uniqueName . "." . $extension;
        //$file = 5f586bf96dcd38.73540086.jpg

        $destination = '../upload/' . $file;
        $destination_id = $_POST['destination_id'];

        if (move_uploaded_file($tmpName, $destination)) {
            $sql = "UPDATE destination SET images = ? WHERE id = ?";
            $stmt = $db->prepare($sql);
            
            if ($stmt) {
                if ($stmt->execute([$file, $destination_id])) {
                    header('Location: ../index.php');
                    exit();
        } else {
            echo "Error: Failed to move the uploaded file.";
        }
    } else {
        echo "Error: Invalid file.";
    }
}
    }
}
