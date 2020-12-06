<?php include ("../model/logar_bd_empregadissimas.php")
?>

<?php include "verifica_login.php"
?>
<!DOCTYPE html>
<html>
<head>
	<title> Solicitar Serviço | Empregadíssimas </title>
	<meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/solicitacao-css.css">
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="./js/jquery-ui.js"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- calendario -->
	<link rel="stylesheet" type="text/css" href="vanilla-calendar-master/src/vanillaCalendar.css">

</head>
<body class="rosa-bg" style="padding:0px">

<!--
	<nav style="margin-top: ">
	  <ul>
	    <li><a href=""> 1. Selecione os dias deseja solicitar </a></li>
	    <li><a href=""> 2. Selecione o Tipo de Serviço/Diária </a></li>
	    <li><a href=""> 3. Selecione o Endereço que ocorrerá o serviço </a></li>
	    <li><a href=""> 4. Selecione a forma de pagamento </a></li>
	  </ul>
	</nav>
-->

<div class="alert alert-success alert-dismissible fade show" id="envia-solicitacao-alert"  role="alert">
  <strong>Solicitação Enviada com Sucesso!</strong> Aguarde o retorno do prestador :)
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

	<div class="main" style="padding:5px 0; margin-top:5px">

		<h1 class="dark-color card-tit" id="center">
			Solicitar Agendamento de Diária  
			<!--Help da Aplicação -->
				<button type="button" class="btn bt-detalhes" data-toggle="popover" title=" Como Enviar Solicitação? " data-content="
																								               1. Selecione o <b>dia</b> que deseja solicitar a diária<br>
																											   2. Selecione um <b>horário</b> do dia selecionado <br>
																											   3. Selecione o <b>tipo</b> de Serviço/Diária <br>
																											   4. Selecione o <b>endereço</b> que ocorrerá o serviço <br>
																											   5. Selecione a <b>forma de pagamento</b> <br>
																											   6. Clique no botão 'Enviar Solicitação' "> 
																											  <i class="fa fa-question-circle"></i> Ajuda </button>
		</h1>		

		<div>
			<div class="card" style="margin-left: 10px">
				<div class="card-container">
					
					<!-- informações gerais do prestador -->
	                <div class="info-geral">
						<div class="row align-items-center flex-row-reverse">
		                	<div class="col-lg-4">

		                        <div class="profile-text go-to">
		                            <h3 class="dark-color">Rita Prestadora</h3>
		                            <div class="row profile-list">
		                                <div class="col-lg-10">
		                                    <div class="media">
		                                        <b>Idade: &nbsp;</b>
		                                        <p>38 Anos</p>
		                                    </div>
		                                    <div class="media">
		                                        <b>Cidade: &nbsp;</b>
		                                        <p>Maringá</p>
		                                    </div>
		                                    <div class="media">
		                                        <b>E-mail: &nbsp;</b>
		                                        <p>example@gmail.com</p>
		                                    </div>
		                                    <div class="media">
		                                        <b>Sexo: &nbsp;</b>
		                                        <p>Feminino</p>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>

	                   	    <!--foto do perfil-->
			                <div class="col-md-7" >
		                        <div class="profile-avatar" >
		                        	<div class="img-container">
		                        		<img src="./imagens/woman21.jpg" id="profile-img" title="Imagem de Perfil">
		                        	</div>
		                        </div>
		                    </div>
		                    <p>&nbsp;</p>
		                </div>	
					  	</br>



					  	<h5> Selecione no calendário abaixo o dia que deseja solicitar a diária, preencha os dados do cartão ao lado e envie sua solicitação</h5>
						<div class="agenda-prestador" id="calendar_u">
							<div id="v-cal" style="width: 46%;height: 50%; float: left; ">
								<div class="vcal-header" >
									<button class="vcal-btn" data-calendar-toggle="previous">
										<svg height="24" version="1.1" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
											<path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"></path>
										</svg>
									</button>
									<div class="vcal-header__label" data-calendar-label="month"> </div>
									<button class="vcal-btn" data-calendar-toggle="next">
										<svg height="24" version="1.1" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
											<path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
										</svg>
									</button>
								</div>
								<div class="vcal-week">
									<span>S</span>
									<span>T</span>
									<span>Q</span>
									<span>Q</span>
									<span>S</span>
									<span>S</span>
									<span>D</span>
								</div>
								<div class="vcal-body" data-calendar-area="month"></div>
							</div>
								<div class="row">
						    		<div class="col card" style="background:white">
						    		
										<p style="visibility: hidden;">	<b>Dia Selecionado:</b> <span data-calendar-label="picked"></span></p>
										<div class="input-group mb-3">
										  	<div class="input-group-prepend">
										    	<label for="inputGroupSelect01">1. Selecione um <b>horário</b> disponível: &nbsp; </label>
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
										    	<label for="inputGroupSelect02">2. Selecione o <b>tipo de Serviço</b>/Diária: &nbsp; </label>
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
										    	<label  for="inputGroupSelect03">3. Selecione o <b>Endereço</b> que ocorrerá o serviço: &nbsp; </label>
										  	</div>
										  	<select class="custom-select" id="inputGroupSelect03">
										    	<option selected>Escolha...</option>
										    	<option value="1">Rua Teste 476</option>
										    	<option value="2">Jardim das Flores 154</option>
										  	</select>
										</div>

								    	<label>4. Selecione a forma de pagamento: </label>
									    <div class="row">
										    <div class="col card">
												<div class="custom-control custom-radio">
												  <input type="radio" class="custom-control-input" id="defaultGroupExample3" name="groupOfDefaultRadios">
												  <label class="custom-control-label" for="defaultGroupExample3"><h4>Dinheiro</h4></label>
												</div>

										    	<p><img src="imagens/pay-day.png"></p>
									    	</div>
									    	 <div class="col card">
												<div class="custom-control custom-radio">
												  <input type="radio" class="custom-control-input" id="defaultGroupExample2" name="groupOfDefaultRadios" checked>
												  <label class="custom-control-label" for="defaultGroupExample2"><h4>Cartão de Crédito</h4></label>
												</div>	
										      	
										      	<p><img src="imagens/credit-card.png"></p>
										    </div>
									    	<div class="col card">
												<div class="custom-control custom-radio">
												  <input type="radio" class="custom-control-input" id="defaultGroupExample1" name="groupOfDefaultRadios">
												  <label class="custom-control-label" for="defaultGroupExample1"><h4>Boleto</h4></label>
												</div>

												<p><img src="imagens/clipart3157546.png"></p>
									    	</div>
										</div>

						    		</div>
						    	</div>
									
								<!-- enviar solicitação ou voltar para o perfil -->
								<p style="text-align: right; margin-top: 10px;">
									<button type="button" class="btn btn-lg bt-aprovar" name="envia-solicitacao" id="envia-solicitacao" onclick="solicitacao_enviada()"><i class="fa fa-check"></i> Enviar Solicitação </button>
									<a href="javascript:history.back()" <button type="button" class="btn btn-lg bt-gray"><i class="fa fa-arrow-left" ></i> Voltar ao Perfil </button></a>
								</p>
							</div>
						</div>

	                </div>
    	        </div>
	        </div>   

	    </div>
	    <!-- --> 
	</div>

	<div id="caixa-enviar-solicitacao" title="Alerta"> 	
		<p>Tem certeza que deseja <b>enviar</b> esta solicitação a este prestador? </p>
	</div>

<script src="vanilla-calendar-master/src/vanillaCalendar.js"></script>
<script type="text/javascript">

	jQuery(function ($) {
	$('.js-accordion-title').on('click', function () {
		 $(this).next().slideToggle(200);
		 $(this).toggleClass('open', 200);
		});
	});

	window.addEventListener('load', function () {
		vanillaCalendar.init({
			disablePastDays: true
		});
	});

	$(document).ready(function(){
		 $('#envia-solicitacao-alert').hide();

	    $('[data-toggle="popover"]').popover({html: true
	    });

	});

	/* alerta Deseja enviar esta solicitação ao prestador? */
	$( "#envia-solicitacao" ).on( "click", function() {
    	$( "#caixa-enviar-solicitacao" ).dialog( "open" );
	});


	function solicitacao_enviada(){
		$('#envia-solicitacao-alert').show()
	}

	$("#caixa-enviar-solicitacao").dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		draggable: false,
		height: "auto",
		width: 350,
		buttons: {
    	"Sim": function() {
      		$( this ).dialog( "close" );
    		},
    	Cancelar: function() {
      		$( this ).dialog( "close" );
    		}
		}
	});

	$('#exampleModalCenter').on('shown.bs.modal', function () {
  		$('#myInput').trigger('focus')
	});
</script>
</body>
</html>