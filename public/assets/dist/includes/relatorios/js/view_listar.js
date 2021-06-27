$('#btnPesquisar').click(function() {
    buscarListaDeRelatorios()
})

$('#btnSalvar').click(function(){
    salvarDados()
})

$('.btnCancelar').click(function(){
    fecharModal() 
 })

function buscarListaDeRelatorios() {
    var inputData = $('#inputData').val()

    $.ajax({
        url : '../relatoriosAjax/buscarListaRelatorios',
        type : 'POST',
        data : {inputData:inputData},
        beforeSend : function(){
            $('#listaDeRelatorios').html('<tr><td colspan="4" class="text-center">Pesquisando...</td></tr>')
            $('#divPesquisa *').attr('disabled', true)
        },
        success : function(data){ 
            $('#listaDeRelatorios').html(data)
            $('#divPesquisa *').attr('disabled', false)
        }
    })
}

function editarDados(id) {
    $.ajax({
        url : '../relatoriosAjax/getRelatorioById',
        type : 'POST',
        data : {id:id},
        dataType: 'json',
        success : function(data){ 
            $('#tituloModal').html('- EDITAR RELATÓRIO (#'+id+')')
            $('#inputId').val(id)
            $('#inputDescricao').val(data['relatorios'].descricao_relatorio)

            $("#modalEditarRelatorio").modal({
                show: true
            })
        }
    });
}

function salvarDados() {
    var inputId = $('#inputId').val()
    var inputDescricao = $('#inputDescricao').val()

    $.ajax({
        url : '../relatoriosAjax/editar',
        type : 'POST',
        dataType: 'json',
        data : {id:inputId, descricao:inputDescricao},
        beforeSend: function(){
            $('#inputDescricao').prop("disabled",true)
            $('.btnCancelar').prop("disabled",true)
            $('#btnSalvar').prop("disabled",true)
        },
        success : function(data){ 
            if(data['status']) {
                buscarListaDeRelatorios()
                fecharModal()
                mensagemAlert(1, data['mensagem'])
                
            }else {
                $('#mensagemInputDescricao').html('<small class="text-red">'+data['erro'].descricao_relatorio+'</small>');
            }

            $('#inputDescricao').prop("disabled",false)
            $('.btnCancelar').prop("disabled",false)
            $('#btnSalvar').prop("disabled",false)
        }
    });
}

function excluirDados(id) {
    if(confirm('Deseja Excluir esse RELATÓRIO?')) {
        $.ajax({
            url : '../relatoriosAjax/excluirRelatorio',
            type : 'POST',
            dataType: 'json',
            data : {inputId:id},
            success : function(data){ 
                if(data['status']) {
                    buscarListaDeRelatorios()
                    mensagemAlert(1,data['mensagem'])
                    
                }else {
                    buscarListaDeRelatorios()
                    mensagemAlert(0,data['mensagem'])
                }
            }
        });
    }
}

function fecharModal() {
    $('#modalEditarRelatorio').modal('hide')
    $('#tituloModal').html('- EDITAR RELATÓRIO')
    $('#inputDescricao').val('')
    $('#inputId').val(0)
    $('#mensagemInputDescricao').html('');
}

function mensagemAlert(tipo, mensagem) {
    if(tipo == 1) {
        Swal.fire({
            position: 'top-end',
            type: 'success',
            title: mensagem,
            showConfirmButton: false,
            timer: 2000
        });

        
    }else{
        Swal.fire({
            position: 'top-end',
            type: 'error',
            title: mensagem,
            showConfirmButton: false,
            timer: 2000
        });
    }
    
}