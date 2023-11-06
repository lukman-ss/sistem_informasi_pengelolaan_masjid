<?php namespace App\Modules\Pengumuman\Controllers;

use CodeIgniter\Controller;
use App\Modules\Pengumuman\Models\PengumumanModel;

class Pengumuman extends Controller
{
    public function index()
    {
        $this->PengumumanModel = new PengumumanModel;
        $list = $this->PengumumanModel->where('status', 0 )->get()->getResultArray();
        $data = [
            'title' => 'Pengumuman Page', 
            'view' => 'metronics/pengumuman/index',
            'data' => 'Pengumuman',
            'list' => $list
        ];
        return view('template/metronic', $data);
    }
    public function store()
    {
        if (!$this->validate([
			'judul_pengumuman' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
			'isi_pengumuman' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $this->PengumumanModel = new PengumumanModel;

        $check = $this->PengumumanModel->where('judul_pengumuman', trim($this->request->getPost('judul_pengumuman')) )->get()->getNumRows();

        if($check == 0)
        {
            $insert = $this->PengumumanModel->insert([
                'judul_pengumuman' => trim($this->request->getPost('judul_pengumuman')),
                'isi_pengumuman' => trim($this->request->getPost('isi_pengumuman')),
            ]);
            session()->setFlashdata('success', 'pengumuman Telah Disimpan');
		    return redirect()->to(base_url('pengumuman'));
        }else{
            session()->setFlashdata('error', 'Judul telah tersedia!');
		    return redirect()->to(base_url('pengumuman'));
        }
    }
    public function update()
    {
        if (!$this->validate([
			'judul_pengumuman' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
			'isi_pengumuman' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
			
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $this->pengumumanModel = new pengumumanModel;

        $check = $this->pengumumanModel->where('judul_pengumuman', trim($this->request->getPost('judul_pengumuman')) )->get()->getNumRows();

        if($check == 1)
        {
            session()->setFlashdata('error', 'Judul telah tersedia!');
        }else{
            $update = $this->pengumumanModel
            ->set('judul_pengumuman',trim($this->request->getPost('judul_pengumuman')))
            ->set('isi_pengumuman',trim($this->request->getPost('isi_pengumuman')))
            ->where('id_pengumuman', $this->request->getPost('id_pengumuman') )
            ->update();
            session()->setFlashdata('success', 'pengumuman Telah Diupdate');
        }
		return redirect()->to(base_url('pengumuman'));
    }
    public function delete(int $id)
    {
        $this->pengumumanModel = new pengumumanModel;

        $check = $this->pengumumanModel->where('id_pengumuman', $id)->get()->getNumRows();

        if($check == 1)
        {

            $update = $this->pengumumanModel
            ->set('status', 1)
            ->where('id_pengumuman', $id )
            ->update();

            if($update)
            {
                session()->setFlashdata('success', 'pengumuman Telah Dihapus');
            }else{
                session()->setFlashdata('error', 'Gagal input. Harap input ulang!');
            }
        }else{
            session()->setFlashdata('error', 'Data tidak tersedia!');
        }
		return redirect()->to(base_url('pengumuman'));
    }
}
