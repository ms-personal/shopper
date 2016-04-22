<?php

	/* Carrega todas as funcionalidades do sistema */
	require_once "/core/Core.php";

	$core = new Core();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Shopper</title>

	<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="container">

	<header>

		<h1>Shopper CRUD</h1>

	</header>

	<section class="row">

		<aside class="column w15">

			<ul>
				<li><a href="/list">Lista de clientes</a></li>
				<li><a href="/add">Cadastro de cliente</a></li>
			</ul>

		</aside>

		<aside class="column w85">

			<!-- content -->
			<?php $core->renderPage();?>
			<!-- content -->

		</aside>

	</section>

</body>
</html>