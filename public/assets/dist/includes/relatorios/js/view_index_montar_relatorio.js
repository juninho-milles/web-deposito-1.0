$('.select2').select2()

var listaRelatorio = []
var lancamento = {}

$('#btnPesquisar').click(function() {
    
    buscarListaDeLancamentos()
})

function buscarListaDeLancamentos() {
    var dadosPesquisa = {
        'inputFornecedor' : $('#inputFornecedor').val(),
        'inputNumeroDaNota' : $('#inputNumeroDaNota').val(),
        'inputSetor' : $('#inputSetor').val(),
        'inputData' : $('#inputData').val()
    }

    $.ajax({
        url : './relatoriosAjax/pesquisarLancamentos',
        type : 'POST',
        data : {dados:dadosPesquisa},
        beforeSend : function(){
            $('#listaDeLancamentos').html('<tr><td colspan="7" class="text-center">Pesquisando...</td></tr>')
            $('#divPesquisa *').attr('disabled', true)
        },
        success : function(data){ 
            $('#listaDeLancamentos').html(data)
            $('#divPesquisa *').attr('disabled', false)
        }
    })
}

//==============================================================================================
function exibirDados() {
    listaRelatorio = listaRelatorio.filter(function (a) {
        return !this[JSON.stringify(a)] && (this[JSON.stringify(a)] = true);
    }, Object.create(null))

    var lista = '';

    if(listaRelatorio.length == 0) {
        lista = '<tr><td colspan="12" class="text-center">Relatório Vazio</td></tr>'
        $('#footer').html('')

    }else {
        listaRelatorio.forEach(function (item, indice, array) {
            lista += '<tr>'
            
            lista += '<td class="text-center">'+(indice+1)+'</td>'
            lista += '<td class="text-center">'+item.nome_motorista+'</td>'
            lista += '<td class="text-center">'+item.placa_veiculo+'</td>'
            lista += '<td class="text-center">'+item.numero_nota+'</td>'
            lista += '<td class="text-center">'+item.nome_fornecedor+'</td>'
            lista += '<td class="text-center">'+item.peso_nota+'</td>'
            lista += '<td class="text-center">'+item.valor_nota+'</td>'
            lista += '<td class="text-center">'+item.hora_entrada+'</td>'
            lista += '<td class="text-center">'+item.hora_saida+'</td>'
            lista += '<td class="text-center">'+item.nome_conferente+'</td>'
            lista += '<td class="text-center">'+item.taxa_descarrego+'</td>'
            lista += '<td class="text-center"><button type="button" class="btn btn-default btn-xs text-blue" onClick="moverParaCima('+indice+')"><i class="glyphicon glyphicon-arrow-up"></i></button> <button type="button" class="btn btn-default btn-xs text-blue" onClick="moverParaBaixo('+indice+')"><i class="glyphicon glyphicon-arrow-down"></i></button> <button type="button" class="btn btn-default btn-xs text-red" onClick="remover('+indice+')"><i class="fa fa-remove"></i></button></td>'
            
            lista += '</tr>'
        });
        
       $('#footer').html('<button type="button" class="btn btn-default btn-xs text-blue" id="btnImprimir" onClick="imprimir()"><i class="fa fa-print"></i> IMPRIMIR RELATÓRIO</button>')
    }   
    
    $('#listaDeLancamentoRelatorio').html(lista)
    
}

function addItem(id) {
    $.ajax({
        url : './relatoriosAjax/buscarLancamentoId',
        type : 'POST',
        data : {id:id},
        dataType: 'json',
        success : function(data){ 
            lancamento = data
            listaRelatorio.push(lancamento)
            exibirDados()
        }
    });
}

function addTodosOsItens() {
   
    var listaId = $('.inputIdLancamento').append()

    for(i=0; i < listaId.length; i++) {
        addItem(listaId[i].value)
    }

    
}

function remover(indice) {
    
    listaRelatorio.splice(indice, 1)
    exibirDados()
}

function moverParaCima(indice) {
    let posicaoAtual = indice
    let posicaoFutura = indice-1

    if(posicaoAtual == 0) {
        posicaoFutura = 0
    }
    listaRelatorio.splice(posicaoFutura, 0, listaRelatorio.splice(posicaoAtual, 1)[0])

    exibirDados()
}

function moverParaBaixo(indice) {
    let posicaoAtual = indice
    let posicaoFutura = indice+1

    listaRelatorio.splice(posicaoFutura, 0, listaRelatorio.splice(posicaoAtual, 1)[0])

    exibirDados()
}

function imprimir() {
    $.ajax({
        url : './relatoriosAjax/imprimirRelatorio',
        type : 'POST',
        data : {relatorio:listaRelatorio},
        dataType: 'json',
        beforeSend : function(){
            $('#btnImprimir').attr('disabled', true)
        },
        success : function(data){ 
            window.open(data['link'], '_blank');
            $('#btnImprimir').attr('disabled', false)
        }
    });
}

