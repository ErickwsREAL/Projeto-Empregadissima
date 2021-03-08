<?php
include ("logar_bd_empregadissimas.php");

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$email = $_POST['email'];
$senha = $_POST['senha'];
 
$sql = "SELECT * FROM pessoa WHERE email = '$email'";

$result = $conn->query($sql);

if (mysqli_num_rows($result) == 0) {
        
    echo '<script>alert("E-mail e/ou senha incorretos.")</script>';
    echo '<script>location.href="../../views/index.php"</script>';
    return;
}

$row = $result->fetch_assoc();


if($row['senha'] != $senha){

    echo '<script>alert("E-mail e/ou senha incorretos.")</script>';
    echo '<script>location.href="../../views/index.php"</script>';
    return; 
}

if($row['status_cadastro'] == '1') {
    
    echo '<script>alert("Seu login ainda não foi liberado, aguarde um email do Empregadíssimas liberando-o :(")</script>';
    echo '<script>location.href="../../views/index.php"</script>';
    return;

}

if($row['status_cadastro'] == '3') {
    
    echo '<script>alert("Seu cadastro foi desativado, entre em contato com os Administradores se deseja ativar novamente.")</script>';
    echo '<script>location.href="../../views/index.php"</script>';
    return;
}

//clausulás guardas acima//

unset($row['senha']);

$_SESSION['pessoa'] = $row;

if($row['tipo_pessoa'] == 1){ //se tipo prestador 
    header("location: ../../views/perfil.php");
} 
elseif($row['tipo_pessoa'] == 2){                        //se tipo contratante
    header("location: ../../views/perfilcontratante.php");
}







    