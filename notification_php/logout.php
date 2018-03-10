<?php 
SESSION_START();

unset($_SESSION['userid']);
header('Location: login.php');
?>