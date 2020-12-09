<?php include ("../model/logar_bd_empregadissimas.php")
?>

<?php include "verifica_login_adm.php"
?>

<?php $_SESSION['administrador']['id_adm']
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="./css/solicitacao-css.css">
	<link rel="stylesheet" type="text/css" href="./css/aprovarCadastros.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="./js/jquery-3.5.1.min.js"></script>
	<script src="./js/jquery-ui.js"></script>

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>

	<title>Cadastros Pendentes - Administador</title>
</head>
<body>
	
	<!--main-->
    <div class="main">
    	<div id="div" name="div">

			<?php
				$var_id = $_SESSION['administrador']['id_adm'];

				$consulta = "SELECT * FROM administrador WHERE id_adm = $var_id";
				$con = $conn -> query($consulta) or die($conn-> error);
			?>

	  		<?php while ($dados_adm= $con ->fetch_array() ){

	  		?>
			<div class="info-adm" style="">
			    <h4>Sessão:&nbsp; <?php echo $dados_adm["sessao"]; ?> &nbsp;&nbsp;&nbsp; <a class="nav-link" href="sair.php" id="btn-sair" style="color:black;font-size:1em;"> Sair </a></h4>
			</div>
	  		<?php 
		  	}	
	  		?>

			<div class="lista-abas animacao-flip">
				<div id="tabs">    	
				    <!--table-->
				    <ul>
						<li><a href="#tabs-1"> Pendentes </a></li>
						<li><a href="#tabs-2"> Exclusão de Contas </a></li>
						<li><a href="#tabs-3"> Relatório </a></li>
					</ul>

					<!-- formulário lista de serviços -->
					<form name="form-lista-cad-apv" id="form-lista-cad-apv">
						<!--action="../controller/Usuario_Controller.php?metodo=aprovar_cadastro"-->
						<!-- Aba cadastros pendentes-->
						<div id="tabs-1">
		    				<div class="cadast-pend">
				    		    <h2>Cadastros Pendentes</h2>
				    		</div>

								<table id="tab_aprovar">
									<tr>
										<th>
											<!-- bootstrap check-box + classe checkMargin-->
											<div class="form-check checkMargin">
												<input class="form-check-input" type="checkbox" value="" id="aprovar-cadastros-checkAll">
												<label class="form-check-label" for="aprovar-cadastros-checkAll"> </label>
											</div>
										</th>
										<th>Codigo do Cadastro</th>
										<th>Nome</th> 
										<th>CPF</th>
										<th>Documento Anexado</th>
										<th>Data Registro</th>
									</tr>

									<?php
										/*Seleciona todos cadatros com status 1 -> que são cadastros que ainda NÃO FORAM APROVADOS */
										$consulta = "SELECT * FROM pessoa where status_cadastro = '1'"; 
										$con = $conn -> query($consulta) or die($conn-> error);
									?>

							  		<?php while ($dados_pessoa = $con ->fetch_array() ){
							  		?>
									<tr>
										<td>
											<!-- bootstrap check-box + classe checkMargin-->
											<div class="form-check checkMargin">
												<input class="form-check-input aprovar-cadastros-check check_apv" type="checkbox" 
													   value="<?php echo $dados_pessoa["id_pessoa"];?>" name="checkbox-apv-cdtros[]"
									 				   id="apr-cad-check-<?php echo $dados_pessoa["id_pessoa"]; ?>">
												<label class="form-check-label aprovar-cadastros-check" for="apr-cad-check1"> </label>
											</div>
										</td>
									    <td> <?php echo $dados_pessoa["id_pessoa"]; ?> </td>
									    <td> <?php echo $dados_pessoa["nome"]; ?> </td>
									    <td> <?php echo $dados_pessoa["cpf"]; ?> </td>
									    <td> <a href="./imagens/<?php echo $dados_pessoa["comprovante"]; ?>" target="_blank"><i class="fa fa-file pointer" data-toggle="modal" data-target="#exampleModalCenter"></i></td></a>
									    <td><?php echo $dados_pessoa["data_nascimento"]; ?></td>
								 	</tr>		 	

									<?php
								   	    }
									?> 

								</table>
						    	<!-- fim table-->

					    	<!-- fim form-lista-cad-apv -->
							<div class="buttons-classe">
								<p>

									<button type="button" class="btn btn-lg bt-aprovar" id="bt-aprovar" name="bt-aprovar" onclick="aprovarCadastrosF();">Aprovar</button>								
									<!--bootstrap buttons + id
									<button type="button" class="btn btn-lg bt-aprovar" id="bt-aprovar" name="bt-aprovar" onclick="aprovarCadastrosF();">Aprovar</button>-->

									<button type="button" class="btn btn-lg bt-reprovar" id="bt-reprovar" onclick="reprovarCadastrosF();">Reprovar</button>
								</p>
							</div>
						</div>

					</form>						
				    <!-- fim aba Cadastros Pendentes-->

						<!-- aba 2 - Exclusao de Conta -->
						<form method="POST" action="../controller/Usuario_Controller.php?metodo=excluir_cadastro">
							<div id="tabs-2">
								<div class="cadast-pend">
				    		    	<h2>Excluir Contas</h2>
				    			</div>
						   	
						    	
									
									<table id="tabledata">
										<tr>
											<th>
												<!-- bootstrap check-box + classe checkMargin-->
												<div class="form-check checkMargin">
													<input class="form-check-input" type="checkbox" value="" id="checkAll2">
													<label class="form-check-label" for="checkAll2"> </label>
												</div>
											</th>
											<th>Codigo do Cadastro</th>
											<th>Nome</th> 
											<th>CPF</th>								
										</tr>
										
										<?php
										 	$stmt = $conn->prepare("SELECT * FROM pessoa WHERE status_cadastro = '2'");
										 	$stmt->execute();
										 	$result = $stmt->get_result();	

										?>
										<?php while($row = $result->fetch_array()){ ?>
										<tr>
											<td>
												<!-- bootstrap check-box + classe checkMargin-->
												<div class="form-check checkMargin">
													<input class="form-check-input check" name="checagem[]" type="checkbox" value="<?php echo $row['id_pessoa'] ?>" id="defaultCheck4">
													<label class="form-check-label" for="defaultCheck4"> </label>
												</div>	
											</td>
										    <td><?php echo $row['id_pessoa'] ?></td>
										    <td><?php echo $row['nome'] ?></td>
										    <td><?php echo $row['cpf'] ?></td>							    
									 	</tr>		 	
										<?php } ?>
									</table>
							    	<!-- fim table-->
							    			
									<div class="buttons-classe">
										<p>
											<!--bootstrap buttons + id-->
											<button type="submit" name="submit" class="btn btn-lg" id="bt-excluir">Excluir</button>
										</p>
									</div>
								</div>	
							</form>			
							

						
						<!--fim aba Exclusao de Conta -->

						<!-- aba 3 - Relatorio -->
						<div id="tabs-3">
							<p style="display: inline-block">Tipo de relatório:</p>
							<input type="radio" id="opt-service" name="report-opt" value="null">
							<label for="opt-service">Relatório de serviços</label>&nbsp;
							<input type="radio" id="opt-person" name="report-opt" value="null">
							<label for="opt-person">Relatório de usuários</label>
							<div id="list-tabs" class="lista-abas animacao-flip">
								<div class="range-filter">									
									Contratante: <input type="text" id="contrante" class="my-form-control">
									Prestador: <input style="margin-bottom: 0.5%;" type="text" id="prestador" class="my-form-control">&emsp;&emsp;
									De: <input id="inicio-data" class="my-date-form" type="date"></input>&nbsp;
									Para: <input style="margin-bottom: 0.5%;" id="fim-data" class="my-date-form" type="date"></input>
									<button id="reset-button" class="cancel-button btn-sm btn-danger">Resetar</button>
									<button id="apply-button" class="apply-button btn-sm btn-danger">Aplicar</button>
								</div>
								<div id="report-tabs">
									<ul>
										<li><a href="#tabs-4"> Pendentes </a></li>
										<li><a href="#tabs-5"> Em Andamento </a></li>
										<li><a href="#tabs-6"> Finalizadas </a></li>
										<li><a href="#tabs-7"> Gráficos </a></li>
									</ul>
									<div id="tabs-4">

										<div class="card-report">
											<div class="card-container">

												<!-- -->
												<div class="grid-container">
													<div class="grid-item">
														<div class="img-container">
															<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
														</div>
													</div>

													<div class="grid-item">
														<h3> <b> Solicitação de Serviço de Julia Contratante para Roberta Dias</b></h3> 
														<p><b> Dia: </b> 25/12/2020 	&nbsp;	 <b>Hora: </b> 8:00 às 15:00
														</p> 
													</div>

													<div class="grid-item">
														<div class="img-container">
															<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
														</div>
													</div>
												</div>
												<!-- -->

												<p class="center">
													<!--bootstrap buttons + classe-->
													<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-pend" name="detalhe-pend" data-toggle="modal" data-target="#exampleModalCenter">Detalhes</button>
												</p>
											</div>
										</div>

										<div class="card-report">
											<div class="card-container">
												
												<!-- -->
												<div class="grid-container">
													<div class="grid-item">
														<div class="img-container">
															<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
														</div>
													</div>

													<div class="grid-item">
														<h3> <b> Solicitação de Serviço de Paolla Campos para Eduarda Oliveira </b></h3> 
														<p><b> Dia: </b> 29/12/2020 	&nbsp;	 <b>Hora: </b> 8:00 às 15:00
														</p> 
													</div>

													<div class="grid-item">
														<div class="img-container">
															<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
														</div>
													</div>
												</div>
												<!-- -->

												<p class="center">
													<!--bootstrap buttons + classe-->
													<button type="button" class="btn btn-lg bt-detalhes" data-toggle="modal" data-target="#exampleModalCenter"> Detalhes </button>
												</p>
											</div>
										</div>

										<div class="card-report">
											<div class="card-container">

												<!-- -->
												<div class="grid-container">
													<div class="grid-item">
														<div class="img-container">
															<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
														</div>
													</div>

													<div class="grid-item">
														<h3> <b> Solicitação de Serviço de Julia Contratante para Roberta Dias</b></h3> 
														<p><b> Dia: </b> 25/12/2020 	&nbsp;	 <b>Hora: </b> 8:00 às 15:00
														</p> 
													</div>

													<div class="grid-item">
														<div class="img-container">
															<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
														</div>
													</div>
												</div>
												<!-- -->

												<p class="center">
													<!--bootstrap buttons + classe-->
													<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-pend" name="detalhe-pend" data-toggle="modal" data-target="#exampleModalCenter">Detalhes</button>
												</p>
											</div>
										</div>

									</div>
									<div id="tabs-5">
										<div class="card-report">
											<div class="card-container">

													<!-- -->
													<div class="grid-container">
														<div class="grid-item">
															<div class="img-container">
																<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
															</div>
														</div>

														<div class="grid-item">
															<h3> <b>Rogéria Sampaio possui um serviço em andamento com Carla Santos</b></h3> 
															<p><b> Dia: </b> 22/12/2020 	&nbsp;	 <b>Hora: </b> 8:00 às 15:00
															</p> 
														</div>

														<div class="grid-item">
															<div class="img-container">
																<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
															</div>
														</div>
													</div>
													<!-- -->

													<!--bootstrap buttons + classe-->
													<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-and" name="detalhe-and" data-toggle="modal" data-target="#exampleModalCenter">Detalhes</button>
												</p>
											</div>
										</div>
										<div class="card-report">
											<div class="card-container">

													<!-- -->
													<div class="grid-container">
														<div class="grid-item">
															<div class="img-container">
																<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
															</div>
														</div>

														<div class="grid-item">
															<h3> <b>Joaquina Silva possui um serviço em andamento com Maria Claudia</b></h3> 
															<p><b> Dia: </b> 22/12/2020 	&nbsp;	 <b>Hora: </b> 8:00 às 15:00
															</p> 
														</div>

														<div class="grid-item">
															<div class="img-container">
																<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
															</div>
														</div>
													</div>
													<!-- -->

													<!--bootstrap buttons + classe-->
													<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-and" name="detalhe-and" data-toggle="modal" data-target="#exampleModalCenter">Detalhes</button>
												</p>
											</div>
										</div>
										<div class="card-report">
											<div class="card-container">

													<!-- -->
													<div class="grid-container">
														<div class="grid-item">
															<div class="img-container">
																<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
															</div>
														</div>

														<div class="grid-item">
															<h3> <b>Lucina Lucia possui um serviço em andamento com Luiza Luz</b></h3> 
															<p><b> Dia: </b> 22/12/2020 	&nbsp;	 <b>Hora: </b> 8:00 às 15:00
															</p> 
														</div>

														<div class="grid-item">
															<div class="img-container">
																<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
															</div>
														</div>
													</div>
													<!-- -->

													<!--bootstrap buttons + classe-->
													<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-and" name="detalhe-and" data-toggle="modal" data-target="#exampleModalCenter">Detalhes</button>
												</p>
											</div>
										</div>
										<div class="card-report">
											<div class="card-container">

													<!-- -->
													<div class="grid-container">
														<div class="grid-item">
															<div class="img-container">
																<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
															</div>
														</div>

														<div class="grid-item">
															<h3> <b>Rogéria Sampaio possui um serviço em andamento com Carla Santos</b></h3> 
															<p><b> Dia: </b> 22/12/2020 	&nbsp;	 <b>Hora: </b> 8:00 às 15:00
															</p> 
														</div>

														<div class="grid-item">
															<div class="img-container">
																<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
															</div>
														</div>
													</div>
													<!-- -->

													<!--bootstrap buttons + classe-->
													<button type="button" class="btn btn-lg bt-detalhes" id="detalhe-and" name="detalhe-and" data-toggle="modal" data-target="#exampleModalCenter">Detalhes</button>
												</p>
											</div>
										</div>
									</div>
									<div id="tabs-6">
										<div class="card-report">
											<div class="card-container">

												<!-- -->
												<div class="grid-container">
													<div class="grid-item">
														<div class="img-container">
															<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
														</div>
													</div>

													<div class="grid-item">
														<h3> <b> Serviço Finalizado de Julia Prestadora para Carla Contratante </b></h3> 
														<p><b> Dia: </b> 25/12/2020		&nbsp;	 <b>Hora: </b> 8:00 às 15:00
														</p> 
													</div>

													<div class="grid-item">
														<div class="img-container">
															<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
														</div>
													</div>
												</div>
												<!-- -->

												<p>
													<!-- bootstrap buttons + classe -->
													<button type="button" class="btn btn-lg bt-detalhes" id="detalhes-and" name="detalhes-fina" data-toggle="modal" data-target="#exampleModalCenter" > Detalhes </button>
												</p>
											</div>
										</div>
										<div class="card-report">
											<div class="card-container">

												<!-- -->
												<div class="grid-container">
													<div class="grid-item">
														<div class="img-container">
															<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
														</div>
													</div>

													<div class="grid-item">
														<h3> <b> Serviço Finalizado de Gabriela Esteves para Priscilla Meida </b></h3> 
														<p><b> Dia: </b> 25/12/2020		&nbsp;	 <b>Hora: </b> 8:00 às 15:00
														</p> 
													</div>

													<div class="grid-item">
														<div class="img-container">
															<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
														</div>
													</div>
												</div>
												<!-- -->

												<p>
													<!-- bootstrap buttons + classe -->
													<button type="button" class="btn btn-lg bt-detalhes" id="detalhes-and" name="detalhes-fina" data-toggle="modal" data-target="#exampleModalCenter" > Detalhes </button>
												</p>
											</div>
										</div>
										<div class="card-report">
											<div class="card-container">

												<!-- -->
												<div class="grid-container">
													<div class="grid-item">
														<div class="img-container">
															<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
														</div>
													</div>

													<div class="grid-item">
														<h3> <b> Serviço Finalizado de Paimon para Cristiane Barbosa </b></h3> 
														<p><b> Dia: </b> 25/12/2020		&nbsp;	 <b>Hora: </b> 8:00 às 15:00
														</p> 
													</div>

													<div class="grid-item">
														<div class="img-container">
															<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
														</div>
													</div>
												</div>
												<!-- -->

												<p>
													<!-- bootstrap buttons + classe -->
													<button type="button" class="btn btn-lg bt-detalhes" id="detalhes-and" name="detalhes-fina" data-toggle="modal" data-target="#exampleModalCenter" > Detalhes </button>
												</p>
											</div>
										</div>
										<div class="card-report">
											<div class="card-container">

												<!-- -->
												<div class="grid-container">
													<div class="grid-item">
														<div class="img-container">
															<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
														</div>
													</div>

													<div class="grid-item">
														<h3> <b> Serviço Finalizado de Julia Prestadora para Carla Contratante </b></h3> 
														<p><b> Dia: </b> 25/12/2020		&nbsp;	 <b>Hora: </b> 8:00 às 15:00
														</p> 
													</div>

													<div class="grid-item">
														<div class="img-container">
															<img src="./imagens/mulher.png" id="profile-img" title="Imagem de Perfil">
														</div>
													</div>
												</div>
												<!-- -->

												<p>
													<!-- bootstrap buttons + classe -->
													<button type="button" class="btn btn-lg bt-detalhes" id="detalhes-and" name="detalhes-fina" data-toggle="modal" data-target="#exampleModalCenter" > Detalhes </button>
												</p>
											</div>
										</div>
									</div>
									<div id="tabs-7">
										<div id="graph-wrapper">
											<div style="display: inline-block;" id="piechart"></div>
											<div style="display: inline-block;" id="columnchart"></div>
											<div style="display: inline-block;" id="areachart"></div>
										</div>	
									</div>
								</div>
							</div>
							<div style="margin-left: 0.5%; display: inline-block; width: 9%;" class="form-group">
								<select name="select-user-type" onchange="changeFunction()" class="form-control form-control-sm" id="select-user">
									<option>Tipo de usuário</option>
									<option>Prestador</option>
									<option>Contratante</option>
									<option>Ambos</option>
								</select>
							</div>
							<div style="align-items: center;" id="person-report">
								<div id="filter-wrapper">
									<div style="display: inline-block;"id="prestador-opt">
										Prestador: <input style="width: 400px; margin-right: 15px;" type="text" class="my-form-control">
									</div>
									<div style="display: inline-block;" id="contratante-opt">
										Contrantante: <input style="width: 400px;" type="text" class="my-form-control">
									</div>&emsp;
									<div style="width: 12%; display: inline-block; margin-right: 1%;" class="form-group">
										<select onchange="changeFunction()" class="form-control form-control-sm" id="select-user">
											<option>Status da conta</option>
											<option>Ativa</option>
											<option>Inativa</option>
										</select>
									</div>
									<button onclick="resetFields()" id="user-reset-button" class="cancel-button btn-sm btn-danger">Resetar</button>
									<button onclick="showUserGrid()" id="user-apply-button" class="apply-button btn-sm btn-success">Aplicar</button>
								</div>
								<?php
									$query = "SELECT id_pessoa, nome, foto, tipo_pessoa FROM pessoa";
									$result = $conn->query($query) or die($conn->error);
								?>
								<div id="user-grid">
									<?php while ($dados_pessoa_relatorio = $result->fetch_array() ){
									?>
									<div id="user-item">
										<div class="thumbnail">
											<?php
												if ($dados_pessoa_relatorio["foto"] != NULL) {
													$foto = $dados_pessoa_relatorio["foto"]; 
												} else {
													$foto = 'profile.png';
												}

												if ($dados_pessoa_relatorio['tipo_pessoa'] == 1) {
													$tipo_pessoa = "Prestador";
												} else {
													$tipo_pessoa = "Contratante";
												}
											?>
											<img id="report-img" src="./imagens/<?php echo $foto; ?>">
											<div class="caption">
												<h3 style="font-size:20px; color: white"><?php echo $dados_pessoa_relatorio["nome"]; ?></h3>
												<h3 style="font-size:20px; color: white"><?php echo $tipo_pessoa; ?></h3>
												<p><a href="./perfil-prestador-visao-contratante.php?id_prestador=<?php echo $dados_pessoa_relatorio["id_pessoa"]; ?>" class="profile-btn btn btn-primary" role="button">Visitar perfil</a></p>
											</div>
										</div>
									</div>
									<?php 
									}
									?>
								</div>
								<div id="graph-user-wrapper">
									<div style="display: inline-block;" id="user_piechart"></div>
									<div style="display: inline-block;" id="user_columnchart"></div>
									<div style="display: inline-block;" id="user_areachart"></div>
								</div>
							</div>
						</div>
						<!--fim aba Relatorio -->

				 	</div>   
	 			</div>
			</div>
	    </div>
	    <!--fim main-->

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

		<div class="item footer">Copyright @EmpregadíssimaOwners</div>

		<div class="dialog-reprovar-adm" id="dialog-reprovar-adm" title="Alerta">
		  <p> Deseja <b>Rejeitar</b> esta/estas Solicitação/Solicitações? </p>
		</div>

		<!--Verifica se o usuário checou algum checkbox -->
		<div class="dialog-checkbox-nao-checado" id="dialog-checkbox-nao-checado" title=" Erro! ">
		  <p> Para Reprovar Cadastros é necessário selecionar pelo menos 1 checkbox </p>
		</div>

		<!--fim do formulario-->
	</form>

</body>

<!--jquery-->
<script>
    $(document).ready(function(){ 	

		$("#aprovar-cadastros-checkAll").click(function(){
		    $('.aprovar-cadastros-check').not(this).prop('checked', this.checked);
		});
	

		$("#checkAll2").click(function () {
		    $(".check").prop('checked', $(this).prop('checked'));
		});



		$( function() {
			$("#tabs").tabs();
			$('#report-tabs').tabs();		
		});

		$('#exampleModalCenter').on('shown.bs.modal', function () {
	  		$('#myInput').trigger('focus')
		})	

		$( function() {
		    $( "#dialog-reprovar-adm" ).dialog({
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

		$( function() {
		    $( "#dialog-checkbox-nao-checado" ).dialog({
		    	autoOpen: false,
		     	resizable: false,
		      	height: "auto",
		      	width: 400,
		      	modal: true,
		      	buttons: {
		        Ok: function() {
		          $( this ).dialog( "close" );
		        }
		      }
		    });
		} );

	});



	$( ".bt-reprovar" ).on( "click", function() {
		if ($('#form :checkbox.aprovar-cadastros-check:checked').length > 0){
	    	$( "#dialog-reprovar-adm" ).dialog( "open" );
	  	}
	  	else{
	 	  	$( "#dialog-checkbox-nao-checado" ).dialog( "open" );
	 	}
	});

	$( "#bt-excluir" ).on( "click", function() {
		if ($('#form :checkbox.check:checked').length > 0){
	    	$( "#dialog-excluir-adm" ).dialog( "open" );
	  	}
	  	else{
	 	  	$( "#dialog-checkbox-nao-checado2" ).dialog( "open" );
	 	}
	});

	$("#person-report").hide();
	$("#list-tabs").hide();
	$("#select-user").hide();

	$("#opt-service").click(function(){
		$("#person-report").hide();
		$("#list-tabs").show();
		$("#select-user").hide();
	});

	$("#opt-person").click(function(){
		$("#list-tabs").hide();
		$("#person-report").show();
		$("#select-user").show();
	});

	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

	// Draw the chart and set the chart values
	function drawChart() {
		var grafServicos = google.visualization.arrayToDataTable([
			['Servicos', 'Totais'],
			['Pendente', 8],
			['Cancelados', 1],
			['Em andamento', 2],
			['Finalizados', 4],
		]);

		var grafAvaliacoes = google.visualization.arrayToDataTable([
			['Element', 'Avaliações', { role: 'style' }],
			['1 estrela', 43, 'red'],      
			['2 estrelas', 26, 'orange'], 
			['3 estrelas', 32, 'yellow'],
			['4 estrelas', 96, 'blue'],
			['5 estrelas', 150, 'green'],
		]);

		var grafServicosMes = google.visualization.arrayToDataTable([
			['Ano', 'Finalizados', 'Cancelados'],
			['2017',  432,      134],
			['2018',  607,      154],
			['2019',  660,       231],
			['2020',  1034,      217],
		]);

		var grafUsers = google.visualization.arrayToDataTable([
			['Usuários', 'Totais'],
			['Contratantes ativos', 15],
			['Contratantes inativos', 3],
			['Prestador ativo', 30],
			['Prestador inativo', 4],
		]);

		var grafUsersTotal = google.visualization.arrayToDataTable([
			['Element', 'Quantidade', { role: 'style' }],
			['Prestadores', 34, 'blue'],      
			['Contratantes', 18, 'grey'], 
		]);

		var grafUserFreq = google.visualization.arrayToDataTable([
			['Ano', 'Prestadores', 'Contratantes'],
			['2017',  432,      325],
			['2018',  607,      460],
			['2019',  660,       513],
			['2020',  1034,      745],
		]);

		// Optional; add a title and set the width and height of the chart
		var options1 = {'title':'Gráfico de serviços', 'width':545, 'height':400};
		var options2 = {'title':'Gráfico de avaliações', 'width':545, 'height':400};

		var options3 = {
			width: 545,
			height: 400,
			title: 'Crescimento dos usuários por ano',
			hAxis: {title: 'Ano',  titleTextStyle: {color: '#333'}},
			vAxis: {minValue: 0}
		};

		// Display the chart inside the <div> element with id="piechart"
		var chart1 = new google.visualization.PieChart(document.getElementById('piechart'));
		var chart2 = new google.visualization.ColumnChart(document.getElementById('columnchart'));
		var chart3 = new google.visualization.AreaChart(document.getElementById('areachart'));
		var chart4 = new google.visualization.PieChart(document.getElementById('user_piechart'));
		var chart5 = new google.visualization.ColumnChart(document.getElementById('user_columnchart'));
		var chart6 = new google.visualization.AreaChart(document.getElementById('user_areachart'));
		chart1.draw(grafServicos, options1);
		chart2.draw(grafAvaliacoes, options2);
		chart3.draw(grafServicosMes, options3);
		chart4.draw(grafUsers, options1);
		chart5.draw(grafUsersTotal, options2);
		chart6.draw(grafUserFreq, options3);
	}

	$("#filter-wrapper").hide();
	$("#prestador-opt").hide();
	$("#contratante-opt").hide();
	$("#user-grid").hide();

	function changeFunction () {
		var data = document.getElementById('select-user').value;
		$("#filter-wrapper").show();
		switch (data) {					
			case 'Prestador':
				$("#contratante-opt").hide();
				$("#prestador-opt").show();
				break;
			case 'Contratante':
				$("#prestador-opt").hide();
				$("#contratante-opt").show();
				break;
			case 'Ambos':
				$("#prestador-opt").show();
				$("#contratante-opt").show();
				break;
			case 'Tipo de usuário': 
				$("#filter-wrapper").hide();
				$("#user-grid").hide();
				$("#graph-user-wrapper").show();
		}
	}

	function showUserGrid () {
		$("#user-grid").show();
		$("#graph-user-wrapper").hide();
	}

	function resetFields () {
		$("#user-grid").hide();
		$("#graph-user-wrapper").show();
	}

	function aprovarCadastrosF(){
		var listaAprovados = document.getElementsByClassName("check_apv");

		if (!confirm("Deseja APROVAR este(s) cadastro(s)?")) {
			return false;
		}
		else{
			document.getElementById("form-lista-cad-apv").method= "POST";
			document.getElementById("form-lista-cad-apv").action= "../controller/Usuario_Controller.php?metodo=aprovar_cadastro";
	        document.getElementById("form-lista-cad-apv").submit();// Form submission
		}
	}

	function reprovarCadastrosF(){
		var listaAprovados = document.getElementsByClassName("check_apv");

		if (!confirm("Deseja REPROVAR este(s) cadastro(s)?")) {
			return false;
		}
		else{
			document.getElementById("form-lista-cad-apv").method= "POST";
			document.getElementById("form-lista-cad-apv").action= "../controller/Usuario_Controller.php?metodo=reprovar_cadastro";
	        document.getElementById("form-lista-cad-apv").submit();// Form submission
		}
	}
	
</script>

</html>