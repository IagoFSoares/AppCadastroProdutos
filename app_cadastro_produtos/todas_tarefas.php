
<?php 

	$acao = 'recuperar';

	require 'tarefa_controller.php';

	/*
	echo "<pre>";
	print_r($tarefas);
	echo "</pre>";
	*/

?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Produtos</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script>
			function editar(id, txt_tarefa) {

				//form de adição
				let form = document.createElement('form')
				form.action = 'tarefa_controller.php?acao=atualizar'
				form.method = 'post'
				form.className = 'row'

				//input entrada do texto
				let inputTarefa = document.createElement('input')
				inputTarefa.type = 'text'
				inputTarefa.name = 'tarefa'
				inputTarefa.className = 'col-9 form-control'
				inputTarefa.value = txt_tarefa

				// input hidden para guardar o id da tarefa
				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'id'
				inputId.value = id

				//button envio form
				let button = document.createElement('button')
				button.type = 'submit'
				button.className = 'col-3 btn btn-info'
				button.innerHTML = 'atualizar'

				//incluir inputTarefa no form
				form.appendChild(inputTarefa)

				//incluir inputId no form
				form.appendChild(inputId)

				//incluir button no form
				form.appendChild(button)

				//teste
				//console.log(form)

				//alert(id)

				//selecionar a div tarefa 
				let tarefa = document.getElementById('tarefa_'+id)

				//limpar texto da tarefa para a inclusão do form
				tarefa.innerHTML = ' '

				//inclusão do form na pagina
				tarefa.insertBefore(form, tarefa[0])

				
			}

			function remover(id) {
				location.href = 'todas_tarefas.php?acao=remover&id=' +id;
			}

			function marcarRealizada(id) {
				location.href = 'todas_tarefas.php?acao=marcarRealizada&id=' +id;
			}
		</script>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista de Produtos
				</a>
			</div>
			<ul class="btn btn-success">
		        <li class="nav-item">
		          <a class="nav-link" href="logoff.php">SAIR</a>
		        </li>
		     </ul>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="home.php">Produtos em Estoque</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Adicionar Produto</a></li>
						<li class="list-group-item active"><a href="#">Relatório Produtos</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Relatório de Produtos</h4>
								<hr />

								<? foreach($tarefas as $indice => $tarefa) { ?>
									<div class="row mb-3 d-flex align-items-center tarefa">
									<div class="col-sm-9" id='tarefa_<?= $tarefa->id ?>'>
										<?= $tarefa->tarefa ?>(<?= $tarefa->status ?>)
									</div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $tarefa->id ?>)"></i>
										
										<? if ($tarefa->status == 'Em Estoque') { ?>
										
										<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefa->id ?>, '<?= $tarefa->tarefa ?>' )"></i>
										<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $tarefa->id ?>)"></i>

										<? } ?>
									</div>
								</div>

								<? } ?>

							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>