<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Help extends Controller
{
    public function index()
    {
        $data['title'] = 'Bantuan - CariHewan';
        return view('help', $data);
    }
}