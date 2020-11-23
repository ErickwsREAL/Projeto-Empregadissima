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
        <a class="navbar-brand" href="#">Empregadíssimas</a>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
	        <li class="nav-item active">
				<a class="nav-link" href="#">Inicio </a>
	        </li>
	        <li class="nav-item active">
	            <a class="nav-link" href="#">Busca </a>
	        </li>
          </ul>
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

					<div class="card">
						<div class="card-container">

							<!-- -->
							<div class="grid-container">
								<div class="grid-item">
		                        	<div class="img-container">
		                        		<img src="./imagens/woman21.jpg" id="profile-img" title="Imagem de Perfil">
		                        	</div>
								</div>

								<div class="grid-item">
									<h3> <b> Solicitação de Serviço de Rita Prestadora </b></h3> 
									<p><b> Dia: </b> 25/12/2020 	&nbsp;	 <b>Hora: </b> 8:00 às 15:00
									</p> 
								</div>
							</div>
							<!-- -->

							<p class="center">
								<!--bootstrap buttons + classe-->
								<button type="button" class="btn btn-lg bt-aprovar" id="aprovar-pend" name="aprovar-pend">Aceitar</button>
								<button type="button" class="btn btn-lg bt-reprovar" id="reprovar-pend" name="reprovar-pend">Rejeitar</button>
								<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-pend" name="detalhe-pend" data-toggle="modal" data-target="#exampleModalCenter">Detalhes</button>
							</p>
						</div>
					</div>

					<div class="card">
						<div class="card-container">
							
							<!-- -->
							<div class="grid-container">
								<div class="grid-item">
		                        	<div class="img-container">
		                        		<img src="./imagens/woman21.jpg" id="profile-img" title="Imagem de Perfil">
		                        	</div>
								</div>

								<div class="grid-item">
									<h3> <b> Solicitação de Serviço de Rita Prestadora </b></h3> 
									<p><b> Dia: </b> 25/12/2020 	&nbsp;	 <b>Hora: </b> 8:00 às 15:00
									</p> 
								</div>
							</div>
							<!-- -->

							<p class="center">
								<!--bootstrap buttons + classe-->
								<button type="button" class="btn btn-lg bt-aprovar"> Aceitar </button>
								<button type="button" class="btn btn-lg bt-reprovar"> Rejeitar </button>
								<button type="button" class="btn btn-lg bt-detalhes" data-toggle="modal" data-target="#exampleModalCenter"> Detalhes </button>
							</p>
						</div>
					</div>

				</div>
				<div id="tabs-2">
					<div class="card">
						<div class="card-container">

								<!-- -->
								<div class="grid-container">
									<div class="grid-item">
			                        	<div class="img-container">
			                        		<img src="./imagens/woman21.jpg" id="profile-img" title="Imagem de Perfil">
			                        	</div>
									</div>

									<div class="grid-item">
										<h3> <b>Você possui um serviço em andamento com Rita Prestadora</b></h3> 
										<p><b> Dia: </b> 25/12/2020 	&nbsp;	 <b>Hora: </b> 8:00 às 15:00
										</p> 
									</div>
								</div>
								<!-- -->

								<!--bootstrap buttons + classe-->
								<button type="button" class="btn btn-lg bt-detalhes btn-check" id="check-out" data-toggle="modal" data-target="#checkoutModal">Check-out</button>
								<button type="button" class="btn btn-lg bt-detalhes btn-check" id="check-in" data-toggle="modal" data-target="#checkinModal">Check-in</button>
								<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-and" name="detalhe-and" data-toggle="modal" data-target="#exampleModalCenter">Detalhes</button>
							</p>
						</div>
					</div>
				</div>
				<div id="tabs-3">
					<div class="card">
						<div class="card-container">

							<!-- -->
							<div class="grid-container">
								<div class="grid-item">
		                        	<div class="img-container">
		                        		<img src="./imagens/woman21.jpg" id="profile-img" title="Imagem de Perfil">
		                        	</div>
								</div>

								<div class="grid-item">
									<h3> <b> Serviço Finalizado com Rita Prestadora </b></h3> 
									<p><b> Dia: </b> 25/12/2020		&nbsp;	 <b>Hora: </b> 8:00 às 15:00
									</p> 
								</div>
							</div>
							<!-- -->

							<p>
								<!-- bootstrap buttons + classe -->
								<button type="button" class="btn btn-lg bt-detalhes" id="detalhes-and" name="detalhes-fina" data-toggle="modal" data-target="#exampleModalCenter" > Detalhes </button>

								<!-- leva para pagina de avaliações -->
								<button type="button" class="btn btn-lg bt-avaliar" id="avaliar-and" name="avaliar-fina" style="margin-right: 15px; font-weight: bold;"> Avaliar </button>
							</p>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" id="exampleModalCenter" aria-hidden="true">
  <div class="modal-dialog modal-lg">
 
     <div class="modal-content">
 
		<div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle"> Detalhes da Solicitação </h5>
	    
	    	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	    	    <span aria-hidden="true">&times;</span>
	        </button>
	    </div>

     	<div class="modal-body">
        	<p><b> Data: </b>   25/12/2020   &nbsp; 
        	   <b> Hora: </b>   8:00 às 15:00
        	</p>
        	<p><b> Tipo de Serviço: </b> Casa até 2 quartos 1 banheiro</p>
        	<p><b> Valor a ser pago:</b> 260,00 </p>
        	<p><b> Endereço que ocorrerá o serviço: </b> Rua Teste 476 </p>
        	<p><b> Forma de Pagamento: </b> Dinheiro </p>
        	<!--informação apenas do prestador-->
        	<p><b> Avaliação do solicitante: </b>   <span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span> </p>

        	<!--informação apenas do solicitante-->
        	<p><b> Avaliação do prestador: </b></p>
        	<p><b> Visite o perfil aqui: </b> <a href=""> Visite o perfil do prestador/ solicitante </a> </p>
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

<div class="item footer">Footer</div>

<script>

	$( function() {
		$("#tabs").tabs();
	});

	function solicitacao_enviada(){
		$('#envia-solicitacao-alert').show()
	};

	$('#exampleModalCenter').on('shown.bs.modal', function () {
  		$('#myInput').trigger('focus')
	});


</script>

</html>