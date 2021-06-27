<?php

namespace App\Controllers;

use App\Models\SetorModel;

class Setores extends BaseController {

    protected $setorModel;

    public function __construct() {
        $this->setorModel = new SetorModel();
    }

	public function index() {
		$dados = [
			'tela' => 'setores/view_index',
            'js' => 'setores/includes/js/view_index_js',
			'css' => 'setores/includes/css/view_index_css',
			'pagina' => 'SETORES',
            'listaDeSetores' => $this->setorModel->retornaListaDeSetores()
		];

		return view('view_index', $dados);
	}
}
