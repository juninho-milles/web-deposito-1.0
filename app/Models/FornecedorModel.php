<?php

namespace App\Models;

use CodeIgniter\Model;

class FornecedorModel extends Model {

    protected $table                = 'fornecedor';
    protected $primaryKey           = 'id_fornecedor';
    protected $allowedFields        = ['nome_fornecedor', 'cnpj_cpf', 'setor_fornecedor', 'status_fornecedor'];
    protected $returnType           = 'array';

    protected $validationRules      = ['nome_fornecedor' => 'required','cnpj_cpf' => 'required|not_in_list[naovalido, no]|max_length[18]'];

    protected $validationMessages   = [
        'nome_fornecedor' => [
            'required' => '* Digite o nome do Fornecedor'
        ],
        'cnpj_cpf' => [
            'required' => '* Digite o CNPJ ou CPF do Fornecedor!',
            'not_in_list' => '* O Formato do campo não é Válido!',
            'max_length' => '* O campo deve conter no Máximo 18 Dígitos!'
            
        ]
    ];

    //Meus Metodos
    public function retornaListaDeFornecedoresDeposito() {
        $fornecedores = esc($this->where('status_fornecedor', 'ativo')
                            ->where('setor_fornecedor', 'deposito')
                            ->orderBy("nome_fornecedor", "ASC")
                            ->findAll());

        $listaDeRetorno = '';
        $contadorIndice = 1;

        if(!empty($fornecedores)) {
            foreach($fornecedores as $fornecedor):
                $listaDeRetorno .= '
                        <tr>
                            <td class="text-center">'.$contadorIndice++.'</td>
                            <td class="text-center text-blue"><b>'.$fornecedor['nome_fornecedor'].'</b></td>
                            <td class="text-center">'.$fornecedor['cnpj_cpf'].'</td>
                            <td class="text-center text-yellow">'.strtoupper($fornecedor['setor_fornecedor']).'</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-xs text-yellow" onClick="editarDados('.$fornecedor['id_fornecedor'].')"><i class="fa fa-edit"></i></button> 
                                <button type="button" class="btn btn-default btn-xs text-red " onClick="excluirDados('.$fornecedor['id_fornecedor'].')"><i class="fa fa-trash"></i></button>
                            </td> 
                        </tr>
                    ';
            endforeach;
        }else {
            $listaDeRetorno .= '
            <tr>
                <td colspan="5" class="text-center">Nenhum Registro Encontrado</td>
            </tr>';
        }

        return $listaDeRetorno;
        
    }

    public function retornaListaDeFornecedoresHorti() {
        $fornecedores = esc($this->where('status_fornecedor', 'ativo')
                            ->where('setor_fornecedor', 'hortifruti')
                            ->orderBy("nome_fornecedor", "ASC")
                            ->findAll());

        $listaDeRetorno = '';
        $contadorIndice = 1;

        if(!empty($fornecedores)) {
            foreach($fornecedores as $fornecedor):
                $listaDeRetorno .= '
                        <tr>
                            <td class="text-center">'.$contadorIndice++.'</td>
                            <td class="text-center text-blue"><b>'.$fornecedor['nome_fornecedor'].'</b></td>
                            <td class="text-center">'.$fornecedor['cnpj_cpf'].'</td>
                            <td class="text-center text-green">'.strtoupper($fornecedor['setor_fornecedor']).'</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-xs text-yellow" onClick="editarDados('.$fornecedor['id_fornecedor'].')"><i class="fa fa-edit"></i></button> 
                                <button type="button" class="btn btn-default btn-xs text-red " onClick="excluirDados('.$fornecedor['id_fornecedor'].')"><i class="fa fa-trash"></i></button>
                            </td> 
                        </tr>
                    ';
            endforeach;
        }else {
            $listaDeRetorno .= '
            <tr>
                <td colspan="5" class="text-center">Nenhum Registro Encontrado</td>
            </tr>';
        }

        return $listaDeRetorno;
        
    }

    public function retornaBuscaDinamica($valorCampoBusca, $setor) {
        if($valorCampoBusca != '') {
            $fornecedores = esc($this->where('status_fornecedor', 'ativo')
                            ->where('setor_fornecedor', $setor)
                            ->like('nome_fornecedor', $valorCampoBusca)
                            ->orderBy("nome_fornecedor", "ASC")
                            ->findAll());

            $listaDeRetorno = '';
            $contadorIndice = 1;
            $setorFornecedor = 'deposito';

            if($setor == 'deposito'):
                $setorFornecedor = '<td class="text-center text-yellow">DEPOSITO</td>';
            else:
                $setorFornecedor = '<td class="text-center text-green">HORTIFRUTI</td>';
            endif;

            if(!empty($fornecedores)) {
                foreach($fornecedores as $fornecedor):
                    $listaDeRetorno .= '
                            <tr>
                                <td class="text-center">'.$contadorIndice++.'</td>
                                <td class="text-center text-blue"><b>'.$fornecedor['nome_fornecedor'].'</b></td>
                                <td class="text-center">'.$fornecedor['cnpj_cpf'].'</td>
                                '.$setorFornecedor.'
                                <td class="text-center">
                                    <button type="button" class="btn btn-default btn-xs text-yellow" onClick="editarDados('.$fornecedor['id_fornecedor'].')"><i class="fa fa-edit"></i></button> 
                                    <button type="button" class="btn btn-default btn-xs text-red " onClick="excluirDados('.$fornecedor['id_fornecedor'].')"><i class="fa fa-trash"></i></button>
                                </td> 
                            </tr>
                        ';
                endforeach;
            }else {
                $listaDeRetorno .= '
                <tr>
                    <td colspan="5" class="text-center">Nenhum Registro Encontrado</td>
                </tr>';
            }
    
            return $listaDeRetorno;


        }else {
            if($setor == 'deposito'){
                return $this->retornaListaDeFornecedoresDeposito();
            } else {
                return $this->retornaListaDeFornecedoresHorti();
            }
        }
    }

    public function montarSelectFornecedores($id) {
        $fornecedores = esc($this->where('status_fornecedor', 'ativo')
                            ->orderBy("nome_fornecedor", "ASC")
                            ->findAll());
                            
        $listaDeRetorno = '';

        if($id != 0):
            foreach($fornecedores as $fornecedor):
                if($fornecedor['id_fornecedor'] == $id):
                    $listaDeRetorno .= '<option selected = "true" value="'.$fornecedor['id_fornecedor'].'">'.$fornecedor['nome_fornecedor'].'</option>';
                else:
                    $listaDeRetorno .= '<option value="'.$fornecedor['id_fornecedor'].'">'.$fornecedor['nome_fornecedor'].'</option>';
                endif;
            endforeach;

            return $listaDeRetorno;
        else:
            foreach($fornecedores as $fornecedor):
                $listaDeRetorno .= '<option value="'.$fornecedor['id_fornecedor'].'">'.$fornecedor['nome_fornecedor'].'</option>';            
            endforeach;

            return $listaDeRetorno;
        endif;
    }

}