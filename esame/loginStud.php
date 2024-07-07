<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // escape su username e password per evitare sql injection
      
      $myusername = mysqli_real_escape_string($db,$_POST['Matricola']);
      $mypassword = mysqli_real_escape_string($db,$_POST['Pass']); 
      
      $sql = "SELECT * FROM STUDENTE WHERE Matricola = '$myusername' and Pass_Stud = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      
      $count = mysqli_num_rows($result);
      
      // If result trova $myusername and $mypassword, table row deve essere 1 
		
      if($count == 1) {
        
         $_SESSION['login_stud'] = $myusername; // regolo sessione
         
         header("location: visualizza.php");
      }else {
            echo "<script> alert('dati errati o non esistenti') </script>";
      }
   }
?>
<html>
   
   <head>
      <title>Login Studente</title>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap">
     <link rel="stylesheet" href="style3.css">
	    <meta name="viewport" content="width=device-width,initial-scale=1.0">
	 <script type="text/javascript">
	
	<!--
		function valida(){

			var mat = document.stud.Matricola.value;
			var pass = document.stud.Pass.value;

			if(mat == ""){
				
			alert("inserisci matricola!");
				return false;
			} 

			if(pass== ""){
				
				alert("inserisci password!");
				return false;
			}
			

		   return true;


		}
		
//-->
	
	
	</script>
      
   </head>
   <body>
        <div class="wrapper">
         <div class="title">
            Login Studente
         </div>
         <form action="" method="post" name="stud">
            <div class="field">
               <input type="text" name= "Matricola"required>
               <label>Matricola</label>
            </div>
            <div class="field">
               <input type="password" name="Pass" required>
               <label>Password</label>
            </div>
            
            <div class="field">
               <input type="submit" value="Login" onClick="return valida()">
            </div>
            
         </form>
      </div>
	
     
             
               

   </body>
</html>