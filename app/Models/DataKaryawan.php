<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKaryawan extends Model
{
    protected $table = "karyawans";
    protected $fillable =['nip_karyawan','nama_karyawan','alamat_karyawan','notelp_karyawan','jabatan','department','jenis_kelamin'];
}
