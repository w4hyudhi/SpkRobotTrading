<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function sub()
    {
        return $this->belongsToMany(Subkriteria::class,'nilai_alternatifs','alternatif_id','subkriteria_id');
    }
}
