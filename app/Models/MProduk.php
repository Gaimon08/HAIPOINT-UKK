<?php

namespace App\Models;

use CodeIgniter\Model;

class MProduk extends Model
{
    protected $table            = 'tbl_produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_produk', 'barcode', 'nama_produk', 'id_jenis_produk', 'stok', 'id_satuan', 'harga_beli', 'harga_jual'];

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

    // JOIN
    public function getAllproduk()
    {
        $produk = new MProduk;
        $produk->select('tbl_produk.barcode, tbl_produk.nama_produk, tbl_jenis_produk.id_jenis_produk, tbl_jenis_produk.nama_jenis, tbl_produk.stok, tbl_produk.harga_beli, tbl_produk.harga_jual, tbl_produk.id_produk,
        tbl_satuan.id_satuan, tbl_satuan.nama_satuan');
        $produk->join('tbl_jenis_produk', 'tbl_jenis_produk.id_jenis_produk=tbl_produk.id_jenis_produk');
        $produk->join('tbl_satuan', 'tbl_satuan.id_satuan=tbl_produk.id_satuan');
        return $produk->findAll();
    }

    public function deleteProduct($id)
    {
        $query = $this->db->table('tbl_produk')->delete(array('id_produk' => $id));
        return $query;
    }

    // public function getAllproduk()
    // {
    //     $builder = $this->db->table('tbl_produk');
    //     $builder->select('tbl_produk.barcode, tbl_produk.nama_produk, tbl_jenis_produk.nama_jenis, tbl_produk.stok, tbl_produk.harga_beli, tbl_produk.harga_jual, tbl_produk.id_produk, tbl_satuan.nama_satuan');
    //     $builder->join('tbl_jenis_produk', 'tbl_jenis_produk.id_jenis_produk = tbl_produk.id_jenis_produk');
    //     $builder->join('tbl_satuan', 'tbl_satuan.id_satuan = tbl_produk.id_satuan');
    //     return $builder->get()->getResult();
    // }
}
