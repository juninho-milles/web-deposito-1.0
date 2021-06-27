<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Result;
use CodeIgniter\Model;

class LancamentoModel extends Model {

    protected $table                = 'lancamento';
    protected $primaryKey           = 'id_lancamento';
    protected $allowedFields        = [
        'fornecedor_id_fornecedor', 
        'conferente_id_conferente',
        'setor_id_setor',
        'arquivo_lancamento',
        'numero_nota',
        'valor_nota',
        'peso_nota',
        'nome_motorista',
        'placa_veiculo',
        'taxa_descarrego',
        'hora_entrada',
        'hora_saida',
        'data_entrada',
        'observacao',
        'data_lancamento',
        'status_lancamento'
    ];

    protected $returnType           = 'array';

    protected $validationRules      = [
        'numero_nota' => 'required|numeric',
        'valor_nota' => 'required',
        'nome_motorista' => 'required',
        'hora_entrada' => 'required',
        'hora_saida' => 'required',
        'data_entrada' => 'required',
        'observacao' => 'max_length[400]'
    ];

    protected $validationMessages   = [
        'numero_nota' => [
            'required' => '* Digite o número da nota!',
            'numeric' => '* Esse campo só permite NÚMEROS!'
        ],

        'valor_nota' => [
            'required' => '* Digite o valor da nota!'
        ],
        
        'nome_motorista' => [
            'required' => '* Digite o nome do motorista!'
        ],

        'hora_entrada' => [
            'required' => '* Digite a hora de entrada!'
        ],
        
        'hora_saida' => [
            'required' => '* Digite a hora de saída!'
        ],

        'data_entrada' => [
            'required' => '* Digite a data de entrada!'
        ],

        'observacao' => [
            'max_length' => '* Utilize no maximo 400 caracteres!'
        ]
    ];

    public function getById($id_lancamento) {
        return esc($this->from('fornecedor, setor, conferente')
                    ->where('id_fornecedor = fornecedor_id_fornecedor')
                    ->where('id_setor = setor_id_setor')
                    ->where('id_conferente = conferente_id_conferente')
                    ->where('status_lancamento', 'ativo')
                    ->find($id_lancamento));

    }

    public function retornaListaDeLancamentos() {
        $lancamentos = esc($this->from('fornecedor, setor, conferente')
                            ->where('id_fornecedor = fornecedor_id_fornecedor')
                            ->where('id_setor = setor_id_setor')
                            ->where('id_conferente = conferente_id_conferente')
                            ->where('data_entrada',retornaDataAtual())
                            ->where('status_lancamento', 'ativo')
                            ->orderBy("data_lancamento", "DESC")
                            ->findAll());

        $listaDeRetorno = '';
        $contadorIndice = 1;

        if(!empty($lancamentos)) {
            foreach($lancamentos as $lancamento):
                $listaDeRetorno .= '
                        <tr>
                            <td class="text-center">'.$contadorIndice++.'</td>
                            <td class="text-center text-primary text-bold">'.$lancamento['nome_fornecedor'].'</td>
                            <td class="text-center">'.$lancamento['numero_nota'].'</td>
                            <td class="text-center text-navy">'.$lancamento['nome_conferente'].'</td>
                            <td class="text-center text-purple">'.$lancamento['nome_setor'].'</td>
                            <td class="text-center">'.implode('/', array_reverse(explode('-', $lancamento['data_entrada']))).'</td>
                            <td class="text-center">
                                <a href="'.base_url('lancamentos/detalhes/'.$lancamento['id_lancamento']).'" class="btn btn-default btn-xs text-blue"><i class="fa fa-eye"></i> DETALHES</a> 
                            </td> 
                        </tr>
                    ';
            endforeach;
        }else {
            $listaDeRetorno .= '
            <tr>
                <td colspan="7" class="text-center">Nenhum Registro Encontrado</td>
            </tr>';
        }

        return $listaDeRetorno;
    }

    public function retornaBuscaLancamentos($query) {
        $lancamentos = esc(
                            $this->from('fornecedor, setor, conferente')
                                    ->where('id_fornecedor = fornecedor_id_fornecedor')
                                    ->where('id_setor = setor_id_setor')
                                    ->where('id_conferente = conferente_id_conferente')
                                    ->where($query)
                                    ->where('status_lancamento', 'ativo')
                                    ->orderBy("data_lancamento", "DESC")
                                    ->findAll()
                        );

        $listaDeRetorno = '';
        $contadorIndice = 1;

        if(!empty($lancamentos)) {
            foreach($lancamentos as $lancamento):
                $listaDeRetorno .= '
                        <tr>
                            <td class="text-center">'.$contadorIndice++.'</td>
                            <td class="text-center text-primary text-bold">'.$lancamento['nome_fornecedor'].'</td>
                            <td class="text-center">'.$lancamento['numero_nota'].'</td>
                            <td class="text-center text-navy">'.$lancamento['nome_conferente'].'</td>
                            <td class="text-center text-purple">'.$lancamento['nome_setor'].'</td>
                            <td class="text-center">'.implode('/', array_reverse(explode('-', $lancamento['data_entrada']))).'</td>
                            <td class="text-center">
                                <a href="'.base_url('lancamentos/detalhes/'.$lancamento['id_lancamento']).'" class="btn btn-default btn-xs text-blue"><i class="fa fa-eye"></i> DETALHES</a> 
                            </td> 
                        </tr>
                    ';
            endforeach;
        }else {
            $listaDeRetorno .= '
            <tr>
                <td colspan="7" class="text-center">Nenhum Registro Encontrado</td>
            </tr>';
        }

        return $listaDeRetorno;
    }



    //================= buscar lancamento para relatorio ==============================//
    public function retornaBuscaLancamentosRelatorio($query) {
        $lancamentos = esc(
                            $this->from('fornecedor, setor, conferente')
                                    ->where('id_fornecedor = fornecedor_id_fornecedor')
                                    ->where('id_setor = setor_id_setor')
                                    ->where('id_conferente = conferente_id_conferente')
                                    ->where($query)
                                    ->where('status_lancamento', 'ativo')
                                    ->orderBy("data_lancamento", "ASC")
                                    ->findAll()
                        );

        $listaDeRetorno = '';
        $contadorIndice = 1;

        if(!empty($lancamentos)) {
            
            foreach($lancamentos as $lancamento):
                $listaDeRetorno .= '
                        <tr>
                            <td class="text-center">'.$contadorIndice++.'</td>
                            <td class="text-center text-primary text-bold">'.$lancamento['nome_fornecedor'].'</td>
                            <td class="text-center">'.$lancamento['numero_nota'].'</td>
                            <td class="text-center text-navy">'.$lancamento['nome_conferente'].'</td>
                            <td class="text-center text-purple">'.$lancamento['nome_setor'].'</td>
                            <td class="text-center">'.implode('/', array_reverse(explode('-', $lancamento['data_entrada']))).'</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-xs text-green btnAdd" onClick="addItem('.$lancamento['id_lancamento'].')"><i class="fa fa-plus"></i> ADD</button> 
                            </td> 
                        </tr>

                        <input type="hidden" class="inputIdLancamento" value="'.$lancamento['id_lancamento'].'">
                    ';
            endforeach;

            $listaDeRetorno .= '
                <tr>
                    <td colspan="6" class="text-center"></td>
                    <td class="text-center">
                    <button type="button" class="btn btn-default btn-xs text-blue btnAdd" onClick="addTodosOsItens()"><i class="fa fa-list-ol"></i> ADD TODOS</button> 
                    </td>
                </tr>
            ';
        }else {
            $listaDeRetorno .= '
            <tr>
                <td colspan="7" class="text-center">Nenhum Registro Encontrado</td>
            </tr>';
        }

        return $listaDeRetorno;
    }

    public function retornaListaDeLancamentosRelatorio() {
        $lancamentos = esc($this->from('fornecedor, setor, conferente')
                            ->where('id_fornecedor = fornecedor_id_fornecedor')
                            ->where('id_setor = setor_id_setor')
                            ->where('id_conferente = conferente_id_conferente')
                            ->where('data_entrada',retornaDataAtual())
                            ->where('status_lancamento', 'ativo')
                            ->orderBy("data_lancamento", "ASC")
                            ->findAll());

        $listaDeRetorno = '';
        $contadorIndice = 1;
        $listaId = [];

        if(!empty($lancamentos)) {
            
            foreach($lancamentos as $lancamento):
                $listaDeRetorno .= '
                        <tr>
                            <td class="text-center">'.$contadorIndice++.'</td>
                            <td class="text-center text-primary text-bold">'.$lancamento['nome_fornecedor'].'</td>
                            <td class="text-center">'.$lancamento['numero_nota'].'</td>
                            <td class="text-center text-navy">'.$lancamento['nome_conferente'].'</td>
                            <td class="text-center text-purple">'.$lancamento['nome_setor'].'</td>
                            <td class="text-center">'.implode('/', array_reverse(explode('-', $lancamento['data_entrada']))).'</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-xs text-green btnAdd" onClick="addItem('.$lancamento['id_lancamento'].')"><i class="fa fa-plus"></i> ADD</button> 
                            </td> 
                        </tr>

                        <input type="hidden" class="inputIdLancamento" value="'.$lancamento['id_lancamento'].'">
                    ';

            endforeach;

            $listaDeRetorno .= '
                <tr>
                    <td colspan="6" class="text-center"></td>
                    <td class="text-center">
                    <button type="button" class="btn btn-default btn-xs text-blue btnAdd" onClick="addTodosOsItens()"><i class="fa fa-list-ol"></i> ADD TODOS</button> 
                    </td>
                </tr>
            ';
        }else {
            $listaDeRetorno .= '
            <tr>
                <td colspan="7" class="text-center">Nenhum Registro Encontrado</td>
            </tr>';
        }

        return $listaDeRetorno;
    }

}