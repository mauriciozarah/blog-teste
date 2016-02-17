<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Blog Teste</title>
	<script src="<?php echo base_url('js/ckeditor/ckeditor.js');?>"></script>
</head>
<body>
	<?php echo form_open('/home/cadastrar'); ?>
		<?php echo $this->fckeditor->Create(); ?>
	<?php echo form_close(); ?>

</body>
<script>
	//CKEDITOR.replace('');
</script>
</html>