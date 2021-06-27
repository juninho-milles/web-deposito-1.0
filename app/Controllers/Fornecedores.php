<?php

namespace App\Controllers;

use App\Models\FornecedorModel;

class Fornecedores extends BaseController {

    protected $fornecedorModel;

	public function __construct() {
		$this->fornecedorModel = new FornecedorModel();
	}

	public function index() {
		$dados = [
			'tela' => 'fornecedores/view_index',
			'pagina' => 'FORNECEDORES'
		];

		return view('view_index', $dados);
	}

    public function deposito() {
        $dados = [
			'tela' => 'fornecedores/view_deposito',
            'js' => 'fornecedores/includes/js/view_index_js',
			'css' => 'fornecedores/includes/css/view_index_css',
			'pagina' => 'FORNECEDORES',
            'listaDeFornecedores' => $this->fornecedorModel->retornaListaDeFornecedoresDeposito()
		];

		return view('view_index', $dados);
    }

    public function hortifruti() {
		$dados = [
			'tela' => 'fornecedores/view_hortifruti',
            'js' => 'fornecedores/includes/js/view_index_js',
			'css' => 'fornecedores/includes/css/view_index_css',
			'pagina' => 'FORNECEDORES',
            'listaDeFornecedores' => $this->fornecedorModel->retornaListaDeFornecedoresHorti()
		];

		return view('view_index', $dados);
    }

}
