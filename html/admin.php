<?php
require_once('./connect/autoload.php');
require_once('./connect/connect.php');


$manager = new Manager($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_destination'])) {
        $destinationIdDelete = $_POST['destination_id'];
        $manager->removeDestination($destinationIdDelete);
    } elseif 
    (isset($_POST['add_destination'])) { 
        $DestinationData = [
            'location' => $_POST['new_location'],
            'price' => $_POST['new_price'],
        ];
        $Destination = new Destination($DestinationData);
        $manager->createDestination($Destination,$_POST['new_tour_operator']);
    } elseif 
    (isset($_POST['add_certification'])) { 
        $date = new DateTime($_POST['new_date']);
        $CertificationData = [
            'expiresAt' => $date->format('Y-m-d'),
            'signatory' => $_POST['new_sign'],
        ];
        $newCertificate = new Certificate($CertificationData);
        var_dump($newCertificate);
        $manager->createCertificate($newCertificate, $_POST['new_tour_operator']);
    }
}


$tourOperators = $manager->findAllTourOperator();
$destinations = $manager->getAllDestination();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Destination</title>
</head>
<body>
    <h1>Delete Destination</h1>    
    <form method="POST" action="">
        <label for="destination_id">Select a destination to delete:</label>
<select name="destination_id" id="destination_id">
    <?php foreach ($destinations as $destination) : ?>
        <option value="<?php echo $destination->getid(); ?>">
            <?php echo $destination->getLocation(); ?>
        </option>
    <?php endforeach; ?>
</select>
        </select>
        <button type="submit" name="delete_destination">Delete</button>
    </form>
    
    <h1>Create Destination</h1>  
    <form method="POST" action="">
        <label for="new_location">Location:</label>
        <input type="text" name="new_location" id="new_location" required><br>
        
        <label for="new_price">Price:</label>
        <input type="number" name="new_price" id="new_price" required><br>
        <select name="new_tour_operator" id="new_tour_operator">
            <?php foreach ($tourOperators as $operator) : ?>
                <option value="<?php echo $operator->getId(); ?>">
                    <?php echo $operator->getName(); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="add_destination">Create Destination</button>
    </form>

    <h1>Create Certificate</h1>  
    <form method="POST" action="">
        <label for="new_date">Expiration Date:</label>
        <input type="date" name="new_date" id="new_date" required><br>
        
        <label for="new_sign">Signatory:</label>
        <input type="text" name="new_sign" id="new_sign" required><br>
        <select name="new_tour_operator" id="new_tour_operator">
            <?php foreach ($tourOperators as $operator) : ?>
                <option value="<?php echo $operator->getId(); ?>">
                    <?php echo $operator->getName(); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="add_certification">Create Certificate</button>
    </form>
</body>
</html>
<?php 
foreach($destinations as $destination){
    echo '<div>';
    echo 'location ='.$destination->getLocation().'<br>';
    echo 'price ='.$destination->getPrice().'<br>';
    echo 'id'.$destination->getid();
    echo '</div>';
}
?>

