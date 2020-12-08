<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$sessao = $_POST['sessao'];


include ("../model/logar_bd_empregadissimas.php");


if(!empty($sessao)){ 

    $sql = "SELECT * FROM administrador WHERE sessao = '$sessao'";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    if($row['sessao'] === $sessao){ 
        unset($row['sessao']);

        $_SESSION['administrador'] = $row;

        header("location: adm-manter-cadastros.php");

    }
    else{
        echo '<script>alert("Sessão não encontrada.")</script>';
        //echo '<script>location.href="../views/index.php"</script>';
    }

} 
else{
    echo '<script>alert("Informe sua sessão.")</script>';
    //echo '<script>location.href="../views/index.php"</script>';
}