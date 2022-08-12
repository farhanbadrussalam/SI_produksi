<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mesin extends Model
{
    use HasFactory;
    protected $table = 'master_mesin';
    protected $guarded = ['id'];
    protected $with = ['proses_mesin'];

    public function proses_mesin()
    {
        return $this->hasMany(proses_mesin::class);
    }
}
