<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub extends Model
{
    protected $guarded = [];
    public function produit()
    {
        return $this->belongsTo('App\Produit', 'product_id', 'product_id');

    }
}
