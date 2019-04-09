<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractCategorie extends Model
{
    protected $table = 'contracts_categorie';
    protected $fillable = [
        'id_contract', 'id_categoria'
    ];
}
