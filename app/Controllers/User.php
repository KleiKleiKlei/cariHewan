<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function profil()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $data['user'] = $userModel->find(session()->get('user_id'));
        $data['title'] = 'Profil Saya';

        return view('profil', $data);
    }
}