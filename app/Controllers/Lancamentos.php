<?php

namespace App\Controllers;

use App\Models\ConferenteModel;
use App\Models\FornecedorModel;
use App\Models\LancamentoModel;
use App\Models\SetorModel;

class Lancamentos extends BaseController {

	protected $lancamentosModel;

	public function __construct() {
		$this->lancamentosModel = new LancamentoModel();
		
	}
	public function index() {
		$setorModel = new SetorModel();
		$conferenteModel = new ConferenteModel();
		$fornecedorModel = new FornecedorModel();

		$dados = [
			'tela' => 'lancamentos/view_index',
			'css' => 'lancamentos/includes/css/view_index_css',
            'js' => 'lancamentos/includes/js/view_index_js',
			'pagina' => 'LANÇAMENTOS',
			'selectFornecedores' => $fornecedorModel->montarSelectFornecedores(0),
			'selectConferentes' => $conferenteModel->montarSelectConferentes(0),
			'selectSetores' => $setorModel->montarSelectSetores(0),
			'listaLancamentos' => $this->lancamentosModel->retornaListaDeLancamentos()
		];

		return view('view_index', $dados);
	}

    public function cadastrar() {
		$setorModel = new SetorModel();
		$conferenteModel = new ConferenteModel();
		$fornecedorModel = new FornecedorModel();

        $dados = [
			'tela' => 'lancamentos/view_form',
			'css' => 'lancamentos/includes/css/view_form_css',
            'js' => 'lancamentos/includes/js/view_form_js',
			'pagina' => 'LANÇAMENTOS',
			'selectFornecedores' => $fornecedorModel->montarSelectFornecedores(0),
			'selectConferentes' => $conferenteModel->montarSelectConferentes(0),
			'selectSetores' => $setorModel->montarSelectSetores(0)
		];

		return view('view_index', $dados);
    }

	public function editar($id=0) {
		if($id == 0):
			return redirect()->to(base_url('lancamentos/cadastrar'));
		endif;

		$setorModel = new SetorModel();
		$conferenteModel = new ConferenteModel();
		$fornecedorModel = new FornecedorModel();

		$lancamento = $this->lancamentosModel->getById($id);

        $dados = [
			'tela' => 'lancamentos/view_form',
			'css' => 'lancamentos/includes/css/view_form_css',
            'js' => 'lancamentos/includes/js/view_form_js',
			'pagina' => 'LANÇAMENTOS',
			'dadosLancamento' => $lancamento,
			'selectFornecedores' => $fornecedorModel->montarSelectFornecedores($lancamento['fornecedor_id_fornecedor']),
			'selectConferentes' => $conferenteModel->montarSelectConferentes($lancamento['conferente_id_conferente']),
			'selectSetores' => $setorModel->montarSelectSetores($lancamento['setor_id_setor'])
		];

		return view('view_index', $dados);
	}

	public function detalhes($id=0) {
		if($id == 0):
			return redirect()->to(base_url('lancamentos'));
		endif;

		$dados = [
			'tela' => 'lancamentos/view_detalhes',
			'pagina' => 'LANÇAMENTOS',
			'css' => 'lancamentos/includes/css/view_detalhes_css',
			'js' => 'lancamentos/includes/js/view_detalhes_js',
			'lancamento' => $this->lancamentosModel->getById($id)
		];

		return view('view_index', $dados);
	}

}