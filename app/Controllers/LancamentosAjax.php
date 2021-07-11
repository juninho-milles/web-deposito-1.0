<?php

namespace App\Controllers;

use App\Libraries\LblDropbox;
use App\Models\LancamentoModel;

class LancamentosAjax extends BaseController {

	protected $lancamentoModel;

	public function __construct() {
		$this->lancamentoModel = new LancamentoModel();
	}

    public function salvar() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('lancamentos'));
        endif;

        $dadosLancamento = $this->request->getPost('dados');

        if($dadosLancamento['inputId'] != 0):
            $dados = [
                'id_lancamento' => $dadosLancamento['inputId'],
                'fornecedor_id_fornecedor' => $dadosLancamento['inputFornecedor'],
                'conferente_id_conferente' => $dadosLancamento['inputConferente'],
                'setor_id_setor' => $dadosLancamento['inputSetor'],
                'numero_nota' => $dadosLancamento['inputNumeroDaNota'],
                'valor_nota' => $dadosLancamento['inputValorDaNota'],
                'peso_nota' => validaCampoPeso($dadosLancamento['inputPesoDaNota']),
                'nome_motorista' => mb_convert_case($dadosLancamento['inputMotorista'], MB_CASE_TITLE, "UTF-8"),
                'placa_veiculo' => strtoupper($dadosLancamento['inputPlacaDoVeiculo']),
                'taxa_descarrego' => validaCampoDescarrego($dadosLancamento['inputTaxaDescarrego']),
                'hora_entrada' => $dadosLancamento['inputHoraEntrada'],
                'hora_saida' => $dadosLancamento['inputHoraSaida'],
                'data_entrada' => $dadosLancamento['inputDataEntrada'],
                'observacao' => $dadosLancamento['inputObservacao']
            ];
            
            return $this->editar($dados);
        else:
            $dados = [
                'fornecedor_id_fornecedor' => $dadosLancamento['inputFornecedor'],
                'conferente_id_conferente' => $dadosLancamento['inputConferente'],
                'setor_id_setor' => $dadosLancamento['inputSetor'],
                'arquivo_lancamento' => '',
                'numero_nota' => $dadosLancamento['inputNumeroDaNota'],
                'valor_nota' => $dadosLancamento['inputValorDaNota'],
                'peso_nota' => validaCampoPeso($dadosLancamento['inputPesoDaNota']),
                'nome_motorista' => mb_convert_case($dadosLancamento['inputMotorista'], MB_CASE_TITLE, "UTF-8"),
                'placa_veiculo' => strtoupper($dadosLancamento['inputPlacaDoVeiculo']),
                'taxa_descarrego' => validaCampoDescarrego($dadosLancamento['inputTaxaDescarrego']),
                'hora_entrada' => $dadosLancamento['inputHoraEntrada'],
                'hora_saida' => $dadosLancamento['inputHoraSaida'],
                'data_entrada' => $dadosLancamento['inputDataEntrada'],
                'observacao' => $dadosLancamento['inputObservacao'],
                'data_lancamento' => date('Y-m-d H:i:s'),
                'status_lancamento' => 'ativo'
            ];
            
            return $this->cadastrar($dados);
        endif;

    }

    private function cadastrar($dados) {
        if($this->lancamentoModel->save($dados)):
            $retorno = [
                'status' => true,
                'id' => $this->lancamentoModel->getInsertID(),
                'mensagem' => 'Lançamento CADASTRADO Com Sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'erro' => $this->lancamentoModel->errors()
            ];

            return json_encode($retorno);
        endif;
    }

    private function editar($dados) {
        if($this->lancamentoModel->save($dados)):
            $retorno = [
                'status' => true,
                'id' => $dados['id_lancamento'],
                'mensagem' => 'Lançamento ALTERADO Com Sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'erro' => $this->lancamentoModel->errors()
            ];

            return json_encode($retorno);
        endif;
    }

    public function delete() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('lancamentos'));
        endif;

        $idLancamento = $this->request->getPost('id');

        $dados = [
            'id_lancamento' => $idLancamento,
            'status_lancamento' => 'inativo'
        ];

        if($this->lancamentoModel->save($dados)):
            $retorno = [
                'status' => true,
                'mensagem' => 'Lançamento DELETADO Com Sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'mensagem' => 'Não foi possível DELETAR esse Lançamento!'
            ];

            return json_encode($retorno);
        endif;

    }

    public function pesquisarLancamento() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('lancamentos'));
        endif;
        sleep(1);

        $dadosLancamento = $this->request->getPost('dados');

        $consulta = '';

        if($dadosLancamento['inputFornecedor'] != 0) {
            $consulta .= ' AND fornecedor_id_fornecedor = '.$dadosLancamento['inputFornecedor'];
        }

        if($dadosLancamento['inputNumeroDaNota'] != '') {
            $consulta .= ' AND numero_nota = '.$dadosLancamento['inputNumeroDaNota'];
        }

        if($dadosLancamento['inputConferente'] != 0) {
            $consulta .= ' AND conferente_id_conferente = '.$dadosLancamento['inputConferente'];
        }

        if($dadosLancamento['inputSetor'] != 0) {
            $consulta .= ' AND setor_id_setor = '.$dadosLancamento['inputSetor'];
        }

        if($dadosLancamento['inputData'] != '') {
            $consulta .= ' AND data_entrada = "'.$dadosLancamento['inputData'].'"';
        }

        $query = substr($consulta, 4);

        if($query != ''):
            echo $this->lancamentoModel->retornaBuscaLancamentos($query);
           
        else:
            echo $this->lancamentoModel->retornaListaDeLancamentos();
            
        endif;
        
    }

    public function cadastrarDocumento() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('lancamentos'));
        endif;
        
        $idLancamento = $this->request->getPost('idLancamento');

        $nome = uniqid();
        $_FILES['pdf']['upload_max_filesize'] = '20M';
        $_FILES['pdf']['post_max_size'] = '21M';
        $tempFile = $_FILES['pdf']['tmp_name']; 
        $ext = explode(".",$_FILES['pdf']['name']);
        $ext = end($ext);

        $nomeDropbox = "/".$nome.".".$ext;
        
        
        $dropbox = new LblDropbox();
        
        
        $arquivo = $dropbox->salvarArquivos($tempFile, $nomeDropbox);
       
        
        $dados = [
            'id_lancamento' => $idLancamento,
            'arquivo_lancamento' => $arquivo
        ];
        
     
       
        if($this->lancamentoModel->save($dados)):
            $retorno = [
                'status' => true,
                'mensagem' => 'Arquivo salvo com sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'mensagem' => 'Erro ao salvar arquivo!'
            ];

            return json_encode($retorno);
        endif;
        
        
    }

    public function buscarLink() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('lancamentos'));
        endif;
        
        $idLancamento = $this->request->getPost('idLancamento');

        $lancamento = $this->lancamentoModel->find($idLancamento);
    
        $dropbox = new LblDropbox();
        $nomeArquivo = '/'.$lancamento['arquivo_lancamento'];

        $link = $dropbox->getUrlArquivo($nomeArquivo);

        echo $link;
    }

}