<?php

class dbconn {
	public $dblocal;
	public function __construct()
	{

	}
	public function initDBO()
	{
		$this->dblocal = new PDO("mysql:host=localhost;dbname=LAMPSchool-1;charset=latin1","root","pwd",array(PDO::ATTR_PERSISTENT => true));
		$this->dblocal->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);	
		
	}
}
?>
