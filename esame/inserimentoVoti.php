<?php

include('session.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") { // verifica se la richiesta ricevuta è un POST
    $matricola = test_input($_POST['Matricola']);
	 $italiano = test_input($_POST['Italiano']);
    $storia = test_input($_POST['Storia']);
	 $inglese = test_input($_POST['Inglese']);
	 	 $matematica = test_input($_POST['Matematica']);
    $chimica = test_input($_POST['Chimica']);
	 $note = test_input($_POST['Note']);
	 	 $assenze = test_input($_POST['Assenze']);
    $ritardi = test_input($_POST['Ritardi']);
	 $uscite = test_input($_POST['Uscite']);
	 	 $informatica = test_input($_POST['Informatica']);
    $condotta = test_input($_POST['Condotta']);
	 $media=($italiano+$condotta+$chimica+$storia+$matematica+$inglese+$informatica)/7;
	 $conn = new mysqli("localhost","root","","scuola");
	 if ($conn->connect_error) {
            die("connessione fallita: " . $conn->connect_error);
        } 
         $select = mysqli_query($conn, "SELECT * FROM REGISTRO WHERE Mat = '".$_POST['Matricola']."'");
if(mysqli_num_rows($select)) { // controllo se per questo studente, sono già stati inseriti i voti di fine anno
   echo"<script> alert('Errore inserimento: Voti già esistenti!!'); </script>";
}
else if(!(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM STUDENTE WHERE Matricola = '".$_POST['Matricola']."'"))))  echo"<script> alert('Errore inserimento: matricola non esistente!!'); </script>";
else{
		 $sql = "
                INSERT INTO REGISTRO(Condotta,Italiano,Matematica,Storia,Informatica,Inglese,Chimica,Media,Ritardi,Uscite,Assenze,Note,Mat)
                VALUES ('" . $condotta . "', '" . $italiano . "','" . $matematica . "','" . $storia . "','" . $informatica . "', '" . $inglese . "','" . $chimica . "','" . $media . "','" . $ritardi . "', '" . $uscite . "','" . $assenze . "','" . $note . "','" . $matricola . "')";
     //questo sql2 server per aggiornare la tabella inserimento_voti,creatasi per via della molteplicità N a N     
  $sql2=" SELECT ID_Seg from SEGRETARIO WHERE Username='".$_SESSION['login_user']."'";
				$value=  mysqli_query($conn,$sql2); // value è un oggetto, ma voglio il valore in stringa di ID_Seg, per poterlo inserire nella tabella
				$row=mysqli_fetch_row($value);
				$resultstring = $row[0];
				$sql3 = "INSERT INTO inserimento_voti (Id_Reg, Id_Seg) VALUES (LAST_INSERT_ID(),'" . $resultstring . "')";

$result1 = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql3); 
       
		
		if ($result1) {
			 if($result2) header("Location: inserimentoVoti.php");
          
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
}}
function test_input($data) {
    $data = trim($data); // rimuovo caratteri strani
    $data = stripslashes($data); // rimuovo backslashes 
    $data = htmlspecialchars($data); // converto caratteri predefiniti in entità hmtl
    return $data;
}
?>
		
<html>
<head>
 <title>Inserimento voti</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="style2.css">
		<img src="voti.jpg" alt="Sunflower" width="150" height="150" style="float: left;">
		   <meta name="viewport" content="width=device-width,initial-scale=1.0">
		
		
		<script type="text/javascript">
	
	<!--
		function valida(){

			var mat = document.voti.Matricola.value;
			var ita=document.voti.Italiano.value;
			var mate = document.voti.Matematica.value;
			var stor = document.voti.Storia.value;
			var ing = document.voti.Inglese.value;
			var cond=document.voti.Condotta.value;
			var info = document.voti.Informatica.value;
			var chi = document.voti.Chimica.value;
			var rit = document.voti.Ritardi.value;
			var ass=document.voti.Assenze.value;
			var usc = document.voti.Uscite.value;
			var not = document.voti.Note.value;




// controllo campi
			if(mat == "" || isNaN(mat)){
			alert("inserisci matricola!");
				return false;
			} 
				if(ita == ""){
				
			alert("inserisci voto in italiano!");
				return false;
			} 
			if((ita < 1) || (ita > 10) || isNaN(ita)) {
			
				alert("voto in italiano non valido!!");
				return false;	
			}
			if(mate == ""){
				
			alert("inserisci voto in matematica!");
				return false;
			} 
			if((mate < 1) || (mate > 10) || isNaN(mate)) {
				
				alert("voto in matematica non valido!!");
				return false;	
			}
			if(cond == ""){
			
			alert("inserisci voto in condotta!");
				return false;
			} 
			if((cond < 1) || (cond > 10) || isNaN(cond)) {
				
				alert("voto in condotta non valido!!");
				return false;	
			}
			if(ing == ""){
				
			alert("inserisci voto in inglese!");
				return false;
			} 
			if((ing < 1) || (ing > 10) || isNaN(ing)) {
				
				alert("voto in inglese non valido!!");
				return false;	
			}
			if(info == ""){
				
			alert("inserisci voto in informatica!");
				return false;
			} 
			if((info < 1) || (info > 10) || isNaN(info)) {
				
				alert("voto in informatica non valido!!");
				return false;	
			}
			if(stor == ""){
				
			alert("inserisci voto in storia!");
				return false;
			} 
			if((stor < 1) || (stor > 10) || isNaN(stor)) {
				
				alert("voto in informatica non valido!!");
				return false;	
			}
			if(chi == ""){
				
			alert("inserisci voto in chimica!");
				return false;
			} 
			if((chi < 1) || (chi > 10) || isNaN(chi)) {
				
				alert("voto in chimica non valido!!");
				return false;	
			}
			if(ass == "" || isNaN(ass)){
				
			alert("inserisci numero assenze!");
				return false;
			} 
			if(not == "" || isNaN(not)){
				
			alert("inserisci numero note!");
				return false;
			} 
			if(rit == "" || isNaN(rit)){
				
			alert("inserisci numero ritardi!");
				return false;
			} 
			if(usc == "" || isNaN(usc)){
				
			alert("inserisci numero uscite!");
				return false;
			} 
          alert("Inserimento inviato!!");
		   return true;


		}
		
//-->
	
	
	</script>
</head>

<body>
<form method ="post" action="inserimentoVoti.php" name="voti">
<h1>Inserimento Voti</h1>
				<label for "Matricola"> Matricola </label>
            <input type="text" id="Matricola" placeholder="Matricola" name="Matricola" maxlength="5" required>
			<label for "Condotta"> Condotta </label>
		 <input type="text" id="Condotta" placeholder="Condotta" name="Condotta" maxlength="2" required>
		 <label for "Italiano"> Italiano </label>
		 <input type="text" id="Italiano" placeholder="Italiano" name="Italiano" maxlength="2" required>
		 <label for "Matematica"> Matematica </label>
		 <input type="text" id="Matematica" placeholder="Matematica" name="Matematica" maxlength="2" required>
		 <label for "Storia"> Storia </label>
		 <input type="text" id="Storia" placeholder="Storia" name="Storia" maxlength="2" required>
		 <label for "Informatica"> Informatica </label>
		 <input type="text" id="Informatica" placeholder="Informatica" name="Informatica" maxlength="2" required>
		 <label for "Inglese"> Inglese </label>
		 <input type="text" id="Inglese" placeholder="Inglese" name="Inglese" maxlength="2" required>
		 <label for "Chimica"> Chimica </label>
		 <input type="text" id="Chimica" placeholder="Chimica" name="Chimica" maxlength="2" required>
		
		 <label for "Ritardi"> Ritardi </label>
		 <input type="text" id="Ritardi" placeholder="Ritardi" name="Ritardi" maxlength="2" required>
		 <label for "Uscite"> Uscite </label>
		 <input type="text" id="Uscite" placeholder="Uscite" name="Uscite" maxlength="2" required>
		 <label for "Assenze"> Assenze </label>
		 <input type="text" id="Assenze" placeholder="Assenze" name="Assenze" maxlength="2" required>
		 <label for "Note"> Note </label>
		 <input type="text" id="Note" placeholder="Note" name="Note" maxlength="2" required>
		 
            <button type="sumbit" name="Registra" onClick="return valida()">Inserisci</button>
			<br>
			<br>
			<a href="logout.php"> Logout</a>
			
        </form>


</body>
</html>