<?php namespace App\Modules\Galeri\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table      = "gallery";
    protected $primaryKey = "id";

    protected $returnType     = array();
    protected $useSoftDeletes = true;

    protected $allowedFields = ['title', 'images', 'status'];

    protected $useTimestamps = false;
    protected $createdField  = "created_at";
    protected $updatedField  = "updated_a";
    protected $deletedField  ="deleted_at";

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}