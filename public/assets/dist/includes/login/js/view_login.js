window.onload = function() {
    $('#tela_login').fadeIn(3000)
}

function logar() {
    let inputUsuario = $('#inputUsuario').val()
    let inputSenha = $('#inputSenha').val()

    $.ajax({
        url : './LoginAjax/logar',
        type : 'POST',
        data : {inputUsuario:inputUsuario, inputSenha:inputSenha},
        dataType: 'json',
        beforeSend : function(){
            $('#divLogin *').attr('disabled', true)
        },
        success : function(data){ 
            if(data['status']) {
                window.location.href = "./home";
            }else {
                $('#mensagemInputUsuario').html('<small class="text-red">'+data['erroUsuario']+'</small>');
                $('#mensagemInputSenha').html('<small class="text-red">'+data['erroSenha']+'</small>');

                $('#divLogin *').attr('disabled', false)
            }
        }
    })
}