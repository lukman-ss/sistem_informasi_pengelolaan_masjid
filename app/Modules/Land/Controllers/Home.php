<?php namespace App\Modules\Land\Controllers;
use App\Modules\Galeri\Models\GaleriModel;
use App\Modules\Transaksi\Models\TransaksiModel;
use App\Modules\Pengumuman\Models\PengumumanModel;
use App\Modules\Berita\Models\BeritaModel;

class Home extends BaseController
{
	public function index()
	{
		$this->GaleriModel = new GaleriModel;
		// $this->TransaksiModel = new TransaksiModel;
		$this->PengumumanModel = new PengumumanModel;
		$this->BeritaModel = new BeritaModel;

		$data['pengumuman'] = $this->PengumumanModel->limit(1)->get()->getResultArray()[0];
		$data['galeri'] = $this->GaleriModel->get()->getResultArray();
		$data['berita'] = $this->BeritaModel->limit(1)->get()->getResultArray()[0];
		return view('template/landing', $data);
	}

	//--------------------------------------------------------------------

}
