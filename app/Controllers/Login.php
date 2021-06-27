<?php

namespace App\Controllers;
use App\Models\UsuariosModel;

class Login extends BaseController {

	public function index() {
        if(session()->isLogado === true) {
            return redirect()->to(base_url());
        }

		$dados = [
			'pagina' => 'LOGIN'
		];

		return view('telas/view_login', $dados);
	}

    public function logout() {
        if(session()->destroy()) {
            return redirect()->to(base_url('login'));
        }else {
            return redirect()->to(base_url('login'));
        }
    }

    public function test() {

        $usuarioModel = new UsuariosModel();

        $dados = [
            'nome_usuario' => 'supervisor',
            'senha_usuario' => password_hash('12354', PASSWORD_DEFAULT),
            'nivel_acesso' => 'supervisor',
            'status_usuario' => 'ativo'
        ];

        if($usuarioModel->save($dados)):
            echo 'deu certo';
        else:
            echo 'deu erro';
        endif;
    }
}