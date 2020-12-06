<?php include ("../model/logar_bd_empregadissimas.php")
?>

<?php include "verifica_login.php"?>

<?php echo $_SESSION['pessoa']['id_pessoa']?>
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
                <a class="nav-link" href="./visao-contratante.html"> Busca </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./perfilcontratante.html">Perfil </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./manter-solicitacao-contratante.html">Minhas Solicitações </a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <a class="nav-link" href="./index.html" id="btn-sair" style="color:white;   "> Sair </a>
            </div>
            </div>
        </nav>

        <div class="column3"></div>
        <!-- coluna à direita (grid) -->
        <div class="column4"></div>

        <!-- inicio area do filtro/busca -->
        <div class="filter-section">
            <div class="search-bar" action="action_page.php" >
                <input type="text" placeholder="Procure por um(a) prestador(a)..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
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
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/woman21.jpg">
                    <div class="caption">
                        <h3 style="font-size:20px; color:white">Rita Prestadora</h3>
                        <p><a href="./perfil-prestador-visao-contratante.html" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/avatar2.png">
                    <div class="caption">
                        <h3 style="font-size:20px; color: white">Joaquina Oliveira</h3>
                        <p><a href="#" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/avatar3.png">
                    <div class="caption">
                        <h3 style="font-size:20px; color: white">Amelia Clarisse</h3>
                        <p><a href="#" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/avatar5.png">
                    <div class="caption">
                        <h3 style="font-size:20px; color: white">Dandara Eva</h3>
                        <p><a href="#" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/avatar9.png">
                    <div class="caption">
                        <h3 style="font-size:20px; color: white">Gabriela Duz</h3>
                        <p><a href="#" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/avatar5.png">
                    <div class="caption">
                        <h3 style="font-size:20px; color: white">Alice Sayuri</h3>
                        <p><a href="#" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/avatar7.jpeg">
                    <div class="caption">
                        <h3 style="font-size:20px; color: white">Barbara Paz</h3>
                        <p><a href="#" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/avatar1.png">
                    <div class="caption">
                        <h3 style="font-size:20px; color: white">Rogéria Dias</h3>
                        <p><a href="#" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/avatar8.png">
                    <div class="caption">
                        <h3 style="font-size:20px; color: white">Leopoldina Matos</h3>
                        <p><a href="#" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/avatar5.png">
                    <div class="caption">
                        <h3 style="font-size:20px; color: white">Deide Costa</h3>
                        <p><a href="#" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/avatar1.png">
                    <div class="caption">
                        <h3 style="font-size:20px; color: white">Cristiane Julia</h3>
                        <p><a href="#" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/avatar8.png">
                    <div class="caption">
                        <h3 style="font-size:20px; color: white">Aurora Oliveira</h3>
                        <p><a href="#" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/avatar2.png">
                    <div class="caption">
                        <h3 style="font-size:20px; color: white">Josefina Silva</h3>
                        <p><a href="#" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/avatar9.png">
                    <div class="caption">
                        <h3 style="font-size:20px; color: white">Jubiliana Carry</h3>
                        <p><a href="#" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
            <div class="contractor-item">
                <div class="thumbnail">
                    <img src="./imagens/avatar1.png">
                    <div class="caption">
                        <h3 style="font-size:20px; color: white">Maria Fátima</h3>
                        <p><a href="#" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
                    </div>
                </div>
            </div>              
        </div>
        <!-- fim grid -->

        <div id="c-solicitacoes" class="c-solicitacoes">
        </div>

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