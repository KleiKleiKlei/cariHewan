<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function saveRegister()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nama'            => 'required|alpha_space',
            'email'           => 'required|valid_email|is_unique[users.email]',
            'nomor_telepon'   => 'required|numeric|min_length[13]',
            'password'        => 'required|min_length[6]',
            'password_confirm'=> 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $userModel = new UserModel();

        $userModel->insert([
            'nama'           => $this->request->getPost('nama'),
            'email'          => $this->request->getPost('email'),
            'nomor_telepon'  => $this->request->getPost('nomor_telepon'),
            'password'       => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        return view('auth/redirect_home');
    }
}
