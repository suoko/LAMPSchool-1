<?php 
SESSION_START();

unset($_SESSION['idutente']);
header('Location: login.php');
?>