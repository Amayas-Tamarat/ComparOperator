<?php
require_once('./connect/autoload.php');
require_once('./connect/connect.php');

$manager = new Manager($db);
$operator = $manager->findOperatorById(3);
$tourOperator =$manager->createTourOperator($operator);

if(isset($_POST['name']) && $_POST['name'] !=""){
    $manager->insertReview($tourOperator, $_POST['name'],$_POST['note'],$_POST['comments'] );
    header("Location: ./listTourOperators.php");  
}
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
    <div>
        <h3><?php echo $tourOperator->getName() ?></h3>
        <p><?php echo($manager->tourNote($tourOperator)) ?></p>

        <form class="reviewForm" action="" method="post">
            <label for="name">Enter your name</label>
            <input type="text" name="name">
            <label for="note">rate :</label>
            <input type="number" name="note" placeholder="Rate the tour from 1 to 5">
            <label for="comments">Comments:</label>
            <input type="text" name="comments">
            <input type="submit">
        </form>

        <?php
            $manager->displayReviews($tourOperator);
        ?>
    </div>
    
</body>
</html>