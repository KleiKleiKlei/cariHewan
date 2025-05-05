<?php

namespace App\Controllers;

use App\Models\HewanModel;
use App\Models\LaporanModel;

helper('BingMaps');

class Laporan extends BaseController
{
    protected $hewanModel;
    protected $laporanModel;
    protected $session;

    public function __construct()
    {
        $this->hewanModel = new HewanModel();
        $this->laporanModel = new LaporanModel();
        $this->session = session();
    }

    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        $model = new \App\Models\LaporanModel();
        
        // Get all reports for current user with pet and user details
        $data['laporan'] = $model->select('laporan.*, hewan.*, users.nomor_telepon')
            ->join('hewan', 'hewan.id_hewan = laporan.id_hewan')
            ->join('users', 'users.id_user = laporan.id_user')
            ->where('laporan.id_user', session()->get('user_id'))
            ->orderBy('tanggal_laporan', 'DESC')
            ->findAll();

        return view('laporan/riwayat', $data);
    }

    public function riwayat()
    {
        // Check if user is logged in
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        $laporanModel = new LaporanModel();
        
        // Get all reports for current user with pet details
        $data['laporan'] = $laporanModel->select('
            laporan.*,
            hewan.*,
            DATE_FORMAT(laporan.tanggal_laporan, "%d %M %Y") as formatted_date
        ')
        ->join('hewan', 'hewan.id_hewan = laporan.id_hewan')
        ->where('laporan.id_user', session()->get('user_id'))
        ->orderBy('laporan.tanggal_laporan', 'DESC')
        ->findAll();

        return view('laporan/riwayat', $data);
    }

    public function buat()
    {
        $data['title'] = 'Buat Laporan';
        return view('laporan/buat', $data);
    }

    public function saveLaporanHilang()
    {
        // Check login
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Validation rules
        $rules = [
            'nama_hewan' => 'required|min_length[3]',
            'Jenis_hewan' => 'required|min_length[3]',
            'Ras_hewan' => 'required|min_length[3]',
            'warna_bulu' => 'required',
            'warna_mata' => 'required',
            'jenis_kelamin' => 'required|in_list[Jantan,Betina,Tidak Tahu]',
            'ciri_khas' => 'required|min_length[5]',
            'foto_hewan' => 'uploaded[foto_hewan]|is_image[foto_hewan]|mime_in[foto_hewan,image/jpg,image/jpeg,image/png]',
            'deskripsi_laporan' => 'required|min_length[10]',
            'lokasi_terakhir' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', $this->validator->listErrors());
        }

        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            // Handle file upload
            $foto = $this->request->getFile('foto_hewan');
            $namaFoto = $foto->getRandomName();
            
            // Create directory if not exists
            if (!is_dir('uploads/pet_photos')) {
                mkdir('uploads/pet_photos', 0777, true);
            }
            
            // Move file
            $foto->move('uploads/pet_photos', $namaFoto);

            // Prepare hewan data
            $hewanData = [
                'nama_hewan' => $this->request->getPost('nama_hewan'),
                'Jenis_hewan' => $this->request->getPost('Jenis_hewan'),
                'Ras_hewan' => $this->request->getPost('Ras_hewan'),
                'warna_bulu' => $this->request->getPost('warna_bulu'),
                'warna_mata' => $this->request->getPost('warna_mata'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'ciri_khas' => $this->request->getPost('ciri_khas'),
                'foto_hewan' => $namaFoto,
                'status_reunifikasi' => 'Belum kembali',
                'id_user' => $this->session->get('id_user')
            ];

            // Insert hewan
            $this->hewanModel->insert($hewanData);
            $idHewan = $this->hewanModel->insertID();

            // Prepare laporan data
            $laporanData = [
                'id_hewan' => $idHewan,
                'deskripsi_laporan' => $this->request->getPost('deskripsi_laporan'),
                'tipe_laporan' => 'Hilang',
                'tanggal_laporan' => date('Y-m-d H:i:s'),
                'lokasi_terakhir' => $this->request->getPost('lokasi_terakhir'),
                'latitude' => $this->request->getPost('latitude'),
                'longitude' => $this->request->getPost('longitude'),
                'id_user' => $this->session->get('id_user'),
                'status_laporan' => 'Aktif',
                'status_admin' => 'no'
            ];

            // Insert laporan
            $this->laporanModel->insert($laporanData);

            $db->transCommit();
            
            return redirect()->to('laporan/success')
                ->with('success', 'Terima kasih! Laporan hewan hilang berhasil disimpan.');

        } catch (\Exception $e) {
            $db->transRollback();
            
            // Delete uploaded file if exists
            if (isset($namaFoto) && file_exists('uploads/pet_photos/' . $namaFoto)) {
                unlink('uploads/pet_photos/' . $namaFoto);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function lost()
    {
        $data['title'] = 'Laporan Hewan Hilang';
        return view('laporan/lost', $data);
    }

    public function saveLost()
    {
        // Start database transaction
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Initialize models
            $hewanModel = new HewanModel();
            $laporanModel = new LaporanModel();

            // Handle file upload
            $foto = $this->request->getFile('foto_hewan');
            $fotoName = null;
            
            if ($foto->isValid() && !$foto->hasMoved()) {
                $fotoName = $foto->getRandomName();
                $foto->move('./uploads', $fotoName);
            }

            // Prepare hewan data
            $hewanData = [
                'nama_hewan' => $this->request->getPost('nama_hewan'),
                'Jenis_hewan' => $this->request->getPost('Jenis_hewan'),
                'Ras_hewan' => $this->request->getPost('Ras_hewan'),
                'warna_bulu' => $this->request->getPost('warna_bulu'),
                'warna_mata' => $this->request->getPost('warna_mata'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'ciri_khas' => $this->request->getPost('ciri_khas'),
                'foto_hewan' => $fotoName,
            ];

            // Insert hewan data
            $id_hewan = $hewanModel->insert($hewanData);

            // Get coordinates for reverse geocoding
            $lat = $this->request->getPost('latitude');
            $lng = $this->request->getPost('longitude');
            
            // Prepare laporan data
            $laporanData = [
                'id_user' => session()->get('user_id'),
                'id_hewan' => $id_hewan,
                'deskripsi_laporan' => $this->request->getPost('deskripsi_laporan'),
                'lokasi_terakhir' => $this->request->getPost('lokasi_terakhir'),
                'latitude' => $lat,
                'longitude' => $lng,
                'tanggal_laporan' => date('Y-m-d H:i:s'),
                'status_admin' => 'pending',
                'tipe_laporan' => 'Hilang'
            ];

            // Insert laporan data
            $laporanModel->insert($laporanData);

            // Commit transaction
            $db->transComplete();

            if ($db->transStatus() === false) {
                // Transaction failed
                return redirect()->back()
                    ->with('error', 'Terjadi kesalahan saat menyimpan laporan.')
                    ->withInput();
            }

            // Success
            return redirect()->to('/')
                ->with('success', 'Laporan berhasil dikirim dan menunggu persetujuan admin.');

        } catch (\Exception $e) {
            // Roll back transaction on error
            $db->transRollback();
            
            log_message('error', $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function success()
    {
        // Add this method after your existing methods
        if (!session()->has('success')) {
            return redirect()->to('/laporan');
        }
        
        $data['title'] = 'Laporan Berhasil';
        return view('laporan/success', $data);
    }

    public function ditemukan()
    {
        $data['title'] = 'Laporan Hewan Ditemukan';
        return view('laporan/ditemukan', $data);
    }

    public function saveDitemukan()
    {
        // Start database transaction
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Initialize models
            $hewanModel = new HewanModel();
            $laporanModel = new LaporanModel();

            // Handle file upload
            $foto = $this->request->getFile('foto_hewan');
            $fotoName = null;
            
            if ($foto->isValid() && !$foto->hasMoved()) {
                $fotoName = $foto->getRandomName();
                $foto->move('./uploads', $fotoName);
            }

            // Prepare hewan data
            $hewanData = [
                'nama_hewan' => $this->request->getPost('nama_hewan'),
                'Jenis_hewan' => $this->request->getPost('Jenis_hewan'),
                'Ras_hewan' => $this->request->getPost('Ras_hewan'),
                'warna_bulu' => $this->request->getPost('warna_bulu'),
                'warna_mata' => $this->request->getPost('warna_mata'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'ciri_khas' => $this->request->getPost('ciri_khas'),
                'foto_hewan' => $fotoName,
            ];

            // Insert hewan data
            $id_hewan = $hewanModel->insert($hewanData);

            // Get coordinates
            $lat = $this->request->getPost('latitude');
            $lng = $this->request->getPost('longitude');
            
            // Prepare laporan data with explicit status_admin set to 'no'
            $laporanData = [
                'id_user' => session()->get('user_id'),
                'id_hewan' => $id_hewan,
                'deskripsi_laporan' => $this->request->getPost('deskripsi_laporan'),
                'lokasi_terakhir' => $this->request->getPost('lokasi_terakhir'),
                'latitude' => $lat,
                'longitude' => $lng,
                'tanggal_laporan' => date('Y-m-d H:i:s'),
                'status_admin' => 'no',  // Explicitly set to 'no'
                'tipe_laporan' => 'Ditemukan'
            ];

            // Insert laporan data
            $laporanModel->insert($laporanData);

            // Commit transaction
            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()
                    ->with('error', 'Terjadi kesalahan saat menyimpan laporan.')
                    ->withInput();
            }

            return redirect()->to('/')
                ->with('success', 'Laporan berhasil dikirim dan menunggu persetujuan admin.');

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function delete($id)
    {
        // Check if user is logged in
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        // Start transaction
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $laporanModel = new LaporanModel();
            $hewanModel = new HewanModel();

            // Get the report
            $laporan = $laporanModel->find($id);

            // Check if report exists and belongs to current user
            if ($laporan && $laporan['id_user'] == session()->get('user_id')) {
                // Get the associated hewan id
                $id_hewan = $laporan['id_hewan'];

                // Delete the report first (child)
                $laporanModel->delete($id);

                // Then delete the pet record (parent)
                $hewanModel->delete($id_hewan);

                // Complete transaction
                $db->transComplete();

                if ($db->transStatus() === false) {
                    throw new \Exception('Failed to delete report');
                }

                // Success
                return redirect()->to('/laporan/riwayat')
                    ->with('success', 'Laporan berhasil dihapus');
            }

            return redirect()->to('/laporan/riwayat')
                ->with('error', 'Laporan tidak ditemukan atau Anda tidak memiliki akses');

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', $e->getMessage());
            
            return redirect()->to('/laporan/riwayat')
                ->with('error', 'Gagal menghapus laporan: ' . $e->getMessage());
        }
    }
}