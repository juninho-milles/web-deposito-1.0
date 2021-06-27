function deletarLancamento(id) {
    if(confirm('Deseja Excluir esse LANÇAMENTO?')) {
        $.ajax({
            url : '../../lancamentosAjax/delete',
            type : 'POST',
            dataType: 'json',
            data : {id:id},
            success : function(data){ 
                if(data['status']) {
                    
                    LancamentoDELETADO(1,data['mensagem']);
                    
                }else {
                    
                    LancamentoDELETADO(0,data['mensagem']);
                }
            }
        });
    }
}

function LancamentoDELETADO(tipo, mensagem) {
    if(tipo == 1) {
        $('#mensagemSucesso').css({"display":"block"})
        $('#mensagem').html(mensagem)
        $('#divFooterSucesso').css({"display":"block"})
    }else {
        $('#mensagemError').css({"display":"block"})
        $('#mensagem').html(mensagem)
        $('#divFooterError').css({"display":"block"})
    }

    $("#modalLancamentoDELETADO").modal({
        show: true
    });
}

