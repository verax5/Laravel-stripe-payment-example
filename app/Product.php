<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = ['title', 'snippet', 'slug', 'body', 'type', 'download', 'thumbnail', 'category_id'];

    public function user() {
        return $this->belongsTo(Product::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }
}