<?php

namespace App\Models;

use CodeIgniter\Model;

class HewanModel extends Model
{
    protected $table = 'hewan';
    protected $primaryKey = 'id_hewan';
    protected $allowedFields = [
        'nama_hewan', 'Jenis_hewan', 'Ras_hewan', 
        'warna_bulu', 'warna_mata', 'jenis_kelamin', 
        'ciri_khas', 'foto_hewan'
    ];
    protected $returnType = 'array';
}
