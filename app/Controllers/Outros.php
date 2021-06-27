<?php

namespace App\Controllers;

use App\Models\FornecedorModel;
use App\Models\OutrosModel;
use Mpdf\Mpdf;

class Outros extends BaseController {

	public function index() {
		$dados = [
			'tela' => 'outros/view_index',
			'pagina' => 'OUTROS'
		];

		return view('view_index', $dados);
	}

	public function recibo_descarrego() {
		$fornecedoresModel = new FornecedorModel();
		$outrosModel = new OutrosModel();

		$dados = [
			'tela' => 'outros/view_recibo_descarrego',
			'js' => 'outros/includes/js/view_recibo_descarrego_js',
			'css' => 'outros/includes/css/view_recibo_descarrego_css',
			'selectFornecedores' => $fornecedoresModel->montarSelectFornecedores(0),
			'listaDeRecibos' => $outrosModel->retornaListaDeRecibos(),
			'pagina' => 'OUTROS'
		];

		return view('view_index', $dados);
	}

	public function imprimir($id){
	
		$outrosModel = new OutrosModel();
	
		$dados['dadosRecibo'] = $outrosModel->find($id);

				
        $mpdf = new Mpdf(['orientation' => '']);
        $html = view('telas/outros/view_imprimir_recibo',$dados,[]);
		$mpdf->WriteHTML($html);
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output('recibo_'.retornaDataAtual().'.pdf','I');
		
	}
}
