<?php 
$user = 'root';
$pass = 'root';

try {
    $db = new PDO('mysql:host=mysql;dbname=', $user, $pass);
} catch (PDOException $e) {
      print "Erreur ! : " . $e->getMessage() . "<br/>";
      die();
}

?>