<?php include ("../controller/login_control/logar_bd_empregadissimas.php")
?>

<?php include ("../controller/login_control/verifica_login_usuario.php") ?>

<?php $_SESSION['pessoa']['id_pessoa'];

/*parametro get*/
$id_prestador=$_GET["id_prestador"];

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

					<?php
						$var_id = $_SESSION['pessoa']['id_pessoa'];

						$consulta = "SELECT * FROM pessoa WHERE id_pessoa = $id_prestador";
						$con = $conn -> query($consulta) or die($conn-> error);
					?>

			  		<?php while ($dados_prestador= $con ->fetch_array() ){
			  		?>	 

						<div class="row align-items-center flex-row-reverse">
		                	<div class="col-lg-4">


		                        <div class="profile-text go-to">
		                            <h3 class="dark-color"><?php echo $dados_prestador["nome"]; ?></h3>
		                            <div class="row profile-list">
		                                <div class="col-lg-10">
		                                    <div class="media">
		                                        <b>Idade: &nbsp;</b>
											<?php
												$dataNascimento = $dados_prestador["data_nascimento"];;
												$date = new DateTime($dataNascimento);
												$interval = $date->diff( new DateTime( date('Y-m-d') ) );
											?>	                                        
	                                        <p><?php echo $interval->format( '%Y anos' ); ?></p>
		                                    </div>
		                                    <div class="media">
		                                        <b>Cidade: &nbsp;</b>
		                                        <p><?php echo $dados_prestador["cidade"]; ?></p>
		                                    </div>
		                                    <div class="media">
		                                        <b>E-mail: &nbsp;</b>
		                                        <p><?php echo $dados_prestador["email"]; ?></p>
		                                    </div>
		                                    <div class="media">
		                                    	<b>Sexo: &nbsp;</b>
												<?php
													if ($dados_prestador["sexo"] == 1) {
													    $sexo = 'Masculino';
													} elseif ($dados_prestador["sexo"] == 2) {
													    $sexo = 'Feminino';
													} else {
													    $sexo = 'Outros';
													}
												?>                                    	
		                                        <label><?php echo $sexo; ?></label>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>

	                   	    <!--foto do perfil-->
			                <div class="col-md-7" >
		                        <div class="profile-avatar" >
		                        	<div class="img-container">
										<?php
											if ($dados_prestador["foto"] != NULL) {
												$foto = $dados_prestador["foto"]; 
											} else {
											    $foto = 'profile.png';
											}
										?>
		                        		<img src="./imagens/<?php echo $foto; ?>" class="rounded img-thumbnail" title="avatar">
		                        	</div>
		                        </div>
		                    </div>
		                    <p>&nbsp;</p>
		                </div>	
					  	</br>
					<?php 
						  }

					?>  


					  	<h5> &nbsp; - Selecione no calendário abaixo o dia que deseja solicitar a diária, preencha os dados do cartão ao lado e envie sua solicitação</h5>
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

							<form id="form-ins-servico" name="form-ins-servico">
								<div class="row">
						    		<div class="col card" style="background:white">
						    			

										<p style="visibility: ;">	<b> 0 .Dia Selecionado:</b> 
										<input type="hidden" name="id_prestador" value="<?php echo $id_prestador; ?>">
										<input type="hidden" name="id_contratante" value="<?php echo $var_id; ?>"> 

											<span id="data_servico" data-calendar-label="picked"></span>
										</p>
										<div class="input-group mb-3">
										  	<div class="input-group-prepend">
										    	<label for="inputGroupSelect01">1. Selecione um <b>horário</b> disponível: &nbsp; </label>
										  	</div>
										  	<select class="custom-select" id="inputGroupSelect01">
										    	<option value="" selected>Escolha...</option>
										    	<option value="1">8:00 às 15:00</option>
										    	<option value="2">15:00 às 19:00</option>
										    	<option value="3">Dia Inteiro</option>
										  	</select>
										</div>

										<div class="input-group mb-3">
										  	<div class="input-group-prepend">
										    	<label for="id_diaria">2. Selecione o <b>tipo de Serviço</b>/Diária: &nbsp; </label>
										  	</div>
										  	<select class="custom-select" name="id_diaria">
										    	<option name="id_diaria" value="0" selected>Escolha...</option>
													<?php

														$consulta = "SELECT * FROM diaria_prestador WHERE id_pessoa = $id_prestador ORDER BY descricao_diaria";
														$con = $conn -> query($consulta) or die($conn-> error);
													?>

											  		<?php while ($diaria_prestador= $con ->fetch_array() ){
											  		?>	
					                                        <option name="id_diaria" value="<?php echo $diaria_prestador["id_diaria"]; ?>"><?php echo $diaria_prestador["descricao_diaria"]; ?> R$<?php echo $diaria_prestador["valor"]; ?></option>
						                            <?php
						                                  }
						                            ?>
										  	</select>
										</div>
										<div class="input-group mb-3">
										  	<div class="input-group-prepend">
										    	<label  for="id_endereco">3. Selecione o <b>Endereço</b> que ocorrerá o serviço: &nbsp; </label>
										  	</div>
										  	<select class="custom-select" id="id_endereco" name="id_endereco">
										    	<option selected>Escolha...</option>
													<?php
														$consulta = "SELECT * FROM endereco WHERE id_pessoa = $var_id ORDER BY bairro";
														$con = $conn -> query($consulta) or die($conn-> error);
													?>

											  		<?php while ($endereco_contr= $con ->fetch_array() ){
											  		?>	
														<option  name="id_endereco" value="<?php echo $endereco_contr["id_endereco"]; ?>"><?php echo $endereco_contr["bairro"];?> <?php echo $endereco_contr["rua"];?> - <?php echo $endereco_contr["numero"];  ?> </option>
						                            <?php
						                                  }
						                            ?>
										  	</select>
										</div>

								    	<label>4. Selecione a forma de pagamento: </label>
									    <div class="row">
										    <div class="col card">
												<div class="custom-control custom-radio">
												  <input type="radio" class="custom-control-input" id="forma_pagamento_dinheiro" name="forma_pagamento" value="1">
												  <label class="custom-control-label" for="forma_pagamento_dinheiro"><h4>Dinheiro</h4></label>
												</div>
										    	<p><img src="imagens/pay-day.png"></p>
									    	</div>
									    	 <div class="col card">
												<div class="custom-control custom-radio">
												  <input type="radio" class="custom-control-input" id="forma_pagamento_cartao" name="forma_pagamento" value="2"checked>
												  <label class="custom-control-label" for="forma_pagamento_cartao"><h4>Cartão de Crédito</h4></label>
												</div>	
										      	<p><img src="imagens/credit-card.png"></p>
										    </div>
									    	<div class="col card">
												<div class="custom-control custom-radio">
												  <input type="radio" class="custom-control-input" id="forma_pagamento_boleto" name="forma_pagamento" value="3">
												  <label class="custom-control-label" for="forma_pagamento_boleto"><h4>Boleto</h4></label>
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
							</form>
						</div>

	                </div>
    	        </div>
	        </div>   

	    </div>
	    <!-- --> 
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

	    $('[data-toggle="popover"]').popover({html: false
	    });

	});

	/* alerta Deseja enviar esta solicitação ao prestador? */
	$( "#envia-solicitacao" ).on( "click", function() {
    	$( "#caixa-enviar-solicitacao" ).dialog( "open" );
	});

	function getMonthFromString(mon){
	   return new Date(Date.parse(mon +" 01, 2012")).getMonth()+1
	}

	function solicitacao_enviada(){
		var data_inteira_van = document.getElementById("data_servico").innerHTML;

		var mes = getMonthFromString(data_inteira_van.substring(4, 7));
		var dia = data_inteira_van.substring(8, 10);
		var ano = data_inteira_van.substring(11, 15);

		var data_servico= ano+"/"+mes+"/"+dia;
		//alert(data_servico);

		if (!confirm("Deseja Enviar esta solicitação de serviço?")) {
			return false;
		}	
		else{
				  
		 document.getElementById("form-ins-servico").action= "../controller/Servico_Controller.php?metodo=inserir&data_servico="+data_servico;
	 	 document.getElementById("form-ins-servico").method= "POST";
		 document.getElementById("form-ins-servico").submit();// Form submission

		  return true;
		}
	}

	$('#exampleModalCenter').on('shown.bs.modal', function () {
  		$('#myInput').trigger('focus')
	});
</script>
</body>
</html>