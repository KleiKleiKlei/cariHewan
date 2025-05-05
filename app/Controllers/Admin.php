<?php

namespace App\Controllers;

use App\Models\LaporanModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    public function login()
    {
        return view('admin/login');
    }

    public function verify()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($username === 'tf2pyro' && $password === 'firefirefire123') {
            session()->set('admin_logged_in', true);
            return redirect()->to('supersecret/dashboard');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function dashboard()
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('supersecret');
        }

        $laporanModel = new LaporanModel();
        $userModel = new UserModel();

        $data = [
            'title' => 'Admin Dashboard',
            'pending_reports' => $laporanModel->getPendingReports(),
            'approved_reports' => $laporanModel->getApprovedReports(),
            'total_users' => $userModel->countAllResults(),
            'users' => $userModel->findAll() // Add this line to get all users
        ];

        return view('admin/dashboard', $data);
    }

    public function approve($id)
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('supersecret');
        }

        $laporanModel = new LaporanModel();
        $laporanModel->update($id, ['status_admin' => 'yes']);
        return redirect()->back()->with('success', 'Report approved');
    }

    public function reject($id)
    {
        if (!session()->get('admin_logged_in')) {
            return redirect()->to('supersecret');
        }

        $laporanModel = new LaporanModel();
        $laporanModel->update($id, ['status_admin' => 'no']);
        return redirect()->back()->with('success', 'Report rejected');
    }

    public function updateReportStatus($id_laporan)
    {
        // Check if admin is logged in
        if (!session()->get('admin_logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request']);
        }

        $status = $this->request->getPost('status');
        if (!in_array($status, ['yes', 'no'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid status']);
        }

        $laporanModel = new LaporanModel();
        
        try {
            // Begin transaction
            $db = \Config\Database::connect();
            $db->transStart();

            // Update the status
            $result = $laporanModel->update($id_laporan, [
                'status_admin' => $status
            ]);

            if (!$result) {
                throw new \Exception('Failed to update status');
            }

            // Commit transaction
            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Status updated successfully'
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Status update failed: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ]);
        }
    }

    public function logout()
    {
        session()->remove('admin_logged_in');
        return redirect()->to('supersecret');
    }
}