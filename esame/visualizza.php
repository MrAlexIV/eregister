<?php

include('session2.php');
?>

<html>
<head>
   
    <link rel="stylesheet" type="text/css" href="style4.css" media="screen"/>
   <meta name="viewport" content="width=device-width,user-scalable=no">
	<title> Registro </title>

</head>

<body>
    <header><img src="img2.png" width="300" height="300"/></header>
	
 <div class="container">
 <h2> Registro</h2>
 <table>
     <thead>
	   <tr> 
	       <th>Matricola</th>
		   <th>Condotta</th>
		   <th>Italiano</th>
		   <th>Matematica</th>
		   <th>Storia</th>
		   <th>Informatica</th>
		   <th>Inglese</th>
		   <th>Chimica</th>
		   <th>Media</th>
		   <th>Ritardi</th>
		   <th>Uscite</th>
		   <th>Assenze</th>
		   <th>Note</th>
		   </tr>
		   </thead>
		   
		   <tbody>
		 <?php
		 echo "<br>";
			echo "Effettua logout: <a href=logout2.php>Logout</a>";
		
    
   
	 $conn = new mysqli("localhost","root","","scuola");
	 if ($conn->connect_error) {
            die("connessione fallita: " . $conn->connect_error);
        } 
        
		 $sql = "
                   SELECT Mat,Condotta,Italiano,Matematica,Storia,Informatica,Inglese,Chimica,Media,Ritardi,Uscite,Assenze,Note FROM REGISTRO WHERE Mat='".$_SESSION['login_stud']."'
                ";
				$result=$conn->query($sql);
		if ($result->num_rows>0) {
  while($row=$result->fetch_assoc()){
        $row_mat = $row["Mat"];
        $row_condotta = $row["Condotta"];
        $row_italiano = $row["Italiano"];
        $row_matematica = $row["Matematica"];
		 $row_storia = $row["Storia"];
        $row_informatica = $row["Informatica"];
        $row_inglese = $row["Inglese"];
        $row_chimica = $row["Chimica"];
		 $row_media = $row["Media"];
        $row_ritardi = $row["Ritardi"];
        $row_uscite = $row["Uscite"];
        $row_assenze = $row["Assenze"];
		$row_note = $row["Note"];
         
      
        echo '<tr> 
                <td>' . $row_mat . '</td> 
                <td>' . $row_condotta . '</td> 
                <td>' . $row_italiano . '</td> 
                <td>' . $row_matematica . '</td> 
				 <td>' . $row_storia . '</td> 
                <td>' . $row_informatica . '</td> 
                <td>' . $row_inglese . '</td> 
                <td>' . $row_chimica . '</td> 
				 <td>' . $row_media . '</td> 
                <td>' . $row_ritardi . '</td> 
                <td>' . $row_uscite . '</td> 
                <td>' . $row_assenze . '</td> 
				<td>' . $row_note . '</td> 
                
              </tr>';
			  // controllo se lo studente è promosso oppure no(deve avere media maggiore ugale a 6 e nessun voto sotto il 4. Più non deve avere note>30)
			  if($row_media>=6.00 && $row_italiano>=4 && $row_condotta>=4 && $row_storia>=4 && $row_informatica>=4 && $row_inglese>=4 && $row_chimica>=4  && $row_matematica>=4 && $row_note<=30) echo "<br> <h4> ESITO: PROMOSSO </h4>";
			  else echo "<br> <h4> ESITO: BOCCIATO </h4>";
			  
		}}else {
            echo "<br> Voti non ancora inseriti";
		 } 
			  ?>
		   
		   </tbody>
</table>
</div>
</body>
</html>

