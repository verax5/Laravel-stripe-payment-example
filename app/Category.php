<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    protected $fillable  = ['name', 'body', 'slug'];

    public function products() {
        return $this->hasMany(Product::class);
    }
}
