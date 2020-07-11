<?php
namespace App\Models;

class Status extends \App\Models\AbstractModels\AbstractStatus
{
    protected $fillable = ['pkStatus', 'descricao'];
}