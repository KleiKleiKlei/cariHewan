<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LaporanModel;

class DaftarHewan extends Controller
{
    public function hilang()
    {
        $model = new \App\Models\LaporanModel();
        
        // Get real data
        $data['laporan'] = $model->select('laporan.*, hewan.*, users.nomor_telepon')
            ->join('hewan', 'hewan.id_hewan = laporan.id_hewan')
            ->join('users', 'users.id_user = laporan.id_user')
            ->where('laporan.status_admin', 'yes')
            ->where('laporan.tipe_laporan', 'Hilang')
            ->paginate(9);

        // Add placeholder data if no real data exists
        if (empty($data['laporan'])) {
            $data['laporan'] = [
                [
                    'id_laporan' => 'demo1',
                    'nama_hewan' => 'Buddy',
                    'Jenis_hewan' => 'Anjing',
                    'Ras_hewan' => 'Golden Retriever',
                    'warna_bulu' => 'Coklat Keemasan',
                    'warna_mata' => 'Coklat',
                    'jenis_kelamin' => 'Jantan',
                    'ciri_khas' => 'Bekas luka di kaki kanan depan',
                    'foto_hewan' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/93/Golden_Retriever_Carlos_%2810581910556%29.jpg/500px-Golden_Retriever_Carlos_%2810581910556%29.jpg',
                    'lokasi_terakhir' => 'Taman Bungkul, Surabaya',
                    'tanggal_laporan' => '2025-05-03',
                    'nomor_telepon' => '081234567890',
                    'status_admin' => 'yes',
                    'tipe_laporan' => 'Hilang'
                ]
            ];
        }

        $data['pager'] = $model->pager;
        return view('daftar_hewan/hilang', $data);
    }

    public function lost()
    {
        $model = new \App\Models\LaporanModel();
        $data['laporan'] = $model->getFilteredLaporan();
        
        return view('laporan/lost', $data);
    }

    public function mencariPemilik()
    {
        $model = new \App\Models\LaporanModel();
        
        // Get real data
        $data['laporan'] = $model->select('laporan.*, hewan.*, users.nomor_telepon')
            ->join('hewan', 'hewan.id_hewan = laporan.id_hewan')
            ->join('users', 'users.id_user = laporan.id_user')
            ->where('laporan.status_admin', 'yes')
            ->where('laporan.tipe_laporan', 'Ditemukan')
            ->paginate(9);

        $data['pager'] = $model->pager;
        
        return view('daftar_hewan/mencariPemilik', $data);
    }
}

