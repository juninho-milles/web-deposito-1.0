$('.select2').select2()

$('#btnPesquisar').click(function() {
    
    buscarListaDeLancamentos()
})

function buscarListaDeLancamentos() {
    var dadosPesquisa = {
        'inputFornecedor' : $('#inputFornecedor').val(),
        'inputNumeroDaNota' : $('#inputNumeroDaNota').val(),
        'inputConferente' : $('#inputConferente').val(),
        'inputSetor' : $('#inputSetor').val(),
        'inputData' : $('#inputData').val()
    }

    $.ajax({
        url : './lancamentosAjax/pesquisarLancamento',
        type : 'POST',
        data : {dados:dadosPesquisa},
        beforeSend : function(){
            $('#listaDeConferentes').html('<tr><td colspan="7" class="text-center">Pesquisando...</td></tr>')
            $('#divPesquisa *').attr('disabled', true)
        },
        success : function(data){ 
            $('#listaDeConferentes').html(data)
            $('#divPesquisa *').attr('disabled', false)
        }
    })
}

