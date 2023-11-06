<?php namespace App\Modules\Pengumuman\Models;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
    protected $table      = "pengumuman";
    protected $primaryKey = "id_pengumuman";

    protected $returnType     = array();
    protected $useSoftDeletes = true;

    protected $allowedFields = ['judul_pengumuman', 'isi_pengumuman', 'status'];

    protected $useTimestamps = false;
    protected $createdField  = "created_at";
    protected $updatedField  = "updated_a";
    protected $deletedField  ="deleted_at";

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}