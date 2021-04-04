<?php
include ("logar_bd_empregadissimas.php");

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$sessao = $_POST['sessao'];

$sql = "SELECT * FROM administrador WHERE sessao = '$sessao'";

$result = $conn->query($sql);

if (mysqli_num_rows($result) == 0) {
        
    echo '<script>alert("Sessão não encontrada.")</script>';
    echo '<script>location.href="../../views/index.php"</script>';
    return;
}

$row = $result->fetch_assoc();

unset($row['sessao']);

$_SESSION['administrador'] = $row;

header("location: ../../views/adm-manter-cadastros.php");





