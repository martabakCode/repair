<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialSeeder extends Seeder
{
    public function run()
    {
        DB::table('divisi')->insert([
            ['id_divisi' => 'DV001', 'nama_divisi' => 'Produksi'],
            ['id_divisi' => 'DV002', 'nama_divisi' => 'Maintenance'],
            ['id_divisi' => 'DV003', 'nama_divisi' => 'Moldshop'],
        ]);

        DB::table('level')->insert([
            ['id_level' => 1, 'level' => 'admin'],
            ['id_level' => 2, 'level' => 'user'],
            ['id_level' => 3, 'level' => 'teknisi'],
        ]);

        DB::table('mesin')->insert([
            ['id_mesin' => 'MC001', 'nama_mesin' => 'Mesin Pendingin Chiller', 'merk_mesin' => 'ThermoQ', 'kapasitas' => '1000', 'id_divisi' => 'DV001', 'tahun_pembuatan' => 2017, 'periode_pakai' => 2017],
            ['id_mesin' => 'MC002', 'nama_mesin' => 'Vibrating Screen', 'merk_mesin' => 'Crude Oil Tank', 'kapasitas' => '1400 – 3', 'id_divisi' => 'DV003', 'tahun_pembuatan' => 2016, 'periode_pakai' => 2017],
            ['id_mesin' => 'MC003', 'nama_mesin' => 'Boiler', 'merk_mesin' => 'Mitsubishi Heavy Ind', 'kapasitas' => '2000', 'id_divisi' => 'DV002', 'tahun_pembuatan' => 2017, 'periode_pakai' => 2018],
            ['id_mesin' => 'MC004', 'nama_mesin' => 'Sterilizer', 'merk_mesin' => 'Sumitomo', 'kapasitas' => '2000', 'id_divisi' => 'DV001', 'tahun_pembuatan' => 2017, 'periode_pakai' => 2018],
        ]);

        DB::table('spareparts')->insert([
            ['id_sparepart' => 'SP001', 'nama_sparepart' => 'Mesin Pendingin Chiller', 'merk_sparepart' => 'ThermoQ', 'kapasitas' => '1000', 'id_divisi' => 'DV001', 'tahun_pembuatan' => 2017],
            ['id_sparepart' => 'SP002', 'nama_sparepart' => 'Vibrating Screen', 'merk_sparepart' => 'Crude Oil Tank', 'kapasitas' => '1400 – 3', 'id_divisi' => 'DV003', 'tahun_pembuatan' => 2016],
            ['id_sparepart' => 'SP003', 'nama_sparepart' => 'Boiler', 'merk_sparepart' => 'Mitsubishi Heavy Ind', 'kapasitas' => '2000', 'id_divisi' => 'DV002', 'tahun_pembuatan' => 2017],
            ['id_sparepart' => 'SP004', 'nama_sparepart' => 'Sterilizer', 'merk_sparepart' => 'Sumitomo', 'kapasitas' => '2000', 'id_divisi' => 'DV001', 'tahun_pembuatan' => 2017],
        ]);

        DB::table('perawatan')->insert([
            ['id_jadwal' => 'SC001', 'tgl' => '2017-12-13', 'id_divisi' => 'DV002', 'id_mesin' => 'MC003', 'id_teknisi' => 'teknisi', 'point_chek' => 'Filter Oil', 'tgl_jadwal' => '2017-12-13', 'status' => 'Closed'],
        ]);

        DB::table('perbaikan')->insert([
            ['id_perbaikan' => 'TC0001', 'tgl_buat' => '2017-12-13', 'id_mesin' => 'MC003', 'id_user' => 'US001', 'judul' => 'Mesin Boiler Mati', 'keterangan' => 'Keluar Asap dan bau gosong', 'id_teknisi' => 'teknisi', 'status' => 'Closed'],
            ['id_perbaikan' => 'TC0002', 'tgl_buat' => '2017-12-14', 'id_mesin' => 'MC002', 'id_user' => 'US001', 'judul' => 'Temperatur Over', 'keterangan' => 'Over heating pada Top Cover', 'id_teknisi' => 'teknisi', 'status' => 'Open'],
            ['id_perbaikan' => 'TC0003', 'tgl_buat' => '2018-06-08', 'id_mesin' => 'MC002', 'id_user' => 'US001', 'judul' => 'Pengaruh Jejaring Sosial terha', 'keterangan' => 'Mantap', 'id_teknisi' => 'teknisi', 'status' => 'Open'],
        ]);

        DB::table('user')->insert([
            ['id_user' => 'US001', 'nama_user'=>'Sigit', 'nama_lengkap' => 'Sigit Dwi Prasetyo', 'password' => bcrypt('sigit'), 'id_divisi' => 'DV003', 'level' => 'admin'],
            ['id_user' => 'US002', 'nama_user'=>'Alvaaro', 'nama_lengkap' => 'Alvaaro Al Kahfi', 'password' => bcrypt('alvaro'), 'id_divisi' => 'DV002', 'level' => 'teknisi'],
            ['id_user' => 'US003', 'nama_user'=>'Rizal', 'nama_lengkap' => 'Rizal', 'password' => bcrypt('rizal'), 'id_divisi' => 'DV003', 'level' => 'user'],
        ]);
    }
}
