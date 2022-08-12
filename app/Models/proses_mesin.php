<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proses_mesin extends Model
{
    protected $table = 'proses_mesin';
    protected $guarded = ['id'];
    use HasFactory;
}
