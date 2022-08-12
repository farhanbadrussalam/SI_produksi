<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    use HasFactory;
    protected $table = 'tbl_jadwal';
    protected $with = ['mesin', 'user'];
    protected $guarded = ['id'];

    public function mesin()
    {
        return $this->belongsTo(mesin::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
