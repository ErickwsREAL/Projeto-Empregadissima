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
  				<button type="button" class="btn btn-primary btn-sm voltar" id="buttonVoltar">	Voltar </button>
			</nav>
		</div>

		<div class="container" id="formCadastro">
			<!-- formulário cadastro de usuário -->
			<form action="../controller/PessoaControlador.php?metodo=Inserir" method="POST">
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
					<input type="tel" class="form-control" id="telefoneUsuario" name="telefone" placeholder="Ex: (00) 98855-7711" minlength="15" required>
	 			</div>
 				<div class="form-group">
				    <label for="dataNascUsuario">Data de nascimento (Somente acima de 18 anos)</label>
				    <input type="date" class="form-control" id="dataNascUsuario" name="data_nascimento" min="1920-01-01" max="2003-04-28" required>
 				</div>
	  			<div class="form-group">
					<br><label for="nomeUsuario">Cidade</label>
					<input type="text" class="form-control" id="CidadeUsuario" name="cidade" maxlength="50" placeholder="Máximo 50 caractéres..." required>
	  			</div> 				
 				<div class="form-group">
				    <label for="senhaUsuario">Senha</label>
				    <input type="password" class="form-control" id="senhaUsuario" name="senha" minlength="8" required>
 				</div>
				<div class="form-group" id="comprovantes">
					<br><label for="comprovanteUsuario">Comprovante pessoal (Documento):</label>
					<input type="file" id="comprovanteUsuario" name="comprovante" required>
 				</div>	
  					<br><button type="submit" class="btn btn-primary" id="submitCadastro">Enviar</button>
			</form>
			<!--Fim formulario-->
		</div>				
		
		<script>
		$(document).ready(function(){
			
			$( "#buttonVoltar" ).on( "click", function() {
		    	if (!confirm("Deseja retornar a página inicial? Suas informações não serão salvas.")){
	    			
				}else {
					window.location.href = "index.php";
				}
		    });
	
			var $seuCampoCpf = $("#cpfUsuario");
			$seuCampoCpf.mask('000.000.000-00', {reverse: true});

			var $campoTel = $("#telefoneUsuario");
			$campoTel.mask('(00) 00000-0000');
		});
		</script>
	</body>
</html>