<?php namespace App\Modules\Login\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table      = "user";
    protected $primaryKey = "id";

    protected $returnType     = array();
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'nama', 
        'email', 
        'image', 
        'role_id', 
        'is_active', 
        'date_created',
    ];

    protected $useTimestamps = false;
    // protected $createdField  = "created_at";
    // protected $updatedField  = "updated_a";
    // protected $deletedField  ="deleted_at";

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}