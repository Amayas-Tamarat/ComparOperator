<?php

require_once('./connect/connect.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>

<body>
    <!----HEADER PART--->
    <div>
        <nav>
            <ul>
                <li><a href="">Accueil</a></li>
                <li><a href="">Page 2</a></li>
                <li><a href="">Page 3</a></li>
                <li><a href="">Page 4</a></li>
                <li><a href="">Page 5</a></li>
                <li><a href="">Page 6</a></li>
            </ul>
        </nav>
    </div>
    <!----Carousel --->
    <div class="pictures">
        <div class="container">
            <div class="row">
                <div class="col-8 py-2">
                    <img class="img-fluid" src="./assets/picture/monaco.jpg" alt="">
                </div>

                <div class="col-4 py-2">
                    <div class="row">
                        <img class="img-fluid" src="./assets/picture/londres.jpg" alt="">
                    </div>
                    <div class="row pt-2">
                        <img class="img-fluid" src="./assets/picture/paris.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <img class="img-fluid" src="./assets/picture/tunis.jpg" alt="">
                </div>
                <div class="col-6">
                    <img class="img-fluid" src="./assets/picture/tunis.jpg" alt="">
                </div>
            </div>
        </div>


    </div>
</body>

</html>