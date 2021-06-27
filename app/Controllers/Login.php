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

}