<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/cssperfil.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="./js/jquery-3.5.1.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>	
	<title>Perfil Prestador</title>
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
                            <h3 class="dark-color">Rita Prestadora</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In tempus rutrum bibendum. Sed ornare vel arcu non varius. Sed mattis risus sit amet sagittis dignissim. Fusce turpis nisi, pharetra non consequat sed, maximus id augue. Aliquam a laoreet eros. </p>
                            <div class="row profile-list">
                                <div class="col-md-6">
                                    <div class="media">
                                        <label>Idade</label>
                                        <p>38 Anos</p>
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
                        		<img src="./imagens/woman21.jpg" class="rounded img-thumbnail" title="avatar">
                        	</div>
                        </div>
                    </div>
                </div>

                <!--div com cliente, qte avaliações e star rating -->
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
						<div class="card-container">
					    	<h4><b>Serviços</b></h4>
					    	<p>Lista de Serviços Oferecidos</p>
							<ul class="list-group">
							  	<li class="list-group-item">
							  		<p class="man-desc">Casa até 2 quartos 1 banheiro</p>
							  		<div style="float: right;">
										<h6 class="count h2">260,00</h6>
                                		<p class="m-0px font-w-600">Preço</p>
									</div>
							  	</li>

							  	<li class="list-group-item">
							  		<p class="man-desc">Casa maior 2 quartos </p>
							  		<div style="float: right;">
										<h6 class="count h2">300,00</h6>
                                		<p class="m-0px font-w-600">Preço</p>
									</div>
							  	</li>

							  	<li class="list-group-item">
							  		<p class="man-desc">Limpeza Interna armários/janelas</p>
							  		<div style="float: right;">
										<h6 class="count h2">500,00</h6>
                                		<p class="m-0px font-w-600">Preço</p>
									</div>
							  	</li>
							</ul>
							<p><button type="button" class="btn btn-lg btManter" id="add-service"><i class="fa fa-plus"></i> Adicionar</button></p>
					  	</div>

						<div class="list-group-item" id="new-service">
							<form id="form">							
								<p>Descreva o serviço:</p>
									<textarea class="form-control" id="desc_servico" name="desc_servico" style="margin-top:10px"></textarea>
								<p>Preço:</p>
									<input type="number" class="form-control" id="preco_servico" name="preco_servico"> 
					  		</form>
					  		<p style="text-align: center;margin-top: 5px">
					  			<button type="submit" class="btn btSalvar">Salvar</button>
					  			<button type="submit" class="btn btFechar">Fechar</button>
					  		</p>
					  	</div>

					</div>		  	
			  	</div>

			  	<!--menu de outras manutenções-->
			  	<div class="col-5">
			  		
			  		<button type="button" class="btn btn-lg btn-block btManter" style="margin:0px;margin-top: 50px;margin-right:0px;"><i class="fa fa-calendar"></i>&nbsp; Agenda &nbsp;</button>
			  		<button type="button" class="btn btn-lg btn-block btManter" style="margin:0px;margin-top: 50px;margin-right:0px;" onclick="abreAdicionarSolicitação()"><i class="fa fa-envelope"></i>&nbsp; Solicitar Serviço &nbsp;</button>
			  		<button type="button" class="btn btn-lg btn-block btManter" data-toggle="modal" data-target="#editarModal" style="margin:0px;margin-top: 50px;margin-right:0px;"><i class="fa fa-cog"></i>&nbsp; Editar Perfil &nbsp;</button>
			  		<button type="button" class="btn btn-lg btn-block btManter" data-toggle="modal" data-target="#enderecoModal" style="margin:0px;margin-top: 50px;margin-right:0px;"><i class="fa fa-cog"></i>&nbsp; Editar Endereço &nbsp;</button>
			  	</div>

			</div>
			<!--fim manutenções -->
        	<!--modal editar perfil -->
        	<div class="modal fade modal-lg" id="editarModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg">
			    	<div class="modal-content">
			      	<div class="modal-header">
			        	<h5 class="modal-title" id="editarModalTitle">Editar</h5>
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          	<span aria-hidden="true">&times;</span>
			        	</button>
			      	</div>
			      	<div class="modal-body" id="editarBody">
			      		<form>
			      			<div class="form-group">
								<label for="editarDescricao">Descrição:</label>		
								<input class="form-control form-control-sm" type="textarea" name="descricao" id="editarDescricao" required>
							</div>
			      			<div class="form-group">
								<label for="editarNome">Senha:</label>		
								<input class="form-control form-control-sm" type="text" name="nome" id="editarNome" required>
							</div>
							<div class="form-group">
								<label for="editarBairro">Endereço:</label>
								<input type="text" name="">
							</div>	
			      			<button type="submit" class="btn btn-primary" id="buttonLogin" value="Enviar"> Entrar </button>
			      		</form>
			      	</div>
			    	</div>
			  	</div>
			</div>	
			<!--fim modal crud endereço -->
			<div class="modal fade modal-lg" id="enderecoModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg">
			    	<div class="modal-content">
			      	<div class="modal-header">
			        	<h5 class="modal-title" id="editarModalTitle">Editar</h5>
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          	<span aria-hidden="true">&times;</span>
			        	</button>
			      	</div>
			      	<div class="modal-body" id="editarBody">
			      		<form>
			      			<div class="form-group">
								<label for="editarDescricao">Descrição:</label>		
								<input class="form-control form-control-sm" type="textarea" name="descricao" id="editarDescricao" required>
							</div>
			      			<div class="form-group">
								<label for="editarNome">Senha:</label>		
								<input class="form-control form-control-sm" type="text" name="nome" id="editarNome" required>
							</div>
							<div class="form-group">
								<label for="editarBairro">Endereço:</label>
								<input type="text" name="">
							</div>	
			      			<button type="submit" class="btn btn-primary" id="buttonLogin" value="Enviar"> Entrar </button>
			      		</form>
			      	</div>
			    	</div>
			  	</div>
			</div>	

        </div>
        <!--fim div seção-->

	   	<div class="item footer">Footer</div>
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
	</script>
</html>