<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    protected $fillable = ['name', 'price','description','admin_id'];
    protected $hidden = ['admin_id'];

    public function  admin(){
        return $this->belongsTo(Admin::class);
    }

}