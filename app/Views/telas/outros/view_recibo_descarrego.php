<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2><i class="fa fa-files-o"></i> RECIBO TAXA DE DESCARREGO</h2>
        </div>
    
        <div class="col-md-2"></div>
    
        <div class="col-md-4">
            <button type="button" class="btn btn-default pull-right h2 text-green" data-toggle="modal" data-target="#modalGerarRecibo"><i class="fa fa-plus"></i> <b>GERAR RECIBO</b></button>
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
                                <th style="width: 70%;" class="text-center">DESCRIÇÃO</th>
                                <th style="width: 10%;" class="text-center">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody id="listaDeRecibos">   
                            <?=$listaDeRecibos?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="modalGerarRecibo" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
    	<div class="modal-content">
        	<div class="modal-header">
            	<button type="button" class="close btnCancelar" aria-label="Close">
                  	<span aria-hidden="true">×</span>
				</button>
                <h4 class="modal-title" id="tituloModal">- GERAR RECIBO DE TAXA DE DESCARREGO</h4>
            </div>

            <div class="modal-body">
                
	            <div class="box-body">
                    <div class="form-group">
                        <label>FORNECEDOR:</label>
                        <select class="form-control select2" style="width: 100%;" id="inputFornecedor" name="inputFornecedor">
                            <?=$selectFornecedores?>
                        </select>
                    </div>

                    <div class="form-group">
						<label for="cnpj_cpf">CPF/CNPJ:</label>
						<input type="text" class="form-control" id="inputCnpj_cpf" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18" name="inputCnpj_cpf" placeholder="Digite o CNPJ ou CPF do fornecedor..."> 
					</div>

                    <div class="form-group">
                        <label>Nº DA NOTA:</label>
						<input type="number" class="form-control inputNumeroDaNota" id="inputNumeroDaNota" name="inputNumeroDaNota[]" placeholder="Digite o número da nota...">
					</div>

                    <div class="form-group text-center">
						<button type="button" class="btn btn-defaault btn-sm text-blue" id="add-campo"> + ADICIONAR</button>
					</div>

					<hr>

					<div id="formulario">
						
					</div>

					<hr>

                    <div class="form-group">
					    <label for="valor">VALOR:</label>
						<input type="text" class="form-control" id="inputValor" name="inputValor" placeholder="R$ 0,00">
					</div>
	            </div>

	            <div class="box-footer text-center">
                  	<button type="button" class="btn btn-default text-green" id="btnGerarRecibo"><i class="fa fa-print"></i> GERAR RECIBO</button>
                </div>
            </div>
        </div>
   	</div>
</div>