<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h2><i class="fa fa-bar-chart"></i> RELATÓRIOS</h2>
        </div>
    
        <div class="col-md-5"></div>
    
        <div class="col-md-3">
            <a href="<?=base_url('relatorios/listar')?>" class="btn btn-default pull-right h2 text-blue"><i class="fa fa-list"></i> <b>LISTA DE RELATÓRIOS</b></a>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-3">
            <div class="box box-solid">
				<div class="box-body" id="divPesquisa">
                    <div class="form-group">
                        <label>FORNECEDOR:</label>
                        <select class="form-control select2" style="width: 100%;" id="inputFornecedor" name="inputFornecedor">
                            <option selected="true" value="0"></option>
                            <?=$selectFornecedores;?>
                        </select>
                    </div>

                    <div class="form-group">
					    <label>Nº DA NOTA:</label>
                        <input type="number" class="form-control" id="inputNumeroDaNota" name="inputNumeroDaNota">
                    </div>

                    <div class="form-group">
                        <label>SETOR:</label>
                        <select class="form-control" id="inputSetor" name="inputSetor">
                            <option selected="true" value="0"></option>
                            <?=$selectSetores;?>
                        </select>
                    </div>

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
                <div class="box-body table-responsive no-padding" style="position: relative; height: 350px;">
                    <table class="table table-hover table-bordered">
                        <thead style="background-color: #182226; color: #FFF">
                            <tr>
                                <th style="width: 3%;" class="text-center">#ID</th>
                                <th class="text-center">FORNECEDOR</th>
                                <th class="text-center">Nº DA NOTA</th>
                                <th class="text-center">CONFERENTE</th>
                                <th class="text-center">SETOR</th>
                                <th class="text-center">DATA DE ENTRADA</th>
                                <th style="width: 10%;" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody id="listaDeLancamentos">   
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-bordered">
                        <thead style="background-color: #182226; color: #FFF">
                            <tr>
                                <th style="width: 3%;" class="text-center">#</th>
                                <th class="text-center">MOTORISTA</th>
                                <th class="text-center">PLACA</th>
                                <th class="text-center">Nº NOTA FISCAL</th>
                                <th class="text-center">FORNECEDOR</th>
                                <th class="text-center">PESO</th>
                                <th class="text-center">R$ VALOR</th>
                                <th class="text-center">ENTRADA</th>
                                <th class="text-center">SAÍDA</th>
                                <th class="text-center">RECEBEDOR</th>
                                <th class="text-center">TAXA DESCARREGO</th>
                                <th style="width: 10%;" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody id="listaDeLancamentoRelatorio">   
                            <tr>
                                <td colspan="13" class="text-center">Relatório Vazio</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer text-center" id="footer">
                    
                </div>
            </div>
        </div>
    </div>
</div>
