<?php namespace App\Modules\Galeri\Controllers;

use CodeIgniter\Controller;
use App\Modules\Galeri\Models\GaleriModel;

class Galeri extends Controller
{
    public function index()
    {
        $this->GaleriModel = new galeriModel;
        $list = $this->GaleriModel->where('status', 0 )->get()->getResultArray();
        $data = [
            'title' => 'Galeri Page', 
            'view' => 'metronics/galeri/index',
            'data' => 'Galeri',
            'list' => $list
        ];
        return view('template/metronic', $data);
    }
    public function store()
    {
        if (!$this->validate([
			'title' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $this->GaleriModel = new GaleriModel;

        $gambar = $this->request->getFile('gambar');
        $gambar_nama = $gambar->getRandomName();

        $check = $this->GaleriModel->where('title', trim($this->request->getPost('title')) )->get()->getNumRows();

        if($check == 0)
        {

            $insert = $this->GaleriModel->insert([
                'title' => trim($this->request->getPost('title')),
                'images' => $gambar_nama,
            ]);
            if($insert)
            {
                $gambar->move('uploads/galeri/', $gambar_nama);
                session()->setFlashdata('success', 'galeri Telah Disimpan');
		        return redirect()->to(base_url('galeri'));
            }else{
                session()->setFlashdata('error', 'Gagal input. Harap input ulang!');
		        return redirect()->to(base_url('galeri'));

            }
        }else{
            session()->setFlashdata('error', 'Judul telah tersedia!');
		    return redirect()->to(base_url('galeri'));
        }
    }
    public function update()
    {
        if (!$this->validate([
			'title' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $this->GaleriModel = new GaleriModel;
        

        $check = $this->GaleriModel->where('title', trim($this->request->getPost('title')) )->get()->getNumRows();

        if($check == 1)
        {
            session()->setFlashdata('error', 'Judul telah tersedia!');
        }else{
            $gambar = $this->request->getFile('gambar');
            if(isset($gambar))
            {
                $gambar_nama = $gambar->getRandomName();
                $update = $this->GaleriModel
                ->set('title',trim($this->request->getPost('title')))
                ->set('images',$gambar_nama)
                ->where('id', $this->request->getPost('id') )
                ->update();
    
                if($update)
                {
                    $gambar->move('uploads/galeri/', $gambar_nama);
                    session()->setFlashdata('success', 'galeri Telah Diupdate');
                }else{
                    session()->setFlashdata('error', 'Gagal input. Harap input ulang!');
		            return redirect()->to(base_url('galeri'));

                }
            }else{
                $update = $this->GaleriModel
                ->set('title',trim($this->request->getPost('title')))
                ->where('id', $this->request->getPost('id') )
                ->update();
                if($update)
                {
                    session()->setFlashdata('success', 'galeri Telah Diupdate');
                }else{
                    session()->setFlashdata('error', 'Gagal input. Harap input ulang!');
		            return redirect()->to(base_url('galeri'));
                }
            }
        }
		return redirect()->to(base_url('galeri'));
    }
    public function delete(int $id)
    {
        $this->GaleriModel = new GaleriModel;

        $check = $this->GaleriModel->where('id', $id)->get()->getNumRows();

        if($check == 1)
        {

            $update = $this->GaleriModel
            ->set('status', 1)
            ->where('id', $id )
            ->update();

            if($update)
            {
                session()->setFlashdata('success', 'galeri Telah Dihapus');
            }else{
                session()->setFlashdata('error', 'Gagal input. Harap input ulang!');
            }
        }else{
            session()->setFlashdata('error', 'Data tidak tersedia!');
        }
		return redirect()->to(base_url('galeri'));
    }
}
