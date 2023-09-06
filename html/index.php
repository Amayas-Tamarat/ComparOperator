<?php
require_once('./connect/autoload.php');
require_once('./connect/connect.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <!----HEADER PART--->
    <div class="accueil">
        <?php
        include('./partials/nav.php')
        ?>

        <div>
            <h2>Bon voyage</h2>
        </div>
    </div>

    <!-- IMAGE -->

    <div class="">
        <?php
        $destinations = new Manager($db);
        $listeDestinations = $destinations->getAllDestination(); 
        ?>

        <div class="d-flex">
            <div class="card">
                <img src='./upload/<?php echo $listeDestinations[0]->getImages(); ?>' class='img-fluid'>
                <div class="overlay">
                    <?php echo $listeDestinations[0]->getLocation() . "<br>";
                    echo $listeDestinations[0]->getPrice(); ?>
                </div>
            </div>
            <div class="card">
                <img src='./upload/<?php echo $listeDestinations[1]->getImages(); ?>' class='img-fluid'>
                <div class="overlay">
                    <?php echo $listeDestinations[1]->getLocation() . "<br>";
                    echo $listeDestinations[1]->getPrice(); ?>
                </div>
            </div>
            <div class="card">
                <img src='./upload/<?php echo $listeDestinations[2]->getImages(); ?>' class='img-fluid'>
                <div class="overlay">
                    <?php echo $listeDestinations[2]->getLocation() . "<br>";
                    echo $listeDestinations[2]->getPrice(); ?>
                </div>
            </div>
            <div class="card">
                <img src='./upload/<?php echo $listeDestinations[3]->getImages(); ?>' class='img-fluid'>
                <div class="overlay">
                    <?php echo $listeDestinations[3]->getLocation() . "<br>";
                    echo $listeDestinations[3]->getPrice(); ?>
                </div>
            </div>
        </div>


        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>