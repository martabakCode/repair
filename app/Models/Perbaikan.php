<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    use HasFactory;
    protected $table = 'perbaikan';
    protected $primaryKey = 'id_perbaikan';
    public $incrementing = false; // Specify if the primary key is auto-incrementing or not
    protected $keyType = 'string'; // Specify the data type of the primary key
    public $timestamps = false; // Specify if you want to automatically maintain the `created_at` and `updated_at` columns
    protected $fillable = [
        'tgl_buat', 'id_mesin', 'id_user', 'judul', 'keterangan', 'id_teknisi', 'status','id_sparepart'
    ];

    // Definisikan relasi jika ada
    // Misalnya, relasi dengan model Mesin dan User
    public function mesin()
    {
        return $this->belongsTo(Mesin::class, 'id_mesin', 'id_mesin');
    }
    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'id_sparepart', 'id_sparepart');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'id_teknisi', 'id_user');
    }
}

