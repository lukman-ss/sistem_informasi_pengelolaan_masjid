<?php namespace App\Modules\Transaksi\Controllers;

use CodeIgniter\Controller;
use App\Modules\Transaksi\Models\TransaksiModel;

class Transaksi extends Controller
{
    public function index()
    {
        $this->TransaksiModel = new TransaksiModel;

        $list = $this->TransaksiModel->get()->getResultArray();
        $data = [
            'title' => 'Transaksi Page', 
            'view' => 'metronics/transaksi/index', 
            'list' => $list,
        ];
        return view('template/metronic', $data);
    }
    public function update_valid(int $id, string $valid)
    {
        $this->TransaksiModel = new TransaksiModel;

        $this->TransaksiModel->set('is_valid', $valid)->where('id_transaksi', $id)->update();

        return redirect()->to('transaksi');
    }
    
    public function user_insert_transaksi()
    {
        $this->TransaksiModel = new TransaksiModel;
        // `deskripsi`, `jenis_transaksi`, `kategori_transaksi`, `nominal`
        $insert = $this->TransaksiModel->insert([
            'deskripsi'             => trim($this->request->getPost('deskripsi')),
            'jenis_transaksi'       => trim($this->request->getPost('jenis_transaksi')),
            'kategori_transaksi'    => trim($this->request->getPost('kategori_transaksi')),
            'nominal'               => trim($this->request->getPost('nominal')),
        ]);

        if($insert)
        {
            session()->setFlashdata('success', 'Transaksi Telah Disimpan');
        }else{
            session()->setFlashdata('error', 'Transaksi Gagal Disimpan');
        }
        return redirect()->to('/#transaksi');

    }
}
