<?php

namespace App\Imports;

use App\Models\Warga;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WargaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Warga([
            'nik' => $row['nik'],
            'nama_lengkap' => $row['nama_lengkap'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            'alamat' => $row['alamat'],
            'rt' => $row['rt'],
            'rw' => $row['rw'],
            'no_kk' => $row['no_kk'],
            'pendidikan' => $row['pendidikan'],
            'agama' => $row['agama'],
            'status_keluarga' => $row['status_keluarga'],
            'status_perkawinan' => $row['status_perkawinan'],
            'pekerjaan' => $row['pekerjaan'],
            'no_hp' => $row['no_hp'],
            'status_rumah' => $row['status_rumah'],
            'status_warga' => $row['status_warga'],
        ]);
    }
}
