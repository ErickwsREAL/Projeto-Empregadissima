<?php include ("../model/logar_bd_empregadissimas.php")
?>

<?php include "verifica_login.php"?>

<?php echo $_SESSION['pessoa']['id_pessoa'];


function getDadosPrestador($id_prestador) {
	include ("../model/logar_bd_empregadissimas.php");

    $sql = "SELECT nome, foto, tipo_pessoa FROM pessoa WHERE id_pessoa='$id_prestador'";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    $dados_prestador = array(
        'nome' => $row["nome"],
        'foto' => $row["foto"],
		'tipo_pessoa' => $row["tipo_pessoa"]
    );

    $conn->close();
    
    return $dados_prestador;
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="./css/solicitacao-css.css">
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
	      		<a class="nav-link" href="./sair.php" id="btn-sair" style="color:white;"> Sair </a>
	    	</div>
        </div>
    </nav>
    <!--fim navbar-->

    <div class="main">
		<div class="card-tit">
			<h2 id="titulo-pag"> Minhas Solicitações </h2>
		</div>

		<div class="lista-abas animacao-flip">
			<form name="form-pend" id="form-pend">
			<div id="tabs">
				<ul>
					<li><a href="#tabs-1"> Pendentes </a></li>
					<li><a href="#tabs-2"> Em Andamento </a></li>
					<li><a href="#tabs-3"> Finalizadas </a></li>
				</ul>

				<div id="tabs-1">
					
					<?php
						$var_id = $_SESSION['pessoa']['id_pessoa'];

						$consulta = "SELECT * FROM servico WHERE id_contratante = $var_id AND status_servico = 1 ";
						$con = $conn -> query($consulta) or die($conn-> error);

			  			while ($dados_servico= $con ->fetch_array() ){
						
							$id_prestador = $dados_servico["id_prestador"];

							$parametros = getDadosPrestador($id_prestador);

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
									<h3> <b> Solicitação de Serviço com <?php echo $valores['nome'] ?> </b></h3> 
									<p><b> Dia: </b> <?php echo $dados_servico["data_servico"]; ?> 	&nbsp;	 <b>Hora: </b> 
									</p> 
								</div>
							</div>
							<!-- -->

							<p class="center">
								<!--bootstrap buttons + classe-->
								<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-pend-<?php echo $dados_servico["id_servico"]; ?>" name="detalhe-pend" data-toggle="modal" data-target="#detalhes-pend-modal" onclick="buscarDetalhes(this.id)"> Detalhes </button>
								<button type="button" class="btn btn-lg bt-alterar"  id="alterar-pend"  name="alterar-pend" data-toggle="modal" data-target="#alterar-pend-modal" style="margin-right: 15px; font-weight: bold;"> Alterar </button>
								<button type="button" class="btn btn-lg bt-cancelar" id="cancelar-pend" name="cancelar-pend" style="margin-right: 15px; font-weight: bold;"> Cancelar </button>	
							</p>

						</div> 
					</div>

					<?php 
						}
					?>

				</div>
				<div id="tabs-2">

				<?php

					$consulta = "SELECT * FROM servico WHERE id_contratante = $var_id AND status_servico = 2 ";
					$con = $conn -> query($consulta) or die($conn-> error);
				?>

		  		<?php 

		  			while ($dados_servico= $con ->fetch_array() ){
					
						$id_prestador = $dados_servico["id_prestador"];

						$parametros = getDadosPrestador($id_prestador);

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
										<h3> <b> Você possui um serviço em andamento com <?php echo $valores['nome'] ?> </b></h3> 
										<p><b> Dia: </b> <?php echo $dados_servico["data_servico"]; ?> 	&nbsp;	 <b>Hora: </b> 

										</p> 
									</div>
								</div>
								<!-- -->

								<!--bootstrap buttons + classe-->
								<button type="button" class="btn btn-lg bt-detalhes btn-check" id="check-out" data-toggle="modal" data-target="#checkoutModal">Check-out</button>
								<button type="button" class="btn btn-lg bt-detalhes btn-check" id="check-in" data-toggle="modal" data-target="#checkinModal">Check-in</button>
								<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-pend-<?php echo $dados_servico["id_servico"]; ?>" name="detalhe-and" data-toggle="modal" data-target="#detalhes-pend-modal" onclick="buscarDetalhes(this.id) ">Detalhes</button>
							</p>
						</div>
					</div>
				</div>

					<?php 
						}
					?>

				<div id="tabs-3">


				<?php

					$consulta = "SELECT * FROM servico WHERE id_contratante = $var_id AND status_servico = 3 ";
					$con = $conn -> query($consulta) or die($conn-> error);

		  			while ($dados_servico= $con ->fetch_array() ){
					
						$id_prestador = $dados_servico["id_prestador"];

						$parametros = getDadosPrestador($id_prestador);

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
									<h3> <b> Serviço Finalizado com <?php echo $valores['nome'] ?> </b></h3> 
									<p><b> Dia: </b> <?php echo $dados_servico["data_servico"]; ?>
									</p> 
								</div>
							</div>
							<!-- -->

							<p>
								<!-- bootstrap buttons + classe -->
								<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-pend-<?php echo $dados_servico["id_servico"]; ?>" name="detalhes-fina" data-toggle="modal" data-target="#detalhes-pend-modal" onclick="buscarDetalhes(this.id)"> Detalhes </button>

								<!-- leva para pagina de avaliações -->
								<button type="button" class="btn btn-lg bt-avaliar" id="avaliar-and" name="avaliar-fina" data-toggle="modal" data-target="#modal-avaliar" style="margin-right: 15px; font-weight:bold;"> Avaliar </button>
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
							  <h5 class="modal-title">Avaliação do Prestador</h5>
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

		</form>
<!-- fim do form-pend -->
	</div>


	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detalhes-pend-modal" id="detalhes-pend-modal" aria-hidden="true">
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
	        	   <b> Hora: </b>   
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

	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="alterar-pend-modal" id="alterar-pend-modal" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	 
	     <div class="modal-content modal-color">
	
			<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle"> Alterar Solicitação com Rita Prestadora </h5>
		    
		    	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		    	    <span style="color: white" aria-hidden="true">&times;</span>
		        </button>
		    </div>

		    <form action="">
		     	<div class="modal-body">
		        	
		     		<div class="form-group row">
						<label for="data-solicitacao" class="col-2 col-form-label">Date</label>
					 	<div class="col-10">
					    	<input class="form-control" type="date" value="2020-11-22" id="data-solicitacao">
					  	</div>
					</div>

					<div class="input-group mb-3">
					  	<div class="input-group-prepend">
					    	<label for="inputGroupSelect01"> Horário disponível: &nbsp; </label>
					  	</div>
					  	<select class="custom-select" id="inputGroupSelect01">
					    	<option selected>Escolha...</option>
					    	<option value="1">8:00 às 15:00</option>
					    	<option value="2">15:00 às 19:00</option>
					    	<option value="3">Dia Inteiro</option>
					  	</select>
					</div>

					<div class="input-group mb-3">
					  	<div class="input-group-prepend">
					    	<label for="inputGroupSelect02"> Tipo de Serviço/Diária: &nbsp; </label>
					  	</div>
					  	<select class="custom-select" id="inputGroupSelect02">
					    	<option selected>Escolha...</option>
					    	<option value="1">Casa até 2 quartos 1 banheiro R$260,00</option>
					    	<option value="2">Casa maior 2 quartos R$300,00</option>
					    	<option value="3">Casa + Limpeza Interna armários/janelas R$500,00</option>
					  	</select>
					</div>
					<div class="input-group mb-3">
					  	<div class="input-group-prepend">
					    	<label  for="inputGroupSelect03"> Endereço que ocorrerá o serviço: &nbsp; </label>
					  	</div>
					  	<select class="custom-select" id="inputGroupSelect03">
					    	<option selected>Escolha...</option>
					    	<option value="1">Rua Teste 476</option>
					    	<option value="2">Jardim das Flores 154</option>
					  	</select>
					</div>

					<div class="input-group mb-3">
					  	<div class="input-group-prepend">
					    	<label  for="inputGroupSelect04"> Forma de Pagamento: &nbsp; </label>
					  	</div>
					  	<select class="custom-select" id="inputGroupSelect04">
					    	<option selected>Escolha...</option>
					    	<option value="1">Dinheiro</option>
					    	<option value="2">Cartão</option>
					    	<option value="3">Boleto</option>
					  	</select>
					</div>

		        	<p><b> Visite o perfil aqui: </b> <a href="./perfil-prestador-visao-contratante.html" target="_blank"> Visite o perfil do prestador/ solicitante </a> </p>

		        	<p style="text-align: center"><button type="submit" class="btn btSalvar" id="salvar-alt-pend">Salvar</button></p>
		      	</div>
	      	</form>
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

	<div id="dialog" title="Alerta">
	  <p> Deseja <b>Cancelar</b> a Solicitação 001 ? </p>
	</div>	

</body>

<div class="item footer">Copyright @EmpregadíssimaOwners</div>

<script >
	$( function() {
		$("#tabs").tabs();
	});

	function solicitacao_enviada(){
		$('#envia-solicitacao-alert').show()
	}

	$('#detalhes-pend-modal').on('shown.bs.modal', function () {
  		$('#myInput').trigger('focus')
	})	

	$( function() {
	    $( "#dialog" ).dialog({
	    	autoOpen: false,
	     	resizable: false,
	      	height: "auto",
	      	width: 400,
	      	modal: true,
	      	buttons: {
	        "Sim": function() {
	          $( this ).dialog( "close" );
	        },
	        Sair: function() {
	          $( this ).dialog( "close" );
	        }
	      }
	    });
	} );

    $( ".bt-cancelar" ).on( "click", function() {
	    $( "#dialog" ).dialog( "open" );
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

	function buscarDetalhes(id_serv){
		var id_servico = id_serv.substring(13);
			alert(id_servico);

			document.getElementById("form-pend").action= "../controller/Servico_Controller.php?metodo=buscar&id_servico="+id_servico;
	 	 	document.getElementById("form-pend").method= "POST";
		 	document.getElementById("form-pend").submit(); // Form submission
	}

</script>

</html>