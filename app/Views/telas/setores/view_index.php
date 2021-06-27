<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h2><i class="fa fa-bank"></i> SETORES</h2>
        </div>
    
        <div class="col-md-5"></div>
    
        <div class="col-md-3">
            <button type="button" class="btn btn-default pull-right h2 text-green" data-toggle="modal" data-target="#modalSalvarSetor"><i class="fa fa-plus"></i> <b>CADASTRAR NOVO</b></button>
        </div>
    </div>

    <hr>
    
    <div class="box box-solid">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
                <thead style="background-color: #182226; color: #FFF">
                    <tr>
                        <th style="width: 3%;" class="text-center">#ID</th>
                        <th style="width: 25%;" class="text-center">SETORES</th>
                        <th class="text-center">DESCRIÇÃO</th>
                        <th style="width: 10%;" class="text-center">AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="listaDeSetores">   
                    <?=$listaDeSetores?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSalvarSetor" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close btnCancelar" aria-label="Close">
                  	<span aria-hidden="true">×</span>
				</button>
                <h4 class="modal-title" id="tituloModal">- CADASTRAR SETOR</h4>
            </div>

            <div class="modal-body">
                
	            <div class="box-body">
				    <div class="form-group">
						<label for="nomeSetor">NOME DO SETOR:</label>
						<input type="text" class="form-control" id="inputSetor" required="true" name="inputSetor" placeholder="Digite o nome do setor...">
                        <p id="mensagemInputSetor"></p>
					</div>
                    <div class="form-group">
                        <label for="descricaoSetor">DESCRIÇÃO:</label>
                        <textarea style="resize: none" class="form-control" id="inputDescricao" name="inputDescricao" rows="2" maxlength="150" placeholder="Digite uma descrição para o setor..."></textarea>
                        <p id="mensagemInputDescricao"></p>
                    </div>

                    <input type="hidden" id="inputId" name="inputId" value="0">
	            </div>

	            <div class="box-footer text-center">
                  	<button type="button" class="btn btn-default text-blue" id="btnSalvar"><i class="fa fa-check"></i> SALVAR</button>
                    <button type="button" class="btn btn-default text-red btnCancelar"><i class="fa fa-remove"></i> CANCELAR</button>
                </div>
            </div>
        </div>
   	</div>
</div>