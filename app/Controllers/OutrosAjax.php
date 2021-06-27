<?php

namespace App\Controllers;

use App\Models\FornecedorModel;
use App\Models\OutrosModel;

class OutrosAjax extends BaseController {

	protected $fornecedorModel;

	public function __construct() {
		$this->fornecedorModel = new FornecedorModel();
	}

    public function buscarFornecedor() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('outros'));
        endif;

        $inputFornecedor = $this->request->getPost('inputFornecedor');

        $dados['fornecedores'] = esc($this->fornecedorModel->where('status_fornecedor', 'ativo')->find($inputFornecedor));

        echo json_encode($dados);
    }

    public function gerarRecibo() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('outros'));
        endif;

        $outrosModel = new OutrosModel();

        $inputFornecedor = $this->request->getPost('inputFornecedor');
        $inputCnpj_cpf = $this->request->getPost('inputCnpj_cpf');
        $inputValor = $this->request->getPost('inputValor');
        $dadosNumeroNota = $this->request->getPost('dadosNumeroNota');

        $fornecedor = esc($this->fornecedorModel->where('status_fornecedor', 'ativo')->find($inputFornecedor));
        $valor = '0,00';

        if($inputValor != '') {
            $valor = $inputValor;
        }

        $texto = '';
        $numeroNota = '';

        for($i = 0; $i < count($dadosNumeroNota); $i++) {
            $numeroNota .= $dadosNumeroNota[$i].', ';
        }

        $texto .='Recebi a importância de R$ <b>'.$valor.' ('.converteValorPorExtenso($valor, 2).')</b> referente a descarrego de produtos constante na(s)
        nota(s) fiscal nº ,'.$numeroNota.' fornecedor (es) '.$fornecedor['nome_fornecedor'].', CNPJ n.'.$inputCnpj_cpf.'.';
        
        $dados = [
            'descricao_outros' => 'RECIBO - '.$fornecedor['nome_fornecedor'],
            'texto' => $texto,
            'data_outros' => retornaDataAtual()
        ];

        if($outrosModel->save($dados)) {
            $idrecibo = $outrosModel->getInsertID();
            echo base_url('outros/imprimir/'.$idrecibo);
        }else {
            echo 'erro!';
        }

    }

    public function buscarListaDeRecibos() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('outros'));
        endif;

        $reciboModel = new OutrosModel();

        $listaRecibos = $reciboModel->retornaListaDeRecibos();

        echo $listaRecibos;
    }

    public function delete() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('outros'));
        endif;

        $reciboModel = new OutrosModel();

        $inputId = $this->request->getPost('id');

        if($reciboModel->delete($inputId)):
            $retorno = [
                'status' => true,
                'mensagem' => 'Recibo DELETADO Com Sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'mensagem' => 'Erro ao Deletar Recibo!'
            ];

            return json_encode($retorno);
        endif;
    }

    public function pesquisarListaRecibos() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('outros'));
        endif;
        
        sleep(1);
        $outrosModel = new OutrosModel();
        $data = $this->request->getPost('inputData');

        echo $outrosModel->retornaListaDeRecibos($data);
    }
}