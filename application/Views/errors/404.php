<!DOCTYPE html>
<html lang="pt_BR">
<head>
	<!-- Meta tags -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge, Chrome=1">

	<!-- Stylesheet -->
	<style>
		.box {
			width: 100%;
			max-width: 980px;
			margin: 3rem auto;
			border: 1px solid #E9E9E9;
			box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
			color: #666;
		}

		.box-header {
			display: block;
			margin: 0;
			padding: 1rem;
			border-bottom: 1px solid #E9E9E9;
			background-color: #F44336;
			color: #FFF;
		}

		.box-body {
			display: block;
			margin: 0;
			padding: 1rem;
		}
	</style>

	<!-- Title -->
	<title>Parentheses &dash; 404 Página não encontrada</title>
</head>
<body>
	<div class="box">
		<h3 class="box-header">Opsss... 404 Página não encontrada</h3>
		<p class="box-body"><?php echo $msg; ?></p>
	</div>
</body>
</html>
