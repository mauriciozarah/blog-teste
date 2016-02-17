<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<link rel="canonical" value="http://localhost/blog-teste/" />
	<title>Blog v1.0</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" />
</head>
<body>
	<div class="container">
		<legend>Blog v1.0</legend>
		<div class="row">
			<div class="col-md-12" style="text-align:right;"><a href="<?php echo base_url('login/index'); ?>">Login</a></div>
		</div>
		{RESULT_POST}
		<div class="row">
			<div class="col-md-4 col-sm-12 col-xs-12">
				<img src="<?php echo base_url('assets/fotos-post/fotos'); ?>/{pai_foto}" class="img-responsive" />
			</div>
			<div class="col-md-8 col-sm-12 col-xs-12">
				<h3>{pai_titulo}</h3>
				<p>{pai_conteudo}</p>
				<p class="pull-right"><a href="<?php echo base_url('noticias'); ?>/{pai_slug}">[+Detalhes]</a></p>
			</div>
		</div>
		<hr />
		{/RESULT_POST}
	</div>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
</body>
</html>