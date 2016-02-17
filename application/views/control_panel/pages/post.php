        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Novo Post</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <?php if($this->session->flashdata("sucess") != ""): echo mensagem("success", $this->session_flashdata("success")); endif; ?>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Insira um novo Post
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php $attr = array("role" => "form"); echo  form_open_multipart('control_panel/post/insert', $attr);?>
                                        <div class="form-group">
                                            <label>Título do Post</label>
                                            <input class="form-control" name="post_titulo" onkeyup="insereSlug(this.value);" required="required" value="<?php echo set_value('post_titulo'); ?>" maxlength="255">
                                            <p class="help-block" style="font-style:italic !important;color:#ff0000 !important;"><?php echo form_error('post_titulo'); ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Slug para SEO</label>
                                            <input class="form-control" name="slug" id="slug" required="required" value="<?php echo set_value('slug'); ?>" maxlength="255">
                                            <p class="help-block" style="font-style:italic !important;color:#ff0000 !important;"><?php echo form_error('slug'); ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Breve Descrição</label>
                                            <input class="form-control" name="breve_descricao" required="required" value="<?php echo set_value('breve_descricao'); ?>" maxlength="255">
                                            <p class="help-block" style="font-style:italic !important;color:#ff0000 !important;"><?php echo form_error('breve_descricao'); ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Data da Postagem</label>
                                            <input class="form-control data" type="text" name="data_hora" required="required" value="<?php echo set_value('data_hora'); ?>" maxlength="10" />
                                            <p class="help-block" style="font-style:italic !important;color:#ff0000 !important;"><?php echo form_error('data_hora'); ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Imagem para o Post</label>
                                            <input type="file" name="foto[]" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Conteúdo do Post</label>
                                            <?php $descricao = set_value('descricao'); ?>
                                            <?php echo $this->ckeditor->editor('descricao', $descricao);?>
                                            <p class="help-block" style="font-style:italic !important;color:#ff0000 !important;"><?php echo form_error('descricao'); ?></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Inserir Post como ativo?</label>
                                            <label class="radio-inline">
                                                <input type="radio" name="ativo" id="optionsRadiosInline1" value="S" checked>Ativo
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="ativo" id="optionsRadiosInline2" value="N">Inativo
                                            </label>
                                            <p class="help-block" style="font-style:italic !important;color:#ff0000 !important;"><?php echo form_error('ativo'); ?></p>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-info">Cadastrar</button>
                                        <button type="reset" class="btn btn-warning">Resetar</button>
                                    <?php echo form_close(); ?>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        
        <!-- scripts da pagina de posts -->
        <script>
        function insereSlug(valor){
            var v = valor;
            $.ajax({
                url:"<?php echo base_url('control_panel/post/geraSlug'); ?>",
                type:"post",
                dataType:"json",
                data:{v:v,'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>'},
                beforeSend:function(){
                    $("#slug").val("Carregando...");
                },
                success:function(data){
                    $("#slug").val(data.slug);
                },
                error:function(xhr, err){
                    console.log(err);
                }
            });
        }


        </script>