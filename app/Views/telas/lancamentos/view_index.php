<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h2><i class="fa fa-file-text"></i> LANÇAMENTOS</h2>
        </div>
    
        <div class="col-md-5"></div>
    
        <div class="col-md-3">
            <a href="<?=base_url('lancamentos/cadastrar')?>" class="btn btn-default pull-right h2 text-green"><i class="fa fa-plus"></i> <b>CADASTRAR NOVO</b></a>
        </div>
    </div>

    <hr>

    <div class="box box-solid">
        <div class="box-header with-border" id="divPesquisa">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>FORNECEDOR:</label>
                        <select class="form-control select2" style="width: 100%;" id="inputFornecedor" name="inputFornecedor">
                            <option selected="true" value="0"></option>
                            <?=$selectFornecedores?>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
					    <label>Nº DA NOTA:</label>
                        <input type="number" class="form-control" id="inputNumeroDaNota" name="inputNumeroDaNota">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>CONFERENTE:</label>
                        <select class="form-control" id="inputConferente" name="inputConferente">
                           <option selected="true" value="0"></option>
                           <?=$selectConferentes?>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label>SETOR:</label>
                        <select class="form-control" id="inputSetor" name="inputSetor">
                            <option selected="true" value="0"></option>
                            <?=$selectSetores?>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
					    <label>DATA DE ENTRADA:</label>
                        <input type="date" class="form-control" id="inputData" name="inputData">
                    </div>
                </div>

            </div>

            <div class="row text-center">
                <button type="button" id="btnPesquisar" class="btn btn-default btn-flat text-green"><i class="fa fa-search"></i> <strong>PESQUISAR</strong></button>
            </div>
        </div>

        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
                <thead style="background-color: #182226; color: #FFF">
                    <tr>
                        <th style="width: 3%;" class="text-center">#ID</th>
                        <th class="text-center">FORNECEDOR</th>
                        <th class="text-center">Nº DA NOTA</th>
                        <th class="text-center">CONFERENTE</th>
                        <th class="text-center">SETOR</th>
                        <th class="text-center">DATA DE ENTRADA</th>
                        <th style="width: 10%;" class="text-center">AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="listaDeConferentes">   
                    <?=$listaLancamentos?>
                </tbody>
            </table>
        </div>
    </div>
</div>