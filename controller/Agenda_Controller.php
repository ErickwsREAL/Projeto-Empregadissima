<?php include ("login_control/logar_bd_empregadissimas.php") ?>
<?php
    require_once ("../model/Agenda.php");

    switch($_GET['metodo']) {
        case 'inserir_agenda':
            $r = Agenda::insert($_GET['id_prestador'], $_POST['datas_selecionadas']);

            echo '<script> alert("'.$r.'")</script>';
            echo '<script>location.href="../views/visao-prestador.php"</script>';
            break;
        case 'deletar_agenda':
            $r = Agenda::delete($_GET['id_agenda']);

            echo '<script> alert("'.$r.'")</script>';
            echo '<script>location.href="../views/visao-prestador.php"</script>';
            break;            
        case 'selecionar_agenda':
            $r = Agenda::select($id_prestador);
            break;
        default:
            echo '<script> alert("Teste") </script>';
            break;
    }

?>