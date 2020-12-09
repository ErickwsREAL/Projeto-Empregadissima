<?php include ("../model/logar_bd_empregadissimas.php")
?>

<?php include "verifica_login.php"
?>

<?php echo $_SESSION['pessoa']['id_pessoa']
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/cssperfil.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="./js/jquery-3.5.1.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/jquery-ui.js"></script>
	<script src="./js/jquery.mask.min.js"></script>
	<title>Perfil Prestador</title>
</head>

	<body class="rosa-bg">

		<!--nav bar -->
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
	        <a class="navbar-brand">Empregadíssimas</a>
	        <div class="collapse navbar-collapse" id="navbarCollapse">
	          <ul class="navbar-nav mr-auto">
		        <li class="nav-item active">
		            <a class="nav-link" href="./perfil.php"> Perfil </a>
		        </li>
		        <li class="nav-item active">
		            <a class="nav-link" href="./manter-solicitacao.php"> Minhas Solicitações </a>
		        </li>
	          </ul>
	          	<div class="form-inline my-2 my-lg-0">
		      		<a class="nav-link" href="./sair.php" id="btn-sair" style="color:white;"> Sair </a>
		    	</div>
	        </div>
	      </nav>
	      <!--fim navbar-->

		
		
			<div class="section profile-div" id="profile">
				<!-- informações do perfil-->
	            <div class="container">
					
					<?php
						$var_id = $_SESSION['pessoa']['id_pessoa'];

						$consulta = "SELECT * FROM pessoa WHERE id_pessoa = $var_id";
						$con = $conn -> query($consulta) or die($conn-> error);
					?>

			  		<?php while ($dados_pessoa= $con ->fetch_array() ){
						$tipo_pessoa = $dados_pessoa["tipo_pessoa"];
			  		?>	                
	                
	                <div class="row align-items-center flex-row-reverse">
	                    <div class="col-lg-6">
	                        <div class="profile-text go-to">

	                            <h3 class="dark-color"> <?php echo $dados_pessoa["nome"]; ?> </h3>
	                                <p> <?php echo $dados_pessoa["descricao"]; ?> </p>
	                            <div class="row profile-list">
	                                <div class="col-md-6">
	                                    <div class="media">
	                                        <label>Idade</label>

											<?php
												$dataNascimento = $dados_pessoa["data_nascimento"];;
												$date = new DateTime($dataNascimento );
												$interval = $date->diff( new DateTime( date('Y-m-d') ) );
											?>	      

	                                        <p> <?php echo $interval->format( '%Y anos' ); ?> </p>
	                                    </div>
	                                    <div class="media">
	                                        <label>Cidade</label>
	                                        <p> <?php echo $dados_pessoa["cidade"]; ?> </p>
	                                    </div>

	                                </div>
	                                <div class="col-md-6">
	                                    <div class="media">
	                                        <label>E-mail</label>
	                                        <p> <?php echo $dados_pessoa["email"]; ?> </p>
	                                    </div>
	                                    <div class="media">
	                                        <label>Sexo</label>

										<?php
											if ($dados_pessoa["sexo"] == 1) {
											    $sexo = 'Masculino';
											} elseif ($dados_pessoa["sexo"] == 2) {
											    $sexo = 'Feminino';
											} else {
											    $sexo = 'Outros';
											}
										?>
	                                        <p> <?php echo $sexo; ?></p>
	                                    </div>
	                                </div>
	                            </div>

	                        </div>
	                    </div>
	                    <!--foto do perfil-->
	                    <div class="col-lg-6">
	                        <div class="profile-avatar" >
	                        	<div class="img-container">

										<?php
											if ($dados_pessoa["foto"] != NULL) {
												$foto = $dados_pessoa["foto"]; 
											} else {
											    $foto = 'profile.png';
											}
										?>
										<img src="./imagens/<?php echo $foto; ?>" class="rounded img-thumbnail" name="foto" title="avatar">
	                        	</div>
	                        </div>
	                    </div>
	                </div>

					<?php 
						  }

					?> 
	                <!--div com cliente qte avaliações e star rating -->
	                <div class="counter">
	                    <div class="row">
	                        <div class="col-6 col-lg-3">
	                            <div class="count-data text-center">
	                                <h6 class="count h2">26</h6>
	                                <p class="m-0px font-w-600">Clientes</p>
	                            </div>
	                        </div>

	                        <div class="col-6 col-lg-3">
	                            <div class="count-data text-center">
	                                <h6 class="count h2">20</h6>
	                                <p class="m-0px font-w-600">Quantidade de Avaliações</p>
	                            </div>
	                        </div>

	                        <div class="col-6 col-lg-3">
	                            <div class="count-data text-center">
	                                <h6 class="count h2">
	                                	<!-- avaliações de estrela com o font awesome-->
	                                	<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
	                                </h6>
	                                <p class="m-0px font-w-600">Avaliações</p>
	                            </div>
	                        </div>

	                    </div>
	                </div>
	                <!-- fim div -->
	            </div>
	            <!--fim info perfil-->
	        	
	        	<!--manutenções-->

				<div class="row">
				 	<div class="col-7">
						<!--manutenção da diária-->
						
						<div class="card">
							<!-- formulário lista de serviços -->
							<form name="form-lista-servicos" id="form-lista-servicos">
								
								<?php
									$var_id = $_SESSION['pessoa']['id_pessoa'];

									$consulta = "SELECT descricao_diaria, valor, id_diaria FROM diaria_prestador WHERE id_pessoa = $var_id";
									$con = $conn -> query($consulta) or die($conn-> error);
								?>

								<div class="card-container">
							    	<h4><b>Serviços</b></h4>
							    	<p>Lista de Serviços Oferecidos</p>
									<ul class="list-group">

							  		<?php while ($dados_diaria = $con ->fetch_array() ){
							  		?>

									  	<li class="list-group-item">

									  		<p class="man-desc"> <?php echo $dados_diaria["descricao_diaria"]; ?> </p>
									  		<div style="float: right;">
												<h6 class="count h2"> <?php echo $dados_diaria["valor"]; ?> </h6>
												<p class="m-0px font-w-600"> R$ </p>

		                                		<!-- botão visivel apenas para prestadores -->
												<p>
			                                		<button type="button" class="btn btn-danger btn-sm spc bt-excluir-servico" 
			                                				id="bt-excluir-servico-<?php echo $dados_diaria["id_diaria"]; ?>" 
			                                				onClick="excluir_diaria(this.id)">
			                                				<i class="fa fa-trash"></i> Excluir </button>

			                            			<button type="button" class="btn btn-sm bt-avaliar bt-editar" 
			                            					id="bt-editar-<?php echo $dados_diaria["id_diaria"]; ?>" 
			                            					name="bt-editar-<?php echo $dados_diaria["id_diaria"]; ?>"
			                            					onClick="busca_diaria(this.id);">

			                            			<i class="fa fa-edit"></i> Editar </button>
			                            		</p>
											</div>

									  	</li>
									<?php 
										  }

									?> 
									<input name="id_pessoa" id="id_pessoa" size="1" style="visibility: hidden;" value="<?php echo $var_id; ?>">
									</ul>
							  		
							  		<p><button type="button" class="btn btn-lg btManter" id="add-service"><i class="fa fa-plus"></i> Adicionar</button></p>
							  	</div>

								<div class="list-group-item" id="new-service">
															
										<p>Descreva o serviço:</p>
											<textarea class="form-control" id="desc_servico" name="desc_servico" placeholder="Ex: Casa maior 3 quartos" 
											value="echo $_GET['desc_servico'];" required ><?php if(isset($_GET['desc_servico']))echo $_GET['desc_servico']; ?></textarea>

										<p>Preço:</p>
											<input type="number" class="form-control" id="preco_servico" name="preco_servico" placeholder="Ex:200,00" size="10" 
											value="<?php echo $_GET['preco_servico']; ?>" step="0.01" required> 

										<!--input id: necessário para alterar uma diária-->
											<input type="hidden" class="form-control" id="id_diaria" name="id_diaria" size="1" disabled
											value="<?php echo $_GET['id_diaria']; ?>" > 
																	  		 
							  		<p style="text-align: center;margin-top: 5px">
							  			<button class="btn btSalvar btAlterar" id="alterar-service" value="Alterar" onclick="alterar_servico(id_diaria.value, desc_servico.value, preco_servico.value);">Alterar</button>

							  			<button class="btn btSalvar" id="salvar-service" value="Enviar" onclick="enviar_diaria();">Salvar</button>
							  			
							  			<button class="btn btFechar" id="fechar-service" value="Cancelar">Cancelar</button>
							  		</p>
							  	</div>

							</form>
						</div>		  	
				  	</div>

				  	<!--menu de outras manutenções-->
			  	<div class="col-5">	
			  		<form name="form-altera-pessoa" id="form-altera-pessoa">
				  		 <a class="nav-link btn btn-lg btn-block btManter" href="./visao-prestador.php" style="margin:0px;margin-top: 50px;margin-right:0px;"><i class="fa fa-calendar"></i>&nbsp; Agenda &nbsp;</a>
				  		<!--<button type="button" class="btn btn-lg btn-block btManter" style="margin:0px;margin-top: 50px;margin-right:0px;"><i class="fa fa-calendar"></i>&nbsp; Agenda &nbsp;</button>-->
				  		<button type="button" class="btn btn-lg btn-block btManter" data-toggle="modal" data-target="#editarModal" style="margin:0px;margin-top: 50px;margin-right:0px;" onclick="buscaInfoPessoa(<?php echo $var_id; ?>)"><i class="fa fa-cog"></i>&nbsp; Editar Perfil &nbsp;</button>
				  		<!--<button type="button" class="btn btn-lg btn-block btManter" style="margin:0px;margin-top: 50px;margin-right:0px;" onclick="abreAdicionarSolicitação()"><i class="fa fa-envelope"></i>&nbsp; Solicitar Serviço &nbsp;</button>-->
			  		</form>
				  	<form method="POST" action="../controller/Usuario_Controller.php?metodo=desativarCadastro">
				  		<input name="id_p" value="<?php echo $var_id ?>" style="display: none;">
				  		<button type="submit" class="btn btn-lg btn-block btManter" id="desativarConta" style="margin:0px;margin-top: 50px;margin-right:0px;"><i class="fa fa-trash-o"></i>&nbsp; Desativar Conta &nbsp;</button>
				  	</form>
			  	</div>
			</div>
			<!--fim manutenções -->

        	<!--editarPerfil -->
        	<div class="modal fade modal-lg" id="editarModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg">
			  		<form id="form-altera-pessoa-modal" name="form-altera-pessoa-modal">
			    	<div class="modal-content">
				      	<div class="modal-header">
				        	
				        	<h5 class="modal-title" id="editarModalTitle">Editar Perfil</h5>

				        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          	<span aria-hidden="true">&times;</span>
				        	</button>
				      	</div>
				      	<div class="modal-body" id="editarBody">
				      		<form id="editarForm" action="../controller/Usuario_Controller.php?metodo=alterar" method="POST">
				      			<div class="form-group">
									<label for="editarDescricao">Descrição:</label>		
									<textarea class="form-control" rows="3" name="descricao" id="editarDescricao" placeholder="uma breve descrição de você ou seu serviços..."><?php if(isset($_GET['descricao']))echo $_GET['descricao'];?></textarea>
								</div>
				      			<div class="form-group labelPeq">
									<label for="editarNome">Nome:</label>		
									<input class="form-control form-control-sm" type="text" name="nome" id="editarNome" placeholder="Novo nome.." maxlength="50" value="<?php echo $_GET['nome']; ?>">
								</div>
				      			<div class="form-group labelPeq">
									<label for="editarTelefone">Telefone:</label>		
									<input class="form-control form-control-sm" type="tel" name="telefone" id="editarTelefone"  placeholder="(00) 98855-7711" minlength="11" value="<?php echo $_GET['telefone']; ?>">
								</div>
				      			<div class="form-group labelPeq">
									<label for="foto">Foto de Perfil:</label>		
									<input type="file" id="foto" name="foto" value="<?php echo $_GET['foto']; ?>">
								</div>							
				      			<button type="button" class="btn btn-primary buttonEditar" id="buttonEditarPerfil" value="Enviar" data-toggle="tooltip" title="Esse botão é desabilitado se os campos estiverem vazios." onclick="salvar_alteracoes(<?php echo $var_id; ?>,<?php echo $tipo_pessoa; ?>)"> Salvar Edição </button>
				      		</form>
				      	</div>
			    	</div>
			    	</form>
			  	</div>
			</div>	
        
        </div>
        <!--fim div seção-->

	   	<div class="item footer">Copyright @EmpregadíssimaOwners</div>
		

<!--		<div id="caixa-excluir-servico" title="Alerta"> 	
			<p>Tem certeza que deseja <b>excluir</b> esse serviço? </p>
		</div> -->
	</body>

	<!--jquery -->
	<script>
		$(document).ready(function(){ 

			if (window.location.search.substring(0,14) == "?desc_servico="){
				$("#new-service").show();
				
				//quando é a volta
				document.getElementById("salvar-service").style.visibility = "hidden";
				document.getElementById("salvar-service").style.width = "0px";
				document.getElementById("salvar-service").style.height = "1px";
			}
			else{
				$("#new-service").hide();
			}

			if (window.location.search.substring(0,11) == "?descricao=") {
				$('#editarModal').modal('show');
			}

			/*botão adicionar*/
			$("#add-service").click(function(){
				$("#new-service").show("slow");
				/*botão Alterar não deve aparecer*/
				document.getElementById("salvar-service").style.visibility = "visible";
				document.getElementById("salvar-service").style.width = "80px";
				document.getElementById("salvar-service").style.height = "38px";

				document.getElementById("alterar-service").style.visibility = "hidden";
			});

			/*botão fechar*/
			$("#fechar-service").click(function(){
				$("#new-service").hide("slow");
			});

			/*botão editar: abre new service com as informações*/
			$(".bt-editar").click(function(){
				$("#new-service").show("slow");
				/*botão Alterar deve aparecer*/
				document.getElementById("alterar-service").style.visibility = "visible";

				/*botão Salvar não deve aparecer*/
				document.getElementById("salvar-service").style.visibility = "hidden";
				//document.getElementById("salvar-service").style.width = "0px";
				//document.getElementById("salvar-service").style.height = "1px";
			});

			$( "#desativarConta" ).on( "click", function() {
		    	$( "#caixa" ).dialog( "open" );
			});
			
			$(".bt-excluir-servico").on( "click", function() {
		    	$( "#caixa-excluir-servico" ).dialog( "open" );
			});

			$('#editarForm input').blur(function(){
			    if(!$(this).val() && !$('#editarForm #editarDescricao').val() && !$('#editarForm #editarNome').val() && !$('#editarForm #editarTelefone').val()) {
			        $('#buttonEditarPerfil').prop("disabled",true);
			    }
			});	

			$('#editarForm input').blur(function(){
			    if($(this).val() ) {
			        $('#buttonEditarPerfil').prop("disabled",false);
			    }
			});

			$('#editarForm #editarDescricao').blur(function(){
			    if(!$(this).val() && !$('#editarForm input').val()) {
			        $('#buttonEditarPerfil').prop("disabled",true);
			    }
			});	

			$('#editarForm #editarDescricao').blur(function(){
			    if($(this).val() ) {
			        $('#buttonEditarPerfil').prop("disabled",false);
			    }
			});	

			var $campoTel = $("#editarTelefone");
			$campoTel.mask('(00) 00000-0000');

		});

		/*abre pagina enviar solicitação*/
		function abreAdicionarSolicitação() {
			window.open("enviar-solicitacao.html","_self");
		}

		/*CRUD Serviços Prestador - Foi utilizado o onclick ao invés do submit no próprio botão para assim utilizar o mesmo formulário com diferentes valores para o
			parametro metodo na url*/
		function enviar_diaria(){
			document.getElementById("form-lista-servicos").action= "../controller/Servico_Prestador_Controller.php?metodo=inserir";
			document.getElementById("form-lista-servicos").method= "POST";
            document.getElementById("form-lista-servicos").submit();// Form submission
    	}

    	function excluir_diaria(clicked_id){

			/*Apartir do id do botão, pega-se uma substring de 19 posições, assim, pegando o id da diária.
				Ex: clicked_id = bt-excluir-servico-18, com a substring(19) temos na variavel res = 18, que é o id da diaria */
			var id_diaria = clicked_id.substring(19);

			if (!confirm("Deseja EXCLUIR este serviço da lista?")) {
				return false;
			}	
			else{
 				  
 			  document.getElementById("form-lista-servicos").action= "../controller/Servico_Prestador_Controller.php?metodo=deletar&id_diaria="+id_diaria;
		 	  document.getElementById("form-lista-servicos").method= "POST";
			  document.getElementById("form-lista-servicos").submit();// Form submission

			  return true;
			}
    	}

    	function busca_diaria(clicked_id){
    		var id_diaria = clicked_id.substring(10);

 			document.getElementById("form-lista-servicos").action= "../controller/Servico_Prestador_Controller.php?metodo=buscar&id_diaria="+id_diaria;
		 	document.getElementById("form-lista-servicos").method= "POST";
			document.getElementById("form-lista-servicos").submit(); // Form submission
    	}

		function alterar_servico(id_diaria, old_desc_servico, old_preco_servico){

			if (!confirm("Deseja ALTERAR este serviço da lista?")) {
				return false;
			}
			else{
 				  
 			  document.getElementById("form-lista-servicos").action= "../controller/Servico_Prestador_Controller.php?metodo=atualizar&id_diaria="+id_diaria;

 			  //+"&old_desc_servico"+old_desc_servico+"&old_preco_servico"+old_preco_servico;
		 	  document.getElementById("form-lista-servicos").method= "POST";
			  document.getElementById("form-lista-servicos").submit(); // Form submission

			  return true;
			}
    	}
    	/*Fim CRUD Serviços Prestador*/	

    	/*busca informações para modal Editar Perfil*/
    	function buscaInfoPessoa(id_pessoa){
 			document.getElementById("form-altera-pessoa").action= "../controller/Usuario_Controller.php?metodo=buscar&id_pessoa="+id_pessoa;
		 	document.getElementById("form-altera-pessoa").method= "POST";
			document.getElementById("form-altera-pessoa").submit(); // Form submission
    	}

    	/*salva alterações do usuário -> foto, detalhes, telefone etc*/
    	function salvar_alteracoes(id_pessoa, tipo_pessoa){
 		 	document.getElementById("form-altera-pessoa-modal").action= "../controller/Usuario_Controller.php?metodo=atualizar&id_pessoa="+id_pessoa+"&tipo_pessoa="+tipo_pessoa;
		 	document.getElementById("form-altera-pessoa-modal").method= "POST";
			document.getElementById("form-altera-pessoa-modal").submit(); // Form submission
    	}
	</script>
</html>
