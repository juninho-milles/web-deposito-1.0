<?php

namespace App\Controllers;

use App\Models\SetorModel;

class SetoresAjax extends BaseController {

	protected $setorModel;

	public function __construct() {
		$this->setorModel = new SetorModel();
	}

    public function salvar() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('setores'));
        endif;
        
        $inputId = $this->request->getPost('id');
        $inputNome = $this->request->getPost('nome');
        $inputDescricao = $this->request->getPost('descricao');
        
        if($inputId != 0):
            return $this->editar($inputId,$inputNome, $inputDescricao);
        else:
            return $this->cadastrar($inputNome, $inputDescricao);
        endif;

    }

    private function cadastrar($nome, $descricao) {
        $dados = [
            'nome_setor' => mb_convert_case($nome, MB_CASE_TITLE, "UTF-8"),
            'descricao_setor' => mb_convert_case($descricao, MB_CASE_TITLE, "UTF-8"),
            'status_setor' => 'ativo'
        ];

        if($this->setorModel->save($dados)):
            $retorno = [
                'status' => true,
                'mensagem' => 'Setor CADASTRADO Com Sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'erro' => $this->setorModel->errors()
            ];

            return json_encode($retorno);
        endif;
    }

    private function editar($id, $nome, $descricao) {
        $dados = [
            'id_setor' => $id,
            'nome_setor' => mb_convert_case($nome, MB_CASE_TITLE, "UTF-8"),
            'descricao_setor' => mb_convert_case($descricao, MB_CASE_TITLE, "UTF-8"),
            'status_setor' => 'ativo'
        ];

        if($this->setorModel->save($dados)):
            $retorno = [
                'status' => true,
                'mensagem' => 'Setor ALTERADO Com Sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'erro' => $this->setorModel->errors()
            ];

            return json_encode($retorno);
        endif;
    }

    public function delete() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('setores'));
        endif;

        $inputId = $this->request->getPost('id');

        $dados = [
            'id_setor' => $inputId,
            'status_setor' => 'inativo'
        ];

        if($this->setorModel->save($dados)):
            $retorno = [
                'status' => true,
                'mensagem' => 'Setor DELETADO Com Sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'mensagem' => 'Erro ao Deletar Setor!'
            ];

            return json_encode($retorno);
        endif;
    }

    public function getListaDeSetores() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('setores'));
        endif;

        $retorno['listaDeSetores'] = $this->setorModel->retornaListaDeSetores();

        echo $retorno['listaDeSetores'];
    }

    public function getSetorById() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('setores'));
        endif;

        $idSetor = $this->request->getPost('id');
        $dados['setores'] = esc($this->setorModel->where('status_setor', 'ativo')->find($idSetor)); 

        echo json_encode($dados);
    }
}