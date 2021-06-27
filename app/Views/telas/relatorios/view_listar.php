<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2><i class="fa fa-bar-chart"></i> LISTA DE RELATÓRIOS</h2>
        </div>
    
        <div class="col-md-2"></div>
    
        <div class="col-md-2">
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
				<div class="box-body" id="divPesquisa">
                    
                    <div class="form-group">
					    <label>DATA DE ENTRADA:</label>
                        <input type="date" class="form-control" id="inputData" name="inputData">
                    </div>

                    
                    <div class="text-center">
                        <button type="button" id="btnPesquisar" class="btn btn-default btn-flat text-green"><i class="fa fa-search"></i> <strong>PESQUISAR</strong></button>
                    </div>
				</div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="box box-solid">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-bordered">
                        <thead style="background-color: #182226; color: #FFF">
                            <tr>
                                <th style="width: 3%;" class="text-center">#ID</th>
                                <th style="width: 40%;" class="text-center">RELATÓRIOS</th>
                                <th class="text-center">DATA DE CADASTRO</th>
                                <th style="width: 20%;" class="text-center">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody id="listaDeRelatorios">   
                            <?=$listaDeRelatorio?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
</div>

<div class="modal fade" id="modalEditarRelatorio" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close btnCancelar" aria-label="Close">
                  	<span aria-hidden="true">×</span>
				</button>
                <h4 class="modal-title" id="tituloModal">- EDITAR RELATÓRIO</h4>
            </div>

            <div class="modal-body">
                
	            <div class="box-body">
				    <div class="form-group">
						<label for="descricaoRelatorio">DESCRIÇÂO RELATÓRIO:</label>
						<input type="text" class="form-control" id="inputDescricao" required="true" name="inputDescricao" placeholder="Digite a descrição para o relatório...">
                        <input type="hidden" id="inputId" name="inputId" value="0">
                        <p id="mensagemInputDescricao"></p>
					</div>
	            </div>

	            <div class="box-footer text-center">
                  	<button type="button" class="btn btn-default text-blue" id="btnSalvar"><i class="fa fa-check"></i> SALVAR</button>
                    <button type="button" class="btn btn-default text-red btnCancelar"><i class="fa fa-remove"></i> CANCELAR</button>
                </div>
            </div>
        </div>
   	</div>
</div>