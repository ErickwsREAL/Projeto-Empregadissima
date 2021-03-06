<?php include ("../controller/login_control/logar_bd_empregadissimas.php")
?>
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
  				<a tabindex="0" class="btn btn-primary btn-sm buttonH" id="contato" role="button" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="Contato" data-content="Entre em contato conosco pelo E-mail: Empregadissima@projeto.com">Contato</a>
			</nav>
		</div>				

		<div class="collapse" id="collapseAdm">
			<div class="card card-body" id="cardAdm">
					<form action=../controller/login_control/login_adm.php method="POST">
						<div class="form-group">
							<label for="admLogin">Sessão:</label>		
							<input type="text" name="sessao" id="admLogin" required>
						</div>
						<button type="submit" class="btn btn-primary btn-sm" name="login_adm" id="buttonAdm" value="Enviar"> Iniciar </button>
					</form>
			</div>
		</div>

		<div class="container mt-5" id="headerT">
			<h2> Bem Vindo ao</h2>	
			<h1> Empregadíssima </h1>
			<p> Contrate e disponibilize serviços domésticos de forma fácil.</p>
		</div>

		<div class="container" id="middle">
			<div id="entrar">
			 	<button type="button" class="btn btn-outline-primary btn-lg w-25 buttonE" data-toggle="modal" data-target="#loginModal">Entrar</button>
			 	<a href="./cadastro.php" type="button" class="btn btn-outline-primary btn-lg w-25 buttonE">Cadastrar</a>
			</div>
			
			<div class="modal fade" id="loginModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-dialog-centered">
			    	<div class="modal-content">
			      	<div class="modal-header">
			        	<h5 class="modal-title" id="loginModalTitle">Login</h5>
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          	<span aria-hidden="true">&times;</span>
			        	</button>
			      	</div>
			      	<div class="modal-body" id="loginBody">
			      		<!-- Fomulário para login -->
			      		<form action="../controller/login_control/login_usuario.php" method="POST">
			      			<div class="form-group">
								<label for="loginEmail">Email:</label>		
								<input class="form-control form-control-sm" type="text" name="email" id="loginEmail" required>
							</div>
			      			<div class="form-group">
								<label for="loginSenha">Senha:</label>		
								<input class="form-control form-control-sm" type="password" name="senha" id="loginSenha" required>
							</div>	

			      			<button type="submit" class="btn btn-primary buttonLoginT" id="login" name="login" value="Enviar"> Entrar </button>
			      		</form>

			      	</div>
			    	</div>
			  	</div>
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