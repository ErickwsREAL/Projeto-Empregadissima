<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$email = $_POST['email'];
$senha = $_POST['senha'];

include ("../model/logar_bd_empregadissimas.php");


if(!empty($email) && !empty($senha)){ 

    $sql = "SELECT * FROM pessoa WHERE email = '$email'";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    if($row['senha'] === $senha && $row['status_cadastro'] == '2'){ 
        unset($row['senha']);

        $_SESSION['pessoa'] = $row;

        if($row['tipo_pessoa'] === 1){ //se tipo prestador 
            header("location: perfil.php");
        } else{                        //se tipo contratante
            header("location: perfilcontratante.php");
        }
    }
    elseif ($row['status_cadastro'] != '2') {
        echo '<script>alert("Seu login ainda não foi liberado, aguarde um email do Empregadíssimas liberando-o :(")</script>';
        echo '<script>location.href="../views/index.php"</script>';
    }
    else{
        echo '<script>alert("E-mail e/ou senha incorretos.")</script>';
        echo '<script>location.href="../views/index.php"</script>';
    }

} 
else{
    echo '<script>alert("Informe o e-mail e a senha.")</script>';
    echo '<script>location.href="../views/index.php"</script>';
}