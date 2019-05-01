<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $fillable = ['user_id', 'order', 'paid', 'product_id', 'expires', 'subscribe_date'];
}
