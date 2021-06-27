<?php

namespace App\Controllers;

use App\Models\FornecedorModel;

class FornecedoresAjax extends BaseController {

	protected $fornecedorModel;

	public function __construct() {
		$this->fornecedorModel = new FornecedorModel();
	}

    public function salvar() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('fornecedores'));
        endif;
        
        $inputId = $this->request->getPost('id');
        $inputFornecedor = $this->request->getPost('fornecedor');
        $inputCnpj_cpf = $this->request->getPost('cnpj_cpf');
        $inputSetor = $this->request->getPost('setor');

        if($inputId != 0):
            return $this->editar($inputId, $inputFornecedor, $inputCnpj_cpf, $inputSetor);
        else:
            return $this->cadastrar($inputFornecedor, $inputCnpj_cpf, $inputSetor);
        endif;

    }

    private function cadastrar($inputFornecedor, $inputCnpj_cpf, $inputSetor) {
  
        $dados = [
            'nome_fornecedor' => strtoupper($inputFornecedor),
            'cnpj_cpf' => validaCpfCnpj($inputCnpj_cpf),
            'setor_fornecedor' => $inputSetor,
            'status_fornecedor' => 'ativo'
        ];

        if($this->fornecedorModel->save($dados)):
            $retorno = [
                'status' => true,
                'mensagem' => 'Fornecedor CADASTRADO Com Sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'erro' => $this->fornecedorModel->errors()
            ];

            return json_encode($retorno);
        endif;
    }

    private function editar($inputId, $inputFornecedor, $inputCnpj_cpf, $inputSetor) {
  
        $dados = [
            'id_fornecedor' => $inputId,
            'nome_fornecedor' => strtoupper($inputFornecedor),
            'cnpj_cpf' => validaCpfCnpj($inputCnpj_cpf),
            'setor_fornecedor' => $inputSetor,
            'status_fornecedor' => 'ativo'
        ];

        if($this->fornecedorModel->save($dados)):
            $retorno = [
                'status' => true,
                'mensagem' => 'Fornecedor ALTERADO Com Sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'erro' => $this->fornecedorModel->errors()
            ];

            return json_encode($retorno);
        endif;
    }

    public function delete() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('fonrecedores'));
        endif;

        $inputId = $this->request->getPost('id');

        $dados = [
            'id_fornecedor' => $inputId,
            'status_fornecedor' => 'inativo'
        ];

        if($this->fornecedorModel->save($dados)):
            $retorno = [
                'status' => true,
                'mensagem' => 'Fornecedor DELETADO Com Sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'mensagem' => 'Erro ao Deletar Fornecedor!'
            ];

            return json_encode($retorno);
        endif;
    }

    public function getListaDeFornecedores() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('fornecedores'));
        endif;

        $inputSetor = $this->request->getPost('setor');

        if($inputSetor == 'deposito'):
            $retorno['listaDeFornecedores'] = $this->fornecedorModel->retornaListaDeFornecedoresDeposito();

            echo $retorno['listaDeFornecedores'];
        else:
            $retorno['listaDeFornecedores'] = $this->fornecedorModel->retornaListaDeFornecedoresHorti();

            echo $retorno['listaDeFornecedores'];
        endif;
    }

    public function getFornecedorById() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('fornecedores'));
        endif;

        $idFornecedor = $this->request->getPost('id');
        $dados['fornecedores'] = esc($this->fornecedorModel->where('status_fornecedor', 'ativo')->find($idFornecedor)); 

        echo json_encode($dados);
    }

    public function buscaDinamicaFornecedores() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('fornecedores'));
        endif;

        $inputBusca = $this->request->getPost('inputBusca');
        $inputSetor = $this->request->getPost('inputSetor');

        echo $this->fornecedorModel->retornaBuscaDinamica($inputBusca, $inputSetor);

    }

}