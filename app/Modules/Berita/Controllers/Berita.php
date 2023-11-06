<?php namespace App\Modules\Berita\Controllers;

use CodeIgniter\Controller;
use App\Modules\Berita\Models\BeritaModel;

class Berita extends Controller
{
    public function index()
    {
        $this->BeritaModel = new BeritaModel;
        $list = $this->BeritaModel->where('status', 0 )->get()->getResultArray();
        $data = [
            'title' => 'Berita Page', 
            'view' => 'metronics/berita/index',
            'data' => 'Berita',
            'list' => $list
        ];
        return view('template/metronic', $data);
    }
    public function store()
    {
        if (!$this->validate([
			'judul_berita' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
			'isi_berita' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
			
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $this->BeritaModel = new BeritaModel;

        $gambar = $this->request->getFile('gambar');
        $gambar_nama = $gambar->getRandomName();

        $check = $this->BeritaModel->where('judul_berita', trim($this->request->getPost('judul_berita')) )->get()->getNumRows();

        if($check == 0)
        {

            $insert = $this->BeritaModel->insert([
                'judul_berita' => trim($this->request->getPost('judul_berita')),
                'isi_berita' => trim($this->request->getPost('isi_berita')),
                'image' => $gambar_nama,
                'tanggal_berita' => date('Y-m-d'),
            ]);
    
            if($insert)
            {
                $gambar->move('uploads/berkas/', $gambar_nama);
            }else{
                session()->setFlashdata('error', 'Gagal input. Harap input ulang!');
		        return redirect()->to(base_url('berita'));

            }
        }else{
            session()->setFlashdata('error', 'Judul telah tersedia!');
		    return redirect()->to(base_url('berita'));

        }

		
		session()->setFlashdata('success', 'Berita Telah Disimpan');
		return redirect()->to(base_url('berita'));
    }
    public function update()
    {
        if (!$this->validate([
			'judul_berita' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
			'isi_berita' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
			
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $this->BeritaModel = new BeritaModel;
        

        $check = $this->BeritaModel->where('judul_berita', trim($this->request->getPost('judul_berita')) )->get()->getNumRows();

        if($check == 1)
        {
            session()->setFlashdata('error', 'Judul telah tersedia!');
        }else{
            $gambar = $this->request->getFile('gambar');
            if(isset($gambar))
            {
                $gambar_nama = $gambar->getRandomName();
                $update = $this->BeritaModel
                ->set('judul_berita',trim($this->request->getPost('judul_berita')))
                ->set('isi_berita',trim($this->request->getPost('isi_berita')))
                ->set('image',$gambar_nama)
                ->set('tanggal_berita', date('Y-m-d'))
                ->where('id_berita', $this->request->getPost('id_berita') )
                ->update();
    
                if($update)
                {
                    $gambar->move('uploads/berkas/', $gambar_nama);
                    session()->setFlashdata('success', 'Berita Telah Diupdate');
                }else{
                    session()->setFlashdata('error', 'Gagal input. Harap input ulang!');
		            return redirect()->to(base_url('berita'));

                }
            }else{
                $update = $this->BeritaModel
                ->set('judul_berita',trim($this->request->getPost('judul_berita')))
                ->set('isi_berita',trim($this->request->getPost('isi_berita')))
                ->set('tanggal_berita', date('Y-m-d'))
                ->where('id_berita', $this->request->getPost('berita_id') )
                ->update();
    
                if($update)
                {
                    session()->setFlashdata('success', 'Berita Telah Diupdate');
                }else{
                    session()->setFlashdata('error', 'Gagal input. Harap input ulang!');
		            return redirect()->to(base_url('berita'));

                }
            }
        }
		return redirect()->to(base_url('berita'));
    }
    public function delete(int $id)
    {
        $this->BeritaModel = new BeritaModel;

        $check = $this->BeritaModel->where('id_berita', $id)->get()->getNumRows();

        if($check == 1)
        {

            $update = $this->BeritaModel
            ->set('status', 1)
            ->where('id_berita', $id )
            ->update();

            if($update)
            {
                session()->setFlashdata('success', 'Berita Telah Dihapus');
            }else{
                session()->setFlashdata('error', 'Gagal input. Harap input ulang!');
            }
        }else{
            session()->setFlashdata('error', 'Data tidak tersedia!');
        }
		return redirect()->to(base_url('berita'));
    }
}
