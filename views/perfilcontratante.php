<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/csscontratante.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="./js/jquery-3.5.1.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/jquery-ui.js"></script>	
	<title>Perfil Contratante</title>
</head>
	<body class="rosa-bg">

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

		<div class="section profile-div" id="profile">
			<!-- informações do perfil-->
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-lg-6">
                        <div class="profile-text go-to">
                            <h3 class="dark-color">Julia Contratante</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tempus rutrum bibendum. Sed ornare vel arcu non varius. Sed mattis risus sit amet sagittis dignissim. Fusce turpis nisi, pharetra non consequat sed, maximus id augue. Aliquam a laoreet eros. </p>
                            <div class="row profile-list">
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>Idade</label>
                                        <p>49 Anos</p>
                                    </div>
                                    <div class="media">
                                        <label>Cidade</label>
                                        <p>Maringá</p>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>E-mail</label>
                                        <p>example@gmail.com</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--foto do perfil-->
                    <div class="col-lg-6">
                        <div class="profile-avatar" >
                        	<div class="img-container">
                        		<img src="./imagens/mulher.png	" class="rounded img-thumbnail" title="avatar">
                        	</div>
                        </div>
                    </div>
                </div>

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

			  		<button type="button" class="btn btn-lg btn-block btManter" data-toggle="modal" data-target="#editarModal" style="margin:0px;margin-top: 50px;margin-right:0px;"><i class="fa fa-cog"></i>&nbsp; Editar Perfil &nbsp;</button>
			  		<button type="button" class="btn btn-lg btn-block btManter" data-toggle="modal" data-target="#enderecoModal" style="margin:0px;margin-top: 50px;margin-right:0px;"><i class="fa fa-key fa-fw	"></i>&nbsp; Meus Endereços &nbsp;</button>
			  		<button type="button" class="btn btn-lg btn-block btManter" id="desativarConta" style="margin:0px;margin-top: 50px;margin-right:0px;"><i class="fa fa-trash-o"></i>&nbsp; Desativar Conta &nbsp;</button>
			  	</div>

			</div>
			<!--fim manutenções -->
        	<!--modal editar perfil -->
        	<div class="modal fade modal-lg" id="editarModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg">
			    	<div class="modal-content">
			      	<div class="modal-header">
			        	<h5 class="modal-title" id="editarModalTitle">Editar Perfil</h5>
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          	<span aria-hidden="true">&times;</span>
			        	</button>
			      	</div>
			      	<div class="modal-body" id="editarBody">
			      		<form>
			      			<div class="form-group">
								<label for="editarDescricao">Descrição:</label>		
								<textarea class="form-control" id="editarDescricao" rows="3" name="nome" id="editarDescricao"></textarea>
							</div>
			      			<div class="form-group labelPeq">
								<label for="editarNome">Nome:</label>		
								<input class="form-control form-control-sm" type="text" name="nome" id="editarNome">
							</div>
			      			<div class="form-group labelPeq">
								<label for="editarTelefone">Telefone:</label>		
								<input class="form-control form-control-sm" type="tel" name="telefone" id="editarTelefone">
							</div>
			      			<button type="submit" class="btn btn-primary buttonEditar" id="buttonEditarPerfil" value="Enviar"> Salvar Edição </button>
			      		</form>
			      	</div>
			    	</div>
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
			      		<div id="editarEndereço">
				      		<div class="col-md-10">
						      <label for="endereçosUsuário">Endereços: </label>
						      <select id="endereçosUsuário" class="form-control">
						      	<option selected>Jardim Sumaré, Rua Pioneiro Genir Galli, 313, CEP: 87035-602</option>
						      	<option>...</option>
						      </select>
					    	</div>	
					      	<button type="button" class="btn btn-dprimary buttonEditar butf" id="buttonEditarEnd"> Editar Selecionado</button>
					      	<button type="button" class="btn btn-danger butf" id="buttonExcluirEnd"> Excluir Selecionado</button>
				      	</div>
				      	<div id="editarEnd3">	
				      			<p> Editar Endereço Selecionado:</p>
				      			<form>
									<div class="form-row">
	    								<div class="col-md-4">
	      									<input type="text" class="form-control" placeholder="Bairro" id="bairroUsuárioED" name="bairro">
	    								</div>
	    								<div class="col-md-4">
	      									<input type="text" class="form-control" placeholder="Rua" id="ruaUsuárioED" name="rua">
	    								</div>
	  									<div class="col-md-2">
	  										<input type="number" class="form-control" placeholder="Numero" id="numeroUsuárioED" name="numero">
	  									</div>
	  								</div>
	  								<div class="form-row">
	  									<div class="col-md-4">
	  										<input type="text" class="form-control" name="complemento" id="complementoUsuárioED" placeholder="Complemento">
	  									</div>
	  									<div class="col-md-2">
	  										<input type="number" class="form-control" name="CEP" placeholder="CEP" id="cepUsuárioED">
	  									</div>
	  								</div>
	  								<button type="submit" class="btn btn-primary buttonEditar butf" id="buttonED" value="Enviar">Salvar</button>
	  								<button type="button" class="btn btn-primary buttonEditar butf" id="buttonCan">Cancelar</button>
								</form>
							</div>
						<div id="adicionarEndereço">	
							<p>Adicionar um endereço:</p>
					      	<form>
								<div class="form-row">
    								<div class="col-md-4">
      									<input type="text" class="form-control arruma" placeholder="Bairro" id="bairroUsuário" name="bairro">
    								</div>
    								<div class="col-md-4">
      									<input type="text" class="form-control arruma" placeholder="Rua" id="ruaUsuário" name="rua">
    								</div>
  									<div class="col-md-2">
  										<input type="number" class="form-control arruma" placeholder="Numero" id="numeroUsuário" name="numero">
  									</div>
  								</div>
  								<div class="form-row">
  									<div class="col-md-4">
  										<input type="text" class="form-control" name="complemento" id="complementoUsuário" placeholder="Complemento">
  									</div>
  									<div class="col-md-2">
  										<input type="number" class="form-control" name="CEP" placeholder="CEP" id="cepUsuário">
  									</div>
  								</div>
  								<button type="submit" class="btn btn-primary buttonEditar" id="buttonAdd" value="Enviar">Salvar</button>
							</form>
						</div>
					</div>
					</div>
				</div>
			</div>					

        </div>
        <!--fim div seção-->

	   	<div class="item footer">Footer</div>
		</div>
		<div id="caixa" title="Alerta"> 	
			<p>Tem certeza que deseja desativar sua conta? A reativação só é possível após contato com o Administrador</p>
		</div>
		<div id="caixa2" title="Alerta"> 	
			<p>Tem certeza que deseja excluir esse endereço?</p>
		</div>
	</body>

	<!--jquery -->
	<script>	
		$(document).ready(function(){ 
			$("#new-service").hide();

			$("#add-service").click(function(){
			$("#new-service").toggle("slow");
			});
		});

		function abreAdicionarSolicitação() {
			window.open("enviar-solicitacao.html","_blank");
		}

		$('#buttonEditarEnd').on('click', function(){
			$('#editarEnd3').show();
			$('#editarEndereço').hide();	
		});

		$('#buttonCan').on('click', function(){
			$('#editarEnd3').hide();
			$('#editarEndereço').show();	
		});

		$( "#desativarConta" ).on( "click", function() {
		    $( "#caixa" ).dialog( "open" );
		});

		$( "#buttonExcluirEnd" ).on( "click", function() {
		    $( "#enderecoModal" ).modal('hide');
		});

		$( "#buttonExcluirEnd" ).on( "click", function() {
		    $( "#caixa2" ).dialog( "open" );
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
	          	$( this ).dialog( "close" );
	        	},
	        	Cancelar: function() {
	          	$( this ).dialog( "close" );
	        	}
      		}
		});

		$("#caixa2").dialog({
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
	          	 $( "#enderecoModal" ).modal('show');
	          	 $( this ).dialog( "close" );
	        	}
      		}
		});
	</script>
</html>