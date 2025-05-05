<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    protected $allowedFields = [
        'id_user', 'id_hewan', 'deskripsi_laporan',
        'lokasi_terakhir', 'latitude', 'longitude',
        'tanggal_laporan', 'status_admin', 'tipe_laporan'
    ];
    protected $returnType = 'array';

    public function getPendingReports()
    {
        return $this->select('
            laporan.*,
            hewan.*,
            users.nama as nama_pelapor,
            users.nomor_telepon,
            DATE_FORMAT(laporan.tanggal_laporan, "%d %M %Y") as formatted_date
        ')
            ->join('hewan', 'hewan.id_hewan = laporan.id_hewan')
            ->join('users', 'users.id_user = laporan.id_user')
            ->where('laporan.status_admin', 'no')  // Get all reports with 'no' status
            ->whereIn('laporan.tipe_laporan', ['Hilang', 'Ditemukan'])  // Include both report types
            ->orderBy('laporan.tanggal_laporan', 'DESC')
            ->findAll();
    }

    public function getApprovedReports()
    {
        return $this->select('
            laporan.*,
            hewan.*,
            users.nama as nama_pelapor,
            users.nomor_telepon,
            DATE_FORMAT(laporan.tanggal_laporan, "%d %M %Y") as formatted_date
        ')
            ->join('hewan', 'hewan.id_hewan = laporan.id_hewan')
            ->join('users', 'users.id_user = laporan.id_user')
            ->where('laporan.status_admin', 'yes')
            ->whereIn('laporan.tipe_laporan', ['Hilang', 'Ditemukan'])  // Include both report types
            ->orderBy('laporan.tanggal_laporan', 'DESC')
            ->findAll();
    }

    public function updateStatus($id_laporan, $status)
    {
        return $this->update($id_laporan, [
            'status_admin' => $status
        ]);
    }
}