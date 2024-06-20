<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    use HasFactory;
    protected $table = 'mesin'; // Specify the table name explicitly if it differs from the model name convention
    public $primaryKey = 'id_mesin'; // Specify the primary key
    public $incrementing = false; // Specify if the primary key is auto-incrementing or not
    protected $keyType = 'string'; // Specify the data type of the primary key
    public $timestamps = false; // Specify if you want to automatically maintain the `created_at` and `updated_at` columns
    protected $fillable = [
        'id_mesin',
        'nama_mesin',
        'merk_mesin',
        'kapasitas',
        'id_divisi',
        'tahun_pembuatan',
        'periode_pakai',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id_divisi');
    }
}
