<?php 
include ("../controller/login_control/logar_bd_empregadissimas.php");
include ("../controller/login_control/verifica_login_usuario.php");
include_once ("../controller/PessoaControlador.php");
include_once ("../controller/EnderecoControlador.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/csscontratante.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="./js/jquery-3.5.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/jquery-ui.js"></script>	
	<script src="./js/jquery.mask.min.js"></script>
	<title>Perfil Contratante</title>
</head>
	<body class="rosa-bg">

		<!--nav bar -->
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand">Empregadíssimas</a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
	        <li class="nav-item active">
	            <a class="nav-link" href="./visao-contratante.php"> Busca </a>
	        </li>
	        <li class="nav-item active">
	            <a class="nav-link" href="./perfilcontratante.php"> Perfil </a>
	        </li>
	        <li class="nav-item active">
	            <a class="nav-link" href="./manter-solicitacao-contratante.php"> Minhas Solicitações </a>
	        </li>
          </ul>
          	<div class="form-inline my-2 my-lg-0">
	      		<a class="nav-link" href="../controller/login_control/sair.php" id="btn-sair" style="color:white;"> Sair </a>
	    	</div>
        </div>
      </nav>
      <!--fim navbar-->

		<div class="section profile-div" id="profile">
			<!-- informações do perfil-->
            <div class="container">

				<?php
					$var_id = $_SESSION['pessoa']['id_pessoa'];
					$tipo_pessoa = $_SESSION['pessoa']['tipo_pessoa'];
					
					$Contratante = buscarUsuario($var_id, $tipo_pessoa);
				?>
		  		
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-6">
                        <div class="profile-text go-to">
                            <h3 class="dark-color"> <?php echo $Contratante->getNome() ?></h3>
                                <p><?php echo $Contratante->getDescricao() ?></p>
                            <div class="row profile-list">
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>Idade</label>
									
										<?php
											$dataNascimento = $Contratante->getDataNascimento();
											$date = new DateTime($dataNascimento);
											$interval = $date->diff( new DateTime( date('Y-m-d') ) );
										?>

                                        <p><?php echo $interval->format( '%Y anos' ); ?></p>
                                    </div>
                                    <div class="media">
                                        <label>Cidade</label>
                                        <p><?php echo $Contratante->getCidade() ?></p>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>E-mail</label>
                                        <p><?php echo $Contratante->getEmail() ?></p>
                                    </div>
                                    <div class="media">
                                        <label>Sexo</label>
										<?php

											$sexoID = $Contratante->getSexo();
											if ($sexoID == 1) {
												$sexo = 'Masculino';
											} elseif ($sexoID == 2) {
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
									if ($Contratante->getFoto() != NULL) {
										$foto = $Contratante->getFoto(); 
									} else {
									    $foto = 'profile.png';
									}
								?>

                        		<img src="./imagens/<?php echo $foto; ?>" class="rounded img-thumbnail" title="avatar">
                        	</div>
                        </div>
                    </div>
                </div>
               	
<!--arrumado acima------------------------------------------------------------------------------------------------------------------------->			

                <!--div com cliente, qte avaliações e star rating -->
                <div class="counter">
                    <div class="row">
                        <div class="col-6 col-lg-3">
                            <div class="count-data text-center">
                                <h6 class="count h2">13</h6>
                                <p class="m-0px font-w-600">Quantidade de Avaliações</p>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="count-data text-center" id="ava2">
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
			<div class="row" id="nada">
			  	<!--menu de outras manutenções-->
			  	<div class="col-6" id="buttons">
			  		<form name="form-altera-pessoa" id="form-altera-pessoa">
				  		<button type="button" class="btn btn-lg btn-block btManter" data-toggle="modal" data-target="#editarModal" style="margin:0px;margin-top: 50px;margin-right:0px;"><i class="fa fa-cog"></i>&nbsp; Editar Perfil &nbsp;</button>

				  		<button type="button" class="btn btn-lg btn-block btManter" data-toggle="modal" data-target="#enderecoModal" style="margin:0px;margin-top: 50px;margin-right:0px;"><i class="fa fa-key fa-fw	"></i>&nbsp; Meus Endereços &nbsp;</button>
			  		</form>
			  		<form id="desativaForm">
				  		<input name="id_pessoa"  id="id_pessoaDesativa"value="<?php echo $var_id ?>" style="display: none;">
				  		<input name="tipo_pessoa" id="tipo_pessoaDesativa" value="<?php echo $tipo_pessoa ?>" style="display: none;">
				  	</form>
				  		<button class="btn btn-lg btn-block btManter" id="desativarConta" onclick="DesativarPessoa()" style="margin:0px;margin-top: 50px;margin-right:0px;"><i class="fa fa-trash-o"></i>&nbsp; Desativar Conta &nbsp;</button>
			  	</div>

			</div>
			<!--fim manutenções -->
        	<!--modal editar perfil -->
        	<div class="modal fade modal-lg" id="editarModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg">
			  		<form id="form-altera-pessoa-modal" name="form-altera-pessoa-modal" method="POST" action="../controller/PessoaControlador.php?metodo=Atualizar">
				    	<div class="modal-content">
					      	<div class="modal-header">
					        	<h5 class="modal-title" id="editarModalTitle">Editar Perfil</h5>
					        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          	<span aria-hidden="true">&times;</span>
					        	</button>
					      	</div>
					      	<div class="modal-body" id="editarBody">
					      		<form id="editarForm">
					      			<div class="form-group">
										<label for="editarDescricao">Descrição:</label>		
										<textarea class="form-control" id="editarDescricao" rows="3" name="descricao" id="editarDescricao" placeholder="uma breve descrição de você ou seu serviços..."><?php echo $Contratante->getDescricao() ?></textarea>
									</div>
					      			<div class="form-group labelPeq">
										<label for="editarNome">Nome:</label>		
										<input class="form-control form-control-sm" type="text" name="nome" id="editarNome" placeholder="Novo nome.." maxlength="50" required value="<?php echo $Contratante->getNome() ?>">
									</div>
					      			<div class="form-group labelPeq">
										<label for="editarTelefone">Telefone:</label>		
										<input class="form-control form-control-sm" type="tel" name="telefone" id="editarTelefone" placeholder="(00) 98855-7711" minlength="15" required value="<?php echo $Contratante->getTelefone() ?>">
									</div>
					      			<div class="form-group labelPeq">
										<label for="foto">Foto de Perfil:</label>		
										<input type="file" id="foto" name="foto" value="<?php echo $Contratante->getFoto(); ?>">
									</div>	
									<button type="submit" class="btn btn-primary buttonEditar" id="buttonEditarPerfil" style=""> Salvar Edição </button>

									<input name="id_pessoa" value="<?php echo $var_id ?>" style="visibility: hidden;">
									<input name="tipo_pessoa"  value="<?php echo $tipo_pessoa ?>" style="visibility: hidden;">							
					      		</form>
					      	</div>
				    	</div>
				    </form>
			  	</div>
			</div>	
		
			<!--modal crud endereço -->
			<div class="modal fade modal-lg" id="enderecoModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg">
			    	<div class="modal-content">
			      	<div class="modal-header">
			        	<h5 class="modal-title" id="editarModalTitle">Meus Endereços</h5>
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          	<span aria-hidden="true">&times;</span>
			        	</button>
			      	</div>
			      	
			      	<div class="modal-body">
			      		<?php
							$rows = buscarTEnd($var_id);

							if ($rows == "false") {
							
							echo '<div id="editarEndereço">
				      		<div class="col-md-10">
								<form id="formedit">		      
								    <label for="endereçosUsuárioIN">Endereços: </label>
								    <select id="endereçosUsuárioIN" class="form-control">
								      	
								      	<option selected > Não existe endereços em seu nome! Tente adicionar um. </option>
								      
								    </select>
						    		<button type="button" class="btn btn-dprimary buttonEditar butf" disabled id="buttonEditarEndIN"> Editar Selecionado</button>
						    		<button type="button" class="btn btn-danger butf" disabled> Excluir Selecionado </button>
						    	</form>
						    </div>				
				      	</div>';		

							}else{
						?>

			      		<div id="editarEndereço">
				      		<div class="col-md-10">
								<form id="formedit">		      
								    <label for="endereçosUsuário">Endereços: </label>
								    <input name="id_contratante"  value="<?php echo $var_id ?>" style="visibility: hidden;">
								    <select id="endereçosUsuário" name="enderecoSelecionado" class="form-control">
										<?php foreach ($rows as $row){ 
									  	?>    	
								      	
								      	<option  selected value="<?php echo $row['id_endereco']; ?>"> Bairro: <?php echo $row['bairro']; ?> Rua: <?php echo $row['rua']; ?>, Número: <?php echo $row['numero']; ?>, Complemento: <?php echo $row['complemento']; ?> CEP: <?php echo $row['cep']; ?> </option>
								      

								      	<?php } ?>
								      	 
								    </select>
						    		<button type="button" class="btn btn-dprimary buttonEditar butf" id="buttonEditarEnd"> Editar Selecionado</button>
						    		<button type="button" class="btn btn-danger butf" onclick="excluir_end();"> Excluir Selecionado </button>
						    	</form>
						    </div>				
				      	</div>
				      


				      	<div id="editarEnd3">			
				      			<p> Editar Endereço Selecionado:</p>
				      			<form id="formEndereco" method="POST" action="../controller/EnderecoControlador.php?metodo=Atualizar">
									<div class="form-row">
	    								<div class="col-md-4">
	      									<input type="text" class="form-control" placeholder="Bairro" id="bairroUsuárioED" name="bairro" required >
	    								</div>
	    								<div class="col-md-4">
	      									<input type="text" class="form-control" placeholder="Rua" id="ruaUsuárioED" name="rua" required >
	    								</div>
	  									<div class="col-md-2">
	  										<input type="number" class="form-control" placeholder="Numero" id="numeroUsuárioED" name="numero" required>
	  									</div>
	  								</div>
	  								<div class="form-row">
	  									<div class="col-md-4">
	  										<input type="text" class="form-control" name="complemento" id="complementoUsuárioED" placeholder="Complemento" required>
	  									</div>
	  									<div class="col-md-2">
	  										<input type="text" class="form-control" name="cep" placeholder="CEP" id="cepUsuárioED" max="9" required >
	  									</div>
	  										<input name="id_contratante" value="<?php echo $var_id ?>" style="visibility: hidden;">
	  										<input name="id_end" id="id_c" style="visibility: hidden;">
	  								</div>
	  								<button type="submit" class="btn btn-primary buttonEditar butf2" id="buttonED">Salvar</button>
	  								<button type="button" class="btn btn-primary buttonEditar butf2" id="buttonCan">Cancelar</button>
								</form>
							</div>
						<?php } ?>
						
						<div id="adicionarEndereço">	
							<p>Adicionar um endereço:</p>

					      	<form method="POST" action="../controller/EnderecoControlador.php?metodo=Inserir">
								<div class="form-row">
    								<div class="col-md-4">
      									<input type="text" class="form-control arruma" placeholder="Bairro" id="bairroUsuário"  name="bairro" required>
    								</div>
    								<div class="col-md-4">
      									<input type="text" class="form-control arruma" placeholder="Rua" id="ruaUsuário" name="rua" required>
    								</div>
  									<div class="col-md-2">
  										<input type="number" class="form-control arruma" placeholder="Numero" id="numeroUsuário" name="numero" required>
  									</div>
  								</div>
  								<div class="form-row">
  									<div class="col-md-4">
  										<input type="text" class="form-control" name="complemento" id="complementoUsuário" placeholder="Complemento">
  									</div>
  									<div class="col-md-2">
  										<input type="text" class="form-control" name="cep" placeholder="CEP" id="cepUsuário" max="9" required>
  									</div>
  										<input name="id_c" id="id_c" value="<?php echo $var_id; ?>" style="visibility: hidden;">
  								</div>
  								<button type="submit" class="btn btn-primary buttonEditar" id="buttonAdd" >Salvar</button>
							</form>
						</div>
					
					</div>
					
					</div>
				</div>
			</div>					

        </div>
        <!--fim div seção-->


	   	<div class="item footer" style="color:white;">Copyright @EmpregadíssimaOwners</div>
		</div>
		
	</body>

	<!--jquery -->
	<script>	
		$(document).ready(function(){ 
			//document.getElementById('autoform').submit();
			
			if (window.location.search.substring(0,11) == "?descricao=") {
				$('#editarModal').modal('show');
			}
			
			$('#editarEnd3').hide();

			//$('#buttonEditarEnd').on('click', function(){
				//$('#editarEnd3').show();
				//$('#editarEndereço').hide();
				//$('#adicionarEndereço').hide();
						
			//});

			$('#buttonCan').on('click', function(){
				$('#editarEnd3').hide();
				$('#editarEndereço').show();	
				$('#adicionarEndereço').show();
			});

			$( "#buttonExcluirEnd" ).on( "click", function() {
			    $( "#enderecoModal" ).modal('hide');
			});

			$('#buttonEditarEnd').on('click', function(event){
				
				event.preventDefault();
				//var $form = $(this);
				var id_end = $('#endereçosUsuário').val();
				//console.log(id_end);
				//console.log($('#endereçosUsuário').val());

				$.ajax({
					url: '../controller/EnderecoControlador.php',
					type: "POST",
					dataType :"html",
					data: {'id_endBuscar': id_end},
					
					success: function(value){
			           	var data = value.split(",");
			           	$('#bairroUsuárioED').val(data[0]);
			           	$('#ruaUsuárioED').val(data[1]);
			           	$('#numeroUsuárioED').val(data[2]);
			           	$('#complementoUsuárioED').val(data[4]);
			           	$('#cepUsuárioED').val(data[3]);
			           	$('#id_c').val(data[5]);
			            //$('#course_credit').val(data[1]);
			        	$('#editarEnd3').show();
			        	$('#editarEndereço').hide();
						$('#adicionarEndereço').hide();
			        }
				});

			});		
			
		});	
			

			function abreAdicionarSolicitação() {
				window.open("enviar-solicitacao.html","_blank");
			}

			

			var $campoTel = $("#editarTelefone");
				$campoTel.mask('(00) 00000-0000');

			var $campoCep = $("#cepUsuário");
				$campoCep.mask('00000-000');
			var $campoCep2 = $("#cepUsuárioED");
				$campoCep2.mask('00000-000');
			
			//restrição de botão submit editar perfil provisório
			/*$('#editarForm input').blur(function(){
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
			});*/
			//restrição de botão submit editar endereço provisório	
			/*$('#formEndereco #bairroUsuárioED').blur(function(){
			    if(!$(this).val() && !$('#formEndereco #ruaUsuárioED').val() && !$('#formEndereco #numeroUsuárioED').val() && !$('#formEndereco #cepUsuárioED').val() && !$('#formEndereco #complementoUsuárioED').val()) {
			        $('#buttonED').prop("disabled",true);
			    } else {
			    	$('#buttonED').prop("disabled",false);
			    }
			});	

			$('#formEndereco #ruaUsuárioED').blur(function(){
			    if(!$(this).val() && !$('#formEndereco #bairroUsuárioED').val() && !$('#formEndereco #numeroUsuárioED').val() && !$('#formEndereco #cepUsuárioED').val() && !$('#formEndereco #complementoUsuárioED').val()) {
			        $('#buttonED').prop("disabled",true);
			    } else {
			    	$('#buttonED').prop("disabled",false);
			    }
			});


			$('#formEndereco #numeroUsuárioED').blur(function(){
			    if(!$(this).val() && !$('#formEndereco #bairroUsuárioED').val() && !$('#formEndereco #ruaUsuárioED').val() && !$('#formEndereco #cepUsuárioED').val() && !$('#formEndereco #complementoUsuárioED').val()) {
			        $('#buttonED').prop("disabled",true);
			    } else {
			    	$('#buttonED').prop("disabled",false);
			    }
			});

			$('#formEndereco #cepUsuárioED').blur(function(){
			    if(!$(this).val() && !$('#formEndereco #bairroUsuárioED').val() && !$('#formEndereco #ruaUsuárioED').val() && !$('#formEndereco #numeroUsuárioED').val() && !$('#formEndereco #complementoUsuárioED').val()) {
			        $('#buttonED').prop("disabled",true);
			    } else {
			    	$('#buttonED').prop("disabled",false);
			    }
			});

			$('#formEndereco #complementoUsuárioED').blur(function(){
			    if(!$(this).val() && !$('#formEndereco #bairroUsuárioED').val() && !$('#formEndereco #ruaUsuárioED').val() && !$('#formEndereco #numeroUsuárioED').val() && !$('#formEndereco #cepUsuárioED').val()) {
			        $('#buttonED').prop("disabled",true);
			    } else {
			    	$('#buttonED').prop("disabled",false);
			    }
			});*/
			
			function DesativarPessoa(){
				if (!confirm("Deseja DESATIVAR este cadastro?")) {
					return false; 
				}	
				else{
	 				var e = document.getElementById("id_pessoaDesativa");
					var a = document.getElementById("tipo_pessoaDesativa");
					var id_pessoa = e.value;
					var tipo_pessoa = a.value;

	 			 	document.getElementById("desativaForm").action= "../controller/PessoaControlador.php?metodo=Desativar&id_pessoa="+id_pessoa+"&tipo_pessoa="+tipo_pessoa;
			 	 	document.getElementById("desativaForm").method= "POST";
				 	document.getElementById("desativaForm").submit();

				 	return true;
				}
    		}

			function excluir_end(){
				if (!confirm("Deseja EXCLUIR este endereço?")) {
					return false; 
				}	
				else{
	 				  
	 			 document.getElementById("formedit").action= "../controller/EnderecoControlador.php?metodo=Excluir";
			 	 document.getElementById("formedit").method= "POST";
				 document.getElementById("formedit").submit();

				}
    		}

    	/*salva alterações do usuário -> foto, detalhes, telefone etc*/
    	/*function salvar_alteracoes(id_pessoa, tipo_pessoa){
 			document.getElementById("form-altera-pessoa-modal").action= "../controller/PessoaControlador.php?metodo=Atualizar&id_pessoa="+id_pessoa+"&tipo_pessoa="+tipo_pessoa;
		 	document.getElementById("form-altera-pessoa-modal").method= "POST";
			document.getElementById("form-altera-pessoa-modal").submit(); // Form submission
    	}*/					
	</script>
</html>