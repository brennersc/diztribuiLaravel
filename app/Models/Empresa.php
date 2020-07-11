<?php
namespace App\Models;

class Empresa extends \App\Models\AbstractModels\AbstractEmpresa
{
    // protected $fillable = [ 'razaoSocial','nomeFantasia','cnpj','telefone','endereco',
    // 'cep','logradouro','numero','complemento','estado','cidade' ];
    protected $fillable = [
        'razaoSocial',
        'nomeFantasia',
        'cnpj',
        'endereco',
        'site',
        'telefone',
        'redeSocial',
        'ramoDeAtividade',
        'responsavelMarketing',
        'responsavelFinanceiro',
        'responsavelComercial',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        ];
}
