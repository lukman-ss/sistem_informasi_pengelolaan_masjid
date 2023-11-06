<?php namespace App\Modules\Login\Controllers;

use CodeIgniter\Controller;
use App\Modules\Login\Models\LoginModel;

class Login extends Controller
{
    public function index()
    {
        $data = ['title' => 'Login Page',  'data' => 'Login'];
        return view('template/login', $data);
    }
    public function process()
    {
        if( !$this->validate([
			'username' 	=> 'required',
			'password' 	=> 'required|min_length[6]',
		]))
		{
			return $this->response->setJSON(['success' => false, 'data' => null, "message" => \Config\Services::validation()->getErrors()]);
		}
		$this->LoginModel = new LoginModel;
		$user  = $this->LoginModel
		->where('nama', $this->request->getVar('username'))->get()->getResultArray(1);

		if( $user )
		{
			if( sha1($this->request->getVar('password')) == $user[0]['password'])
			{
				session()->set('is_login', true);
				session()->set('user_username', $user[0]['nama']);
				session()->set('user_email', $user[0]['email']);
				return redirect()->to('dashboard');
			}else{
                // session set flash data
				return redirect()->to('login');
				// return $this->response->setJSON( ['success'=> false, 'message' => 'Failed Authenticate' ] )->setStatusCode(401);
			}
		}else{
            // session set flash data
            return redirect()->to('login');
			// return $this->response->setJSON( ['success'=> false, 'message' => 'User not found' ] )->setStatusCode(401);
		}
    }
}
