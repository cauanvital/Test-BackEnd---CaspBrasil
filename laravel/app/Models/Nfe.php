<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nfe extends Model {
    protected $table = 'nfes';
    protected $fillable = ['nr_nfe'];

    public function produtos() {
        return $this->hasMany(Produto::class);
    }
}
