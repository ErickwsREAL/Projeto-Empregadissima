<!-- página incial do projeto -->
<!DOCTYPE html>
<html Lang="pt-br">
	<head>
		<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">	
		<link rel="stylesheet" type="text/css" href="./css/EstiloPagInicial.css">
		<script src="./js/jquery-ui.js"></script>
		<script src="./js/jquery-3.5.1.min.js"></script>
		<script src="./js/popper.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
		<title> Empregadíssima | Home Page </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<body>
		<div id="navH">
			<nav class="navbar w-100" id="navbarH">
  				<button type="button" class="btn btn-primary btn-sm buttonH" id="adm" data-toggle="collapse" data-target="#collapseAdm" aria-expanded="false" aria-controls="collapseAdm">Administrador</button>
  				<a tabindex="0" class="btn btn-primary btn-sm ml-auto buttonH" id="sobre" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Sobre" data-content="O sistema Empregradíssima é facilitador da disponibilização e contrato de serviço">Sobre</a>
  				<a tabindex="0" class="btn btn-primary btn-sm ml-auto buttonH" id="contato" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Contato" data-content="Entre em contato conosco pelo E-mail: Empregadissima@projeto.com">Contato</a>
			</nav>
		</div>				

		<div class="collapse" id="collapseAdm">
			<div class="card card-body" id="cardAdm">
					<form>
						<div class="form-group">
							<label for="admLogin">Sessão:</label>		
							<input type="text" name="sessão" id="admLogin" required>
						</div>
						<button type="submit" class="btn btn-primary btn-sm" id="buttonAdm" value="Enviar"> Iniciar </button>
					</form>
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
		</div>
		
		<script>
			$(document).ready(function(){
				$('.popover-dismiss').popover({
  					trigger: 'focus'
				});
				$('.buttonH').popover({
    				container: 'body'
  				});
			});
		</script>	
	</body>
</html>		