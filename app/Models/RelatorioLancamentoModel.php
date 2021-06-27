<?php

namespace App\Models;

use CodeIgniter\Model;

class RelatorioLancamentoModel extends Model {

    protected $table            =   'relatorio_has_lancamento';
    protected $allowedFields    =   ['relatorio_id_relatorio', 'lancamento_id_lancamento', 'data_cadastro_rl'];
    protected $returnType       =   'array';
    
}