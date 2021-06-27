<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model {

    protected $table                = 'usuario';
    protected $primaryKey           = 'id_usuario';
    protected $allowedFields        = ['nome_usuario', 'senha_usuario', 'nivel_acesso', 'status_usuario'];
    protected $returnType           = 'array';

    protected $validationRules      = ['nome_usuario' => 'required|is_unique[usuario.nome_usuario]','senha_usuario' => 'required'];

    protected $validationMessages   = [
        'nome_usuario' => [
            'required' => '* Digite o nome do Usúario!',
            'is_unique' => '* Usuario já Cadastrado!'
        ],
        'senha_usuario' => [
            'required' => '* Digite uma Senha!'
        ]
    ];

    public function buscarUsuarioPeloNome($nome) {
        $usuario = esc($this->where('status_usuario', 'ativo')
                            ->where('nome_usuario', $nome)
                            ->findAll());

        return $usuario;
    }
}