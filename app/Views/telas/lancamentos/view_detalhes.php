<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2><i class="fa fa-file-text"></i> #<?= $lancamento['id_lancamento']?> - <?=$lancamento['nome_fornecedor']?></h2>
        </div>
    
        <div class="col-md-2"></div>
    
        <div class="col-md-2">
			<button type="button" class="btn btn-default pull-right h2 text-green" data-toggle="modal" data-target="#modalInputFile" id="btnAddNota"><i class="fa fa-file-pdf-o"></i> <b>ADICIONAR NOTA</b></button>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-10">
            <div class="box box-solid">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped">
					    <tbody>
						    <tr>
								<td><strong>FORNECEDOR:</strong></td>
							    <td class="text-primary text-bold"><?=$lancamento['nome_fornecedor']?></td>
							</tr>
							<tr>
								<td><strong>CONFERENTE:</strong></td>
								<td class="text-navy text-bold"><?=$lancamento['nome_conferente']?></td>
							</tr>
							<tr>
								<td><strong>SETOR:</strong></td>
							    <td class="text-bold text-purple"><?=$lancamento['nome_setor']?></td>
							</tr>

							<tr>
							    <td colspan="2"><hr></td>
							</tr>

							<tr>
								<td><strong>Nº DA NOTA:</strong></td>
							    <td><?=$lancamento['numero_nota']?></td>
							</tr>
							<tr>
								<td><strong>VALOR DA NOTA:</strong></td>
								<td>R$ <?=$lancamento['valor_nota']?></td>
							</tr>
							<tr>
								<td><strong>PESO DA NOTA:</strong></td>
								<td><?=$lancamento['peso_nota']?> Kg</td>
							</tr>

                            <tr>
							    <td colspan="2"><hr></td>
							</tr>

                            <tr>
								<td><strong>NOME DO MOTORISTA:</strong></td>
								<td><?=$lancamento['nome_motorista']?></td>
							</tr>
                            <tr>
								<td><strong>PLACA DO VEÍCULO:</strong></td>
								<td><?=$lancamento['placa_veiculo']?></td>
							</tr>

                            <tr>
							    <td colspan="2"><hr></td>
							</tr>

                            <tr>
								<td><strong>TAXA DE DESCARREGO:</strong></td>
							    <td>R$ <?=$lancamento['taxa_descarrego']?></td>
							</tr>
                            <tr>
								<td><strong>HORA DE ENTRADA:</strong></td>
							    <td><?=$lancamento['hora_entrada']?> Hs</td>
							</tr>
                            <tr>
								<td><strong>HORA DE SAÍDA:</strong></td>
							    <td><?=$lancamento['hora_saida']?> Hs</td>
							</tr>
                            <tr>
								<td><strong>DATA DE ENTRADA:</strong></td>
							    <td><?=date('d/m/Y',  strtotime($lancamento['data_entrada']))?> </td>
							</tr>

							<tr>
							    <td colspan="2"><hr></td>
							</tr>
					    </tbody>
				    </table>
					
                </div>
                <div class="box-footer text-center">
				<p class="text-left"><strong>OBSERVAÇÃO:</strong></p>
				<div class="well text-justify">
					<p><?=$lancamento['observacao']?></p>
				</div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="box box-solid">
				<div class="box-body text-center" id="divConteudo">
					
					<?php
					if($lancamento['arquivo_lancamento'] != ''):
					?>
						<button type="button" class="btn btn-default btn-block btn-xs text-green" id="btnAcessarPdf"><i class="fa fa-file-pdf-o"></i> ACESSAR NOTA</button>
					<?php
					else:
					?>
						<button type="button" style="display:none;"; class="btn btn-default btn-block btn-xs text-green" id="btnAcessarPdf"><i class="fa fa-file-pdf-o"></i> ACESSAR NOTA</button>

					<?php
					endif;
					?>
					
					

					<a href="<?=base_url('lancamentos/editar/'.$lancamento['id_lancamento'])?>" class="btn btn-default btn-block btn-xs text-yellow" id="btnEditar"><i class="fa fa-edit"></i> EDITAR</a>

					<button type="button" class="btn btn-default btn-block btn-xs text-red" id="btnExcluir" onclick="deletarLancamento(<?=$lancamento['id_lancamento']?>)"><i class="fa fa-trash"></i> EXCLUIR</button>

					<a href="<?=base_url('lancamentos')?>" class="btn btn-default btn-block btn-xs text-blue" id="btnVoltar"><i class="fa fa-reply-all"></i> VOLTAR</a>
				</div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="modalLancamentoDELETADO" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
    	<div class="modal-content">
            <div class="modal-body">
                
	            <div class="box-body text-center">
					<div id="mensagemSucesso" style="display: none;">
						<img src="<?=base_url()?>/assets/dist/img/sucess.gif" class="img-circle" alt="mensagem" width="100" height="100">
					</div>

					<div id="mensagemError" style="display: none;">
						<img src="<?=base_url()?>/assets/dist/img/error.gif" class="img-circle" alt="mensagem" width="100" height="100">
					</div>

                    <h3 id="mensagem"></h3>
	            </div>

	            <div class="box-footer text-center">
					<div id="divFooterSucesso" style="display: none;">
						<a href="<?=base_url('lancamentos')?>" class="btn bg-purple margin btn-sm" id="btnContinuar"><i class="fa fa-mail-reply-all"></i> LANÇAMENTOS</a>
					</div>

					<div id="divFooterError" style="display: none;">
						<a href="<?=base_url('lancamentos/detalhes/'.$lancamento['id_lancamento'])?>" class="btn bg-purple margin btn-sm" id="btnContinuar"><i class="fa fa-mail-reply-all"></i> RETORNAR</a>
					</div>
                </div>
            </div>
        </div>
   	</div>
</div>

<div class="modal fade" id="modalInputFile" data-backdrop="static" data-keyboard="false" style="display: none;">
    <div class="modal-dialog">
    	<div class="modal-content">
			<div class="modal-header">
            	<button type="button" class="close">
                	<span aria-hidden="true">×</span>
				</button>
                <h4 class="modal-title">- ADICIONAR NOTA FISCAL (PDF)</h4>
            </div>
            <div class="modal-body">
				<div class="row text-center">
					<canvas id="pdf-preview" width="150"></canvas>
					<br>
					<div id="pdf-loader">Carregando...</div>
					<br>
					<span id="pdf-name"><small>(vazio)</small></span>
				</div>
              
              	<hr>
				
				<div class="row text-center">
					<button class="btn btn-default text-blue" id="upload-dialog"><i class="fa fa-search"></i> BUSCAR PDF</button>
					

					<button class="btn btn-default text-blue" id="upload-button"><i class="fa fa-check"></i> SALVAR</button>
					<button class="btn btn-default text-red" id="cancel-pdf"><i class="fa fa-remove"></i> CANCELAR</button>
					<form method="POST" enctype="multipart/form-data" id="formulario">
						<input type="file" id="pdf-file" name="pdf" accept="application/pdf">
						<input type="hidden" name="idLancamento" id="idLancamento" value="<?=$lancamento['id_lancamento']?>">
					</form>
				</div>
            </div>
        </div>
   	</div>
</div>