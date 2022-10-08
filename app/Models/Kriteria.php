<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $fillable     = ['kode','nama','atribut','bobot','keterangan','tipe'];
    protected $hidden       = ['created_at','updated_at'];

    public function sub(){
        return $this->hasMany(Subkriteria::class);
    }
}
