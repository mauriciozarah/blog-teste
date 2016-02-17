      <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Lista de Posts</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
				<div class="col-md-12 pull-right">
					<?php $attr = array("role" => "form"); echo form_open(base_url('control_panel/list_post/index', $attr)); ?>
					Título:&nbsp;&nbsp;<input type="text" name="busca" placeholder="Buscar">
					&nbsp;&nbsp;<button type="submit" class="btn btn-info btn-sm">Buscar</button>
					&nbsp;&nbsp;<a href="<?php echo base_url('control_panel/list_post/clear_search'); ?>" class="btn btn-warning btn-sm">Limpar Busca</a>
					<?php echo form_close(); ?>
				</div>
				<hr />
            </div>
            <div class="row">
            	<div class="col-md-12">
            		<h3>Total de {TOTAL_REGISTROS} registro(s)</h3>
            	</div>
            </div>
            <!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Título</th>
								<th>Data</th>
								<th>Ativo?</th>
								<th>Desativar</th>
								<th>Editar</th>
								<th>Excluir</th>
							</tr>
						</thead>
						<tbody>
							{REGISTROS}
								<tr>
									<td>{titulo}</td>
									<td>{data_hora}</td>
									<td>{ativo}</td>
									<td><a href="{PG_DESATIVA}/{idpost}" title="Desativar"><i class="fa fa-times-circle-o fa-2x"></i></a></td>
									<td><a href="{PG_EDITA}/{idpost}" title="Editar"><i class="fa fa-pencil fa-2x"></i></a></td>
									<td><a href="{PG_EXCLUI}/{idpost}" title="Delete"><i class="fa fa-trash fa-2x"></i></a></td>
								</tr>
							{/REGISTROS}

						</tbody>
					</table>
					
					<nav><ul class="pagination pagination-md">
							{LINKS}
					</ul></nav>
					

				</div>
			</div>
      </div><!-- ./page-wrapper -->