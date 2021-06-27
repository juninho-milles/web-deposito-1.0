<?php

namespace App\Models;

use CodeIgniter\Model;

class SetorModel extends Model {

    protected $table                = 'setor';
    protected $primaryKey           = 'id_setor';
    protected $allowedFields        = ['nome_setor', 'descricao_setor', 'status_setor'];
    protected $returnType           = 'array';

    protected $validationRules      = ['nome_setor' => 'required','descricao_setor' => 'required|max_length[150]'];

    protected $validationMessages   = [
        'nome_setor' => [
            'required' => '* Digite o nome do Setor!'
        ],
        'descricao_setor' => [
            'required' => '* Insira uma descrição para o Setor!',
            'max_length' => '* A Descrição deve conter no máximo 150 caracteres!'
        ]
    ];

    //Meus Metodos 
    public function retornaListaDeSetores() {
        $setores = esc($this->where('status_setor', 'ativo')
                            ->orderBy("nome_setor", "ASC")
                            ->findAll());

        $listaDeRetorno = '';
        $contadorIndice = 1;

        if(!empty($setores)) {
            foreach($setores as $setor):
                $listaDeRetorno .= '
                        <tr>
                            <td class="text-center">'.$contadorIndice++.'</td>
                            <td class="text-center text-navy">'.$setor['nome_setor'].'</td>
                            <td class="text-center">"'.$setor['descricao_setor'].'"</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-xs text-yellow" onClick="editarDados('.$setor['id_setor'].')"><i class="fa fa-edit"></i></button> 
                                <button type="button" class="btn btn-default btn-xs text-red " onClick="excluirDados('.$setor['id_setor'].')"><i class="fa fa-trash"></i></button>
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

    public function montarSelectSetores($id) {
        $setores = esc($this->where('status_setor', 'ativo')
                            ->orderBy("nome_setor", "ASC")
                            ->findAll());
                            
        $listaDeRetorno = '';

        if($id != 0):
            foreach($setores as $setor):
                if($setor['id_setor'] == $id):
                    $listaDeRetorno .= '<option selected = "true" value="'.$setor['id_setor'].'">'.$setor['nome_setor'].'</option>';
                else:
                    $listaDeRetorno .= '<option value="'.$setor['id_setor'].'">'.$setor['nome_setor'].'</option>';
                endif;
            endforeach;

            return $listaDeRetorno;
        else:
            foreach($setores as $setor):
                $listaDeRetorno .= '<option value="'.$setor['id_setor'].'">'.$setor['nome_setor'].'</option>';
            endforeach;

            return $listaDeRetorno;
        endif;
    }

}