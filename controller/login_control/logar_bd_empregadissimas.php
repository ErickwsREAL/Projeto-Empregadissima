<?php
	  /**
	   * Logar ao Banco de Dados Empregadíssimas
	   */

       //require_once '../connect.php';
       $servername = "localhost";
       $username = "root";
       $password = "";
       $dbname = "test";

	   $conn = new mysqli($servername, $username, $password, $dbname);


       if ($conn->connect_error) {
    	   die("Connection failed: " . $conn->connect_error);
       }
     	  //echo "Connected successfully";

?>
