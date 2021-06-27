$('.select2').select2()

$('.btnCancelar').click(function() {
    fecharModal()
})

$("#add-campo").click(function () {
	var dados = '<li><div class="form-group text-center"><button class="btn btn-default btn-xs text-red removeItem">X REMOVER</button><input type="number" class="form-control inputNumeroDaNota" id="inputNumeroDaNota" name="inputNumeroDaNota[]" placeholder="Digite o número da nota..."></div></li>';

	$("#formulario").append(dados);
})

$('#formulario').on('click', '.removeItem', function(e) {
    e.preventDefault();

    $(this).parent().remove();
})

$('#inputFornecedor').change(function (){
	var inputFornecedor = $('#inputFornecedor').val();

	if(inputFornecedor == 0) {
		$('#inputCnpj_cpf').val('')
	}else {
		$.ajax({
			url : "../outrosAjax/buscarFornecedor",
			   type : 'POST',
               dataType: 'json',
			   data : {inputFornecedor:inputFornecedor},
			success : function(data){ 
				$('#inputCnpj_cpf').val(data['fornecedores']['cnpj_cpf']);
			}
		})
	}
})

$('#btnGerarRecibo').click(function() {
    gerarRecibo()
})

$('#btnPesquisar').click(function() {
    pesquisarListaDeRecibos()
})

function gerarRecibo() {
    let inputNumeroDaNota = $('.inputNumeroDaNota').append()
    let inputFornecedor = $('#inputFornecedor').val()
    let inputCnpj_cpf = $('#inputCnpj_cpf').val()
    let inputValor = $('#inputValor').val()

    let dadosNumeroNota = []

    for(i=0; i < inputNumeroDaNota.length; i++) {
        dadosNumeroNota.push(inputNumeroDaNota[i].value)
    }

    $.ajax({
        url : "../outrosAjax/gerarRecibo",
            type : 'POST',
            data : {inputFornecedor:inputFornecedor, inputCnpj_cpf:inputCnpj_cpf, inputValor:inputValor, dadosNumeroNota:dadosNumeroNota},
            beforeSend : function() {
                $('.box-body *').attr('disabled', true)
            },
            success : function(data){ 
                $('.box-body *').attr('disabled', false)
                buscarListaDeRecibos()
                window.open(data, '_blank')
        }
    })
}

function excluirDados(id) {
    if(confirm('Deseja Excluir esse RECIBO?')) {
        $.ajax({
            url : '../outrosAjax/delete',
            type : 'POST',
            dataType: 'json',
            data : {id:id},
            success : function(data){ 
                if(data['status']) {
                    buscarListaDeRecibos();
                    mensagemAlert(1,data['mensagem']);
                    
                }else {
                    buscarListaDeRecibos();
                    mensagemAlert(0,data['mensagem']);
                }
            }
        });
    }
}

function fecharModal() {
    document.location.reload(true)
}

function buscarListaDeRecibos() {
    $.ajax({
        url : '../outrosAjax/buscarListaDeRecibos',
        type : 'POST',
        success : function(data){ 
            $('#listaDeRecibos').html(data);
        }
    });
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

function pesquisarListaDeRecibos() {
    let inputData = $('#inputData').val()

    $.ajax({
        url : '../outrosAjax/pesquisarListaRecibos',
        type : 'POST',
        data : {inputData:inputData},
        beforeSend : function(){
            $('#listaDeRecibos').html('<tr><td colspan="3" class="text-center">Pesquisando...</td></tr>')
            $('#divPesquisa *').attr('disabled', true)
        },
        success : function(data){ 
            $('#listaDeRecibos').html(data)
            $('#divPesquisa *').attr('disabled', false)
        }
    })
}


//==================== Formatar VALOR ====================//
$('#inputValor').keyup(function() {
	var v = this.value.replace(/\D/g,'');
	v = (v/100).toFixed(2) + '';
	v = v.replace(".", ",");
	v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
	v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
	this.value = v;
})

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