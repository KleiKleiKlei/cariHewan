<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        $data['title'] = 'Daftar';
        return view('auth/register', $data);
    }

    public function saveRegister()
    {
        $model = new UserModel();
        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'matches[password]',
        ];

        if ($this->validate($rules)) {
            $data = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'nomor_telepon' => $this->request->getPost('nomor_telepon'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            $model->insert($data);
            session()->setFlashdata('success', 'Registrasi berhasil. Silakan login.');
            return redirect()->to('/login');
        } else {
            $data['validation'] = $this->validator;
            $data['title'] = 'Daftar';
            return view('auth/register', $data);
        }
    }

    public function login()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/');
        }
        $data['title'] = 'Masuk';
        return view('auth/login', $data);
    }
    

    public function processLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Akun tidak ditemukan atau email salah.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Kata sandi salah.');
        }

        // Login success
        session()->set('user_id', $user['id_user']);
        session()->set('user_email', $user['email']);
        session()->set('user_name', $user['nama']); // Add this line to use name in welcome message
        
        return redirect()->to('/')->with('success', 'Selamat datang kembali, ' . $user['nama'] . '! 🐾');
    }
    
    
    

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}