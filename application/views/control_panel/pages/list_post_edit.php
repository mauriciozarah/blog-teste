        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Editar Post</h1>
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
                                    <?php $attr = array("role" => "form"); echo  form_open_multipart('control_panel/list_post/update', $attr);?>
                                        <div class="form-group">
                                            <label>Título do Post</label>
                                            <input class="form-control" name="post_titulo" onkeyup="insereSlug(this.value);" required="required" value="<?php echo $POSTS->titulo; ?>" maxlength="255">
                                            <p class="help-block"><font color="#ff0000"><?php echo form_error('post_titulo'); ?></font></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Slug para SEO</label>
                                            <input class="form-control" name="slug" id="slug" required="required" value="<?php echo $POSTS->descricao_slug; ?>" maxlength="255">
                                            <p class="help-block"><font color="#ff0000"><?php echo form_error('slug'); ?></font></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Breve Descrição</label>
                                            <input class="form-control" name="breve_descricao" required="required" value="<?php echo $POSTS->descricao; ?>" maxlength="255">
                                            <p class="help-block"><font color="#ff0000"><?php echo form_error('breve_descricao'); ?></font></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Data da Postagem</label>
                                            <input class="form-control data" type="text" name="data_hora" required="required" value="<?php echo dataBr($POSTS->data_hora); ?>" maxlength="10" />
                                            <p class="help-block"><font color="#ff0000"><?php echo form_error('data_hora'); ?></font></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Imagem para o Post</label>
                                            <input type="file" name="foto[]">
                                        </div>
                                        <div class="form-group">
                                            <label>Conteúdo do Post</label>
                                            <?php $descricao = set_value('descricao'); ?>
                                            <?php echo $this->ckeditor->editor('descricao', $POSTS->conteudo);?>
                                            <p class="help-block"><?php echo form_error('descricao'); ?></font></p>
                                        </div>
                                        <div class="form-group">
                                            <label>Inserir Post como ativo?</label>
                                            <?php 
                                            $ativo    = ($POSTS->ativo == "S")?"checked":"";
                                            $inativo  = ($POSTS->ativo == "N")?"checked":"";
                                            ?>
                                            <label class="radio-inline">
                                                <input type="radio" name="ativo" id="optionsRadiosInline1" value="S" <?php echo $ativo; ?>>Ativo
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="ativo" id="optionsRadiosInline2" value="N" <?php echo $inativo; ?>>Inativo
                                            </label>
                                            <p class="help-block"><font color="#ff0000"><?php echo form_error('ativo'); ?></font></p>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-info">Editar</button>
                                        <button type="reset" class="btn btn-warning">Resetar</button>
                                        <input type="hidden" name="id" value="<?php echo $POSTS->idpost; ?>" />
                                    <?php echo form_close(); ?>
                                </div>
                                <!-- /.col-lg-12 (nested) -->
                                
                            </div>
                            <!-- /.row (nested) -->
                            <?php if($POSTS->imagem != ""): ?>
                            <div class="row">
                                <hr />
                                <legend>Foto Cadastrada</legend>
                                <div class="col-md-12" id="imagem">
                                    <img src="<?php echo base_url('assets/fotos-post/fotos') ?>/<?php echo $POSTS->imagem; ?>" />&nbsp;&nbsp;<button type="button" onclick="deletaFoto('<?php echo $POSTS->idpost ?>');" class="btn btn-danger">Excluir esta Foto</button>
                                </div>
                            </div>
                        <?php endif; ?>
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


        function deletaFoto(id){
            var res = confirm("Confirma deletar esta foto?");
            if(res){
                var id = id;
                $.ajax({
                    url:"<?php echo base_url('control_panel/list_post/delFoto'); ?>",
                    type:"post",
                    dataType:"html",
                    data:{id:id, imagem:'<?php echo $POSTS->imagem; ?>', '<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>'},
                    success:function(data){
                        $("#imagem").html("");
                        $("#imagem").html("Foto deletada com Sucesso.");
                    },
                    error:function(xhr, err){
                        console.log(err);
                    }
                });
            }
        }

        </script>