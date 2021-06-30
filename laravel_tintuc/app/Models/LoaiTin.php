<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoaiTin extends Model
{
    use HasFactory;
    protected $table ="LoaiTin";

    public function theloai(){
        // ghép bảng N đến 1 ('Bảng tới', 'Khóa ngoại', 'Khóa chính)
        return $this->belongsTo('App\Models\TheLoai','idTheLoai', 'id');
    }

    public function tintuc(){
        return $this->hasMany('App\Models\TinTuc', 'idLoaiTin', 'id');
    }

}
