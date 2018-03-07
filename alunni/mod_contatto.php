<?php session_start();

/*
Copyright (C) 2015 Pietro Tamburrano
Questo programma è un software libero; potete redistribuirlo e/o modificarlo secondo i termini della 
GNU Affero General Public License come pubblicata 
dalla Free Software Foundation; sia la versione 3, 
sia (a vostra scelta) ogni versione successiva.

Questo programma è distribuito nella speranza che sia utile 
ma SENZA ALCUNA GARANZIA; senza anche l'implicita garanzia di 
POTER ESSERE VENDUTO o di IDONEITA' A UN PROPOSITO PARTICOLARE. 
Vedere la GNU Affero General Public License per ulteriori dettagli.

Dovreste aver ricevuto una copia della GNU Affero General Public License
in questo programma; se non l'avete ricevuta, vedete http://www.gnu.org/licenses/
*/

	//Programma per la modifica dell'elenco delle tbl_aule
   
	@require_once("../php-ini".$_SESSION['suffisso'].".php");
	
	@require_once("../lib/funzioni.php");
	
	// istruzioni per tornare alla pagina di login 
	////session_start();
	
	
   $tipoutente=$_SESSION["tipoutente"]; //prende la variabile presente nella sessione
	if ($tipoutente=="")
	   {
	   header("location: ../login/login.php?suffisso=".$_SESSION['suffisso']); 
	   die;
	   }	
	
	$titolo="Modifica dati di contatto tutor";
    $script=""; 
    stampa_head($titolo,"",$script,"T");
    //stampa_testata("<a href='../login/ele_ges.php'>PAGINA PRINCIPALE</a> - $titolo","","$nome_scuola","$comune_scuola");
   

	//Connessione al server SQL
	$con=mysqli_connect($db_server,$db_user,$db_password,$db_nome);
	if(!$con)
	{
		print("\n<h1> Connessione al server fallita </h1>");
		exit;
	};
	
	
	//Esecuzione query
   $sql="select * from tbl_alunni where idalunno=". $_SESSION['idutente'];
	$ris=mysqli_query($con,inspref($sql)) or die("Errore: ".inspref($sql));
	 $dati = mysqli_fetch_array($ris) ;
	   
	   $email = $dati['email'];
	   $telcel = $dati['telcel'];
      print "<form action='agg_contatto.php' method='POST'>"; 
	  
	   
	   print "<CENTER><table width='75%' border='0'>";
	 
	   print "<tr><td>Email:</td><td><input type='text' name='email' value='$email'></td></tr>"; 
	   print "<tr><td>Cellulare:</td><td><input type='text' name='telcel' value='$telcel'></td></tr>"; 
	    print "</table>";
	    print "<center><br><b>Con la registrazione dei dati inseriti si autorizza la scuola ad inviare email ed SMS riguardanti le attività scolastiche dell'alunno.</b></center>";
	    print "<CENTER><br> <input type='submit' value='REGISTRA'>";
       print "</CENTER></form>";  
	 
	//stampa_piede("");
	mysqli_close($con);
	

