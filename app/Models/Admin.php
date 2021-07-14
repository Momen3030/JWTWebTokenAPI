<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
class Admin  extends Authenticatable implements JWTSubject
{
    protected $table='admins';
    protected $fillable = ['email', 'password'];
    public function  products(){
        return $this->hasMany(Product::class);
    }


    public function getJWTIdentifier()
        {
            return $this->getKey();
        }
        public function getJWTCustomClaims()
        {
            return [];
        }
}