<?php namespace App\Modules\Transaksi\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = "laporan_transaksi";
    protected $primaryKey = "id_transaksi";

    protected $returnType     = array();
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'tanggal_transaksi',
        'deskripsi',
        'jenis_transaksi',
        'kategori_transaksi',
        'nominal',
        'is_valid',
        'created_at',
    ];

    protected $useTimestamps = false;
    protected $createdField  = "created_at";
    protected $updatedField  = "updated_at";
    protected $deletedField  = "deleted_at";

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}