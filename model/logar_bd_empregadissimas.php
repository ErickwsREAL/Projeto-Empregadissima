<?php
	  /**
	   * Logar ao Banco de Dados Empregadíssimas
	   */

       //require_once '../connect.php';
       $servername = "localhost";
       $username = "root";
       $password = "";
       $dbname = "test";

       /*configurar porta 9301 */
       //require_once '../connect.php';
       //$servername = "db.esweb.com.br";
       //$username = "empreg_adm";
       //$password = "NmFlZTJiZjFmNjI2MDEx";
       //$dbname = "empregadissima";

	   $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
    	  die("Connection failed: " . $conn->connect_error);
      }
     	//echo "Connected successfully";

?>
