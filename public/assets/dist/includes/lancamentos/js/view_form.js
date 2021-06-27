$('.select2').select2()

$('#btnSalvar').click(function() {
    salvarDados()
})

function salvarDados() {
    var dadosLancamento = {
        'inputFornecedor' : $('#inputFornecedor').val(),
        'inputConferente' : $('#inputConferente').val(),
        'inputSetor' : $('#inputSetor').val(),
        'inputNumeroDaNota' : $('#inputNumeroDaNota').val(),
        'inputValorDaNota' : $('#inputValorDaNota').val(),
        'inputPesoDaNota' : $('#inputPesoDaNota').val(),
        'inputMotorista' : $('#inputMotorista').val(),
        'inputPlacaDoVeiculo' : $('#inputPlacaDoVeiculo').val(),
        'inputTaxaDescarrego' : $('#inputTaxaDescarrego').val(),
        'inputHoraEntrada' : $('#inputHoraEntrada').val(),
        'inputHoraSaida' : $('#inputHoraSaida').val(),
        'inputDataEntrada' : $('#inputDataEntrada').val(),
        'inputObservacao' : $('#inputObservacao').val(),
        'inputId' : $('#inputId').val()
    }

    if($('#inputId').val() != 0){
        var url = '../../lancamentosAjax/salvar'
    }else {
        var url = '../lancamentosAjax/salvar'
    }

    $.ajax({
        url : url,
        type : 'POST',
        data : {dados:dadosLancamento},
        dataType: 'json',
        beforeSend : function(){
            $('#divConteudo *').attr('disabled', true)
        },
        success : function(data){ 
            if(data['status']) {
                mensagemModal(data['id'], data['mensagem'])
            }else {
                $('#mensagemInputNumeroDaNota').html(mensagensDeErro(data['erro'].numero_nota))
                $('#mensagemInputValorDaNota').html(mensagensDeErro(data['erro'].valor_nota))
                $('#mensagemInputMotorista').html(mensagensDeErro(data['erro'].nome_motorista))
                $('#mensagemInputHoraEntrada').html(mensagensDeErro(data['erro'].hora_entrada))
                $('#mensagemInputHoraSaida').html(mensagensDeErro(data['erro'].hora_saida))
                $('#mensagemInputDataEntrada').html(mensagensDeErro(data['erro'].data_entrada))
                $('#mensagemInputObservacao').html(mensagensDeErro(data['erro'].observacao))
            }

            $('#divConteudo *').attr('disabled', false)
        }
    })
}

function mensagensDeErro(mensagem) {
    if(mensagem) {
        return '<small class="text-red">'+mensagem+'</small>'
    }else {
        return ''
    }
}

function mensagemModal(referencia, mensagem) {
    $('#mensagemModal').html(mensagem);

    if($('#inputId').val() != 0) {
        var botoes = '<a href="../../lancamentos/detalhes/'+referencia+'" class="btn bg-olive margin btn-sm" id="linkVizualizar"><i class="fa fa-eye"></i> ACESSAR LANÇAMENTO</a>';
        
        $('#divBtns').html(botoes);
    }else {
         var botoes = '<a href="../lancamentos/cadastrar" class="btn bg-purple margin btn-sm" id="btnContinuar"><i class="fa fa-mail-reply-all"></i> CONTINUAR CADASTRANDO</a>';
         botoes += '<a href="../lancamentos/detalhes/'+referencia+'" class="btn bg-olive margin btn-sm" id="linkVizualizar"><i class="fa fa-eye"></i> ACESSAR LANÇAMENTO</a>';
         
         $('#divBtns').html(botoes);
    }

    $("#modalmensagemLancamento").modal({
        show: true
    });
}