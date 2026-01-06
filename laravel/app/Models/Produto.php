<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model {
    protected $fillable = ['nfe_id', 'ds_produto', 'nr_quantidade'];
}
