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
			<form>
  				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="usuário" id="prestador" value="prestador">
					<label class="form-check-label" for="prestador">Prestador</label>
					<input class="form-check-input" type="radio" name="usuário" id="contratante" value="contratante">
					<label class="form-check-label" for="contratante">Contratante</label>
				</div>

  				<div class="form-group">
				    <br><label for="nomeUsuário">Nome</label>
				    <input type="text" class="form-control" id="NomeUsuário" name="nome" required>
  				</div>
  				<div class="form-group">
				    <label for="cpfUsuário">CPF</label>
				    <input type="number" class="form-control" id="cpfUsuário" name="cpf" required>
 				</div>
	 			<div class="form-group">
					<label for="telefoneUsuário">Telefone</label>
					<input type="tel" class="form-control" id="telefoneUsuário" name="telefone" required>
	 			</div>
 				<div class="form-group">
				    <label for="dataNascUsuário">Data de nascimento</label>
				    <input type="date" class="form-control" id="dataNascUsuário" name="dataNascimento" required>
 				</div>
 				<div class="form-group">
				    <label for="senhaUsuário">Senha</label>
				    <input type="password" class="form-control" id="senhaUsuário" name="senha" required>
 				</div>
				<div class="form-row">
				    <div class="form-group col-md-4">
				      <label for="bairroUsuário">Bairro</label>
				      <input type="text" class="form-control endereco" id="bairroUsuário" name="bairro" required>
				    </div>
				    <div class="form-group col-md-4">
				      <label for="ruaUsuário">Rua</label>
				      <input type="text" class="form-control endereco" id="ruaUsuário" name="rua" required>
				    </div>
				    <div class="form-group col-md-2">
				      <label for="numeroUsuário">Número da Casa</label>
				      <input type="number" class="form-control endereco" id="numeroUsuário" name="número" required>
					</div>
					<div class="form-group col-md-2">
				      <label for="complementoUsuário">Complemento</label>
				      <input type="text" class="form-control endereco" id="complementoUsuário" name="complemento" required>
					</div>
					<div class="form-group" id="comprovantes">
					    <br><label for="comprovanteUsuário">Comprovante pessoal (Documento):</label>
					    <input type="file" id="comprovanteUsuário" name="comprovante" required>
 					</div>
				</div>
  					<br><button type="submit" class="btn btn-primary" id="submitCadastro" value="Enviar">Enviar</button>
			</form>
		</div>				

		<div id="caixa" title="Alerta"> 	
			<p>Você será redirecionado para a página principal, cadastros não finalizados serão apagados, deseja continuar?</p>
		</div>
		
		<script>
		$(document).ready(function(){
			
			$( "#buttonVoltar" ).on( "click", function() {
		    	$( "#caixa" ).dialog( "open" );
		    });

			$('#prestador').on('click', function(){           
       			if($(this).is(':checked')){
           			$('.endereco').attr('disabled', true);
       			} else {
           			$('.endereco').attr('disabled', false);
      	 		}
   			});

			$('#contratante').on('click', function(){           
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
	
		});
		</script>
	</body>
</html>