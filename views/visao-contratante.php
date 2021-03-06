<?php include ("../controller/login_control/logar_bd_empregadissimas.php")
?>

<?php include ("../controller/login_control/verifica_login_usuario.php") ?>

<?php
    include ("../controller/PessoaControlador.php");
    if(isset($_POST['search'])) {
        $busca = $_POST['search'];
        $result = buscarPrestadores($busca);
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./css/buscarContratante.css">
<link rel="stylesheet" href="./css/telaAgenda.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title> Empregadíssima | Buscar prestador </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#swap-solic").click(function(){
            $(".filter-section").hide();
            $(".contractor-grid").hide();
            $(".c-solicitacoes").show();
        });

        $("#swap-busca").click(function(){
            $(".c-solicitacoes").hide();
            $(".filter-section").show();
            $(".contractor-grid").show();
        });

        $(".cancel-button").click(function(){
           $(".price-range").hide();
           $(".filter-text").show();
        });

        $(".apply-button").click(function(){
           $(".price-range").hide();
           $(".filter-text").show();
        });

        $("#filter-button").click(function(){
           $(".price-range").toggle();
           $(".filter-text").toggle();
        });
    });

    function change() {
        var btn = document.getElementById('filter-button');
        if (btn.value == "false") {
            btn.value = "true";
            btn.innerHTML = "Esconder filtros";
        }
        else {
            btn.value = "false";
            btn.innerHTML = "Mostrar filtros";
        }
    }

</script>
</head>
<body>
    <!-- inicio grid container -->
    <div class="grid-container">
        <!--nav bar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand">Empregadíssimas</a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link" href="./visao-contratante.php"> Busca </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./perfilcontratante.php">Perfil </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./manter-solicitacao-contratante.php">Minhas Solicitações </a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <a class="nav-link" href="../controller/login_control/sair.php" id="btn-sair" style="color:white;   "> Sair </a>
            </div>
            </div>
        </nav>

        <div class="column3"></div>
        <!-- coluna à direita (grid) -->
        <div class="column4"></div>

        <!-- inicio area do filtro/busca -->
        <div class="filter-section">
            <form action="visao-contratante.php" method="POST" class="search-bar">
                <input type="text" placeholder="Procure por um(a) prestador(a)..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
            <!-- inicio botão do filtro -->
            <button onclick="change()" id="filter-button" class="filter-button btn-sm btn-primary" value="false">
                Mostrar filtros
            </button>
            <!-- fim botão do filtro -->

            <!-- texto -->
            <h1 class="filter-text">Entre no perfil de uma de nossas prestadoras e contrate seus serviços!</h1>            

            <!-- inicio filtro por preço-->
            <div id="filter-id" class="price-range" style="display:none">
                <div class="input-group input-group-sm mb-3 price-filter">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">R$</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Quantia" aria-describedby="inputGroup-sizing-sm" placeholder="Preço mínimo">&nbsp
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-sm">R$</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Quantia" aria-describedby="inputGroup-sizing-sm" placeholder="Preço máximo">
                </div>
            <!-- fim filtro por preço-->

                <!-- inicio filtro por avaliação-->
                <div class="filter-rating">
                    Filtre pela avaliação:
                    <span class="star-rating">
                        <input id="rating5" type="radio" name="rating" value="5">
                        <label for="rating5">5</label>
                        <input id="rating4" type="radio" name="rating" value="4">
                        <label for="rating4">4</label>
                        <input id="rating3" type="radio" name="rating" value="3">
                        <label for="rating3">3</label>
                        <input id="rating2" type="radio" name="rating" value="2">
                        <label for="rating2">2</label>
                        <input id="rating1" type="radio" name="rating" value="1">
                        <label for="rating1">1</label>
                    </span><br>
                </div>
                <button onclick="change()" id="cancel-button" class="cancel-button btn-sm btn-danger">Cancelar</button>
                <button onclick="change() "id="apply-button" class="apply-button btn-sm btn-success">Aplicar</button>
                <!-- fim filtro por avaliação-->
            </div>
        </div>
        <!-- fim da area do filtro/busca -->

        <!-- inicio grid -->
        <div class="contractor-grid">
            <?php 
                if(isset($result)) {
                    while ($dados_pessoa = $result->fetch_array(MYSQLI_ASSOC) ){
            ?>   
                <div class="contractor-item">
                    <div class="thumbnail">
                        <?php
                            if ($dados_pessoa["foto"] != NULL) {
                                $foto = $dados_pessoa["foto"]; 
                            } else {
                                $foto = 'profile.png';
                            }
                        ?>
                        <input type="hidden" name="id_prestador" id="id_prestador" value="<?php echo $dados_pessoa["id_pessoa"]; ?>">                                                 
                        <img src="./imagens/<?php echo $foto; ?>">
                        <div class="caption">
                            <h3 style="font-size:20px; color:white"><?php echo $dados_pessoa["nome"]; ?></h3>
                            <p><a href="./perfil-prestador-visao-contratante.php?id_prestador=<?php echo $dados_pessoa["id_pessoa"]; ?>" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                        </div>
                    </div>
                </div>   
                <?php } ?>
            <?php } ?>
        </div>
        <!-- fim grid -->

        <!-- inicio footer-->
        <div class="footer-page page-footer font-small ">
            <div class="footer-copyright text-center py-3">©Copyright @EmpregadíssimaOwners
            </div>
        </div>
        <!-- fim footer-->
    </div>
    <!-- fim grid contrainer -->
</body>
</html>