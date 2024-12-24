<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Makul extends Model
{
    use HasFactory;

    protected $primaryKey = 'kode_makul';
    // Tipe data primary key adalah string
    public $incrementing = false; // Non-auto incrementing
    protected $keyType = 'string';
    protected $fillable = ['kode_makul', 'nama_makul', 'sks'];

    public function dosens()
    {
        return $this->hasMany(Dosen::class, 'kode_makul', 'kode_makul');
    }
}
