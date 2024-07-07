<?php
$servername = "localhost";
$usernamedb = "root";
$passworddb = "";
$dbname = "scuola";

if ($_SERVER["REQUEST_METHOD"] == "POST") { // verifica se la richiesta ricevuta è un POST
    $username = test_input($_POST['Username']);
    $password = test_input($_POST['Pass']);
	 $codice = test_input($_POST['Codice']);
    
   
    
    
  
 // creo connessione
        $conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);
        // controllo connessione
        if ($conn->connect_error) {
            die("connessione fallita: " . $conn->connect_error);
        } 
      $select = mysqli_query($conn, "SELECT * FROM SEGRETARIO WHERE username = '".$_POST['Username']."'");
if(mysqli_num_rows($select)) { // controllo se un segretario si è gia registrato con quell'username
 
   echo"<script> alert('Usenrname già esistente!!'); </script>";
}
		else{
            $sql = "
                INSERT INTO SEGRETARIO(Username,Pass)
                VALUES ('" . $username . "', '" . $password . "')";
             
        if ($conn->query($sql) === TRUE) {
			
		 header("Location: login.php");
            //echo "New record creato";
			//echo "Effettua login: <a href=login.html>Login</a>";
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
	   <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Registrazione</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="style2.css">


	<script type="text/javascript">
	
	<!--
		function valida(){

			var user = document.registrazione.Username.value;
			var pass = document.registrazione.Pass.value;
			var codice = document.registrazione.Codice.value;
	        





			if(user == ""){
				
			alert("inserisci username!");
				return false;
			} 
			if((user.length <= 2) || (user.length > 50)) {
				
				alert("L'username deve essere compreso tra i 3 e 50 caratteri!!");
				return false;	
			}
			


			if(pass== ""){
				
				alert("inserisci password!");
				return false;
			}
			if((pass.length < 5) || (pass.length > 20)) {
				
				alert("La password deve essere compresa tra i 5 e 20 caratteri!!");
				return false;	
			}

			if(codice == ""){
				
				alert("inserisci codice!");
				return false;
			}
			if(codice!="777") { // controllo codice universale segretari
				
				alert("il codice riportato non combacia !");
				return false;
			}
        
		   return true;


		}
		
//-->
	
	
	</script>
	<script type="text/javascript">
	<!--
	$(window).scroll(function(){
    $('#header').css({
        'left': $(this).scrollLeft() + 15 
         //Why this 15, because in the CSS, we have set left 15, so as we scroll, we would want this to remain at 15px left
    });
});
//-->
</script>


    </head>
    <body>
        <form method="post" action="" name="registrazione" >
            <h1>Registrazione</h1>
			<label for "Username"> Username </label>
            <input type="text" id="Username" placeholder="Username" name="Username" maxlength="50" required>
			<label for "Pass"> Password </label>
            <input type="password" id="Pass" placeholder="Password" name="Pass" maxlength="20" required >
			<label for "Codice"> Codice </label>
			<input type="password" id="Codice" placeholder="codice" name="Codice" required>
            <button type="sumbit" name="Registra" onclick=" return valida()">Registrati</button>
			<br>
					<a href="login.php">
Login Segretario
</a>
<br>
<a href="loginStud.php">
Login Studente
</a>
        </form>
	<center>
	<marquee behavior="alternate" direction="right">
	<img src="reg.jpg">
	</marquee>
	</center>


    </body>
</html>
