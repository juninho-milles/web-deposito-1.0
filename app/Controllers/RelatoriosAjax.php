<?php

namespace App\Controllers;

use App\Models\LancamentoModel;
use App\Models\RelatorioLancamentoModel;
use App\Models\RelatorioModel;

class RelatoriosAjax extends BaseController {

    protected $lancamentoModel;

	public function __construct() {
		$this->lancamentoModel = new LancamentoModel();
	}

    public function pesquisarLancamentos() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('relatorios'));
        endif;

        $dadosLancamento = $this->request->getPost('dados');
        $consulta = '';

        if($dadosLancamento['inputFornecedor'] != 0) {
            $consulta .= ' AND fornecedor_id_fornecedor = '.$dadosLancamento['inputFornecedor'];
        }

        if($dadosLancamento['inputNumeroDaNota'] != '') {
            $consulta .= ' AND numero_nota = '.$dadosLancamento['inputNumeroDaNota'];
        }

        if($dadosLancamento['inputSetor'] != 0) {
            $consulta .= ' AND setor_id_setor = '.$dadosLancamento['inputSetor'];
        }

        if($dadosLancamento['inputData'] != '') {
            $consulta .= ' AND data_entrada = "'.$dadosLancamento['inputData'].'"';
        }

        $query = substr($consulta, 4);

        
        if($query != ''):
            echo $this->lancamentoModel->retornaBuscaLancamentosRelatorio($query);
           
        else:
            echo $this->lancamentoModel->retornaListaDeLancamentosRelatorio();
            
        endif;
    }

    public function buscarLancamentoId() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('relatorios'));
        endif;

        $idLancamento = $this->request->getPost('id');

        $lancamento = $this->lancamentoModel->getById($idLancamento);
        if($lancamento) {
            echo json_encode($lancamento);
        }
    
    }

    public function imprimirRelatorio() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('relatorios'));
        endif;
        
        $relatorio = $this->request->getPost('relatorio');

        $relatorioModel = new RelatorioModel();
        $relatorioLancamento = new RelatorioLancamentoModel();
        $idRelatorio = 0;

        $dadosRelatorio = [
            'descricao_relatorio' => 'Relatório - '.retornaDataHoraAtual(),
            'data_relatorio' => retornaDataAtual(),
            'status_relatorio' => 'ativo'
        ];

        if($relatorioModel->save($dadosRelatorio)) {
            $idRelatorio = $relatorioModel->getInsertID();

            foreach($relatorio as $r) {
                 
                $dadosRelatorioLancamento = [
                    'relatorio_id_relatorio' => $idRelatorio,
                    'lancamento_id_lancamento' => $r['id_lancamento'],
                    'data_cadastro_rl' => round(microtime(true) * 1000)
                ];

                $relatorioLancamento->save($dadosRelatorioLancamento);
            }

                $dados = [
                    'link' => base_url('relatorios/imprimir/'.$idRelatorio)
                ];
    
                echo json_encode($dados);
        }

    }

    public function buscarListaRelatorios() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('relatorios'));
        endif;
        
        $relatorioModel = new RelatorioModel();
        $data = $this->request->getPost('inputData');

        echo $relatorioModel->retornaListaDeRelatorios($data);
    }

    public function getRelatorioById() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('relatorios'));
        endif;

        $relatorioModel = new RelatorioModel();
        $id = $this->request->getPost('id');

        $dados['relatorios'] = esc($relatorioModel->where('status_relatorio', 'ativo')->find($id)); 

        echo json_encode($dados);

    }

    public function editar() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('relatorios'));
        endif;

        $relatorioModel = new RelatorioModel();

        $id = $this->request->getPost('id');
        $descricao = $this->request->getPost('descricao');

        $dados = [
            'id_relatorio' => $id,
            'descricao_relatorio' => mb_convert_case($descricao, MB_CASE_TITLE, "UTF-8")
        ];

        if($relatorioModel->save($dados)):
            $retorno = [
                'status' => true,
                'mensagem' => 'Relatório ALTERADO Com Sucesso!'
            ];

            return json_encode($retorno);
        else:
            $retorno = [
                'status' => false,
                'erro' => $relatorioModel->errors()
            ];

            return json_encode($retorno);
        endif;
    }

    public function excluirRelatorio() {
        if($this->request->getMethod() !== 'post'):
            return redirect()->to(base_url('relatorios'));
        endif;

        $relatorioModel = new RelatorioModel();
        $id = $this->request->getPost('inputId');

        $dados = [
            'id_relatorio' => $id,
            'status_relatorio' => 'inativo'
        ];

        if($relatorioModel->save($dados)):
            $return = [
                'status' => true,
                'mensagem' => 'Relatório DELETADO com sucesso!'
            ];

            echo json_encode($return);
        else:
            $return = [
                'status' => false,
                'mensagem' => 'Erro ao DELETAR Relatório!'
            ];

            echo json_encode($return);
        endif;
    }
}
