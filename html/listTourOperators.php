<?php
require_once('./connect/autoload.php');
require_once('./connect/connect.php');

    $manager = new Manager($db);
    $list = $manager->getAllDestination();

    var_dump($manager->getOperatorByDestination($list[0]));
?>