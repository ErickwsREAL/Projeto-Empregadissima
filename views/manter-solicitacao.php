<?php include ("../controller/login_control/logar_bd_empregadissimas.php")
?>

<?php include ("../controller/login_control/verifica_login_usuario.php") ?>

<?php echo $_SESSION['pessoa']['id_pessoa'];

function getDadosContratante($id_contratante) {
	include ("../controller/login_control/logar_bd_empregadissimas.php");

    $sql = "SELECT nome, foto, tipo_pessoa FROM pessoa WHERE id_pessoa='$id_contratante'";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    $dados_contratante = array(
        'nome' => $row["nome"],
        'foto' => $row["foto"],
        'tipo_pessoa' => $row["tipo_pessoa"]
    );

    $conn->close();
    
    return $dados_contratante;
}

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
			<h2 id="titulo-pag"> Minhas Solicitações </h2>
		</div>

		<div class="lista-abas animacao-flip">
			<div id="tabs">
				<ul>
					<li><a href="#tabs-1"> Pendentes </a></li>
					<li><a href="#tabs-2"> Em Andamento </a></li>
					<li><a href="#tabs-3"> Finalizadas </a></li>
				</ul>

				<div id="tabs-1">
					<form name="form-pend" id="form-pend">
						<?php
							$var_id = $_SESSION['pessoa']['id_pessoa'];

							$consulta = "SELECT * FROM servico WHERE id_prestador = $var_id AND status_servico = 1 ";
							$con = $conn -> query($consulta) or die($conn-> error);
						?>

				  		<?php 

				  			while ($dados_servico= $con ->fetch_array() ){
								$id_contratante = $dados_servico["id_contratante"];

								$parametros = getDadosContratante($id_contratante);

					            $valores = array();
					            $valores['nome'] = $parametros['nome'];
					            $valores['foto'] = $parametros['foto'];
					            $valores['tipo_pessoa'] = $parametros['tipo_pessoa'];
				  		?>

						<div class="card">
							<div class="card-container">

								<!-- -->
								<div class="grid-container">
									<div class="grid-item">
			                        	<div class="img-container">

											<?php
												if ($valores['foto'] != NULL) {
													$foto = $valores['foto']; 
												} else {
												    $foto = 'profile.png';
												}
											?>

			                        		<img src="./imagens/<?php echo $foto; ?>" id="profile-img" title="Imagem de Perfil">

			                        	</div>
									</div>

									<div class="grid-item">
										<input type="hidden" name="tipo_pessoa" value="<?php echo $valores['tipo_pessoa']; ?>">
										<h3> <b> Solicitação de Serviço de <?php echo $valores['nome'] ?> </b></h3> 
										<p><b> Dia:</b> <?php echo $dados_servico["data_servico"]; ?></p> 
										<p><b> Hora Entrada (Previsão): </b> <?php echo $dados_servico["hora_entrada"]; ?> - <b> Hora Saída (Previsão): </b> <?php echo $dados_servico["hora_saida"]; ?> 
									</p> 										
									</div>
								</div>
								<!-- -->

								<p class="center">
									<!--bootstrap buttons + classe-->
									<button type="button" class="btn btn-lg bt-aprovar" id="aprovar-pend-<?php echo $dados_servico["id_servico"]; ?>" 
											name="aprovar-pend" onclick="aprovarServico(this.id);">Aceitar</button>
									<button type="button" class="btn btn-lg bt-reprovar" id="reprovar-pend-<?php echo $dados_servico["id_servico"]; ?>" name="reprovar-pend"
											onclick="reprovarServico(this.id, <?php echo $valores['tipo_pessoa']; ?>);">Rejeitar</button>
									<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-pend-<?php echo $dados_servico["id_servico"]; ?>" name="detalhe-pend" onclick="buscarDetalhes(this.id, <?php echo $valores['tipo_pessoa']; ?>)" data-toggle="modal" data-target="#exampleModalCenter">Detalhes</button>
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
					$consulta = "SELECT * FROM servico WHERE id_prestador = $var_id AND status_servico = 2 ";
					$con = $conn -> query($consulta) or die($conn-> error);

		  			while ($dados_servico= $con ->fetch_array() ){
						$id_contratante = $dados_servico["id_contratante"];

						$parametros = getDadosContratante($id_contratante);
			            $valores = array();
			            $valores['nome'] = $parametros['nome'];
			            $valores['foto'] = $parametros['foto'];
			            $valores['tipo_pessoa'] = $parametros['tipo_pessoa'];

		  		?>
					<div class="card">
						<div class="card-container">

								<!-- -->
								<div class="grid-container">
									<div class="grid-item">
			                        	<div class="img-container">
										<?php
											if ($valores['foto'] != NULL) {
												$foto = $valores['foto']; 
											} else {
											    $foto = 'profile.png';
											}
										?>

		                        		<img src="./imagens/<?php echo $foto; ?>" id="profile-img" title="Imagem de Perfil">
			                        	</div>
									</div>

									<div class="grid-item">
										<input type="hidden" name="tipo_pessoa" value="<?php echo $valores['tipo_pessoa']; ?>">
										<h3> <b>Você possui um serviço em andamento com <?php echo $valores['nome'] ?> </b></h3> 
									<p><b> Dia:</b> <?php echo $dados_servico["data_servico"]; ?></p> 
									<p><b> Hora Entrada (Previsão): </b> <?php echo $dados_servico["hora_entrada"]; ?> - <b> Hora Saída (Previsão): </b> <?php echo $dados_servico["hora_saida"]; ?> 
									</p> 									
									</div>
								</div>
								<!-- -->

								<!--bootstrap buttons + classe-->
								<button type="button" class="btn btn-lg bt-detalhes btn-check" id="check-out" data-toggle="modal" data-target="#checkoutModal">Check-out</button>
								<button type="button" class="btn btn-lg bt-detalhes btn-check" id="check-in" data-toggle="modal" data-target="#checkinModal">Check-in</button>
								<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-pend-<?php echo $dados_servico["id_servico"]; ?>" name="detalhe-pend" onclick="buscarDetalhes(this.id, <?php echo $valores['tipo_pessoa']; ?>)" data-toggle="modal" data-target="#exampleModalCenter">Detalhes</button>
							</p>
						</div>
					</div>

					<?php 
						}
					?>					
				</div>
				<div id="tabs-3">
		  		<?php 
					$consulta = "SELECT * FROM servico WHERE id_prestador = $var_id AND status_servico = 3 ";
					$con = $conn -> query($consulta) or die($conn-> error);

		  			while ($dados_servico= $con ->fetch_array() ){
					
						$id_contratante = $dados_servico["id_contratante"];

						$parametros = getDadosContratante($id_contratante);

			            $valores = array();
			            $valores['nome'] = $parametros['nome'];
			            $valores['foto'] = $parametros['foto'];
			            $valores['tipo_pessoa'] = $parametros['tipo_pessoa'];

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
									<input type="hidden" name="tipo_pessoa" value="<?php echo $valores['tipo_pessoa']; ?>">
									<h3> <b> Serviço Finalizado com <?php echo $valores['nome'] ?> </b></h3> 
									<p><b> Dia: </b> <?php echo $dados_servico["data_servico"]; ?> </p> 
									<p><b> Hora Entrada (Previsão): </b> <?php echo $dados_servico["hora_entrada"]; ?> - <b> Hora Saída (Previsão): </b> <?php echo $dados_servico["hora_saida"]; ?> 
									</p> 
								</div>
							</div>
							<!-- -->

							<p>
								<!-- bootstrap buttons + classe -->
								<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-pend-<?php echo $dados_servico["id_servico"]; ?>" name="detalhe-pend" onclick="buscarDetalhes(this.id, <?php echo $valores['tipo_pessoa']; ?>)" data-toggle="modal" data-target="#exampleModalCenter" > Detalhes </button>

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

	<div id="dialog-cancelar" title="Alerta">
	  <p> Deseja realmente <b>cancelar</b> o serviço?<br> O cancelamento implica no não pagamento ao prestador. </p>
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
			<form>
			    <div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="check-in" id="iniciarServiço" value="iniciado">
					<label class="form-check-label" for="iniciarServiço">Iniciar Serviço</label>
					<input class="form-check-input" type="radio" name="check-in" id="cancelarServiço" value="cancelado">
					<label class="form-check-label" for=cancelarServiço>Cancelar Check-in</label>
				</div>
			    <br><button type="submit" class="btn btn-primary" id="buttonCheckin" value="Enviar"> Confirmar </button>
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
			<form>
			    <div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" name="check-out" id="finalizarServiço" value="finalizado">
					<label class="form-check-label" for="finalizarServiço">Finalizar Serviço</label>
					<input class="form-check-input" type="radio" name="check-out" id="cancelarServiçout" value="cancelado">
					<label class="form-check-label" for="cancelarServiçout">Cancelar Check-out</label>
				</div>
			    <br><button type="submit" class="btn btn-primary" id="buttonCheckin" value="Enviar"> Confirmar </button>
			</form>
		</div>
		</div>
	</div>
</div>	

</body>

<div class="item footer"> Copyright @EmpregadíssimaOwners </div>

<script >
	$(document).ready(function(){ 
		if (window.location.search.substring(0,14) == "?data_servico=") {
			$('#exampleModalCenter').modal('show');
		}
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

	$( "#cancelarServiço" ).on( "click", function() {
	    if($('#cancelarServiço').is(':checked')){
       		$( "#dialog-cancelar" ).dialog( "open" );
       		$('#checkinModal').modal('hide');
       	}
	    
	});

	$( "#cancelarServiçout" ).on( "click", function() {
	    if($('#cancelarServiçout').is(':checked')){
       		$( "#dialog-cancelar" ).dialog( "open" );
       		$('#checkoutModal').modal('hide');
       	}
	    
	});


	$("#dialog-cancelar").dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		draggable: false,
		height: "auto",
		width: 350,
		buttons: {
	        "Sim": function() {
	        	if($('#cancelarServiçout').is(':checked')){
	          		$('#checkoutModal').modal('show');
	          		$( this ).dialog( "close" );
	        	}

	        	if($('#cancelarServiço').is(':checked')){
	          		$('#checkinModal').modal('show');
	          		$( this ).dialog( "close" );	
	        	}
	        		 
	        },
	        "Não": function() {
	          	
	          	if($('#cancelarServiçout').is(':checked')){
	          		$( this ).dialog( "close" );
	          		$('#checkoutModal').modal('show');
	          		$( '#cancelarServiçout' ).prop("checked", false);		
	        	}
				
				
	          	if($('#cancelarServiço').is(':checked')){
	          		$( this ).dialog( "close" );
	          		$('#checkinModal').modal('show');
	          		$( '#cancelarServiço' ).prop("checked", false);		
	        	}
			}
      	}
	});


	function aprovarServico(id_serv){
		var id_servico = id_serv.substring(13);

			if (!confirm("Deseja Aceitar esta solicitação?")) {
				return false;
			}	
			else{
					document.getElementById("form-pend").action= "../controller/Servico_Controller.php?metodo=alt_status_apv&id_servico="+id_servico;
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
				document.getElementById("form-pend").action= "../controller/Servico_Controller.php?metodo=alt_status_rep&id_servico="+id_servico+"&tipo_pessoa="+tipo_pessoa;
		 	 	document.getElementById("form-pend").method= "POST";
			 	document.getElementById("form-pend").submit(); // Form submission
	 			return true;
	 		}
	}

	function buscarDetalhes(id_serv, tipo_pessoa){
		var id_servico = id_serv.substring(13);
			
			document.getElementById("form-pend").action= "../controller/Servico_Controller.php?metodo=buscar&id_servico="+id_servico+"&tipo_pessoa="+tipo_pessoa;
	 	 	document.getElementById("form-pend").method= "POST";
		 	document.getElementById("form-pend").submit(); // Form submission
	}

</script>

</html>