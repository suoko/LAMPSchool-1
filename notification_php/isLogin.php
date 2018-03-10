<?php 
	if(!isset($_SESSION['idutente']))
	{
		header('Location: login.php');
	}
 ?>