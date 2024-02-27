<?php

namespace App\Models;

use CodeIgniter\Model;

class MSupplier extends Model
{
    protected $table            = 'tbl_supplier';
    protected $primaryKey       = 'id_supplier';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_supplier', 'nama_supplier', 'alamat_supplier', 'wa_supplier'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function deleteSupplier($id)
    {
        $query = $this->db->table('tbl_supplier')->delete(array('id_supplier' => $id));
        return $query;
    }
}
