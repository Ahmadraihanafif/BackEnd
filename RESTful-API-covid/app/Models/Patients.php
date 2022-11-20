<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = ['nama', 'phone', 'address', 'status', 'tgl_masuk', 'tgl_keluar'];
}
