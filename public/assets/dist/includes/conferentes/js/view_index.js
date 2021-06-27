$('.btnCancelar').click(function(){
   fecharModal(); 
});

$('#btnSalvar').click(function(params){
    var inputNome = $('#inputNome').val();
    var inputId = $('#inputId').val();

    salvarDados(inputId, inputNome);
});

function salvarDados(id, nome) {
    $.ajax({
        url : './conferentesAjax/salvar',
        type : 'POST',
        dataType: 'json',
        data : {id:id, nome:nome},
        beforeSend: function(){
            controleElementos(1);
        },
        success : function(data){ 
            if(data['status']) {
                buscarListaDeConferentes();
                fecharModal();
                controleElementos(0);
                mensagemAlert(1, data['mensagem']);
                
            }else {
                $('#mensagemInputNome').html('<small class="text-red">'+data['erro'].nome_conferente+'</small>');
                controleElementos(0);
            }
        }
    });
}

function buscarListaDeConferentes() {
    $.ajax({
        url : './conferentesAjax/getListaDeConferentes',
        type : 'POST',
        success : function(data){ 
            $('#listaDeConferentes').html(data);
        }
    });
}

function editarDados(id) {
    $.ajax({
        url : './conferentesAjax/getConferenteById',
        type : 'POST',
        data : {id:id},
        dataType: 'json',
        success : function(data){ 
            if(data['conferentes'] == null) {
                $("#modalSalvarConferente").modal({
                    show: true
                });
            }else {
                $('#tituloModal').html('- EDITAR CONFERENTE (#'+id+')');
                $('#inputId').val(id);
                $('#inputNome').val(data['conferentes'].nome_conferente);

                $("#modalSalvarConferente").modal({
                    show: true
                });

            }
        }
    });
}

function excluirDados(id) {
    if(confirm('Deseja Excluir esse CONFERENTE?')) {
        $.ajax({
            url : './conferentesAjax/delete',
            type : 'POST',
            dataType: 'json',
            data : {id:id},
            success : function(data){ 
                if(data['status']) {
                    buscarListaDeConferentes();
                    mensagemAlert(1,data['mensagem']);
                    
                }else {
                    buscarListaDeConferentes();
                    mensagemAlert(0,data['mensagem']);
                }
            }
        });
    }
}

function fecharModal() {
    $('#modalSalvarConferente').modal('hide');
    $('#tituloModal').html('- CADASTRAR CONFERENTE');
    $('#inputNome').val('');
    $('#inputId').val(0);
    $('#mensagemInputNome').html('');
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

function controleElementos(status) {
    if(status == 1) {
        $('#inputNome').prop("disabled",true);
        $('.btnCancelar').prop("disabled",true);
        $('#btnSalvar').prop("disabled",true);
    }else {
        $('#inputNome').prop("disabled",false);
        $('.btnCancelar').prop("disabled",false);
        $('#btnSalvar').prop("disabled",false);
    }
}