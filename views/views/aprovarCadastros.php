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
	<title>Administador</title>
</head>
<body>

	<!--main-->
    <div class="main">

		<div class="info-adm" style="">
		    <h4>Administrador:&nbsp;AdmTeste&nbsp;&nbsp;&nbsp;\&nbsp;&nbsp;&nbsp;Login: &nbsp;Teste123</h4>
		</div>

		<div class="lista-abas animacao-flip">
			<div id="tabs">    	
			    <!--table-->
			    <ul>
					<li><a href="#tabs-1"> Pendentes </a></li>
					<li><a href="#tabs-2"> Exclusão de Contas </a></li>
					<li><a href="#tabs-3"> Relatório </a></li>
				</ul>
					<!-- Aba cadastros pendentes-->
					<div id="tabs-1">
	    				<div class="cadast-pend">
			    		    <h2>Cadastros Pendentes</h2>
			    		</div>

						<table>
							<tr>
								<th>
									<!-- bootstrap check-box + classe checkMargin-->
									<div class="form-check checkMargin">
										<input class="form-check-input" type="checkbox" value="" id="checkAll">
										<label class="form-check-label" for="checkAll"> </label>
									</div>
								</th>
								<th>Codigo do Cadastro</th>
								<th>Nome</th> 
								<th>CPF</th>
								<th>Documentos Anexados</th>
								<th>Data Registro</th>
							</tr>
							<tr>
								<td>
									<!-- bootstrap check-box + classe checkMargin-->
									<div class="form-check checkMargin">
										<input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
										<label class="form-check-label" for="defaultCheck3"> </label>
									</div>
								</td>
							    <td>1</td>
							    <td>Bruna</td>
							    <td>123.456.456-78</td>
							    <td>-</td>
							    <td>11/11/2020</td>
						 	</tr>		 	
						  	<tr>
						  		<td>
						  			<!-- bootstrap check-box + classe checkMargin-->
									<div class="form-check checkMargin">
										<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
										<label class="form-check-label" for="defaultCheck1"> </label>
									</div>
						  		</td>
							    <td>2</td>
							    <td>Brunr</td>
							    <td>132.159.167-98</td>
							    <td>-</td>
							    <td>21/05/2020</td>
						  	</tr>
						  	<tr>
						  		<td>
						  			<!-- bootstrap check-box + classe checkMargin-->
									<div class="form-check checkMargin">
										<input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
										<label class="form-check-label" for="defaultCheck2"> </label>
									</div>
						  		</td>
							    <td>3</td>
							    <td>Brunw</td>
							    <td>789.658.136.75</td>
							    <td>-</td>
							    <td>20/05/2020</td>
						  	</tr>
						</table>
				    	<!-- fim table-->
				    							<!-- fim aba Cadastros Pendentes-->
						<div class="buttons-classe">
							<p>
								<!--bootstrap buttons + id-->
								<button type="button" class="btn btn-lg" id="bt-aprovar">Aprovar</button>
								<button type="button" class="btn btn-lg" id="bt-reprovar">Reprovar</button>
							</p>
						</div>
					</div>

					<!-- aba 2 - Exclusao de Conta -->
					<div id="tabs-2">
						<div class="cadast-pend">
			    		    <h2>Excluir Contas</h2>
			    		</div>
			    	
			    	<div class="buscarCadastro">
					    <form>
					      <input type="number" placeholder="ID ou CPF..." name="search">
					      <button type="submit"><i class="fa fa-search"></i></button>
					    </form>
					</div>
						
						<table>
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
							<tr>
								<td>
									<!-- bootstrap check-box + classe checkMargin-->
									<div class="form-check checkMargin">
										<input class="form-check-input check" type="checkbox" value="" id="defaultCheck4">
										<label class="form-check-label" for="defaultCheck4"> </label>
									</div>
								</td>
							    <td>1</td>
							    <td>Bruna</td>
							    <td>123.456.456-78</td>							    
						 	</tr>		 	
						  	<tr>
						  		<td>
						  			<!-- bootstrap check-box + classe checkMargin-->
									<div class="form-check checkMargin">
										<input class="form-check-input check" type="checkbox" value="" id="defaultCheck5">
										<label class="form-check-label" for="defaultCheck5"> </label>
									</div>
						  		</td>
							    <td>2</td>
							    <td>Brunr</td>
							    <td>132.159.167-98</td>    
						  	</tr>
						  	<tr>
						  		<td>
						  			<!-- bootstrap check-box + classe checkMargin-->
									<div class="form-check checkMargin">
										<input class="form-check-input check" type="checkbox" value="" id="defaultCheck6">
										<label class="form-check-label" for="defaultCheck7"> </label>
									</div>
						  		</td>
							    <td>3</td>
							    <td>Brunw</td>
							    <td>789.658.136.75</td>
						  	</tr>
						</table>
				    	<!-- fim table-->
				    							<!-- fim aba Cadastros Pendentes-->
						<div class="buttons-classe">
							<p>
								<!--bootstrap buttons + id-->
								<button type="button" class="btn btn-lg" id="bt-excluir">Excluir</button>
							</p>
						</div>
					</div>

					</div>
					<!--fim aba Exclusao de Conta -->

					<!-- aba 3 - Relatorio -->
					<div id="tabs-3">
						

					</div>
					<!--fim aba Relatorio -->

			 	</div>   
 			</div>
			
			<div id="caixa" title="Alerta"> 	
				<p>Tem certeza que deseja excluir esse(s) cadastro(s) permanentemente?</p>
			</div>
		
		</div>
    </div>
    <!--fim main-->


<div class="item footer">Footer</div>

    <!--jquery-->
    <script>
	    $(document).ready(function(){ 
			$("#checkAll").click(function(){
			    $('input:checkbox').not(this).prop('checked', this.checked);
			});
		});

		$("#checkAll2").click(function () {
		    $(".check").prop('checked', $(this).prop('checked'));
		});


		$( function() {
			$("#tabs").tabs();
		} );

	$(window).bind("load", function() { 
	       
	       var footerHeight = 0,
	           footerTop = 0,
	           $footer = $("#footer");
	           
	       positionFooter();
	       
	       function positionFooter() {
	       
	                footerHeight = $footer.height();
	                footerTop = ($(window).scrollTop()+$(window).height()-footerHeight)+"px";
	       
	               if ( ($(document.body).height()+footerHeight) < $(window).height()) {
	                   $footer.css({
	                        position: "absolute"
	                   }).animate({
	                        top: footerTop
	                   })
	               } else {
	                   $footer.css({
	                        position: "static"
	                   })
	               }
	               
	       }

	       $(window)
	               .scroll(positionFooter)
	               .resize(positionFooter)
	               
			$( "#bt-excluir" ).on( "click", function() {
		    	$( "#caixa" ).dialog( "open" );
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

	});

    </script>
</body>
</html>