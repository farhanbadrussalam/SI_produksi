<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produksi extends Model
{
    use HasFactory;
    protected $table = 'tbl_produksi';
    protected $guarded = ['id'];
    protected $with = ['kain', 'jadwal'];

    public function kain()
    {
        return $this->belongsTo(kain::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(jadwal::class);
    }
}
