<?php
    $manager = new Manager($db);

    $list = $manager->getAllDestination();
    foreach($list as $destination)
    {
        echo '<p>' . $destination->getLocation() . '</p>';
    }
?>