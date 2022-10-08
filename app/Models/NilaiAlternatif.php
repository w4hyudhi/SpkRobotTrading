<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAlternatif extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function sub() {
        return $this->belongsTo(Subkriteria::class,'subkriteria_id');
    }
    public function alternatif() {
        return $this->belongsTo(Alternatif::class,'alternatif_id');
    }
}
