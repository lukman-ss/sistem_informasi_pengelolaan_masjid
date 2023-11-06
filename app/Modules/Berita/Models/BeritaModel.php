<?php namespace App\Modules\Berita\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table      = "berita";
    protected $primaryKey = "id_berita";

    protected $returnType     = array();
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'judul_berita', 'image', 'isi_berita', 'tanggal_berita','status'
    ];

    protected $useTimestamps = false;
    protected $createdField  = "created_at";
    protected $updatedField  = "updated_at";
    protected $deletedField  = "deleted_at";

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}