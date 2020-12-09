<?php include ("../model/logar_bd_empregadissimas.php")
?>

<?php include "verifica_login.php"?>

<?php echo $_SESSION['pessoa']['id_pessoa']?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous">

<link href="css/styles.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script src="js/multidatespicker.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
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
    <div class="grid-calendario">
        <!--nav bar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" style="color:white;">Empregadíssimas</a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./perfil.php">Perfil </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./manter-solicitacao.php"> Minhas Solicitações </a>
                </li>
            </ul>
            <div class="form-inline my-2 my-lg-0">
                <a class="nav-link" href="./index.php" id="btn-sair" style="color:white;"> Sair </a>
            </div>
            </div>
        </nav>
        <!--fim navbar-->

        <h3 id="titulo-grid">Selecione a(s) data(s) que deseja disponibilizar</h3>
        <div class="column3"></div>

        <!-- coluna à direita (grid) -->
        <div class="column4"></div>

        <!-- inicio grid -->
        <div id="calendario">
            <input style="width: 100%;" type="text" id="selectedValues" class="date-values" readonly/>
            <div id="parent" class="container">
                <div class="row header-row">
                    <div class="col-xs previous">
                        <a href="#" id="previous" onclick="previous()">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="card-header month-selected col-sm" id="monthAndYear">
                    </div>
                    <div class="col-sm">
                        <select class="form-control col-xs-6" name="month" id="month" onchange="change()"></select>
                    </div>
                    <div class="col-sm">
                        <select class="form-control col-xs-6" name="year" id="year" onchange="change()"></select>
                    </div>
                    <div class="col-xs next">
                        <a href="#" id="next" onclick="next()">
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                <table id="calendar" style="margin-left: 34%; margin-top: 2%;">
                    <thead>
                        <tr>
                            <th>S</th>
                            <th>T</th>
                            <th>Q</th>
                            <th>Q</th>
                            <th>S</th>
                            <th>S</th>
                            <th>D</th>
                        </tr>
                    </thead>
                    <tbody id="calendarBody"></tbody>
                </table>
            </div>
        </div>
        <!-- fim grid -->

        <div id="c-solicitacoes" class="c-solicitacoes">

        </div>

        <!-- inicio footer-->
        <div class="footer-page page-footer font-small ">
            <div class="footer-copyright text-center py-3">© 2020 Copyright:
                <a href="https://empregadissimas.com.br/"> Empregadissímas</a>
            </div>
        </div>
        <!-- fim footer-->
    </div>
    <!-- fim grid contrainer -->
</body>
</html>