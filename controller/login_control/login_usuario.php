<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$email = $_POST['email'];
$senha = $_POST['senha'];

include ("logar_bd_empregadissimas.php");


if(!empty($email) && !empty($senha)){ 

    $sql = "SELECT * FROM pessoa WHERE email = '$email'";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    if($row['senha'] === $senha && $row['status_cadastro'] == '2'){ 
        unset($row['senha']);

        $_SESSION['pessoa'] = $row;

        if($row['tipo_pessoa'] == 1){ //se tipo prestador 
            header("location: ../../views/perfil.php");
        } elseif($row['tipo_pessoa'] == 2){                        //se tipo contratante
            header("location: ../../views/perfilcontratante.php");
        }
    }
    elseif ($row['status_cadastro'] == '1') {
        echo '<script>alert("Seu login ainda não foi liberado, aguarde um email do Empregadíssimas liberando-o :(")</script>';
        echo '<script>location.href="../../views/index.php"</script>';
    }
    elseif ($row['status_cadastro'] == '3') {
        echo '<script>alert("Seu Cadastro foi desativado, entre em contato com os Administradores se deseja ativar novamente.")</script>';
        echo '<script>location.href="../../views/index.php"</script>';
    }
    else{
        echo '<script>alert("E-mail e/ou senha incorretos.")</script>';
        echo '<script>location.href="../../views/index.php"</script>';
    }

} 
else{
    echo '<script>alert("Informe o e-mail e a senha.")</script>';
    echo '<script>location.href="../../views/index.php"</script>';
}