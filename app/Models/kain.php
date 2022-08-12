<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kain extends Model
{
    use HasFactory;
    protected $table = 'master_kain';
    protected $guarded = ['id'];
}
