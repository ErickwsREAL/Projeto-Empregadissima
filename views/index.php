<!-- página incial do projeto -->
<!DOCTYPE html>
<html Lang="pt-br">
	<head>
		<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">	
		<link rel="stylesheet" type="text/css" href="./css/EstiloPagInicial.css">
		<script src="./js/jquery-ui.js"></script>
		<script src="./js/jquery-3.5.1.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
		<title> Empregadíssima | Home Page </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<body>
		<div id="navH">
			<nav class="navbar w-100" id="navbarH">
  				<button type="button" class="btn btn-primary btn-sm buttonH" id="adm" >Administrador</button>
  				<button type="button" class="btn btn-primary btn-sm ml-auto buttonH" id="sobre" data-toggle="collapse" data-target="#collapseSobre" aria-expanded="false" aria-controls="collapseSobre">Sobre</button>
  				<button type="button" class="btn btn-primary btn-sm buttonH" id="contato" data-toggle="collapse" data-target="#collapseContato" aria-expanded="false" aria-controls="collapseContato">Contato</button>
			</nav>
		</div>				

		<div class="container" id="info">
			<div class="collapse" id="collapseSobre">
	  			<div class="card card-body" id="cardSobre">
	  				<p>O Sistema Empregadíssima é um meio fácil de disponibilizar seus serviços domésticos, bem como se estiver procurando por estes serviços.</p>
	  			</div>
	  		</div>
	  		<div class="collapse" id="collapseContato">
	  			<div class="card card-body" id="cardContato">
	  				<p>Entre em contato conosco pelo e-mail: Empregadíssima@contato.com</p>
	  			</div>
	  		</div>		
		</div>	
		
		<div class="container mt-5" id="headerT">
			<h2> Bem Vindo ao</h2>	
			<h1> Empregadíssima </h1>
			<p> Contrate e disponibilize serviços dométicos de forma fácil.</p>
		</div>

		<div class="container" id="middle">
			<div id="entrar">
			 	<button type="button" class="btn btn-outline-primary btn-lg w-25 buttonE">Entrar</button>
			 	<button type="button" class="btn btn-outline-primary btn-lg w-25 buttonE">Cadastrar</button>
			</div>
		</div>

		<div id="footer">
			<div class="p-1 "id="footerE">
				© 2020 Copyright: EmpregadissimaOwners
 		 	</div>
			<img class="img-fluid rounded float-left" src="./imagens/domestica.png" alt="dosmética">
			<h1 class="text-hide" style="background-image: url('./imagens/domestica.png');">Bootstrap</h1>
		</div>
	</body>
</html>		