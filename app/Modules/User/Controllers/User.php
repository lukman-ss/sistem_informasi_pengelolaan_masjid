<?php namespace App\Modules\User\Controllers;

use CodeIgniter\Controller;
use App\Modules\User\Models\UserModel;

class User extends Controller
{
    public function index()
    {
        $this->UserModel = new UserModel;
        $list = $this->UserModel->where('status', 0 )->get()->getResultArray();
        $data = [
            'title' => 'User Page', 
            'view' => 'metronics/user/index',
            'data' => 'user',
            'list' => $list
        ];
        return view('template/metronic', $data);
    }
    public function store()
    {
        if (!$this->validate([
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
			'email' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $this->UserModel = new UserModel;

        $check = $this->UserModel
        ->where('email', trim($this->request->getPost('email')) )
        ->orWhere('nama', trim($this->request->getPost('nama')) )
        ->get()->getNumRows();

        if($check == 0)
        {
            $insert = $this->UserModel->insert([
                'email' => trim($this->request->getPost('email')),
                'nama' => trim($this->request->getPost('nama')),
                'password' => trim(sha1($this->request->getPost('password'))),
            ]);
            session()->setFlashdata('success', 'user Telah Disimpan');
		    return redirect()->to(base_url('user'));
        }else{
            session()->setFlashdata('error', 'User telah tersedia!');
		    return redirect()->to(base_url('user'));
        }
    }
    public function update()
    {
        if (!$this->validate([
			'email' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
			
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
        $this->UserModel = new UserModel;

        $check = $this->UserModel
        ->where('email', trim($this->request->getPost('email')) )
        ->orWhere('nama', trim($this->request->getPost('nama')) )
        ->get()->getNumRows();

        if($check == 1)
        {
            session()->setFlashdata('error', 'Judul telah tersedia!');
        }else{
            $update = $this->UserModel
            ->set('email',trim($this->request->getPost('email')))
            ->set('nama',trim($this->request->getPost('nama')))
            ->where('id', $this->request->getPost('id') )
            ->update();
            session()->setFlashdata('success', 'user Telah Diupdate');
        }
		return redirect()->to(base_url('user'));
    }
    public function delete(int $id)
    {
        $this->UserModel = new UserModel;

        $check = $this->UserModel->where('id', $id)->get()->getNumRows();

        if($check == 1)
        {

            $update = $this->UserModel
            ->set('status', 1)
            ->where('id', $id )
            ->update();

            if($update)
            {
                session()->setFlashdata('success', 'user Telah Dihapus');
            }else{
                session()->setFlashdata('error', 'Gagal input. Harap input ulang!');
            }
        }else{
            session()->setFlashdata('error', 'Data tidak tersedia!');
        }
		return redirect()->to(base_url('user'));
    }
}
