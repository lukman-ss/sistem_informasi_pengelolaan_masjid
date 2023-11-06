<?php namespace App\Modules\User\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = "user";
    protected $primaryKey = "id";

    protected $returnType     = array();
    protected $useSoftDeletes = true;

    protected $allowedFields = 
    ['nama', 'email', 'password', 'image', 'role_id', 'is_active', 'status'];

    protected $useTimestamps = false;
    protected $createdField  = "created_at";
    protected $updatedField  = "updated_a";
    protected $deletedField  ="deleted_at";

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}