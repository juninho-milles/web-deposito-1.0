<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h2><i class="fa fa-truck"></i> DEPÓSITO</h2>
            <input type="hidden" id="tituloFornecedor" value="deposito">
        </div>
    
        <div class="col-md-6">
            <div class="input-group h2">
                <input name="inputBuscarFornecedor" class="form-control" id="inputBuscarFornecedor" type="text" placeholder="Pesquisar Fornecedor...">
                <span class="input-group-btn">
                    <button class="btn btn-success" type="submit" disabled="true">
                    <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
                <input type="hidden" name="inputBuscarFornecedorSetor" id="inputBuscarFornecedorSetor" value="deposito">
            </div>
        </div>
    
        <div class="col-md-3">
            <button type="button" class="btn btn-default pull-right h2 text-green" data-toggle="modal" data-target="#modalSalvarFornecedor"><i class="fa fa-plus"></i> <b>CADASTRAR NOVO</b></button>
        </div>
    </div>

    <hr>

    <div class="box box-solid">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
                <thead style="background-color: #182226; color: #FFF">
                    <tr>
                        <th style="width: 3%;" class="text-center">#ID</th>
                        <th class="text-center">FORNECEDORES</th>
                        <th class="text-center">CNPJ/CPF</th>
                        <th class="text-center">SETOR</th>
                        <th style="width: 10%;" class="text-center">AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="listaDeFornecedores">   
                    <?=$listaDeFornecedores?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="modalSalvarFornecedor" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close btnCancelar" aria-label="Close">
                  	<span aria-hidden="true">×</span>
				</button>
                <h4 class="modal-title" id="tituloModal">- CADASTRAR FORNECEDOR</h4>
            </div>

            <div class="modal-body">
                
	            <div class="box-body">
				    <div class="form-group">
						<label for="nomeFornecedor">NOME DO FORNECEDOR:</label>
						<input type="text" class="form-control" id="inputFornecedor" name="inputFornecedor" placeholder="Digite o nome do fornecedor...">
                        <p id="mensagemInputFornecedor"></p>  
					</div>

                    <div class="form-group">
						<label for="cnpj_cpf">CPF/CNPJ:</label>
						<input type="text" class="form-control" id="inputCnpj_cpf" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18" name="inputCnpj_cpf" placeholder="Digite o CNPJ ou CPF do fornecedor...">
                        <p id="mensagemInputCnpj_cpf"></p>  
					</div>

                    <div class="form-group" id="campoSetor">
                        <input type="hidden" id="inputSetor" name="inputSetor" value="deposito">
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