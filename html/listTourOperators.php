<?php
require_once('./connect/autoload.php');
require_once('./connect/connect.php');

$manager = new Manager($db);
$operator = $manager->findOperatorById(2);
$tourOperator =$manager->createTourOperator($operator);
var_dump($tourOperator);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
<?php
    include('./partials/nav.php');
    ?>
    <h3><?php echo $tourOperator->getName() ?></h3>

    <form action="" method="post">
        <label for=""></label>
        <input type="number">
        <label for=""></label>
        <input type="text">
    </form>
</body>
</html>