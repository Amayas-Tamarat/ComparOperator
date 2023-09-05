<?php
require_once('./connect/autoload.php');
require_once('./connect/connect.php');


$manager = new Manager($db);
$destinations= $manager->getAllDestination();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_destination'])) {
        $destinationIdToDelete = $_POST['destination_id'];
        $manager->removeDestination($destinationIdToDelete);
    }
}

$destinations = $manager->getAllDestination();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Destination</title>
</head>
<body>
<h1>Create Destination</h1>
    <form method="POST" action="">
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" required><br>
        
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required><br>
        
        <button type="submit" name="add_destination">Add Destination</button>
    </form>
    <h1>Delete Destination</h1>    
    <form method="POST" action="">
        <label for="destination_id">Select a destination to delete:</label>
        <select name="destination_id" id="destination_id">
            <?php foreach ($destinations as $destination) : ?>
                <option value="<?php echo $destination->getId(); ?>">
                    <?php echo $destination->getLocation(); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="delete_destination">Delete</button>
    </form>
</body>
</html>
<?php 
foreach($destinations as $destination){
    echo '<div>';
    echo 'id ='.$destination->getId().'<br>';
    echo 'location ='.$destination->getLocation().'<br>';
    echo 'price ='.$destination->getPrice().'<br>';
    echo '</div>';
}
?>

