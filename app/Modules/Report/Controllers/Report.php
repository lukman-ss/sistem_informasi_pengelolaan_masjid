<?php namespace App\Modules\Report\Controllers;

use CodeIgniter\Controller;
use App\Modules\Report\Models\ReportModel;

class Report extends Controller
{
    public function index()
    {
        $data = ['title' => 'Report Page', 'view' => 'land/data', 'data' => 'Hello World from Report Module -> Report!'];
        return view('template/layout', $data);
    }
}
