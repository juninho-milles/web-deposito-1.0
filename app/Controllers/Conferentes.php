<?php

namespace App\Controllers;

use App\Models\ConferenteModel;

class Conferentes extends BaseController {

	protected $conferenteModel;

	public function __construct() {
		
		$this->conferenteModel = new ConferenteModel();
	}

	public function index() {
		
		$dados = [
			'tela' => 'conferentes/view_index',
			'js' => 'conferentes/includes/js/view_index_js',
			'css' => 'conferentes/includes/css/view_index_css',
			'pagina' => 'CONFERENTES',
			'listaDeConferentes' => $this->conferenteModel->retornaListaDeConferentes()
		];

		return view('view_index', $dados);
	}

}
