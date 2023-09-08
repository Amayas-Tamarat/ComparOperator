<?php
require_once('./connect/autoload.php');
require_once('./connect/connect.php');


function authenticate($username, $password)
{
    return $username === 'root' && $password === 'root';
}

$manager = new Manager($db);
// Check if the user is already authenticated.
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // User is already authenticated, continue with the admin panel code.
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authenticate($username, $password)) {
        $_SESSION['authenticated'] = true;
    } else {
        echo "Mauvais mdp ou usernames.";
        exit;
    }
} else {
    include('./login.php');
    exit;
}




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
    } elseif (isset($_POST['delete_tour_operator'])) {
        $idTourOperatorToDelete = $_POST['delete_tour_operator'];
        if ($manager->removeTourOperator($idTourOperatorToDelete)) {
            header('Location: confirmation.php');
            exit;
        } else {
            echo "Error deleting the Tour Operator.";
        }
    }
}


if (isset($_POST['addPremium']) && $_POST['addPremium'] != "") {
    $manager->addPremium($_POST['addPremium']);
    $_POST['addPremium'] = "";
}
if (isset($_POST['removePremium']) && $_POST['removePremium'] != "") {
    $manager->removePremium($_POST['removePremium']);
    $_POST['removePremium'] = "";
}



$tourOperators = $manager->findAllTourOperator();
$destinations = $manager->getAllDestination();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <link rel="stylesheet" href="./css/adminStyle.css">
</head>

<body>
    <h1>Admin Page</h1>
    <div class="container">
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
    </div>

    <?php foreach ($tourOperators as $tourOperator) : ?>
        <?php $tourOperator = $manager->createTourOperator($tourOperator); ?>
        <div class="tour-operator-info">
            <h2>Tour Operator Information</h2>
            <strong>Name:</strong> <?php echo $tourOperator->getName(); ?><br>
            <strong>Link:</strong> <a href="<?php echo $tourOperator->getLink(); ?>"><?php echo $tourOperator->getLink(); ?></a><br>
            <strong>Certificates:</strong> <?php echo ($tourOperator->getCertificate() !== null ? 'Yes' : 'No'); ?><br>
            <strong>Destinations:</strong> <?php echo count($tourOperator->getDestinations()); ?><br>
            <form method="POST" action="">
                <input type="hidden" name="delete_tour_operator" value="<?php echo $tourOperator->getId(); ?>">
                <button type="submit">Delete Tour Operator</button>
            </form>
            <form action="" method="post">
                <label for="removePremium">Retirer premium</label>
                <input type="hidden" name="removePremium" value="<?php echo $tourOperator->getId(); ?> ">
                <input type="submit">
            </form>
            <form action="" method="post">
                <label for="addPremium">Ajouter premium</label>
                <input type="hidden" name="addPremium" value="<?php echo $tourOperator->getId(); ?>">
                <input type="submit">

            </form>

            <hr>
            <h3>Destinations</h3>
            <div>
                <?php foreach ($tourOperator->getDestinations() as $destination) : ?>
                    <div>
                        <strong>Location:</strong> <?php echo $destination->getLocation(); ?><br>
                        <strong>Price:</strong> <?php echo $destination->getPrice(); ?><br>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</body>

</html>