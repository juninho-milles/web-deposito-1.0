<?php

namespace App\Controllers;

use App\Models\FornecedorModel;
use App\Models\RelatorioModel;
use App\Models\SetorModel;
use Mpdf\Mpdf;

class Relatorios extends BaseController {

	public function index() {
		$setorModel = new SetorModel();
		$fornecedorModel = new FornecedorModel();
		
		$dados = [
			'tela' => 'relatorios/view_index',
			'css' => 'relatorios/includes/css/view_index_css',
            'js' => 'relatorios/includes/js/view_index_js',
			'pagina' => 'RELATÓRIOS',
			'selectFornecedores' => $fornecedorModel->montarSelectFornecedores(0),
			'selectSetores' => $setorModel->montarSelectSetores(0),
		];

		return view('view_index', $dados);
	}

	public function listar() {
		$relatorioModel = new RelatorioModel();

		$dados = [
			'tela' => 'relatorios/view_listar',
			'css' => 'relatorios/includes/css/view_listar_css',
			'js' => 'relatorios/includes/js/view_listar_js',
			'pagina' => 'RELATÓRIOS',
			'listaDeRelatorio' => $relatorioModel->retornaListaDeRelatorios()
		];

		return view('view_index', $dados);
	}

	public function imprimir($id){
	
		$relatorioModel = new RelatorioModel();
	
		$dados['dadosRelatorio'] = $relatorioModel->getById($id);

				
        $mpdf = new Mpdf(['orientation' => 'L']);
        $html = view('telas/relatorios/view_imprimir_relatorio',$dados,[]);
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output('relatorio_'.retornaDataAtual().'.pdf','I');
		
	}

}
