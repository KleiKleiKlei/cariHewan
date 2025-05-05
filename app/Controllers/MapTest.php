<?php

namespace App\Controllers;

class MapTest extends BaseController
{
    public function index()
    {
        // Return view directly without layout
        return view('test/map_test');
    }
}