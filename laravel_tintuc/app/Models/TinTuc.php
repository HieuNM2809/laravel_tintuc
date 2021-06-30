<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    use HasFactory;
    protected $table ="TinTuc";

    public function loaitin(){
        return $this->belongsTo('App\Models\LoaiTin', 'idLoaiTin', 'id');
    }
    public function comment(){
        return $this->hasMany('App\models\Comment', 'idTinTuc', 'id');
    }
}
