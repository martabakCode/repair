<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;

    protected $table = 'spareparts';

    protected $primaryKey = 'id_sparepart';
    public $incrementing = false; // Specify if the primary key is auto-incrementing or not
    protected $keyType = 'string'; // Specify the data type of the primary key
    public $timestamps = false;
    protected $fillable = [
        'id_sparepart',
        'nama_sparepart',
        'merk_sparepart',
        'kapasitas',
        'id_divisi',
    ];

    // Relasi dengan tabel divisi
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id_divisi');
    }
}
