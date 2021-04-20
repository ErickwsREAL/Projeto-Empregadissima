<?php 
include ("../controller/login_control/logar_bd_empregadissimas.php");
include ("../controller/login_control/verifica_login_usuario.php"); 
include_once ("../controller/Servico_Controlador.php");
include_once ("../controller/PessoaControlador.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/solicitacao-css.css">
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/jquery-ui.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<title>Empregadíssima | Solicitações </title>
</head>
<body class="rosa-bg" style="padding: 0px">

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
	      		<a class="nav-link" href="../controller/login_control/sair.php" id="btn-sair" style="color:white;"> Sair </a>
	    	</div>
        </div>
    </nav>
    <!--fim navbar-->

    <div class="main">
		<div class="card-tit">
			<h2 id="titulo-pag"> Minhas Solicitações 
				<!--Help da Aplicação -->
				<button type="button" class="btn bt-detalhes" data-toggle="popover" title=" Minhas Solicitações" data-content="
																			<b>1. Pendentes: </b>Solicitações que ainda não foram respondidas pelo prestador
																			(é possivel alterar dados da solicitação em 'Alterar', cancelar a solicitação enviada em 'Cancelar' 
																			ou visualizar os detalhes dela em 'Detalhes')<br>
																			<b> 2. Em Andamento: </b>Solicitações ACEITAS pelo prestador. 
																			No dia e na hora da prestação do servico o botão <b>Check-in</b> será liberado, clicando nele é possível escolher entre duas opções, fazer seu Check-in para o início do serviço ou cancelar o mesmo. 
																			É necessário esperar o Check-in do seu Contratante para que o serviço possa ser iniciado.
																			No horário de término do serviço, se o Check-in de ambos ocorreu corretamente, o <b>Check-out</b> é liberado, você poderá fazer o Check-out/Finalizar serviço, ou se aconteceu algo de errado, poderá cancelar o serviço, se foi feito o Check-out por ambos o serviço é finalizado. Cancelamentos não geram pagamento.<br>
																			<b> 3. Finalizadas: </b> Serviços finalizados, aonde já ocorreu o Check-in e o Check-out, você poderá fazer a sua avaliação do serviço e ver os detalhes do mesmo.<br>
																			<b> 4. Cancelados: </b> Serviços nos quais um dos associados do serviço cancelou o mesmo no momento de fazer o Check-in ou Check-out. É possível ver os detalhes desse serviço cancelado.
																			<i class="fa fa-question-circle></i> Ajuda </button>
			</h2>
		</div>

		<div class="lista-abas animacao-flip">
			<div id="tabs">
				<ul>
					<li><a href="#tabs-1"> Pendentes </a></li>
					<li><a href="#tabs-2"> Em Andamento </a></li>
					<li><a href="#tabs-3"> Finalizadas </a></li>
					<li><a href="#tabs-4"> Cancelados </a></li>
				</ul>

				<div id="tabs-1">
					<form name="form-pend" id="form-pend">
					
					<input type="hidden" name="metodo" id="metodo" value="">
						<?php
							$var_id = $_SESSION['pessoa']['id_pessoa'];
							$tipo_pessoa = $_SESSION['pessoa']['tipo_pessoa'];

							$rows = buscarServicosPrestador($var_id, 1);
						?>

				  		<?php 

				  			foreach ($rows as $row){ 
								$Contratante = buscarUsuario($row["id_contratante"], 2);
								
				  		?>

						<div class="card">
							<div class="card-container">

								<!-- -->
								<div class="grid-container">
									<div class="grid-item">
			                        	<div class="img-container">

											<?php
												if ($Contratante->getFoto() != NULL) {
													$foto = $Contratante->getFoto();
												} else {
												    $foto = 'profile.png';
												}
											?>

			                        		<img src="./imagens/<?php echo $foto; ?>" id="profile-img" title="Imagem de Perfil">

			                        	</div>
									</div>

									<div class="grid-item">
										<input type="hidden" name="tipo_pessoa" value="<?php echo $Contratante->getTipoPessoa(); ?>">
										<h3> <b> Solicitação de Serviço de <?php echo $Contratante->getNome(); ?> </b></h3> 
										<p><b> Dia:</b> <?php echo $row["data_servico"]; ?></p> 
										<p><b> Hora Entrada (Previsão): </b> <?php echo $row["hora_entrada"]; ?> - <b> Hora Saída (Previsão): </b> <?php echo $row["hora_saida"]; ?> 
									</p> 										
									</div>
								</div>
								<!-- -->

								<p class="center">
									<!--bootstrap buttons + classe-->
									<button type="button" class="btn btn-lg bt-aprovar" id="aprovar-pend-<?php echo $row["id_servico"]; ?>" 
											name="aprovar-pend" onclick="aprovarServico(this.id);">Aceitar</button>
									<button type="button" class="btn btn-lg bt-reprovar" id="reprovar-pend-<?php echo $row["id_servico"]; ?>" name="reprovar-pend"
											onclick="reprovarServico(this.id, <?php echo $Contratante->getTipoPessoa(); ?>);">Rejeitar</button>
									<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-pend-<?php echo $row["id_servico"]; ?>" name="detalhe-pend" onclick="buscarDetalhes(this.id, <?php echo $Contratante->getTipoPessoa(); ?>)" data-toggle="modal" data-target="#exampleModalCenter">Detalhes</button>
								</p>
							</div>
						</div>

						<?php 
							}
						?>
					</form>
					<!-- fim do form-pend -->
				</div>

				<div id="tabs-2">
				<?php
						$rows1 = buscarServicosPrestador($var_id, 2);
						$rows2 = buscarServicosPrestador($var_id, 3);

						$rows = array_merge($rows1, $rows2);

						foreach ($rows as $row){ 

							$id_contratante = $row["id_contratante"];
							$Contratante = buscarUsuario($id_contratante, 2);
					?>

					<div class="card">
						<div class="card-container">

								<!-- -->
								<div class="grid-container">
									<div class="grid-item">
			                        	<div class="img-container">
										<?php
											if ($Contratante->getFoto() != NULL) {
												$foto = $Contratante->getFoto();
											} else {
											    $foto = 'profile.png';
											}
										?>

		                        		<img src="./imagens/<?php echo $foto; ?>" id="profile-img" title="Imagem de Perfil">
			                        	</div>
									</div>

									<div class="grid-item">
										<input type="hidden" name="tipo_pessoa" value="<?php echo $Contratante->getTipoPessoa(); ?>">
										<input type="hidden" id="status_servico_aux-<?php echo $row["id_servico"] ?>" value="<?php echo $row["status_servico"] ?>">
										<h3> <b>Você possui um serviço em andamento com <?php echo $Contratante->getNome(); ?> </b></h3> 
									<p><b> Dia:</b> <?php echo $row["data_servico"]; ?></p> 
									<p><b> Hora Entrada (Previsão): </b> <?php echo $row["hora_entrada"]; ?> - <b> Hora Saída (Previsão): </b> <?php echo $row["hora_saida"]; ?> 
									</p>
									<p><b> Status: </b> <?php if ($row["status_servico"] == 2 and $row["check_inP"] == 0) {
																		echo "Aguardando o Check-in";
																	}
																	if ($row["status_servico"] == 2 and $row["check_inP"] == 1) {
																		echo "Aguardando Check-in do Contratante";
																	}
																	if ($row["status_servico"] == 3 and $row["check_outP"] == 0 and $row["check_outC"] == 0) {
																		echo "Serviço Iniciado";
																	}
																	if ($row["status_servico"] == 3	and $row["check_outC"] == 1) {
																		echo "Aguardando o Check-out";
																	}  
																	
																	if ($row["status_servico"] == 3 and	$row["check_outP"] == 1) {
																		echo "Aguardando o Check-out do Prestador";
																	}  
															?></p>							
									</div>
								</div>
								<!-- -->

								<!--bootstrap buttons + classe-->
								<button type="button" style="margin-left: 10px" class="btn btn-lg bt-detalhes btn-check" id="check-outP-<?php echo $row["id_servico"]; ?>" data-toggle="modal" data-target="#checkoutModal" onclick="enviarID_Tipo(<?php echo $row["id_servico"]?> , <?php echo $tipo_pessoa ?>)" disabled>Check-out</button>
								
								<button type="button" style="margin-left: 10px" class="btn btn-lg bt-detalhes btn-check" id="check-inP-<?php echo $row["id_servico"]; ?>" data-toggle="modal" data-target="#checkinModal" onclick="enviarID_Tipo(<?php echo $row["id_servico"]?> , <?php echo $tipo_pessoa ?>)">Check-in</button>
								
								<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-pend-<?php echo $row["id_servico"]; ?>" name="detalhe-pend" onclick="buscarDetalhes(this.id, <?php echo $Contratante->getTipoPessoa(); ?>)" data-toggle="modal" data-target="#exampleModalCenter">Detalhes</button>
							</p>
						</div>
					</div>

					<?php 
						}
					?>					
				</div>
				<div id="tabs-3">
		  		<?php
						$rows = buscarServicosPrestador($var_id, 4);

						foreach ($rows as $row){ 

							$id_contratante = $row["id_contratante"];
							$Contratante = buscarUsuario($id_contratante, 2);	
					?>
					<div class="card">
						<div class="card-container">

							<!-- -->
							<div class="grid-container">
								<div class="grid-item">
		                        	<div class="img-container">
		                        		<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
		                        	</div>
								</div>

								<div class="grid-item">
									<input type="hidden" name="tipo_pessoa" value="<?php echo $Contratante->getTipoPessoa(); ?>">
									<h3> <b> Serviço Finalizado com <?php echo $Contratante->getNome() ?> </b></h3> 
									<p><b> Dia: </b> <?php echo $row["data_servico"]; ?> </p> 
									<p><b> Hora Entrada (Previsão): </b> <?php echo $row["hora_entrada"]; ?> - <b> Hora Saída (Previsão): </b> <?php echo $row["hora_saida"]; ?> 
									</p> 
								</div>
							</div>
							<!-- -->

							<p>
								<!-- bootstrap buttons + classe -->
								<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-pend-<?php echo $row["id_servico"]; ?>" name="detalhe-pend" onclick="buscarDetalhes(this.id, <?php echo $Contratante->getTipoPessoa(); ?>)" data-toggle="modal" data-target="#exampleModalCenter" > Detalhes </button>

								<!-- leva para pagina de avaliações -->
								<button type="button" class="btn btn-lg bt-avaliar" id="avaliar-and" name="avaliar-fina" data-toggle="modal" data-target="#modal-avaliar" style="margin-right: 15px; font-weight: bold;"> Avaliar </button>
							</p>
						</div>
					</div>
					<?php 
						}
					?>	
					<!-- avaliação do contratante p/ prestador -->
					<div id="modal-avaliar" class="modal" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">
						  <div class="modal-content">
							<div class="modal-header">
							  <h5 class="modal-title">Avaliação do Contratante</h5>
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<label for="exampleFormControlTextarea1">Deixe um comentário:</label>
									<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
								</div>
								<p>Dê uma nota geral para o serviço:</p>
								<div class="filter-rating">
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
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn-confirmar btn btn-primary">Confirmar</button>
							  <button type="button" class="btn-cancelar btn btn-secondary" data-dismiss="modal">Cancelar</button>
							</div>
						  </div>
						</div>
					</div>
					<!-- fim avaliação do contratante -->
				</div>
				<!--------------->	
				<div id="tabs-4">
				<?php
						$rows = buscarServicosPrestador($var_id, 5);

						foreach ($rows as $row){ 

							$id_contratante = $row["id_contratante"];
							$Contratante = buscarUsuario($id_contratante, 2);
					?>

					<div class="card">
						<div class="card-container"  id="card-container-<?php echo $row["id_servico"] ?>">

								<!-- -->
								<div class="grid-container">
									<div class="grid-item">
			                        	<div class="img-container">
										<?php
											if ($Contratante->getFoto() != NULL) {
												$foto = $Contratante->getFoto();
											} else {
											    $foto = 'profile.png';
											}
										?>

		                        		<img src="./imagens/<?php echo $foto; ?>" id="profile-img" title="Imagem de Perfil">
			                        	</div>
									</div>

									<div class="grid-item">
										<input type="hidden" name="tipo_pessoa" value="<?php echo $Contratante->getTipoPessoa(); ?>">
										<h3> <b>Seu serviço com <?php echo $Contratante->getNome(); ?> foi cancelado.</b></h3> 
									<p><b> Dia:</b> <?php echo $row["data_servico"]; ?></p> 
									<p><b> Hora Entrada (Previsão): </b> <?php echo $row["hora_entrada"]; ?> - <b> Hora Saída (Previsão): </b> <?php echo $row["hora_saida"]; ?> 
									</p>
									<p><b> Status: </b> Cancelado </p>							
									</div>
								</div>
								<!-- -->

								<!--bootstrap buttons + classe-->
								
								<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-pend-<?php echo $row["id_servico"]; ?>" name="detalhe-pend" onclick="buscarDetalhes(this.id, <?php echo $Contratante->getTipoPessoa(); ?>)" data-toggle="modal" data-target="#exampleModalCenter">Detalhes</button>
							</p>
						</div>
					</div>

					<?php 
						}
					?>					
				</div>
			<!--------------->
			</div>
		</div>
	</div>


	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" id="exampleModalCenter" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	 
	     <div class="modal-content modal-color">
	 
			<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle"> Detalhes da Solicitação </h5>
		    
		    	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    	    <span style="color: white" aria-hidden="true">&times;</span>
		        </button>
		    </div>

	     	<div class="modal-body">
	        	<p><b> Data: </b>  <?php if(isset($_GET['data_servico']))echo $_GET['data_servico'];?>   &nbsp; 

		        <p><b> Hora Entrada (Previsão): </b> <?php if(isset($_GET['hora_entrada']))echo $_GET['hora_entrada']; ?> </p>
				<p><b> Hora Saída (Previsão): </b> <?php if(isset($_GET['hora_saida']))echo $_GET['hora_saida'];?> </p>
	        	</p>

					<?php
						$consulta = "SELECT * FROM diaria_prestador WHERE id_diaria = '".$_GET['id_diaria']."'";
						$con = $conn -> query($consulta) or die($conn-> error);

			  			while ($dados_diaria= $con ->fetch_array() ){
			  		?>
		        	<p><b> Tipo de Serviço: </b> <?php echo $dados_diaria["descricao_diaria"]; ?> </p>
		        	<p><b> Valor a ser pago:</b> <?php echo $dados_diaria["valor"]; ?> </p>
	        	<?php
			        }
	        	?>

				<?php
					$consulta = "SELECT * FROM endereco WHERE id_endereco = '".$_GET['id_endereco']."'";
					$con = $conn -> query($consulta) or die($conn-> error);

		  			while ($dados_endereco= $con ->fetch_array() ){
		  		?>	        	
	        	<p><b> Endereço que ocorrerá o serviço: </b> <?php echo $dados_endereco["bairro"];?>&nbsp;  <?php echo $dados_endereco["rua"];?> - <?php echo $dados_endereco["numero"];?>  </p>
	        	<?php   
			        }
	        	?>
				<?php
					if ($_GET['forma_pagamento'] == 1) {
						$forma_pag = "Dinheiro";
					}
					elseif ($_GET['forma_pagamento'] == 2) {
					 	$forma_pag = "Cartão de Crédito";
					} else {
					    $forma_pag = "Boleto";
					}
				?>
 
	        	<p><b> Forma de Pagamento:</b> <?php if(isset($_GET['forma_pagamento']))echo $forma_pag; ?> </p>
	        	<!--informação apenas do prestador-->
	        	<p><b> Avaliação do solicitante: </b>   <span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star"></span>
														<span class="fa fa-star"></span> </p>

	        	<!--informação apenas do solicitante-->
	        	<p><b> Avaliação do prestador: </b></p>
	        <!--	<p><b> Visite o perfil aqui: </b> <a href="./perfil-prestador-visao-contratante.html" target="_blank"> Visite o perfil do prestador </a> </p> -->
	      	</div>
	    </div>
	 
	  </div>
	</div>

<div class="modal fade modalcheck" id="checkinModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="editarModalTitle">Realizar Check-in</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body" id="editarBody">
			<form id="checkinForm">
			    <div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="check-in" id="iniciarServiço" value="iniciado">
					<label class="form-check-label" for="iniciarServiço">Iniciar Serviço</label>
					<input class="form-check-input" type="radio" name="check-in" id="cancelarServiço" value="cancelado">
					<label class="form-check-label" for=cancelarServiço>Cancelar Check-in</label>
				</div>
			    <br><button type="button" class="btn btn-primary" id="buttonCheckin" onclick="fazCheckin()"> Confirmar </button>
			</form>
		</div>
		</div>
	</div>
</div>	

<div class="modal fade modalcheck" id="checkoutModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="editarModalTitle">Realizar Check-out</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body" id="editarBody">
			<form id="checkoutForm">
			    <div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="check-out" id="finalizarServiço" value="finalizado">
					<label class="form-check-label" for="finalizarServiço">Finalizar Serviço</label>
					<input class="form-check-input" type="radio" name="check-out" id="cancelarServiçout" value="cancelado">
					<label class="form-check-label" for="cancelarServiçout">Cancelar Check-out</label>
				</div>
			    <br><button type="button" class="btn btn-primary" onclick="fazCheckout()" id="buttonCheckout"> Confirmar </button>
			</form>
		</div>
		</div>
	</div>
</div>	

</body>

<div class="item footer"> Copyright @EmpregadíssimaOwners </div>

<script>
	$(document).ready(function(){ 
		//localStorage.removeItem("buttonIDP");
		//localStorage.removeItem("check-inPStorage"); //----Não retirar essas 3 funções
		//localStorage.removeItem("check-outPStorage");
		var statusServico;

		statusServico = enviarID_Tipo(localStorage.getItem("buttonIDP"), 1);

		if (localStorage.getItem("check-inPStorage") == "true" && statusServico == 2) {//ERICK
			
			var auxButton =  localStorage.getItem("buttonIDP");
			$("#check-inP-"+auxButton).prop('disabled', true);
		
		}

		if (localStorage.getItem("check-inPStorage") == "true" && statusServico == 3) {//ERICK
			
			var auxButton =  localStorage.getItem("buttonIDP");
			$("#check-inP-"+auxButton).prop('disabled', true);
			$("#check-outP-"+auxButton).prop('disabled', false);
		
		}


		if (localStorage.getItem("check-outPStorage") == "true") {//ERICK
			
			var auxButton =  localStorage.getItem("buttonIDP");
			$("#check-inP-"+auxButton).prop('disabled', true);
			$("#check-outP-"+auxButton).prop('disabled', true);
		
		}

		if (window.location.search.substring(0,14) == "?data_servico=") {
			$('#exampleModalCenter').modal('show');
		}

	    $('[data-toggle="popover"]').popover({html: true, 
	    });	

	});

	$( function() {
		$("#tabs").tabs();
	});

	function solicitacao_enviada(){
		$('#envia-solicitacao-alert').show()
	}

	$('#exampleModalCenter').on('shown.bs.modal', function () {
  		$('#myInput').trigger('focus')
	});

//---------------------------------------------------------------------
	
	var globalIDservico;
	var globaltipo_pessoa;

	function enviarID_Tipo(id_servicotab, tipo_pessoatab) {//ERICK
		globalIDservico = id_servicotab;
		globaltipo_pessoa = tipo_pessoatab;
		statusServico = $('#status_servico_aux-'+id_servicotab).val();
		
		return statusServico;
		//console.log(statusServico);
	}

	function fazCheckin(){//ERICK

		var radioCheckin = $('input[name="check-in"]:checked').val();

		if (radioCheckin == "cancelado") {
			
			if (!confirm("Deseja realmente cancelar o serviço? Está ação resulta no não recebimento do pagamento.")) {
				return false;
			}else{
				
				document.getElementById("checkinForm").action= "../controller/Servico_Controlador.php?metodo=fazerCheckin_out&id_servicoCheck="+globalIDservico+"&tipo_pessoaCheck="+globaltipo_pessoa;
				document.getElementById("checkinForm").method= "POST";
				document.getElementById("checkinForm").submit();

				localStorage.removeItem("buttonIDP");
				localStorage.removeItem("check-inPStorage"); 
				localStorage.removeItem("check-outPStorage");
			
				return true;
			}
		}

		if (radioCheckin == null) {
			
			alert("Nenhuma opção selecionada!");
			return false;		
		}

		document.getElementById("checkinForm").action= "../controller/Servico_Controlador.php?metodo=fazerCheckin_out&id_servicoCheck="+globalIDservico+"&tipo_pessoaCheck="+globaltipo_pessoa;
		document.getElementById("checkinForm").method= "POST";
		document.getElementById("checkinForm").submit();

		localStorage.setItem("buttonIDP", globalIDservico);
		localStorage.setItem("check-inPStorage", "true");
		localStorage.removeItem("check-outPStorage");
	}

	function fazCheckout(){//ERICK

		var radioCheckout = $('input[name="check-out"]:checked').val();

		if (radioCheckout == "cancelado") {
			
			if (!confirm("Deseja realmente cancelar o serviço? Está ação resulta no não recebimento do pagamento.")) {
				return false;
			}else{
				
				document.getElementById("checkoutForm").action= "../controller/Servico_Controlador.php?metodo=fazerCheckin_out&id_servicoCheck="+globalIDservico+"&tipo_pessoaCheck="+globaltipo_pessoa;
				document.getElementById("checkoutForm").method= "POST";
				document.getElementById("checkoutForm").submit();

				localStorage.removeItem("buttonIDP");
				localStorage.removeItem("check-inPStorage"); 
				localStorage.removeItem("check-outPStorage");
			
				return true;
			}
		}

		if (radioCheckout == null) {
			
			alert("Nenhuma opção selecionada!");
			return false;		
		}

		document.getElementById("checkoutForm").action= "../controller/Servico_Controlador.php?metodo=fazerCheckin_out&id_servicoCheck="+globalIDservico+"&tipo_pessoaCheck="+globaltipo_pessoa;
		document.getElementById("checkoutForm").method= "POST";
		document.getElementById("checkoutForm").submit();
		
		localStorage.setItem("buttonIDP", globalIDservico);
		localStorage.setItem("check-outPStorage", "true");
		localStorage.removeItem("check-inPStorage");
	
	}

//-----------------------------------------------------------------------------
	function aprovarServico(id_serv){
		var id_servico = id_serv.substring(13);

			if (!confirm("Deseja Aceitar esta solicitação?")) {
				return false;
			}	
			else{
					document.getElementById("form-pend").action= "../controller/Servico_Controlador.php?metodo=alt_status_apv&id_servico="+id_servico;
			 	 	document.getElementById("form-pend").method= "POST";
				 	document.getElementById("form-pend").submit(); // Form submission
				return true;
			}
	}

	function reprovarServico(id_serv, tipo_pessoa){
		var id_servico = id_serv.substring(14);

			if (!confirm("Deseja REJEITAR esta solicitação?")) {
				return false;
			}	
			else{
				document.getElementById("form-pend").action= "../controller/Servico_Controlador.php?metodo=alt_status_rep&id_servico="+id_servico+"&tipo_pessoa="+tipo_pessoa;
		 	 	document.getElementById("form-pend").method= "POST";
			 	document.getElementById("form-pend").submit(); // Form submission
	 			return true;
	 		}
	}

	function buscarDetalhes(id_serv, tipo_pessoa){
		var id_servico = id_serv.substring(13);
			
			document.getElementById("form-pend").action= "../controller/Servico_Controlador.php?metodo=buscar&id_servico="+id_servico+"&tipo_pessoa="+tipo_pessoa;
	 	 	document.getElementById("form-pend").method= "POST";
		 	document.getElementById("form-pend").submit(); // Form submission
	}

</script>

</html>