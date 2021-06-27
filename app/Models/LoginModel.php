<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\UsuariosModel;

class LoginModel extends Model {

    public function logar($usuario, $senha) {
        $usuarioModel = new UsuariosModel();

        $usuario = $usuarioModel->buscarUsuarioPeloNome($usuario);

        if(count($usuario) == 1) {
            if(password_verify($senha, $usuario[0]['senha_usuario'])):

                $dadosSessao = [
                    'isLogado' => true,
                    'usuario' => $usuario[0]['nome_usuario'],
                    'nivel_acesso' => $usuario[0]['nivel_acesso'],
                ];

                session()->set($dadosSessao);
                
                $dados = [
                    'status' => true
                ];
    
                return $dados;
            else:
                $dados = [
                    'status' => false,
                    'erroUsuario' => '',
                    'erroSenha' => '* Senha Invalida!'
                ];
    
                return $dados;
            endif;
        }else {
            $dados = [
                'status' => false,
                'erroUsuario' => '* Usuário não Encontrado!',
                'erroSenha' => ''
            ];

            return $dados;
        }
    }


}