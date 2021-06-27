<div class="container">
    <div class="row">
        <div class="col-md-8">
        <?php
        if(isset($dadosLancamento)):
        ?>
        <h2><i class="fa fa-file-text"></i> EDITAR LANÇAMENTO #<?=$dadosLancamento['id_lancamento']?></h2>
        <?php
        else:
        ?>
        <h2><i class="fa fa-file-text"></i> CADASTRAR LANÇAMENTO</h2>
        <?php
        endif;
        ?>
        </div>
    
        <div class="col-md-2"></div>
    
        <div class="col-md-2">
        </div>
    </div>

    <hr>

    <div class="box box-solid" id="divConteudo">
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>FORNECEDOR:</label>
                        <select class="form-control select2" style="width: 100%;" id="inputFornecedor" name="inputFornecedor">
                            <?=$selectFornecedores?>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>CONFERENTE:</label>
                        <select class="form-control" id="inputConferente" name="inputConferente">
                            <?=$selectConferentes?>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>SETOR:</label>
                        <select class="form-control" id="inputSetor" name="inputSetor">
                            <?=$selectSetores?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
					    <label>Nº DA NOTA:</label>
                        <?php
                        if(isset($dadosLancamento['numero_nota'])):
                        ?>
						    <input type="number" class="form-control" id="inputNumeroDaNota" name="inputNumeroDaNota" value="<?=$dadosLancamento['numero_nota']?>" placeholder="Digite o número da nota...">
                        <?php
                        else:
                        ?>
						    <input type="number" class="form-control" id="inputNumeroDaNota" name="inputNumeroDaNota" placeholder="Digite o número da nota...">
                        <?php
                        endif;
                        ?>
                        <p id="mensagemInputNumeroDaNota"></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
					    <label>VALOR DA NOTA:</label>
                        <?php
                        if(isset($dadosLancamento['valor_nota'])):
                        ?>
						    <input type="text" class="form-control" id="inputValorDaNota" name="inputValorDaNota" value="<?=$dadosLancamento['valor_nota']?>" placeholder="R$ 0,00">
                        <?php
                        else:
                        ?>
						    <input type="text" class="form-control" id="inputValorDaNota" name="inputValorDaNota" placeholder="R$ 0,00">
                        <?php
                        endif;
                        ?>
                        <p id="mensagemInputValorDaNota"></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
					    <label>PESO DA NOTA:</label>
                        <?php
                        if(isset($dadosLancamento['peso_nota'])):
                        ?>
						<input type="text" class="form-control" id="inputPesoDaNota" name="inputPesoDaNota" value="<?=$dadosLancamento['peso_nota']?>" placeholder="0.000 Kg">
                        <?php
                        else:
                        ?>
						<input type="text" class="form-control" id="inputPesoDaNota" name="inputPesoDaNota" placeholder="0.000 Kg">
                        <?php
                        endif;
                        ?>
					</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
					    <label>NOME DO MOTORISTA:</label>
                        <?php
                        if(isset($dadosLancamento['nome_motorista'])):
                        ?>
						    <input type="text" class="form-control" id="inputMotorista" name="inputMotorista" value="<?=$dadosLancamento['nome_motorista']?>" placeholder="Digite o nome do motorista...">
                        <?php
                        else:
                        ?>
						    <input type="text" class="form-control" id="inputMotorista" name="inputMotorista" placeholder="Digite o nome do motorista...">
                        <?php
                        endif;
                        ?>
                        <p id="mensagemInputMotorista"></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
					    <label>PLACA DO VEÍCULO:</label>
                        <?php
                        if(isset($dadosLancamento['placa_veiculo'])):
                        ?>
						    <input type="text" class="form-control" id="inputPlacaDoVeiculo" name="inputPlacaDoVeiculo" value="<?=$dadosLancamento['placa_veiculo']?>" placeholder="Digite a placa do veículo...">
                        <?php
                        else:
                        ?>
						    <input type="text" class="form-control" id="inputPlacaDoVeiculo" name="inputPlacaDoVeiculo" placeholder="Digite a placa do veículo...">
                        <?php
                        endif;
                        ?>
					    <p id="mensagemInputPlacaDoVeiculo"></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
					    <label>TAXA DE DESCARREGO:</label>
                        <?php
                        if(isset($dadosLancamento['taxa_descarrego'])):
                        ?>
						    <input type="text" class="form-control" id="inputTaxaDescarrego" name="inputTaxaDescarrego" value="<?=$dadosLancamento['taxa_descarrego']?>" placeholder="R$ 0,00">
                        <?php
                        else:
                        ?>
						    <input type="text" class="form-control" id="inputTaxaDescarrego" name="inputTaxaDescarrego" placeholder="R$ 0,00">
                        <?php
                        endif;
                        ?>
					</div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
					    <label>HORA DE ENTRADA:</label>
                        <?php
                        if(isset($dadosLancamento['hora_entrada'])):
                        ?>
						    <input type="time" class="form-control" id="inputHoraEntrada" name="inputHoraEntrada" value="<?=$dadosLancamento['hora_entrada']?>" placeholder="00:00 Hs">
                        <?php
                        else:
                        ?>
						    <input type="time" class="form-control" id="inputHoraEntrada" name="inputHoraEntrada" placeholder="00:00 Hs">
                        <?php
                        endif;
                        ?>
                        <p id="mensagemInputHoraEntrada"></p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
					    <label>HORA DE SAÍDA:</label>
                        <?php
                        if(isset($dadosLancamento['hora_saida'])):
                        ?>
						    <input type="time" class="form-control" id="inputHoraSaida" name="inputHoraSaida" value="<?=$dadosLancamento['hora_saida']?>" placeholder="00:00 Hs">
                        <?php
                        else:
                        ?>
						    <input type="time" class="form-control" id="inputHoraSaida" name="inputHoraSaida" placeholder="00:00 Hs">
                        <?php
                        endif;
                        ?>
                        <p id="mensagemInputHoraSaida"></p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
					    <label>DATA DE ENTRADA:</label>
                        <?php
                        if(isset($dadosLancamento['data_entrada'])):
                        ?>
						    <input type="date" class="form-control" id="inputDataEntrada" name="inputDataEntrada" value="<?=$dadosLancamento['data_entrada']?>">
                        <?php
                        else:
                        ?>
						    <input type="date" class="form-control" id="inputDataEntrada" name="inputDataEntrada">
                        <?php
                        endif;
                        ?>
                        <p id="mensagemInputDataEntrada"></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descricaoSetor">OBSERVAÇÃO:</label>
                        <?php
                        if(isset($dadosLancamento['observacao'])):
                        ?>
                            <textarea style="resize: none" class="form-control" id="inputObservacao" name="inputObservacao" rows="3" maxlength="400" placeholder="Digite uma observação sobre o lançamento..."><?=$dadosLancamento['observacao']?></textarea>
                        <?php
                        else:
                        ?>
                            <textarea style="resize: none" class="form-control" id="inputObservacao" name="inputObservacao" rows="3" maxlength="400" placeholder="Digite uma observação sobre o lançamento..."></textarea>
                        <?php
                        endif;
                        ?>
                        <p id="mensagemInputObservacao"></p>
                    </div>
                </div>
            </div>
            <?php
            if(isset($dadosLancamento['id_lancamento'])):
            ?>
                <input type="hidden" id="inputId" name="inputId" value="<?=$dadosLancamento['id_lancamento']?>">
            <?php
            else:
            ?>
                <input type="hidden" id="inputId" name="inputId" value="0">
            <?php
            endif;
            ?>
        </div>

        <div class="box-footer text-center">
            <button type="button" class="btn btn-default text-blue" id="btnSalvar"><i class="fa fa-check"></i> SALVAR</button>
            <?php
            if(isset($dadosLancamento['id_lancamento'])):
            ?>
                <a href="<?=base_url('lancamentos/detalhes/'.$dadosLancamento['id_lancamento'])?>" class="btn btn-default text-red btnCancelar"><i class="fa fa-remove"></i> CANCELAR</a>
            <?php
            else:
            ?>
                <a href="<?=base_url('lancamentos')?>" class="btn btn-default text-red btnCancelar"><i class="fa fa-remove"></i> CANCELAR</a>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>


<div class="modal fade" id="modalmensagemLancamento" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
    	<div class="modal-content">
            <div class="modal-body">
                
	            <div class="box-body text-center">
                    <img src="<?=base_url()?>/assets/dist/img/sucess.gif" class="img-circle" alt="sucesso" width="100" height="100">
                    <h3 id="mensagemModal"></h3>
	            </div>

	            <div class="box-footer text-center" id="divBtns">
                    
                    
                </div>
            </div>
        </div>
   	</div>
</div>