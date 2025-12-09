<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    // Field yang bisa diisi massal
    protected $fillable = [
        'branch_id',
        'commission_name',
        'university',
        'chairman',
        'contact',
    ];

    // Relasi: komisariat milik satu cabang
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
