<?php

include('session.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") { // verifica se la richiesta ricevuta è un POST
    $nome = test_input($_POST['Nome']);
	 $cognome = test_input($_POST['Cognome']);
    $password = test_input($_POST['Pass_Stud']);
	 $email = test_input($_POST['Email']);
	  $data = test_input($_POST['birthday']);
	 $citta = test_input($_POST['citta']);
	 $conn = new mysqli("localhost","root","","scuola");
	 if ($conn->connect_error) {
            die("connessione fallita: " . $conn->connect_error);
        } 
  $select = mysqli_query($conn, "SELECT * FROM STUDENTE WHERE email = '".$_POST['Email']."'");
if(mysqli_num_rows($select)) { // controllo se un'email simile già esiste per un altro studente
  
   echo"<script> alert('Errore inserimento:email già esistente!!'); </script>";
}      
		else{ $sql = "
                INSERT INTO STUDENTE(Nome,Cognome,Email,Pass_Stud,data,citta)
                VALUES ('" . $nome . "', '" . $cognome . "','" . $email . "','" . $password . "','" . $data . "','" . $citta . "')";
				//questo sql2 server per aggiornare la tabella inserimento_studente,creatasi per via della molteplicità N a N 
				$sql2=" SELECT ID_Seg from SEGRETARIO WHERE Username='".$_SESSION['login_user']."'";
				$value=  mysqli_query($conn,$sql2); // value è un oggetto, ma lo voglio in stringa(ID_Seg) per poterlo inserire nella tabella
				$row=mysqli_fetch_row($value);
				$resultstring = $row[0];
				$sql3 = "INSERT INTO inserimento_studente (Id_Seg, Mat) VALUES ( '" . $resultstring . "', LAST_INSERT_ID())";

$result1 = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql3); 
			
           // $conn->query($sql) === TRUE
         if ($result1  ) {
			if($result2) 
			{  
				header("Location: inserimentoStud.php");
		
			}
          
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
		}
}
function test_input($data) {
    $data = trim($data); // rimuovo caratteri strani
    $data = stripslashes($data); // rimuovo backslashes 
    $data = htmlspecialchars($data); // converto caratteri predefiniti in entità hmtl
    return $data;
}
?>
		
<html>
<head>
 <title>Inserimento Studente</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="style2.css">
		   <meta name="viewport" content="width=device-width,initial-scale=1.0">
	<script type="text/javascript">
	
	<!--
		function valida(){

			var nom = document.inserimento.Nome.value;
			var cogn=document.inserimento.Cognome.value;
			var pass = document.inserimento.Pass_Stud.value;
			var email = document.inserimento.Email.value;
	        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            var data = document.inserimento.birthday.value;
			var citta = document.inserimento.citta.value;




			if(nom == "" || !isNaN(nom)){
				
			alert("inserisci nome!");
				return false;
			} 
				if(cogn == "" || !isNaN(cogn)){
				
			alert("inserisci cognome!");
				return false;
			} 
			


			if(pass== ""){
				
				alert("inserisci password!");
				return false;
			}
			if((pass.length < 5) || (pass.length > 30)) {
				
				alert("La password deve essere compresa tra i 5 e 30 caratteri!!");
				return false;	
			}

			if(email == ""){
				
				alert("inserisci email!");
				return false;
			}
			if(!email.match(mailformat))
			{
				alert(" email address non valido!");
				document.inserimento.Email.focus();
					return false;
            }
			
			if(data == ""){
				
				alert("inserisci data!");
				return false;
			}
			
			if(citta == "" || !isNaN(citta)){
				
				alert("inserisci città!");
				return false;
			}
    
          alert("Inserimento inviato!!");
		   return true;


		}
		
//-->
	
	
	</script>
</head>

<body>
<form method ="post" action="" name="inserimento">
<h1>Inserimento Stud</h1>
             <label for "Nome"> Nome </label>
            <input type="text" id="Nome" placeholder="Nome" name="Nome" maxlength="20" required>
			<label for "Cognome"> Cognome </label>
		 <input type="text" id="Cognome" placeholder="cognome" name="Cognome" maxlength="20" required>
		 <label for "Pass_Stud"> Password </label>
            <input type="password" id="Pass_Stud" placeholder="Password" name="Pass_Stud" maxlength="30" required>
			<label for "Email"> Email </label>
			<input type="text" id="Email" placeholder="email" name="Email" maxlength="30" required>
			<label for "birthday"> Data di nascita </label>
			<input type="date" id="birthday" name="birthday" required>
			<label for "citta"> Luogo di nascita </label>
			<input type="text" id="citta" placeholder="luogo di nascita" name="citta" maxlength="30" required>
			
            <button type="sumbit" name="Registra" onClick="return valida()">Inserisci</button>
			<br>
			<a href="logout.php">Logout </a>
			<br>
			<a href="inserimentoVoti.php">Inserisci voti </a>
        </form>

			

</body>
</html>