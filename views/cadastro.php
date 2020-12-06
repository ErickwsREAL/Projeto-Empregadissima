<?php include ("../model/logar_bd_empregadissimas.php")
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">	
		<link rel="stylesheet" type="text/css" href="./css/EstiloCadastro.css">
		<script src="./js/jquery-3.5.1.min.js"></script>
		<script src="./js/popper.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
		<script src="./js/jquery-ui.js"></script>
		<script src="./js/jquery.mask.min.js"></script>
		<title> Empregadíssima | Cadastro de Usuário </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	</head>
	<body>
		<div id="navCadastro">
			<nav class="navbar w-100" id="navbarCadastro">
  				<button type="button" class="btn btn-primary btn-sm voltar" id="buttonVoltar">
  					<svg width="1em" height="1em" viewBox="0 0 16 16"class="bi bi-arrow-left-circle-fill voltar" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  						<path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z"/>
					</svg>
					Voltar
				</button>
			</nav>
		</div>

		<div class="container" id="formCadastro">
			
			<!-- formulário cadastro de usuário -->
			<form action="../controller/Usuario_Controller.php?metodo=inserir" method="POST">
  				<div id="radios">
	  				<div class="form-check form-check-inline">
	  					<!-- prestador valor=1 -->
						<input class="form-check-input" type="radio" name="tipo_pessoa" id="tipo_pessoa_p" value="1" required> 
						<label class="form-check-label" for="tipo_pessoa_p">Prestador</label>
						<!-- contratante valor=2 -->
						<input class="form-check-input" type="radio" name="tipo_pessoa" id="tipo_pessoa_c" value="2" required>
						<label class="form-check-label" for="tipo_pessoa_c">Contratante</label>
					</div>	
		  			<div class="form-check form-check-inline" id="labelado">
						<input class="form-check-input" type="radio" name="sexo" id="sexoUsuarioM" value="1" required>
						<label class="form-check-label" for="sexoUsuarioM">Masculino</label>
						<input class="form-check-input" type="radio" name="sexo" id="sexoUsuarioF" value="2" required>
						<label class="form-check-label" for="sexoUsuarioF">Feminino</label>
						<input class="form-check-input" type="radio" name="sexo" id="sexoUsuarioA" value="3" required>
						<label class="form-check-label" for="sexoUsuarioA">Outro</label>	
					</div>	
		  		</div>	
		  		
	  			<div class="form-group">
					<br><label for="nomeUsuario">Nome</label>
					<input type="text" class="form-control" id="NomeUsuario" name="nome" maxlength="50" placeholder="Máximo 50 caractéres..." required>
	  			</div>
	  			<div class="form-group">
					<label for="cpfUsuario">CPF</label>
					<input type="text" class="form-control" id="cpfUsuario" name="cpf" min="0" max="11" placeholder="Ex: 111.222.333.44" required>
	 			</div>
		 		<div class="form-group">
					<label for="emailUsuario">E-mail</label>
					<input type="text" class="form-control" id="emailUsuario" name="email" placeholder="Ex: jose@email.com" minlength="10" required>
	 			</div>
	 			<div class="form-group">
					<label for="telefoneUsuario">Telefone</label>
					<input type="tel" class="form-control" id="telefoneUsuario" name="telefone" placeholder="Ex: (00) 98855-7711" minlength="11" required>
	 			</div>
 				<div class="form-group">
				    <label for="dataNascUsuario">Data de nascimento</label>
				    <input type="date" class="form-control" id="dataNascUsuario" name="data_nascimento" min="1910-01-01" required>
 				</div>
	  			<div class="form-group">
					<br><label for="nomeUsuario">Cidade</label>
					<input type="text" class="form-control" id="CidadeUsuario" name="cidade" maxlength="50" placeholder="Máximo 50 caractéres..." required>
	  			</div> 				
 				<div class="form-group">
				    <label for="senhaUsuario">Senha</label>
				    <input type="password" class="form-control" id="senhaUsuario" name="senha" minlength="8" required>
 				</div>
				<div class="form-row">
				    <div class="form-group col-md-4">
				      <label for="bairroUsuario">Bairro</label>
				      <input type="text" class="form-control endereco" id="bairroUsuario" name="bairro" placeholder="Ex: Jardim Sumaré" required>
				    </div>
				    <div class="form-group col-md-4">
				      <label for="ruaUsuario">Rua</label>
				      <input type="text" class="form-control endereco" id="ruaUsuario" name="rua" placeholder="Ex: Pioneiro Genir Galli" required>
				    </div>
				    <div class="form-group col-md-2">
				      <label for="numeroUsuario">Número da Casa</label>
				      <input type="number" class="form-control endereco" id="numeroUsuario" name="numero" placeholder="Ex: 000" required>
					</div>
					<div class="form-group col-md-2">
				      <label for="complementoUsuario">Complemento</label>
				      <input type="text" class="form-control endereco" id="complementoUsuario" name="complemento" placeholder="Ex: APTO 3 BLOCO 503">
					</div>
					<div class="form-group col-md-2">
						<label for="cepUsuario"> CEP </label>
						<input type="text" name="cep" id="cepUsuario" class="form-control endereco" placeholder="87035-600" max="9" required>
					</div>
				</div>
				<div class="form-group" id="comprovantes">
					<br><label for="comprovanteUsuario">Comprovante pessoal (Documento):</label>
					<input type="file" id="comprovanteUsuario" name="comprovante" value="" required>
 				</div>	
  					<br><button type="submit" class="btn btn-primary" id="submitCadastro" name="submitCadastro" value="Enviar">Enviar</button>
			</form>
			<!--Fim formulario-->
		</div>				

		<div id="caixa" title="Alerta"> 	
			<p>Você será redirecionado para a página principal, cadastros não finalizados serão apagados, deseja continuar?</p>
		</div>
		
		<script>
		$(document).ready(function(){
			
			$( "#buttonVoltar" ).on( "click", function() {
		    	$( "#caixa" ).dialog( "open" );
		    });

			$('#tipo_pessoa_p').on('click', function(){           
       			if($(this).is(':checked')){
           			$('.endereco').attr('disabled', true);
       			} else {
           			$('.endereco').attr('disabled', false);
      	 		}
   			});

			$('#tipo_pessoa_c').on('click', function(){           
       			if($(this).is(':checked')){
           			$('.endereco').attr('disabled', false);
       			} else {
           			$('.endereco').attr('disabled', false);
      	 		}
   			});

			$("#caixa").dialog({
				autoOpen: false,
				modal: true,
				resizable: false,
				draggable: false,
				height: "auto",
				width: 350,
				buttons: {
	        		"Sim": function() {
	          			window.history.go(-1);
	        		},
	        		Cancelar: function() {
	          		$( this ).dialog( "close" );
	        		}
      			}
			}); 
	
			var $seuCampoCpf = $("#cpfUsuario");
			$seuCampoCpf.mask('000.000.000-00', {reverse: true});

			var $campoTel = $("#telefoneUsuario");
			$campoTel.mask('(00) 00000-0000');

			var $campoCep = $("#cepUsuario");
			$campoCep.mask('00000-000');
		});
		</script>
	</body>
</html>