<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';
    public $primaryKey = 'id_user'; // Specify the primary key
    public $incrementing = false; // Specify if the primary key is auto-incrementing or not
    protected $keyType = 'string'; // Specify the data type of the primary key
    public $timestamps = false; // Specify if you want to automatically maintain the `created_at` and `updated_at` columns
    protected $fillable = [
        'id_user',
        'nama_user',
        'password',
        'id_divisi',
        'level',
        'nama_lengkap',
        'status_akun',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi dengan tabel divisi
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi', 'id_divisi');
    }
}
