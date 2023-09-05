<?php
require_once('./connect/autoload.php');
require_once('./connect/connect.php');


$manager = new Manager($db);
$destinations= $manager->getAllDestination();

foreach($destinations as $destination){
    echo '<div>';
    echo 'id ='.$destination->getId().'<br>';
    echo 'location ='.$destination->getLocation().'<br>';
    echo 'price ='.$destination->getPrice().'<br>';
    echo '</div>';
}
?>