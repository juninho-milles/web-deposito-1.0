<?php

namespace App\Models;

use CodeIgniter\Model;

class ConferenteModel extends Model {

    protected $table                = 'conferente';
    protected $primaryKey           = 'id_conferente';
    protected $allowedFields        = ['nome_conferente', 'data_cadastro', 'status_conferente'];
    protected $returnType           = 'array';

    protected $validationRules      = ['nome_conferente' => 'required'];

    protected $validationMessages   = [
        'nome_conferente' => [
            'required' => '* Digite o nome do Conferente'
        ]
    ];

    //Meus Metodos 
    public function retornaListaDeConferentes() {
        $conferentes = esc($this->where('status_conferente', 'ativo')
                            ->orderBy("nome_conferente", "ASC")
                            ->findAll());

        $listaDeRetorno = '';
        $contadorIndice = 1;

        if(!empty($conferentes)) {
            foreach($conferentes as $conferente):
                $listaDeRetorno .= '
                        <tr>
                            <td class="text-center">'.$contadorIndice++.'</td>
                            <td class="text-center text-navy">'.$conferente['nome_conferente'].'</td>
                            <td class="text-center">'.implode('/', array_reverse(explode('-', $conferente['data_cadastro']))).'</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-xs text-yellow" onClick="editarDados('.$conferente['id_conferente'].')"><i class="fa fa-edit"></i></button> 
                                <button type="button" class="btn btn-default btn-xs text-red " onClick="excluirDados('.$conferente['id_conferente'].')"><i class="fa fa-trash"></i></button>
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

    public function montarSelectConferentes($id) {
        $conferentes = esc($this->where('status_conferente', 'ativo')
                            ->orderBy("nome_conferente", "ASC")
                            ->findAll());
                            
        $listaDeRetorno = '';

        if($id != 0):
            foreach($conferentes as $conferente):
                if($conferente['id_conferente'] == $id):
                    $listaDeRetorno .= '<option selected = "true" value="'.$conferente['id_conferente'].'">'.$conferente['nome_conferente'].'</option>';
                else:
                    $listaDeRetorno .= '<option value="'.$conferente['id_conferente'].'">'.$conferente['nome_conferente'].'</option>';
                endif;
            endforeach;

            return $listaDeRetorno;
        else:
            foreach($conferentes as $conferente):
                $listaDeRetorno .= '<option value="'.$conferente['id_conferente'].'">'.$conferente['nome_conferente'].'</option>';            
            endforeach;

            return $listaDeRetorno;
        endif;
    }
}