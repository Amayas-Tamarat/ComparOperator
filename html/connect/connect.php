<?php 
$user = 'root';
$pass = '';

try {
    $db = new PDO('mysql:host=localhost;dbname=comparoperator', $user, $pass);
} catch (PDOException $e) {
      print "Erreur ! : " . $e->getMessage() . "<br/>";
      die();
}

?>