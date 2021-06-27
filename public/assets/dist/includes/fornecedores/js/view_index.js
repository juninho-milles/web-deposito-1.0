$('.btnCancelar').click(function(){
    fecharModal(); 
 });

 $('#btnSalvar').click(function(params){
    var inputFornecedor = $('#inputFornecedor').val();
    var inputCnpj_cpf = $('#inputCnpj_cpf').val();
    var inputSetor = $('#inputSetor').val();
    var inputId = $('#inputId').val();

    salvarDados(inputId, inputFornecedor, inputCnpj_cpf, inputSetor);
});

$('#inputBuscarFornecedor').keyup(function(){
    var inputBusca = $(this).val();

    buscaDinamica(inputBusca);
});

function salvarDados(inputId, inputFornecedor, inputCnpj_cpf, inputSetor) {
    $.ajax({
        url : '../fornecedoresAjax/salvar',
        type : 'POST',
        dataType: 'json',
        data : {id:inputId, fornecedor:inputFornecedor, cnpj_cpf:inputCnpj_cpf, setor:inputSetor},
        beforeSend: function(){
            controleElementos(1);
        },
        success : function(data){ 
            if(data['status']) {
                buscarListaDeFornecedores();
                fecharModal();
                controleElementos(0);
                mensagemAlert(1, data['mensagem']);
                
            }else {
                if(data['erro'].nome_fornecedor) {
                    $('#mensagemInputFornecedor').html('<small class="text-red">'+data['erro'].nome_fornecedor+'</small>');
                }else {
                    $('#mensagemInputFornecedor').html('');
                }

                if(data['erro'].cnpj_cpf) {
                    $('#mensagemInputCnpj_cpf').html('<small class="text-red">'+data['erro'].cnpj_cpf+'</small>');

                }else {
                    $('#mensagemInputCnpj_cpf').html('');

                }
                
                controleElementos(0);
            }
        }
    });
}

function editarDados(id) {
    $.ajax({
        url : '../fornecedoresAjax/getFornecedorById',
        type : 'POST',
        data : {id:id},
        dataType: 'json',
        success : function(data){ 
            if(data['fornecedores'] == null) {
                $("#modalSalvarFornecedor").modal({
                    show: true
                });
            }else {
                $('#tituloModal').html('- EDITAR FORNECEDOR (#'+id+')');
                $('#inputId').val(id);
                $('#inputFornecedor').val(data['fornecedores'].nome_fornecedor);
                $('#inputCnpj_cpf').val(data['fornecedores'].cnpj_cpf);

                if(data['fornecedores'].setor_fornecedor == 'deposito') {
                    $('#campoSetor').html('<label>SETOR:</label> <select class="form-control" id="inputSetor" name="inputSetor"><option value="deposito" selected="true">DEPÓSITO</option><option value="hortifruti">HORTIFRUTI</option></select>');
                }else {
                    $('#campoSetor').html('<label>SETOR:</label> <select class="form-control" id="inputSetor" name="inputSetor"><option value="deposito">DEPÓSITO</option><option value="hortifruti" selected="true">HORTIFRUTI</option></select>');
                }

                $("#modalSalvarFornecedor").modal({
                    show: true
                });

            }
        }
    });
}

function excluirDados(id) {
    if(confirm('Deseja Excluir esse FORNECEDOR?')) {
        $.ajax({
            url : '../fornecedoresAjax/delete',
            type : 'POST',
            dataType: 'json',
            data : {id:id},
            success : function(data){ 
                if(data['status']) {
                    buscarListaDeFornecedores();
                    mensagemAlert(1,data['mensagem']);
                    
                }else {
                    buscarListaDeFornecedores();
                    mensagemAlert(0,data['mensagem']);
                }
            }
        });
    }
}

function buscarListaDeFornecedores() {
    var setor = $("#tituloFornecedor").val();

    $.ajax({
        url : '../fornecedoresAjax/getListaDeFornecedores',
        type : 'POST',
        data : {setor:setor},
        success : function(data){ 
            $('#listaDeFornecedores').html(data);
        }
    });
}

function buscaDinamica(dados){
	var dadosSetor = $('#inputBuscarFornecedorSetor').val();
	$.ajax({
		url : "../fornecedoresAjax/buscaDinamicaFornecedores",
	   	type : 'POST',
	   	data : {inputBusca:dados, inputSetor:dadosSetor},
	    success : function(data){ 
				    	$('#listaDeFornecedores').html(data);
	    		}
	});	
}

function fecharModal() {
    $('#modalSalvarFornecedor').modal('hide');
    $('#tituloModal').html('- CADASTRAR FORNECEDOR');
    $('#inputFornecedor').val('');
    $('#inputCnpj_cpf').val('');
    $('#inputId').val(0);
    $('#mensagemInputFornecedor').html('');
    $('#mensagemInputCnpj_cpf').html('');
    $('#campoSetor').html('<input type="hidden" id="inputSetor" name="inputSetor" value="'+$("#tituloFornecedor").val()+'">');
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
        $('#inputFornecedor').prop("disabled",true);
        $('#inputCnpj_cpf').prop("disabled",true);
        $('#inputSetor').prop("disabled",true);
        $('.btnCancelar').prop("disabled",true);
        $('#btnSalvar').prop("disabled",true);
    }else {
        $('#inputFornecedor').prop("disabled",false);
        $('#inputCnpj_cpf').prop("disabled",false);
        $('#inputSetor').prop("disabled",false);
        $('.btnCancelar').prop("disabled",false);
        $('#btnSalvar').prop("disabled",false);
    }
}

//==================== Formatar CNPJ E CPF ====================//
function mascaraMutuario(o,f){
    v_obj=o
    v_fun=f
    setTimeout('execmascara()',1)
}
 
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}
 
function cpfCnpj(v){
 
    //Remove tudo o que não é dígito
    v=v.replace(/\D/g,"")
 
    if (v.length <= 13) { //CPF
 
        //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
 
        //Coloca um ponto entre o terceiro e o quarto dígitos
        //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
 
        //Coloca um hífen entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
 
    } else { //CNPJ
 
        //Coloca ponto entre o segundo e o terceiro dígitos
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")
 
        //Coloca ponto entre o quinto e o sexto dígitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
 
        //Coloca uma barra entre o oitavo e o nono dígitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")
 
        //Coloca um hífen depois do bloco de quatro dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")
 
    }
 
    return v
 
}