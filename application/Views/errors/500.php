<!DOCTYPE html>
<html lang="pt-BR">
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
			font-size: "Noto Sans", sans-serif;
			font-weight: bold;
		}

		.box-body {
			display: block;
			margin: 0;
			padding: 1rem;
			font-family: "Noto Sans", sans-serif;
			font-weight: normal;
		}
	</style>

	<!-- Title -->
	<title>500 Erro do servidor interno</title>
</head>
<body>
	<div class="box">
		<h3 class="box-header">500 Erro do servidor interno</h3>
		<p class="box-body"><?php echo htmlspecialchars_decode($msg); ?></p>
	</div>
</body>
</html>
