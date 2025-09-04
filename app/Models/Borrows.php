<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrows extends Model
{
    protected $fillable = [
        'id_anggota',
        'trans_number',
        'return_data',
        'note',
        'status',
    ];

    public function detailsBorrows()
    {
        return $this->hasMany(DetailBorrow::class,'id_borrow','id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_anggota','id');
    }
}
