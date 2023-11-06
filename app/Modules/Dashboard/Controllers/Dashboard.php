<?php namespace App\Modules\Dashboard\Controllers;

use CodeIgniter\Controller;
use App\Modules\Dashboard\Models\DashboardModel;

class Dashboard extends Controller
{
    public function index()
    {
        $data = ['title' => 'Dashboard Page', 'view' => 'metronics/dashboard/index'];
        return view('template/metronic', $data);
    }
}
