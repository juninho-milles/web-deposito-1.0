<?php

namespace App\Models;

use CodeIgniter\Model;

class RelatorioModel extends Model {

    protected $table                = 'relatorio';
    protected $primaryKey           = 'id_relatorio';
    protected $allowedFields        = ['descricao_relatorio', 'data_relatorio', 'status_relatorio'];
    protected $returnType           = 'array';

    protected $validationRules      = ['descricao_relatorio' => 'required'];

    protected $validationMessages   = [
        'descricao_relatorio' => [
            'required' => '* Digite uma descrição para o relatório!'
        ]
    ];

    public function getById($id) {
        return esc($this->from('relatorio_has_lancamento, lancamento, fornecedor, conferente')
                    ->where('id_relatorio = relatorio_id_relatorio')
                    ->where('id_lancamento = lancamento_id_lancamento')
                    ->where('id_fornecedor = fornecedor_id_fornecedor')
                    ->where('id_conferente = conferente_id_conferente')
                    ->where('id_relatorio', $id)
                    ->where('status_relatorio', 'ativo')
                    ->orderBy("data_cadastro_rl", "ASC")
                    ->findAll());
    }

    public function retornaListaDeRelatorios($dataEntrada='') {

        if($dataEntrada != ''):
            $relatorios = esc($this->where('status_relatorio', 'ativo')
                            ->where('data_relatorio', $dataEntrada)
                            ->orderBy("descricao_relatorio", "DESC")
                            ->findAll());
        else:
            $relatorios = esc($this->where('status_relatorio', 'ativo')
                            ->where('data_relatorio', retornaDataAtual())
                            ->orderBy("descricao_relatorio", "DESC")
                            ->findAll());
        endif;
        
        $listaDeRetorno = '';
        $contadorIndice = 1;

        if(!empty($relatorios)) {
            foreach($relatorios as $relatorio):
                $listaDeRetorno .= '
                        <tr>
                            <td class="text-center">'.$contadorIndice++.'</td>
                            <td class="text-center text-navy">'.$relatorio['descricao_relatorio'].'</td>
                            <td class="text-center">'.implode('/', array_reverse(explode('-', $relatorio['data_relatorio']))).'</td>
                            <td class="text-center">
                                <a href="'.base_url('relatorios/imprimir/'.$relatorio['id_relatorio']).'" target="_blank" class="btn btn-default btn-xs text-blue"><i class="glyphicon glyphicon-print"></i></a>
                                <button type="button" class="btn btn-default btn-xs text-yellow btnEditar" onClick="editarDados('.$relatorio['id_relatorio'].')"><i class="fa fa-edit"></i></button> 
                                <button type="button" class="btn btn-default btn-xs text-red btnExcluir" onClick="excluirDados('.$relatorio['id_relatorio'].')"><i class="fa fa-trash"></i></button>
                            </td> 
                        </tr>
                    ';
            endforeach;
        }else {
            $listaDeRetorno .= '
            <tr>
                <td colspan="4" class="text-center">Nenhum Registro Encontrado</td>
            </tr>';
        }

        return $listaDeRetorno;
        
    }

}