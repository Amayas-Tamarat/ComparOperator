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
        <?php
        $destinations = new Manager($db);
        $listeDestinations = $destinations->getAllDestination();
        ?>

        <div class="container">
            <?php foreach ($listeDestinations as $destination) : ?>
                    <div class="card">
                        <a href="./listTourOperators.php?tour_operator_id=<?php echo $destination->getTour_operator_id(); ?>">
                            <img src='./upload/<?php echo $destination->getImages(); ?>' class='img-fluid'>

                            <div class="overlay">
                                <?php echo $destination->getLocation() . "<br>";
                                echo $destination->getPrice() . " € "; ?>
                            </div>
                        </a>
                    </div>
            <?php endforeach; ?>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>