<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = 'Beranda'; // Judul halaman
        return view('home', $data);
    }
}