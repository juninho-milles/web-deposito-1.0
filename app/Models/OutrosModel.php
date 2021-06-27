<?php

namespace App\Models;

use CodeIgniter\Model;

class OutrosModel extends Model {

    protected $table                = 'outros';
    protected $primaryKey           = 'id_outros';
    protected $allowedFields        = ['descricao_outros', 'texto', 'data_outros'];
    protected $returnType           = 'array';

    //Meus Metodos
    public function retornaListaDeRecibos($dataEntrada='') {
        if($dataEntrada != ''):
            $recibos = esc($this->where('data_outros', $dataEntrada)
                            ->orderBy("descricao_outros", "DESC")
                            ->findAll());
        else:
            $recibos = esc($this->where('data_outros', retornaDataAtual())
                            ->orderBy("descricao_outros", "DESC")
                            ->findAll());
        endif;
        
        $listaDeRetorno = '';
        $contadorIndice = 1;

        if(!empty($recibos)) {
            foreach($recibos as $recibo):
                $listaDeRetorno .= '
                            <tr>
                                <td class="text-center">'.$contadorIndice++.'</td>
                                <td class="text-center text-navy">'.$recibo['descricao_outros'].'</td>
                                <td class="text-center">
                                <a href="'.base_url('outros/imprimir/'.$recibo['id_outros']).'" target="_blank" class="btn btn-default btn-xs text-blue"><i class="glyphicon glyphicon-print"></i></a> 
                                    <button type="button" class="btn btn-default btn-xs text-red " onClick="excluirDados('.$recibo['id_outros'].')"><i class="fa fa-trash"></i></button>
                                </td> 
                            </tr>
                    ';
            endforeach;
        }else {
            $listaDeRetorno .= '
            <tr>
                <td colspan="3" class="text-center">Nenhum Registro Encontrado</td>
            </tr>';
        }

        return $listaDeRetorno;
    }

}