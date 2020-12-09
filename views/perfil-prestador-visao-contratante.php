<?php include ("../model/logar_bd_empregadissimas.php")
?>

<?php include "verifica_login.php"?>

<?php echo $_SESSION['pessoa']['id_pessoa']?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/cssperfil.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="./js/jquery-3.5.1.min.js"></script>
	<title>Perfil Prestador</title>
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
	      		<a class="nav-link" href="./index.php" id="btn-sair" style="color:white;"> Sair </a>
	    	</div>
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
                                    <div class="media">
                                        <label>Sexo</label>
                                        <p>Feminino</p>
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

						<?php
							$consulta = "SELECT descricao_diaria, valor, id_diaria FROM diaria_prestador WHERE id_pessoa = 1";
							$con = $conn -> query($consulta) or die($conn-> error);
						?>

						<div class="card-container">
					    	<h4><b>Serviços</b></h4>
					    	<p>Lista de Serviços Oferecidos</p>
							<ul class="list-group">

						  		<?php 
					  				while ($dados_diaria = $con ->fetch_array() ){
						  		?>
							  	<li class="list-group-item">
							  		<p class="man-desc"> <?php echo $dados_diaria["descricao_diaria"]; ?> </p>
							  		<div style="float: right;">
										<h6 class="count h2"><?php echo $dados_diaria["valor"]; ?></h6>
                                		<p class="m-0px font-w-600">Preço</p>
                                		<!-- botão visivel apenas para prestadores 
										<p>
	                                		<button type="button" class="btn btn-danger btn-sm spc"><i class="fa fa-trash"></i> Excluir </button>
	                            			<button type="button" class="btn btn-sm bt-avaliar bt-editar" id="bt-editar" name="bt-editar"><i class="fa fa-edit"></i> Editar </button>
	                            		</p>-->
									</div>
							  	</li>

								<?php 
									}

								?> 
							</ul>
							<!-- botão visivel apenas para prestadores -->
							<!--<p><button type="button" class="btn btn-lg btManter" id="add-service"><i class="fa fa-plus"></i> Adicionar</button></p> -->
					  	</div>

						<div class="list-group-item" id="new-service">
							<form id="form">							
								<p>Descreva o serviço:</p>
									<textarea class="form-control" id="desc_servico" name="desc_servico" style="margin-top:10px"></textarea>
								<p>Preço:</p>
									<input type="number" class="form-control" id="preco_servico" name="preco_servico"> 
					  		</form>e
					  		<p style="text-align: center;margin-top: 5px">
					  			<button type="submit" class="btn btSalvar" id="salvar-service">Salvar</button>
					  			<button type="submit" class="btn btFechar" id="fechar-service">Cancelar</button>
					  		</p>
					  	</div>

					</div>		  	
			  	</div>

			  	<!--menu de outras manutenções-->
			  	<div class="col-5">
			  		
			  		<!--<button type="button" class="btn btn-lg btn-block btManter" style=" margin:0px;margin-top: 50px;margin-right:0px;"><i class="fa fa-calendar"></i>&nbsp; Agenda &nbsp;</button>-->
			  		<button type="button" class="btn btn-lg btn-block btManter" style="margin:0px;margin-top: 50px;margin-right:0px;" onclick="abreAdicionarSolicitação()"><i class="fa fa-envelope"></i>&nbsp; Solicitar Serviço &nbsp;</button>
			  		
			  	</div>

			</div>
			<!--fim manutenções -->
        </div>
        <!--fim div seção-->

	   	<div class="item footer">Copyright @EmpregadíssimaOwners</div>
		</div>
	</body>

	<!--jquery -->
	<script>
		$(document).ready(function(){ 
			$("#new-service").hide();

			/*botão adicionar*/
			$("#add-service").click(function(){
				$("#new-service").show("slow");
			});

			/*botão fechar*/
			$("#fechar-service").click(function(){
				$("#new-service").hide("slow");
			});

			/*botão editar: abre new service com as informações*/
			$(".bt-editar").click(function(){
				$("#new-service").show("slow");
			});

		});

		/*abre pagina enviar solicitação*/
		function abreAdicionarSolicitação() {
			window.open("enviar-solicitacao.html","_self");
		}

	</script>
</html>