<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password hanno escape, per evitare sql injection
      
      $myusername = mysqli_real_escape_string($db,$_POST['Username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['Pass']); 
        
      $sql = "SELECT ID_Seg FROM SEGRETARIO WHERE Username = '$myusername' and Pass = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      
      $count = mysqli_num_rows($result);
      
      // If result trova $myusername and $mypassword, table row deve essere 1 
		
      if($count == 1) {
        
         $_SESSION['login_user'] = $myusername; // regolo sessione
         
         header("location: inserimentoStud.php");
      }else {
         echo "<script> alert('dati errati o non esistenti') </script>";
      }
   }
?>
<html>
   
   <head>
      <title>Login Segretario</title>
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="style2.css">
       <script type="text/javascript">
	
	<!--
		function valida(){

			var user = document.prof.Username.value;
			var pass = document.prof.Pass.value;

			if(user == ""){
				
			alert("inserisci username!");
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
   
  
	
     
               
               <form action = "" method = "post" name="prof">
			   <h1>Login Segretario</h1>
                  <label>UserName  :</label><input type = "text" name = "Username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "Pass" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit " onClick="return valida()"/><br />
				  <br>
			<a href="register.php"> Sign up </a>
			 <br>
			<a href="loginStud.php"> Sei uno studente? </a>
               </form>
    <center>
	<marquee behavior="scroll" direction="up">
	<img src="login.jpg">
	</marquee>
	</center>           

   </body>
</html>