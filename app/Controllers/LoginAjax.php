<?php

namespace App\Controllers;

use App\Models\LoginModel;

class LoginAjax extends BaseController {

	public function logar() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('login'));
        endif;

        $loginModel = new LoginModel();

        $inputUsuario = $this->request->getPost('inputUsuario');
        $inputSenha = $this->request->getPost('inputSenha');

        $campos = $this->validaCampos($inputUsuario, $inputSenha);

        if($campos['status']):
            echo json_encode($loginModel->logar($inputUsuario, $inputSenha));
        else:
            echo json_encode($campos);
        endif;
        
    }

    private function validaCampos($usuario, $senha) {
        if($usuario == '' && $senha == '') {
            $dados = [
                'status' => false,
                'erroUsuario' => '* Insira o nome de Usuário!',
                'erroSenha' => '* Insira a Senha!'
            ];

            return $dados;

        }elseif($usuario != '' && $senha == '') {
            $dados = [
                'status' => false,
                'erroUsuario' => '',
                'erroSenha' => '* Insira a Senha!'
            ];

            return $dados;

        }elseif($usuario == '' && $senha != '') {
            $dados = [
                'status' => false,
                'erroUsuario' => '* Insira o nome de Usuário!',
                'erroSenha' => ''
            ];

            return $dados;

        }else {
            $dados = [
                'status' => true,
                'erroUsuario' => $usuario,
                'erroSenha' => $senha
            ];

            return $dados;
        }
    }
}