<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $guarded = [];

    public function subs()
    {
        return $this->hasMany('App\Sub', 'product_id');
    }
}
