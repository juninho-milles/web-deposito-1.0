<?php

namespace App\Controllers;

use App\Models\ConferenteModel;

class ConferentesAjax extends BaseController {

	protected $conferenteModel;

	public function __construct() {
		$this->conferenteModel = new ConferenteModel();
	}

	public function salvar() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('conferentes'));
        endif;
        

        $inputNome = $this->request->getPost('nome');
        $inputId = $this->request->getPost('id');

        if($inputId != 0):
            return $this->editar($inputId,$inputNome);
        else:
            return $this->cadastrar($inputNome);
        endif;

    }

    public function delete() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('conferentes'));
        endif;

        $inputId = $this->request->getPost('id');

        $dados = [
            'id_conferente' => $inputId,
            'status_conferente' => 'inativo'
        ];

        if($this->conferenteModel->save($dados)):
            $retorno = [
                'status' => true,
                'mensagem' => 'Conferente DELETADO Com Sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'mensagem' => 'Erro ao Deletar Conferente!'
            ];

            return json_encode($retorno);
        endif;
    }

    public function getListaDeConferentes() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('conferentes'));
        endif;

        $retorno['listaDeConferentes'] = $this->conferenteModel->retornaListaDeConferentes();

        echo $retorno['listaDeConferentes'];
    }

    public function getConferenteById() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('conferentes'));
        endif;

        $idConferente = $this->request->getPost('id');
        $dados['conferentes'] = esc($this->conferenteModel->where('status_conferente', 'ativo')->find($idConferente)); 

        echo json_encode($dados);
    }

    private function cadastrar($nome) {
        $dados = [
            'nome_conferente' => mb_convert_case($nome, MB_CASE_TITLE, "UTF-8"),
            'data_cadastro' => date('Y-m-d'),
            'status_conferente' => 'ativo'
        ];

        if($this->conferenteModel->save($dados)):
            $retorno = [
                'status' => true,
                'mensagem' => 'Conferente CADASTRADO Com Sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'erro' => $this->conferenteModel->errors()
            ];

            return json_encode($retorno);
        endif;
    }

    private function editar($id, $nome) {
        $dados = [
            'id_conferente' => $id,
            'nome_conferente' => mb_convert_case($nome, MB_CASE_TITLE, "UTF-8")
        ];

        if($this->conferenteModel->save($dados)):
            $retorno = [
                'status' => true,
                'mensagem' => 'Conferente ALTERADO Com Sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'erro' => $this->conferenteModel->errors()
            ];

            return json_encode($retorno);
        endif;
    }
    
}
