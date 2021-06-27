$('.btnCancelar').click(function(){
    fecharModal(); 
 });

 $('#btnSalvar').click(function(params){
    var inputNome = $('#inputSetor').val();
    var inputDescricao = $('#inputDescricao').val();
    var inputId = $('#inputId').val();

    salvarDados(inputId, inputNome, inputDescricao);
});

function salvarDados(id, nome, descricao) {
    $.ajax({
        url : './setoresAjax/salvar',
        type : 'POST',
        dataType: 'json',
        data : {id:id, nome:nome, descricao:descricao},
        beforeSend: function(){
            controleElementos(1);
        },
        success : function(data){ 
            if(data['status']) {
                buscarListaDeSetores();
                fecharModal();
                controleElementos(0);
                mensagemAlert(1, data['mensagem']);
            }else {
                if(data['erro'].nome_setor) {
                    $('#mensagemInputSetor').html('<small class="text-red">'+data['erro'].nome_setor+'</small>');
                }else {
                    $('#mensagemInputSetor').html('');
                }

                if(data['erro'].descricao_setor) {
                    $('#mensagemInputDescricao').html('<small class="text-red">'+data['erro'].descricao_setor+'</small>');
                }else {
                    $('#mensagemInputDescricao').html('');
                }
                
                controleElementos(0);
            }
        }
    });
}

function editarDados(id) {
    $.ajax({
        url : './setoresAjax/getSetorById',
        type : 'POST',
        data : {id:id},
        dataType: 'json',
        success : function(data){ 
            if(data['setores'] == null) {
                $("#modalSalvarSetor").modal({
                    show: true
                });
            }else {
                $('#tituloModal').html('- EDITAR SETOR (#'+id+')');
                $('#inputId').val(id);
                $('#inputSetor').val(data['setores'].nome_setor);
                $('#inputDescricao').val(data['setores'].descricao_setor);

                $("#modalSalvarSetor").modal({
                    show: true
                });

            }
        }
    });
}

function excluirDados(id) {
    if(confirm('Deseja Excluir esse SETOR?')) {
        $.ajax({
            url : './setoresAjax/delete',
            type : 'POST',
            dataType: 'json',
            data : {id:id},
            success : function(data){ 
                if(data['status']) {
                    buscarListaDeSetores();
                    mensagemAlert(1,data['mensagem']);
                    
                }else {
                    buscarListaDeSetores();
                    mensagemAlert(0,data['mensagem']);
                }
            }
        });
    }
}

function buscarListaDeSetores() {
    $.ajax({
        url : './setoresAjax/getListaDeSetores',
        type : 'POST',
        success : function(data){ 
            $('#listaDeSetores').html(data);
        }
    });
}

 function fecharModal() {
    $('#modalSalvarSetor').modal('hide');
    $('#tituloModal').html('- CADASTRAR SETOR');
    $('#inputSetor').val('');
    $('#inputDescricao').val('');
    $('#inputId').val(0);
    $('#mensagemInputSetor').html('');
    $('#mensagemInputDescricao').html('');
}

function controleElementos(status) {
    if(status == 1) {
        $('#inputSetor').prop("disabled",true);
        $('#inputDescricao').prop("disabled",true);
        $('.btnCancelar').prop("disabled",true);
        $('#btnSalvar').prop("disabled",true);
    }else {
        $('#inputSetor').prop("disabled",false);
        $('#inputDescricao').prop("disabled",false);
        $('.btnCancelar').prop("disabled",false);
        $('#btnSalvar').prop("disabled",false);
    }
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