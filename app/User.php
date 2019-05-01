<?php namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    protected $fillable = ['username', 'email', 'password', 'confirm_token'];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
