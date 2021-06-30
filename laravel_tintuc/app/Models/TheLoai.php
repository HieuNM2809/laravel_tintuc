<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    use HasFactory;
    protected $table ="TheLoai";

    public function loaitin(){
        // Ghép bảng 1 N ( hasMany:'model','khoaNgoai, 'khoaChinh' )
        return  $this->hasMany('App\Models\LoaiTin','idTheLoai', 'id');
    }
    public function tintuc(){
        // Ghép bảng thông qua bảng khác
        return $this->hasManyThrough(
            'App\Models\TinTuc',    //bảng liên kết tới
             'App\Models\LoaiTin',  // bảng thông qua
             'idTheLoai',            // khóa ngoại bảng thông qua
             'idLoaiTin',           // khóa ngoại bảng liên kết tới
             'id',                  // khóa chính bảng liên kết
             'id'                   // khóa chính bảng thông qua
        );
    }

}
