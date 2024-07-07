<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_stud'];
   
   $ses_sql = mysqli_query($db,"select Matricola from STUDENTE where Matricola = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['Matricola'];
   
   if(!isset($_SESSION['login_stud'])){
      header("location:loginStud.php");
      die();
   }
?>