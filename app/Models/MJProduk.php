<?php

namespace App\Models;

use CodeIgniter\Model;

class MJProduk extends Model
{
    protected $table            = 'tbl_jenis_produk';
    protected $primaryKey       = 'id_jenis_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_jenis_produk', 'nama_jenis'];

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

    public function deleteJProduk($id)
    {
        $query = $this->db->table('tbl_jenis_produk')->delete(array('id_jenis_produk' => $id));
        return $query;
    }

    public function UpdateData($data)
    {
        $this->db->table('tbl_satuan')
            ->where('id_satuan', $data['id_satuan'])
            ->update($data);
    }
}
