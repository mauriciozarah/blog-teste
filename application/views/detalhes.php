<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Blog v1.0</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" />
</head>
<body>
	<div class="container">
		<legend>Blog v1.0</legend>
		<div class="row">
			<div class="col-md-12" style="text-align:right;"><a href="<?php echo base_url('login/index'); ?>">Login</a></div>
		</div>
		<div class="row">
			<div class="col-md-4 col-sm-12 col-xs-12">
				<img src="<?php echo base_url('assets/fotos-post/fotos'); ?>/{IMAGEM}" class="img-responsive" />
			</div>
			<div class="col-md-8 col-sm-12 col-xs-12">
				<h3>{TITULO}</h3>
				<p>{CONTEUDO}</p>
				<p class="pull-right"><i>{DATA_HORA}</i></p>
				<hr />
				<p class="pull-right"><a href="<?php echo base_url('posts'); ?>">[Voltar]</a></p>
			</div>
		</div>
		<hr />
	</div>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
</body>
</html>