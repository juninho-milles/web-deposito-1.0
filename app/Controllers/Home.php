<?php

namespace App\Controllers;

class Home extends BaseController {

	public function index() {
		$dados = [
			'tela' => 'view_home',
			'pagina' => 'HOME'
		];

		return view('view_index', $dados);
	}

}
