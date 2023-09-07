<?php
require_once('./connect/autoload.php');
require_once('./connect/connect.php');


$manager = new Manager($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_destination'])) {
        $destinationIdDelete = $_POST['destination_id'];
        $manager->removeDestination($destinationIdDelete);
    } elseif (isset($_POST['add_destination'])) {
        $DestinationData = [
            'location' => $_POST['new_location'],
            'price' => $_POST['new_price'],
        ];
        $Destination = new Destination($DestinationData);
        $manager->createDestination($Destination, $_POST['new_tour_operator']);
    } elseif (isset($_POST['add_certification'])) {
        $date = new DateTime($_POST['new_date']);
        $CertificationData = [
            'expiresAt' => $date->format('Y-m-d'),
            'signatory' => $_POST['new_sign'],
        ];
        $newCertificate = new Certificate($CertificationData);
        $manager->createCertificate($newCertificate, $_POST['new_tour_operator']);
    } elseif (isset($_POST['create_tour_operator'])) {
        $TourOperatorData = [
            'name' => $_POST['new_name'],
            'link' => $_POST['new_link'],
        ];
        $newTourOperator = new TourOperator($TourOperatorData);
        $manager->createTourOperatorDB($newTourOperator);        
    }
}


$tourOperators = $manager->findAllTourOperator();
// foreach ($tourOperators as $tourOperator) {
//     $tourOperator= $manager->createTourOperator($tourOperator);
//     var_dump($tourOperator);
// }
$destinations = $manager->getAllDestination();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <link rel="stylesheet" href="./css/adminStyle.css">
</head>

<body>
    <h1>Delete Destination</h1>
    <div class="container">
        <div class="form-section">
            <h2>Delete Destination</h2>
            <form method="POST" action="">
                <label for="destination_id">Select a destination to delete:</label>
                <select name="destination_id" id="destination_id">
                    <?php foreach ($destinations as $destination) : ?>
                        <option value="<?php echo $destination->getid(); ?>">
                            <?php echo $destination->getLocation(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="delete_destination">Delete</button>
            </form>
        </div>

        <div class="form-section">
            <h2>Create Destination</h2>
            <form method="POST" action="">
                <label for="new_location">Location:</label>
                <input type="text" name="new_location" id="new_location" required><br>

                <label for="new_price">Price:</label>
                <input type="number" name="new_price" id="new_price" required><br>
                <label for="new_tour_operator">Tour Operator:</label>
                <select name="new_tour_operator" id="new_tour_operator">
                    <?php foreach ($tourOperators as $operator) : ?>
                        <option value="<?php echo $operator->getId(); ?>">
                            <?php echo $operator->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="add_destination">Create Destination</button>
            </form>
        </div>

        <div class="form-section">
            <h2>Create Certificate</h2>
            <form method="POST" action="">
                <label for="new_date">Expiration Date:</label>
                <input type="date" name="new_date" id="new_date" required><br>

                <label for="new_sign">Signatory:</label>
                <input type="text" name="new_sign" id="new_sign" required><br>
                <label for="new_tour_operator">Tour Operator:</label>
                <select name="new_tour_operator" id="new_tour_operator">
                    <?php foreach ($tourOperators as $operator) : ?>
                        <option value="<?php echo $operator->getId(); ?>">
                            <?php echo $operator->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="add_certification">Create Certificate</button>
            </form>
        </div>

        <div class="form-section">
            <h2>Create Tour Operator</h2>
            <form method="POST" action="">
                <label for="new_name">Name:</label>
                <input type="text" name="new_name" id="new_name" required><br>

                <label for="new_link">Link:</label>
                <input type="text" name="new_link" id="new_link" required><br>

                <button type="submit" name="create_tour_operator">Create Tour Operator</button>
            </form>
        </div>
    </div>

    <?php foreach ($tourOperators as $tourOperator) : ?>
        <?php $tourOperator = $manager->createTourOperator($tourOperator); ?>
        <div class="tour-operator-info">
            <h2>Tour Operator Information</h2>
            <strong>Name:</strong> <?php echo $tourOperator->getName(); ?><br>
            <strong>Link:</strong> <a href="<?php echo $tourOperator->getLink(); ?>"><?php echo $tourOperator->getLink(); ?></a><br>
            <strong>Certificates:</strong> <?php echo ($tourOperator->getCertificate() !== null ? 'Yes' : 'No'); ?><br>
            <strong>Destinations:</strong> <?php echo count($tourOperator->getDestinations()); ?><br>
        </div>
    <?php endforeach; ?>
</body>

</html>

<?php
// foreach ($destinations as $destination) {
//     echo '<div>';
//     echo 'location = ' . $destination->getLocation() . '<br>';
//     echo 'price = ' . $destination->getPrice() . '<br>';
//     echo 'id = ' . $destination->getid();
//     echo '</div>';
// }
// foreach ($tourOperators as $tourOperator) {
//     $tourOperator = $manager->createTourOperator($tourOperator);
//     echo '<div>';
//     echo '<h2>Tour Operator Information</h2>';
//     echo '<strong>Name:</strong> ' . $tourOperator->getName() . '<br>';
//     echo '<strong>Link:</strong> <a href="' . $tourOperator->getLink() . '">' . $tourOperator->getLink() . '</a><br>';
//     echo '<strong>Destinations:</strong> ' . count($tourOperator->getDestinations()) . '<br>';
//     echo '</div>';
    
// }


?>