<?php namespace App\Modules\Keuangan\Controllers;

use CodeIgniter\Controller;
use App\Modules\Keuangan\Models\KeuanganModel;

class Keuangan extends Controller
{
    public function index()
    {
        $data = ['title' => 'Keuangan Page', 'view' => 'land/data', 'data' => 'Hello World from Keuangan Module -> Keuangan!'];
        return view('template/layout', $data);
    }
}
